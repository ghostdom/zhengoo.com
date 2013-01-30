<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * RenRen OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Ghostdom.wj
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

class OAuth2_Provider_RenRen extends OAuth2_Provider 
{

	/**
	 * @var 第三方来源名称 - 人人网 （renren）
	 */
	public $source 		= AUTH_SOURCE_NAME_RENREN;

	/**
	 * @var 第三方来源代号
	 */
	public $source_code = AUTH_SOURCE_RENREN; 
	/**
	 * @var  string  the method to use when requesting tokens
	 */
	public $method = 'POST';
	/**
	 * @var   host
	 */
	public $host = "https://api.renren.com/restserver.do";
	/**
	 * @var   return data
	 */
	public $format = 'json';

	/**
	 * @var 
	 */
	public $authorize_params = array(
		'x_renew' => 'true',
		'display' => 'touch'
	);
	
	/**
	 * @var scope
	 */
	public $scope = 'read_user_blog read_user_checkin read_user_feed read_user_guestbook read_user_invitation read_user_like_history read_user_message read_user_notification read_user_photo read_user_status read_user_album read_user_comment read_user_share read_user_request publish_blog publish_checkin publish_feed publish_share write_guestbook send_invitation send_request send_message send_notification photo_upload status_update create_album publish_comment operate_like admin_page';
	/**
	 * @var 
	 */
	private $api_fields_mapping = array(
		'users.getInfo' => 'uid,name,sex,star,zidou,vip,birthday,email_hash,tinyurl,headurl,mainurl,hometown_location,work_info,university_info,hs_info'
	);


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
		return 'https://graph.renren.com/oauth/authorize';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 换取access_token 请求地址
 	 * -----------------------------
	 */
	public function url_access_token()
	{
		return 'https://graph.renren.com/oauth/token';
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
		$this->api_url = $this->host;
		$params['v']            = '1.0';
		$params['access_token'] = $this->access_token;
		$params['format']       = $this->format;
		$params['method']       = $method;
		$params['fields']       = $this->api_fields_mapping[$method];
		return $params;
	}

	// --------------------------------------------------------------------

	public function get_user($uid)
	{
		$params = $this->_req_before('users.getInfo');
		$params['uids'] = $uid;
		$result = $this->_result($this->post($params));
		if($result){
			return $result[0];
		}
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
