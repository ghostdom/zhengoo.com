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
	 * 
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
	 * - 支持 新浪微博
	 * - 支持 点点网
	 * - 支持 淘宝网 
	 * -------------------------------
	 *
	 * @return void
	 */
	public function auth($source)
	{
		$this->load->library('oauth2');
		$oauth = $this->oauth2->provider($source);
		if (!$this->input->get('code')){
            $oauth->authorize();
        }else{
        	try{
        		$token = $oauth->access($this->input->get('code'));
        		$this->_build_auth($token, $source, $oauth);
        	}catch (OAuth2_Exception $e){
        		echo '请重新授权';
        	}        	
        }
	}

	// --------------------------------------------------------------------

	/**
	 * -------------------------------
	 * 处理认证后,授权信息
	 * -------------------------------
	 *
	 * @return void
	 */
	private function _build_auth(array $token, $source, $provider)
	{
		$this->load->config('auth');
		$this->load->helper('auth');
		$auth_key = $this->config->item($source.'_auth');
		foreach ($auth_key as $key => $value) {
			$auth[$value] = $token[$key];
		}
		$auth_source         = name_to_source($source);
		$auth['auth_source'] = $auth_source;
		
		if($auth_source == AUTH_SOURCE_QQ){
			$openid = $provider->get_user_id($auth['auth_access_token']);
			$auth['auth_user'] = $openid;
		}
		$is_auth = $this->auth->find_where(array('auth_user' => $auth['auth_user'], 'auth_source' => $auth_source));
		if($is_auth){
			$is_auth =$is_auth[0];
			if($auth['auth_access_token'] != $is_auth['auth_access_token']){
				$this->auth->update_where(array('auth_id' => $is_auth['auth_id']), $auth);
			}
			$this->load->model('user_model', 'user');
			$user = $this->user->find_by_id($is_auth['auth_uid']);
			$this->session->set_userdata(SESSION_USER, $user[0]);
			redirect('/home');
		}else{
			if($auth_source == AUTH_SOURCE_QQ){
				$oauth_user = $provider->get_user($auth['auth_access_token'], $openid);
			} else {
				$oauth_user = $provider->get_user($auth['auth_user']);
			}
			$user_key = $this->config->item($source.'_user');
			foreach ($user_key as $key => $value) {
				$user[$value] = $oauth_user[$key];
			}
			$this->session->set_userdata(SESSION_AUTH, $auth);
			$this->session->set_userdata(SESSION_AUTH_USER, $user);
			redirect('/signup');
		}
	}
}