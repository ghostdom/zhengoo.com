<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * www.ZhenGoo.com 
 *
 * 
 * 
 * @package		ZhenGoo
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @copyright	Copyright (c) 20012 - 2013, ZhenGoo.com.
 * @link		http://www.ZhenGoo.com
 * @version		0.1.0
 */

// --------------------------------------------------------------------

/**
 * ZhenGoo Authorize Controller
 *
 *
 *
 * @package		ZhenGoo
 * @subpackage	controllers
 * @category	controllers
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */

class Authorize extends ZG_Controller {

	/**
	 * ---------------------------
	 * 初始化 oauth 模型类
	 * ---------------------------
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('auth_model', 'auth');
	}

	// --------------------------------------------------------------------

	/**
	 * -------------------------------
	 * 第三方授权登陆
	 *
	 * - 新浪微博
	 * - 腾讯
	 * - 点点网
	 * - 淘宝网 
	 * - pocket
	 * - 微信
	 * -------------------------------
	 *
	 * @return void
	 */
	public function auth($source)
	{
		$this->load->library('oauth2');
		$oauth = $this->oauth2->provider($source);
		if (!$this->input->get('code')){
			if($this->input->get('return')){
				$this->session->set_userdata('oauth_return', TRUE);
			}
            $oauth->authorize();
        }else{
        	try{
        		$token = $oauth->access($this->input->get('code'));
        		$this->_build_auth($token, $oauth);
        	}catch (OAuth2_Exception $e){
        		echo '请重新授权';
        	}        	
        }
	}

	// --------------------------------------------------------------------


	/**
	 * -------------------------------
	 * 跳转第三方用户主页
	 * -------------------------------
	 *
	 * @return void
	 */
	public function home($user_login_name, $auth_source_str)
	{
		$user = $this->get_user_by_login_name($user_login_name);
		if($user){
			$this->load->config('auth');
			$auth_source = name_to_source($auth_source_str);
			$auth = $this->auth->find_where(array('auth_uid' => $user['user_id'], 'auth_source' => $auth_source));
			$home_url = $this->config->item($auth_source_str.'_home_url') . $auth[0]['auth_domain'];
			redirect($home_url);
		}else{
			echo '404';
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -------------------------------
	 * 处理认证后,授权信息
	 *
	 * - 如果首次授权 进入注册流程
	 * - 授权已存在 检查access_token 如果
	 * 有变化 则更新记录
	 * - 注： 腾讯返回access_token 和标准不太一样 以做特殊处理
	 * -------------------------------
	 *
	 * @param token  	第三方返回的token信息数据对象
	 * @param source 	第三方标识
	 * @param provider	第三方类实例
	 * @return void
	 */
	private function _build_auth(array $token, $provider)
	{
		$this->load->config('auth');
		$this->load->helper('auth');
		$auth_key = $this->config->item($provider->source.'_auth');
		foreach ($auth_key as $key => $value) {
				if(strpos($key, '|')){
					$keys = explode('|', $key);
					$auth[$value] = $token[$keys[0]][$keys[1]];
				}else{
					$auth[$value] = $token[$key];
				}
			}
		$auth['auth_source'] = $provider->source_code;
		
		if($provider->source_code == AUTH_SOURCE_QQ){
			$openid = $provider->get_user_id($auth['auth_access_token']);
			$auth['auth_user'] = $openid;
		}
		$cur_auth = $this->auth->find_where(array('auth_user' => $auth['auth_user'], 'auth_source' => $provider->source_code));
		
		if($this->session->userdata('oauth_return')){
			$this->_auth_bind($cur_auth, $auth, $provider, $auth_key);
		}else{
			if($cur_auth){
	  			$this->_auth_login($cur_auth[0], $auth);
			}else{
				$this->_auth_signup($provider, $auth, $auth_key);
			}
		}
		
	}

	// --------------------------------------------------------------------

	/**
	 * -------------------------------
	 * 授权已存在时，帮用户完成登录操作
	 * 同时更新access_token
	 * -------------------------------
	 *
	 * @param old_auth 	原授权信息
	 * @param new_auth 	新授权信息
	 * @return void
	 */
	function _auth_login($old_auth, $new_auth)
	{
		$this->_refresh_token($old_auth['auth_id'], $old_auth['auth_access_token'], $new_auth);
		$this->refresh_login($old_auth['auth_uid']);
		$this->_refresh_page();
	}

	// --------------------------------------------------------------------

	/**
	 * -------------------------------
	 * 授权未存在时，让用户进行帐号设置流程
	 * 此时不记录授权信息
	 * -------------------------------
	 *
	 * @param old_auth 	第三方类实例
	 * @param auth 	    授权信息
	 * @param auth_key 	本地授权对应信息
	 * @return void
	 */
	function _auth_signup($provider, $auth)
	{
		$oauth_user = $this->_get_auth_user($provider, $auth);
		$user_key = $this->config->item($provider->source.'_user');
		foreach ($user_key as $key => $value) {
			$user[$value] = $oauth_user[$key];
		}
		$auth['auth_domain'] = $this->_get_auth_domain($provider, $oauth_user);
		$this->session->set_userdata(SESSION_AUTH, $auth);
		$this->session->set_userdata(SESSION_AUTH_USER, $user);
		// $this->_refresh_page('/signup');
	}

	// --------------------------------------------------------------------

	/**
	 * -------------------------------
	 * 新增帐号绑定， 成功后记录授权信息
	 * 如果授权已存在，就将原授权先删除，保证一个授权只能授权一次
	 * - 同时更新用户绑定记录
	 * -------------------------------
	 *
	 * @param old_auth 	原授权信息
	 * @param new_auth 	新授权信息
	 * @return void
	 */
	function _auth_bind($old_auth, $new_auth, $provider, $auth_key)
	{
		$this->load->model('user_model', 'user');
		if($old_auth){
			if($old_auth[0]['auth_uid'] != $this->sess_user['user_id'])
			{
				echo "该帐号已授权与其他帐号，如需授权，请将其取消授权。";
				exit();
			}
			$this->auth->delete_by_id($old_auth[0]['auth_id']);	
		}

		$new_auth['auth_uid'] = $this->sess_user['user_id'];
		$new_auth['auth_time'] = time();
		if($provider->is_user_info_api){
			$oauth_user = $this->_get_auth_user($provider, $new_auth);
			$new_auth['auth_domain'] = $this->_get_auth_domain($provider, $oauth_user);
			$this->_logger->info($oauth_user);
		}
		$this->auth->insert($new_auth);
		$this->user->add_user_auth($this->sess_user['user_id'], $new_auth['auth_source'], $this->sess_user['user_oauths']);
		$this->session->unset_userdata('oauth_return');
		$this->refresh_login($this->sess_user['user_id']);
		$this->_refresh_page('/settings/connections/');
	}

	// --------------------------------------------------------------------

	/**
	 * -------------------------------
	 * 授权结束后，刷新页面
	 * - 默认 /home
	 * -------------------------------
	 *
	 * @param url 	结束后，返回地址
	 * @return void
	 */
	function _refresh_page($url = '/home')
	{
		echo '<script type="text/javascript"> parent.location.href = "' . $url . '" </script>';
	}

	// --------------------------------------------------------------------

	/**
	 * -------------------------------
	 * 如果授权已存在， 尝试更新access_token
	 * -------------------------------
	 *
	 * @param auth_id 	授权编号
	 * @param old_access_token 原授权access_token
	 * @param new_token 新授权信息
	 * @return void
	 */
	function _refresh_token($auth_id, $old_access_token, $new_token)
	{
		if($old_access_token != $new_token['auth_access_token'])
		{
			$this->auth->update_where(array('auth_id' => $auth_id), $new_token);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -------------------------------
	 * 获取第三方授权用户的 domain
	 * -------------------------------
	 *
	 * @param provider  	第三方实例
	 * @param auth 			授权信息
	 * @return array  		授权用户信息
	 */
	function _get_auth_user($provider, $auth)
	{
		if($provider->source_code == AUTH_SOURCE_QQ){
			$oauth_user = $provider->get_user($auth['auth_access_token'], $auth['auth_user']);
		} else {
			$provider->access_token = $auth['auth_access_token'];
			$oauth_user = $provider->get_user($auth[$provider->get_user_info_param]);
		}
		// var_dump($oauth_user);
		return $oauth_user;
	}

	// --------------------------------------------------------------------

	/**
	 * -------------------------------
	 * 获取第三方授权用户的 domain
	 * -------------------------------
	 *
	 * @param provider  	第三方实例
	 * @param auth_user 	授权用户信息
	 * @return string  		domain
	 */
	function _get_auth_domain($provider, $auth_user)
	{
		$auth_domain_key = $this->config->item('oauths_domain_key');
		$auth_domain = '';
		if(isset($auth_user[$auth_domain_key[$provider->source]])){
			$auth_domain = $auth_user[$auth_domain_key[$provider->source]];
			if($provider->source_code == AUTH_SOURCE_DIANDIAN){
				$auth_domain = serialize($auth_domain);
			}
		}
		return $auth_domain;
	}

	// --------------------------------------------------------------------

	/**
	 * -------------------------------
	 * 解除授权
	 * -------------------------------
	 *
	 * @param source_code 	授权第三方代码
	 * @return void
	 */
	function remove_bind()
	{
		if($this->is_ajax() && is_numeric($this->input->get('auth_source')))
		{
			$this->load->model('user_model', 'user');
			$this->user->remove_user_auth($this->sess_user['user_id'], $this->input->get('auth_source'), $this->sess_user['user_oauths']);
			$this->refresh_login($this->sess_user['user_id']);
			echo $this->auth->delete_where(array('auth_uid' => $this->sess_user['user_id'], 'auth_source' => $this->input->get('auth_source')));
		}
	}

}