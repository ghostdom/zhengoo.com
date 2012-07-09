<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * TaoBao OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Ghostdom.wj
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

class OAuth2_Provider_Taobao extends OAuth2_Provider 
{

	/**
	 * @var  string  the method to use when requesting tokens
	 */
	public $method = 'POST';
	/**
	 * @var   host
	 */
	public $host = "https://eco.taobao.com/router/rest";
	/**
	 * @var   return data
	 */
	public $format = 'json';

	// --------------------------------------------------------------------

	private $api_fields_mapping = array(
			'taobao.item.get' => 'num_iid,title,price'
		);

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
		return 'https://oauth.taobao.com/authorize';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 换取access_token 请求地址
 	 * -----------------------------
	 */
	public function url_access_token()
	{
		return 'https://oauth.taobao.com/token';
	}

	// --------------------------------------------------------------------

	private function _req_before($method)
	{
		$this->api_url = $this->host;
		$params['method']    = $method;
		$params['timestamp'] = date('Y-m-d H:m:s');
		$params['format']    = $this->format;
		
		$params['v']         = '2.0';
		$params['fields'] = $this->api_fields_mapping[$method];

		if($this->access_token){
			$params['access_token'] = $this->access_token;
		}else{
			$params['app_key']   =  $this->client_id;
			$params['nick'] = 'antszone旗舰店';
			//$this->headers = array('Authorization: Basic '. base64_encode($this->user_name . ':' . $this->password));
		}
		return $params;
	}

	// --------------------------------------------------------------------

	public function get_item($id)
	{
		$params = $this->_req_before('taobao.item.get');
		$params['num_iid'] = $id;
		// $params['fields'] = 'num_iid,title,price';
		return $this->get($params);
	}

}