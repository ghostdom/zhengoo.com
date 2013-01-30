<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * WeiXin OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Ghostdom.wj
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

class OAuth2_Provider_WeiXin extends OAuth2_Provider 
{
	public $source 		= AUTH_SOURCE_NAME_WEIXIN;
	
	public $source_code = AUTH_SOURCE_WEIXIN; 

	/**
	 * @var  string  the method to use when requesting tokens
	 */
	public $method = 'POST';
	/**
	 * @var   host
	 */
	public $host = "https://open.weixin.qq.com/";
	/**
	 * @var   return data
	 */
	public $format = 'json';
	/**
	 *
	 */
	public $app_key = 'appid';

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

	/**
	 * -----------------------------
	 * Oauht2 授权地址
 	 * -----------------------------
	 */
	public function url_authorize()
	{
		return 'https://open.weixin.qq.com/oauth';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 换取access_token 请求地址
 	 * -----------------------------
	 */
	public function url_access_token()
	{
		return 'https://api.weixin.qq.com/token';
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
			$this->api_url = "{$this->host}{$url}.{$this->format}";

		if($this->access_token){
			$params['access_token'] = $this->access_token;
		}else{
			$params['source'] = $this->client_id;
			$this->headers = array('Authorization: Basic '. base64_encode($this->user_name . ':' . $this->password));
		}
		return $params;
	}

}
