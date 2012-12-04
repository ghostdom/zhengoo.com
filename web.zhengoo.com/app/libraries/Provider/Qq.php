<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Weibo OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Ghostdom.wj
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */
class OAuth2_Provider_Qq extends OAuth2_Provider 
{
	/**
	 * @var  string  the method to use when requesting tokens
	 */
	public $method = 'GET';
	/**
	 * @var   host
	 */
	public $host = "https://graph.qq.com/";
	/**
	 * @var   return data
	 */
	public $format = 'json';

	/**
	 * @var socpe
	 */
	public $scope = "get_user_info,add_topic,get_info,add_share,get_fanslist,get_idolist,add_idol,add_pic_t,check_page_fans,do_like";

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * set property
	 * -----------------------------
	 *
	 * @param property_name
	 * @param value
	 * @return void
	 */
	function __set($property_name, $value)
	{
		$this->$property_name = $value;	
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * Oauht2 授权地址
 	 * -----------------------------
	 */
	public function url_authorize()
	{
		return 'https://graph.qq.com/oauth2.0/authorize';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 换取access_token 请求地址
 	 * -----------------------------
	 */
	public function url_access_token()
	{
		return 'https://graph.qq.com/oauth2.0/token';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 发起api请求前:
	 * - 构建api 请求地址
	 * - 判断是否Oauth2授权 访问接口
	 *    -- 非NULL Oauth2授权 请求参数加入access_token 值
	 *	  -- NULL   普通授权	  请求参数加入source 值为 app_key, 头部加入 用户名和密码
	 * -----------------------------
	 * 
	 * @param url 			请求地址
	 * @param access_token   access_token
	 * @return void
	 */
	private function _req_before($url)
	{
		if (strrpos($url, 'http://') !== 0 && strrpos($url, 'https://') !== 0) 
			$this->api_url = "{$this->host}{$url}";

		if($this->access_token){
			$params['access_token'] = $this->access_token;
		}else{
			// $params['source'] = $this->client_id;
			// $this->headers = array('Authorization: Basic '. base64_encode($this->user_name . ':' . $this->password));
		}
		$params['oauth_consumer_key'] = $this->client_id;
		$params['format'] = $this->format;
		return $params;
	}

	// --------------------------------------------------------------------

	/**
	 * --------------------------
	 * 根据access_token换取用户的ID，
     * 与QQ号码一一对应
	 * -------------------------- 
	 * 
	 * @param access_token 	授权code
	 * @return int openid
	 */
	public function get_user_id($access_token)
	{
		$this->access_token = $access_token;
		$params = $this->_req_before('oauth2.0/me');
		preg_match('/{.*}/', $this->get($params), $result);
		$result = json_decode($result[0], TRUE);
		return $result['openid'];
	}

	// --------------------------------------------------------------------

	/**
	 * --------------------------
	 * 获取腾讯微博登录用户的用户资料
	 * - 当openid 等于null 时，调用 get_user_id 获取openid
	 * -------------------------- 
	 * 
	 * @param access_token 	授权code
	 * @param openid 		openid 
	 * @return array user
	 */
	public function get_user($access_token, $openid = NULL)
	{
		if(empty($openid)){
			$openid = $this->get_user_id($access_token);
		}
		$params = $this->_req_before('user/get_info');
		$params['openid'] = $openid;
		$result = $this->get($params);
		return $result['data'];
	}

	// --------------------------------------------------------------------


}