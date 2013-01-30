<?php
/**
 * OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Phil Sturgeon
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

abstract class OAuth2_Provider
{
	/**
	 * @var CI
	 */
	protected $_ci;
	/**
	 * @var  string  provider name
	 */
	public $name;

	/**
	 * @var  string  uid key name
	 */
	public $uid_key = 'uid';

	/**
	 * @var  string  additional request parameters to be used for remote requests
	 */
	public $callback;

	/**
	 * @var  array  additional request parameters to be used for remote requests
	 */
	protected $params = array();

	/**
	 * @var http header
	 */
	protected $headers = array();

	/**
	 * @var  string  the method to use when requesting tokens
	 */
	protected $method = 'GET';

	/**
	 * @var  string  default scope (useful if a scope is required for user info)
	 */
	protected $scope;

	/**
	 * @var  string  scope separator, most use "," but some like Google are spaces
	 */
	protected $scope_seperator = ',';

	/**
	 * string user name
	 */
	protected $user_name;

	/**
	 * string  password
	 */
	protected $password;

	/**
	 * string access_token
	 */
	protected $access_token;

	/**
	 * int page number
	 */
	protected $page_count = 50;

	/**
	 * string api url
	 */
	protected $api_url = '';
	/**
	 * string boundary
	 */
	protected static $boundary = '';
	/**
	 * @var app key 
	 */
	protected $app_key = 'client_id';
	/**
	 * @var 是否有用户信息接口
	 */
	public $is_user_info_api = TRUE;
	/**
	 * @var 
	 */
	public $get_user_info_param = 'auth_user';
	/**
	 * @var
	 */
	public $authorize_params = array();
	/**
	 * @var logger
	 */
	protected $_logger;

	/**
	 * Overloads default class properties from the options.
	 *
	 * Any of the provider options can be set here, such as app_id or secret.
	 *
	 * @param   array   provider options
	 * @return  void
	 */
	public function __construct(array $options = array())
	{
		$this->_ci = get_instance();
		if ( ! $this->name)
		{
			// Attempt to guess the name from the class name
			$this->name = strtolower(substr(get_class($this), strlen('OAuth2_Provider_')));
		}

		$this->_ci->load->config('auth');
		$this->client_id     = $this->_ci->config->item($this->name . '_app_key');
		$this->client_secret = $this->_ci->config->item($this->name . '_app_secret');;
		$this->user_name     = $this->_ci->config->item($this->name . '_user_name');
		$this->password      = $this->_ci->config->item($this->name . '_password');

		isset($options['id']) and $this->client_id              = $options['id'];
		isset($options['secret']) and $this->client_secret      = $options['secret'];
		isset($options['callback']) and $this->callback         = $options['callback'];
		isset($options['scope']) and $this->scope               = $options['scope'];
		isset($options['access_token']) and $this->access_token = $options['access_token'];
		$this->redirect_uri = site_url(get_instance()->uri->uri_string());

		$this->_logger = $this->_logger = Logger::getLogger('Provider: ' . get_class($this));

	}

	/**
	 * Return the value of any protected class variable.
	 *
	 *     // Get the provider signature
	 *     $signature = $provider->signature;
	 *
	 * @param   string  variable name
	 * @return  mixed
	 */
	public function __get($property_name)
	{
		return $this->$property_name;
	}

	/**
	 * Returns the authorization URL for the provider.
	 *
	 *     $url = $provider->url_authorize();
	 *
	 * @return  string
	 */
	abstract public function url_authorize();

	/**
	 * Returns the access token endpoint for the provider.
	 *
	 *     $url = $provider->url_access_token();
	 *
	 * @return  string
	 */
	abstract public function url_access_token();

	/*
	* Get an authorization code from Facebook.  Redirects to Facebook, which this redirects back to the app using the redirect address you've set.
	*/	
	public function authorize($options = array())
	{
		$state = md5(uniqid(rand(), TRUE));
		get_instance()->session->set_userdata('state', $state);

		$params = array(
			$this->app_key 		=> $this->client_id,
			'redirect_uri' 		=> isset($options['redirect_uri']) ? $options['redirect_uri'] : $this->redirect_uri,
			'state' 			=> $state,
			'scope'				=> is_array($this->scope) ? implode($this->scope_seperator, $this->scope) : $this->scope,
			'response_type' 	=> 'code',
			// 'approval_prompt'   => 'force'
		);
		redirect($this->url_authorize().'?'.http_build_query($params));
	}

	/*
	* Get access to the API
	*
	* @param	string	The access code
	* @return	object	Success or failure along with the response details
	*/	
	public function access($code, $options = array())
	{
		$params = array(
			'client_id' 	=> $this->client_id,
			'client_secret' => $this->client_secret,
			'grant_type' 	=> isset($options['grant_type']) ? $options['grant_type'] : 'authorization_code',
			// 'scope'			=> isset($options['scope']) ? $options['scope'] : '',
		);

		switch ($params['grant_type'])
		{
			case 'authorization_code':
				$params['code'] = $code;
				$params['redirect_uri'] = isset($options['redirect_uri']) ? $options['redirect_uri'] : $this->redirect_uri;
			break;

			case 'password':
				$params['username'] = $this->user_name;
				$params['password'] = $this->password;
			break;

			case 'refresh_token':
				$params['refresh_token'] = $code;
			break;
		}

		$response = null;	
		$url = $this->url_access_token();
		$this->_ci->load->library('curl');
		if($this->headers)
			$this->_ci->curl->option(CURLOPT_HTTPHEADER, $this->headers);
		switch ($this->method)
		{
			case 'GET':

				// Need to switch to Request library, but need to test it on one that works
				$url .= '?'.http_build_query($params);
				$response = file_get_contents($url);

				parse_str($response, $return);

			break;

			case 'POST':
				

				$this->_ci->curl
					->create($url)
					->post($params, array('failonerror' => false));

				$response = $this->_ci->curl->execute();
				// echo $response;
				$return = json_decode($response,true);
			break;

			default:
				throw new OutOfBoundsException("Method '{$this->method}' must be either GET or POST");
		}

		if ( ! empty($return['error']))
		{
			throw new OAuth2_Exception($return);
		}
		
		// switch ($params['grant_type'])
		// {
		// 	case 'authorization_code':
		// 		return OAuth2_Token::factory('access', $return);
		// 	break;

		// 	case 'refresh_token':
		// 		return OAuth2_Token::factory('refresh', $return);
		// 	break;
		// }
		return $return;
	}

	/**
	 *
	 * 
	 */
	private function _http($method, $params = array()){
		$this->_ci->load->library('curl');
		if($this->headers)
			$this->_ci->curl->option(CURLOPT_HTTPHEADER, $this->headers);

		switch ($method) {
			case 'GET':
					$response = $this->_ci->curl->simple_get($this->api_url, $params);
				break;
			case 'POST':
					$response = $this->_ci->curl->simple_post($this->api_url, $params); 
				break;
		}

		// var_dump($response);
		$result = json_decode($response, true);

	
		if(empty($result)){
			return $response;
		}
		return $result;
	} 

	/**
	 *
	 */
	public function get($params = array()){
		return $this->_http('GET', $params);
	}

	/**
	 *
	 */
	public function post($params = array()){
		return $this->_http('POST', $params);
	}
}
