<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Pocket OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Ghostdom.wj
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

define('PAGE_STATE_READ', 	'read');		// 页面状态: 已读
define('PAGE_STATE_UNREAD', 'unread');		// 页面状态: 未读

class OAuth2_Provider_Pocket extends OAuth2_Provider 
{

	/**
	 * @var  string  the method to use when requesting tokens
	 */
	public $method = 'POST';
	/**
	 * @var   host
	 */
	public $host = "https://readitlaterlist.com/v2/";
	/**
	 * @var   return data
	 */
	public $format = 'json';

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
		return '';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 换取access_token 请求地址
 	 * -----------------------------
	 */
	public function url_access_token()
	{
		return '';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 构建api请求地址以及通用参数
 	 * -----------------------------
 	 * 
 	 * @param method 	api方法
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @return array    通用请求参数集合
	 */
	private function _req_before($method, $user_name, $password)
	{
		$this->api_url      = $this->host . $method;
		$params['apikey']   = $this->client_id;
		$params['username'] = $user_name;
		$params['password'] = $password;
		return $params;
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== 账号接口 ========== =
	// ================================

	/**
	 * -----------------------------
	 * 用户授权
 	 * -----------------------------
 	 * 
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @return void
	 */
	public function authorize($user_name, $password)
	{
		$params = $this->_req_before('auth', $user_name, $password);
		$this->post($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 用户注册
 	 * -----------------------------
 	 * 
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @return void
	 */
	public function singup($user_name, $password)
	{
		$params = $this->_req_before('signup', $user_name, $password);
		$this->post($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 用户相关信息统计
 	 * -----------------------------
 	 * 
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @return array    用户账号状态 (包括, 稍后阅读数量, 已读,未读)
	 */
	public function get_user_stats($user_name, $password)
	{
		$params = $this->_req_before('stats', $user_name, $password);
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据指定的key 获取用户该信息
 	 * -----------------------------
 	 * 
 	 * @param key 		
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @return 指定信息值
	 */
	private function _get_user_info($key, $user_name, $password)
	{
		$user_stats = $this->get_user_stats($user_name, $password);
		if($user_stats)
		{
			return $user_stats[$key];
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取用户id
 	 * -----------------------------
 	 * 	
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @return int 		用户id
	 */
	public function get_user_id($user_name, $password)
	{
		return $this->_get_user_info('user_since', $user_name, $password);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取用户稍后阅读总数
 	 * -----------------------------
 	 * 	
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @return int 		文章总数
	 */
	public function get_user_page_count($user_name, $password)
	{
		return $this->_get_user_info('count_list', $user_name, $password);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取用户稍后阅读已读总数
 	 * -----------------------------
 	 * 	
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @return int 		已读文章总数
	 */
	public function get_user_read_count($user_name, $password)
	{
		return $this->_get_user_info('count_read', $user_name, $password);
	}
	
	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取用户稍后阅读未读总数
 	 * -----------------------------
 	 * 	
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @return int 		未读文章总数
	 */
	public function get_user_unread_count($user_name, $password)
	{
		return $this->_get_user_info('count_unread', $user_name, $password);
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== List Management ========== =
	// ================================

	/**
	 * -----------------------------
	 * 添加稍后阅读文章
	 * - 支持批量添加
 	 * -----------------------------
 	 * 
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @param url 		文章地址
 	 * @param title 	文章标题
 	 * @return array    
	 */
	public function add_page($user_name, $password, $urls, $title = NULL) 
	{
		if(is_array($urls)){
			$json_urls = array();
			foreach ($urls as $url) {
				$array_url['url'] = $url;
				$json_urls[]= $array_url;
			}
			$params = $this->_req_before('send', $user_name, $password);
			$params['new'] = json_encode($json_urls);
			return $this->post($params);
		}else{
			$params = $this->_req_before('add', $user_name, $password);
			$params['url'] = $urls;
			if($title) $params['title'] = $title;
			return $this->post($params);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取稍后阅读文章列表
	 * - 支持分页获取
	 * - 支持按时间查询
	 * - 支持按状态查询
 	 * -----------------------------
 	 * 
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @param page 		页码
 	 * @param since 	起始时间戳
 	 * @param $state 	文章状态 已读/未读
 	 * @return array    文章集合
	 */
	public function get_page($user_name, $password, $page = 1, $since = NULL, $state = NULL)
	{
		$params = $this->_req_before('get', $user_name, $password);
		$params['page'] 	= $page;
		$params['count'] 	= $this->page_count;
		$params['tags'] 	= 1;

		if($since) $params['since']  = $since;
		if($state) $params['state'] = $state;
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取已读文章列表
	 * - 支持分页获取
	 * - 支持按时间查询
 	 * -----------------------------
 	 * 
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @param page 		页码
 	 * @param since 	起始时间戳
 	 * @return array    文章集合
	 */
	public function get_page_read($user_name, $password, $page = 1, $since = NULL)
	{
		return $this->get_page($user_name, $password, $page, $since, PAGE_STATE_READ);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取未读文章列表
	 * - 支持分页获取
	 * - 支持按时间查询
 	 * -----------------------------
 	 * 
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @param page 		页码
 	 * @param since 	起始时间戳
 	 * @return array    文章集合
	 */
	public function get_page_unread($user_name, $password, $page = 1, $since = NULL)
	{
		return $this->get_page($user_name, $password, $page, PAGE_STATE_UNREAD);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 将文章标记为已读
	 * - 支持批量标记
 	 * -----------------------------
 	 * 
 	 * @param user_name 用户名
 	 * @param password  用户密码
 	 * @param $urls 	所需要标记为已读的url,支持多个url
 	 * @return void
	 */
	public function mark_read($user_name, $password, $urls)
	{
		$read_json = array();
		if(is_array($urls)){
			foreach ($urls as $url) {
				$url_array['url'] = $url;
				$read_json[] =  $url_array;
			}
		}else{
			$url_array['url'] = $urls;
			$read_json[] = $url_array;
		}
		$params = $this->_req_before('send', $user_name, $password);
		$params['read'] = json_encode($read_json);
		return $this->post($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 修改文章标题
	 * - 支持批量修改
 	 * -----------------------------
 	 * 
 	 * @param user_name 		用户名
 	 * @param password  		用户密码
 	 * @param $url_and_tags 	所要修改的文章url以及对应标签 eg. array('url'=>'title')
 	 * @return void
	 */
	public function update_page_title($user_name, $password, $url_and_title)
	{
		$json_array = array();
		foreach ($url_and_title as $url => $title) {
			$array_url['url']   = $url;
			$array_url['title'] = $title;
			$json_array[]       = $array_url;
		}

		$params = $this->_req_before('send', $user_name, $password);
		$params['update_title'] = json_encode($json_array);
		return $this->post($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 修改文章标签
	 * - 支持批量修改
 	 * -----------------------------
 	 * 
 	 * @param user_name 		用户名
 	 * @param password  		用户密码
 	 * @param $url_and_tags 	所要修改的文章url以及对应标签 eg. array('url'=>'tag,tag,tag')
 	 * @return void
	 */
	public function update_page_tag($user_name, $password, $url_and_tags)
	{
		$json_array = array();
		foreach ($url_and_tags as $url => $tag) {
			$array_url['url']  = $url;
			$array_url['tags'] = $tag;
			$json_array[]      = $array_url;
		}

		$params = $this->_req_before('send', $user_name, $password);
		$params['update_tags'] = json_encode($json_array);
		return $this->post($params);
	}
}