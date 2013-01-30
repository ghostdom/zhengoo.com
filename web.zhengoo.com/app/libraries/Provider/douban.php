<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Douban OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Ghostdom.wj
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

class OAuth2_Provider_DouBan extends OAuth2_Provider 
{

	/**
	 * @var 第三方来源名称 - 豆瓣网 （douban）
	 */
	public $source 		= AUTH_SOURCE_NAME_DOUBAN;

	/**
	 * @var 第三方来源代号
	 */
	public $source_code = AUTH_SOURCE_DOUBAN; 
	/**
	 * @var  string  the method to use when requesting tokens
	 */
	public $method = 'POST';
	/**
	 * @var   host
	 */
	public $host = "https://api.douban.com/v2/";
	/**
	 * @var   return data
	 */
	public $format = 'json';

	// public $is_user_info_api = FALSE;

	// /**
	//  * @var 
	//  */
	// public $authorize_params = array(
	// 	'x_renew' => 'true',
	// 	'display' => 'touch'
	// );
	



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
		return 'https://www.douban.com/service/auth2/auth';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 换取access_token 请求地址
 	 * -----------------------------
	 */
	public function url_access_token()
	{
		return 'https://www.douban.com/service/auth2/token';
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
	private function _req_before($method)
	{
		if (strrpos($method, 'http://') !== 0 && strrpos($method, 'https://') !== 0) 
			$this->api_url = "{$this->host}{$method}";
		
		$params['apikey'] =  $this->client_id;
		return $params;
	}

	// --------------------------------------------------------------------

	public function get_user($uid)
	{
		$params = $this->_req_before('user/'.$uid);
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	private function _result($data)
	{
		if(isset($data['error_code'])){
			$this->_logger->info($data);
			return FALSE;
		}else{
			return $data;
		}
	}

}
