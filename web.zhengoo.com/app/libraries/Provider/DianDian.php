<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * DianDian OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Ghostdom.wj
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */
define('BLOG_POST_TYPE_ALL', 	'all');		// 博客文章类型: 所有
define('BLOG_POST_TYPE_TEXT',  	'text'); 	// 博客文章类型: 文字
define('BLOG_POST_TYPE_PHOTO', 	'photo');	// 博客文章类型: 图片
define('BLOG_POST_TYPE_AUDIO', 	'audio');	// 博客文章类型: 音乐
define('BLOG_POST_TYPE_VIDEO', 	'video');	// 博客文章类型: 视频
define('BLOG_POST_TYPE_LINK',  	'link');	// 博客文章类型: 链接

define('POST_STATE_PUBLISHED', 	'published'); 	// 博文发布状态: 发布
define('POST_STATE_DRAFT', 		'draft'); 		// 博文发布状态: 草稿
define('POST_STATE_QUEUE',  	'queue'); 		// 博文发布状态: 队列

class OAuth2_Provider_DianDian extends OAuth2_Provider 
{

	/**
	 * @var  string  the method to use when requesting tokens
	 */
	public $method = 'POST';
	/**
	 * @var   host
	 */
	public $host = "https://api.diandian.com/v1/";
	/**
	 * @var   return data
	 */
	public $format = 'json';

	/**
	 *
	 */
	public $scope = 'read,write';

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
		return 'https://api.diandian.com/oauth/authorize';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 换取access_token 请求地址
 	 * -----------------------------
	 */
	public function url_access_token()
	{
		return 'https://api.diandian.com/oauth/token';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取access_token 方式为 Client Credentials
 	 * -----------------------------
	 */
	private function _app_access_token()
	{
		// $this->method = 'GET';
		$option = array(
			'grant_type' => 'client_credentials',
			'scope'      => 'read,write'
			);
		$token  = $this->access('', $option);
		return isset($token['access_token']) ? $token['access_token'] : '';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取access_token 方式为 password
 	 * -----------------------------
	 */
	private function _password_access_token()
	{
		$option = array(
			'grant_type' => 'password',
			'scope'      => 'read,write'
			);
		$token  = $this->access('', $option);
		return isset($token['access_token']) ? $token['access_token'] : '';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  发起api请求前处理函数
	 * - 处理 api 请求地址
	 * - 处理 access_token
 	 * -----------------------------
 	 * 
 	 * @param url  api地址或方法
 	 * @return array 公共api请求参数
	 */
	private function _req_before($url)
	{	
		if (strrpos($url, 'http://') !== 0 && strrpos($url, 'https://') !== 0) 
			$this->api_url = "{$this->host}{$url}";

		if($this->access_token){
			$params['access_token'] = $this->access_token;
		}else{
			$params['access_token'] = $this->_password_access_token();
		}
		return $params;
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== 用户接口 ========== =
	// ================================

	/**
	 * -----------------------------
	 *  根据指定的api方法, 获取用户相关信息
 	 * -----------------------------
 	 * 
 	 * @param method 	api方法
 	 * @param page 		页码
 	 * @return array    用户相关信息集合
	 */
	private function _get_user($method, $page = NULL)
	{
		$params = $this->_req_before($method);
		if($page)
		{
			$params['limit']  = $this->page_count;
			$params['offset'] = ($page - 1);
		}
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取用户账号相关信息
	 *  包括关注博客数, 用户喜欢post数等
 	 * -----------------------------
 	 * 
 	 * @link http://doc.diandian.com/api/userinfo/
 	 * @return array    用户账号相关信息集合
	 */
	public function get_user_info()
	{
		return $this->_get_user('user/info');
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取用户所喜欢的博客文章
	 * - 包括文章详细信息, 喜欢的文章总数
 	 * -----------------------------
 	 * 
 	 * @link http://doc.diandian.com/api/likes/
 	 * @param page 		页码
 	 * @return array    用户喜欢的博文集合
	 */
	public function get_user_likes($page = 1)
	{
		return $this->_get_user('user/likes', $page);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取用户的所有关注
	 * - 包括关注blog数, 关注的博客信息, 博客名
	 *   博客域名, 最近更新时间
 	 * -----------------------------
 	 *
 	 * @link http://doc.diandian.com/api/following/
 	 * @param page 		页码
 	 * @return array    用户关注的博客集合
	 */
	public function get_user_follow($page =1)
	{

		return $this->_get_user('user/following', $page);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取用户订阅的标签
	 * - 包括标签数组
 	 * -----------------------------
 	 *
 	 * @link http://doc.diandian.com/api/mytags/
 	 * @return array    用户订阅的标签集合
	 */
	public function get_user_tag()
	{
		return $this->_get_user('tag/mytags');
	}


	// --------------------------------------------------------------------
	// ================================
	// = ========== 博客接口 ========== =
	// ================================


	/**
	 * -----------------------------
	 *  获取博客信息
 	 * -----------------------------
 	 *
 	 * @link http://doc.diandian.com/api/blogInfo/
 	 * @param domain 	博客域名
 	 * @return array    博客信息集合
	 */
	public function get_blog_info($domain)
	{
		$url = 'blog/' . $domain . '/info';
		$params = $this->_req_before($url);
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取头像url
 	 * -----------------------------
 	 *
 	 * @link http://doc.diandian.com/api/avatar/
 	 * @param domain 	博客域名
 	 * @param size 		只提供57x57,72x72,114x114,144x144大小的头像 默认:114
 	 * @return array    blog头像url地址
	 */
	public function get_blog_avatar($domain, $size = 114)
	{
		$url = 'blog/'.$domain.'/avatar/'.$size;
		$this->_req_before($url);
		return $this->api_url;
	} 

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取博客粉丝
 	 * -----------------------------
 	 *
 	 * @link http://doc.diandian.com/api/followers/
 	 * @param domain 	博客域名
 	 * @param page 		页码
 	 * @return array    用户订阅的标签集合
	 */
	public function get_blog_fans($domain, $page = 1)
	{
		$url              = 'blog/'.$domain.'/followers';
		$params           = $this->_req_before($url);
		$params['limit']  = $this->page_count;
		$params['offset'] = ($page - 1);
		return $this->get($params);
	}
	// --------------------------------------------------------------------
	// ================================
	// = ========== 动态接口 ========== =
	// ================================

	/**
	 * -----------------------------
	 * 构建获取博文请求
	 * - 获取个人首页博文动态
	 * - 获取标签博文动态
 	 * -----------------------------
 	 *
 	 * @param method 	api方法
 	 * @param page 		页码
 	 * @param since_id  如果有此Id，page将失效。
 	 * @param is_reblog 是否装载转载信息
 	 * @return array    博文信息集合
	 */
	private function _build_posts($method, $page, $since_id, $is_reblog)
	{
		$params = $this->_req_before($method);
		$params['offset']     = ($page - 1);
		$params['limit']      = $this->page_count;
		$params['reblogInfo'] = $is_reblog;
		if($since_id != 0) $params['sinceId'] = $since_id;
		return $this->get($params);
	}

	// --------------------------------------------------------------------
	
	/**
	 * -----------------------------
	 * 获取个人首页博文动态
 	 * -----------------------------
 	 *
 	 * @link http://doc.diandian.com/api/home/
 	 * @param page 		页码
 	 * @param since_id  如果有此Id，page将失效。
 	 * @param is_reblog 是否装载转载信息
 	 * @return array    个人主页博文信息集合
	 */
	public function get_home_post($page = 1, $since_id = 0, $is_reblog = false)
	{
		// $params = $this->_req_before('user/home');
		return $this->_build_posts('user/home', $page, $is_reblog, $since_id);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取标签博文动态
 	 * -----------------------------
 	 *
 	 * @link http://doc.diandian.com/api/tagposts/
 	 * @param tag 		标签
 	 * @param page 		页码
 	 * @param since_id  如果有此Id，page将失效。
 	 * @param is_reblog 是否装载转载信息
 	 * @return array    个人主页博文信息集合
	 */
	public function get_tag_post($tag, $page = 1, $since_id = 0, $is_reblog = false)
	{
		return $this->_build_posts('tag/posts/'.$tag, $page, $is_reblog, $since_id);
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== 文章接口 ========== =
	// ================================

	/**
	 * -----------------------------
	 *  获取博客文章
	 * - 支持分页获取
	 * - 支持指定id获取，此时type,tag,limit,offset将失效。
	 * - 支持按文章类型获取, 文章类型支持:
	 *   -- 文字 BLOG_POST_TYPE_TEXT
	 *   -- 图片 BLOG_POST_TYPE_PHOTO
	 *   -- 音乐 BLOG_POST_TYPE_AUDIO
	 *   -- 视频 BLOG_POST_TYPE_VIDEO
	 *   -- 链接 BLOG_POST_TYPE_LINK
	 * - 只支持单个tag获取
 	 * -----------------------------
 	 * 
 	 * @param domain 	博客域名
 	 * @param id 		文章id
 	 * @param type 		文章类型。不传为全部类型
 	 * @param tag 		文章标签 只支持单个
 	 * @param page 		页码 1为起始页
 	 * @return array 	博客文章信息集合
	 */
	private function _get_post($domain, $id = 0, $type = BLOG_POST_TYPE_ALL, $tag = NULL, $page = 1)
	{
		$url = 'blog/' . $domain . '/posts';
		if($type != BLOG_POST_TYPE_ALL) $url .= '/'.$type;
		$params = $this->_req_before($url);

		if($id != 0){
			$params['id'] = $id ;
		}else{
			if($tag) $params['tag'] = $tag;
			$params['offset'] = ($page - 1);
			$params['limit']  = $this->page_count;
		}
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  根据博客文章id获取该文章详细信息
 	 * -----------------------------
 	 * 
 	 * @param domain 	博客域名
 	 * @param id 		文章id
 	 * @return array 	指定文章信息集合	
	 */
	public function get_post_by_id($domain, $id)
	{
		return $this->_get_post($domain, $id);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取所有类型博客文章
	 * - 支持过滤标签
	 * - 支持分页获取
 	 * -----------------------------
 	 * 
 	 * @param domain 	博客域名
 	 * @param page  	页码 1为起始页
 	 * @param tag 		标签
 	 * @return array 	指定文章信息集合	
	 */
	public function get_post($domain, $page = 1, $tag = NULL)
	{
		return $this->_get_post($domain, 0 , BLOG_POST_TYPE_ALL, $tag, $page);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取 "文字类型" 博客文章
	 * - 支持过滤标签
	 * - 支持分页获取
 	 * -----------------------------
 	 * 
 	 * @param domain 	博客域名
 	 * @param page  	页码 1为起始页
 	 * @param tag 		标签
 	 * @return array 	指定文章信息集合	
	 */
	public function get_post_with_text($domain, $page = 1, $tag = NULL)
	{
		return $this->_get_post($domain, 0, BLOG_POST_TYPE_TEXT, $tag, $page);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取 "图片类型" 博客文章
	 * - 支持过滤标签
	 * - 支持分页获取
 	 * -----------------------------
 	 * 
 	 * @param domain 	博客域名
 	 * @param page  	页码 1为起始页
 	 * @param tag 		标签
 	 * @return array 	指定文章信息集合	
	 */
	public function get_post_with_photo($domain, $page = 1, $tag = NULL)
	{
		return $this->_get_post($domain, 0, BLOG_POST_TYPE_PHOTO, $tag, $page);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取 "音乐类型" 博客文章
	 * - 支持过滤标签
	 * - 支持分页获取
 	 * -----------------------------
 	 * 
 	 * @param domain 	博客域名
 	 * @param page  	页码 1为起始页
 	 * @param tag 		标签
 	 * @return array 	指定文章信息集合	
	 */
	public function get_post_with_audio($domain, $page = 1, $tag = NULL)
	{
		return $this->_get_post($domain, 0, BLOG_POST_TYPE_AUDIO, $tag, $page);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取 "视频类型" 博客文章
	 * - 支持过滤标签
	 * - 支持分页获取
 	 * -----------------------------
 	 * 
 	 * @param domain 	博客域名
 	 * @param page  	页码 1为起始页
 	 * @param tag 		标签
 	 * @return array 	指定文章信息集合	
	 */
	public function get_post_with_video($domain, $page = 1, $tag = NULL)
	{
		return $this->_get_post($domain, 0, BLOG_POST_TYPE_VIDEO, $tag, $page);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取 "链接类型" 博客文章
	 * - 支持过滤标签
	 * - 支持分页获取
 	 * -----------------------------
 	 * 
 	 * @param domain 	博客域名
 	 * @param page  	页码 1为起始页
 	 * @param tag 		标签
 	 * @return array 	指定文章信息集合	
	 */
	public function get_post_with_link($domain, $page = 1, $tag = NULL)
	{
		return $this->_get_post($domain, 0, BLOG_POST_TYPE_LINK, $tag, $page);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 发布博客文章
 	 * -----------------------------
 	 * 
 	 * @return array 	指定文章信息集合	
	 */
	public function _build_create_post($domain, $type, $state, $tag, $slug, $markdown)
	{
		$url                = '/blog/' . $domain . '/post';
		$params             = $this->_req_before($url);
		$params['type']     = $type;
		$params['state']   = $state;
		$params['markdown'] = $markdown;
		if($tag) $params['tag'] = is_array($tag) ? implode(',', $tag) : $tag;
		if($slug) $params['slug'] = $slug;
		return $params;
	}

	// --------------------------------------------------------------------

	public function publish_text($domain, $title = '', $body = '', $tag = NULL, $slug = NULL, $state = POST_STATE_PUBLISHED,  $markdown = false)
	{
		$params = $this->_build_create_post($domain, BLOG_POST_TYPE_TEXT, $state, $tag, $slug, $markdown);
		if(!empty($title) || !empty($body)){
			$params['title'] = $title;
			$params['body'] = $body;
			return $this->post($params);
		}else{
			return false;
		}
	}

	// --------------------------------------------------------------------

	public function publish_photo($domain, $img, $caption = '', $tag = NULL, $slug = NULL, $state = POST_STATE_PUBLISHED,  $markdown = false)
	{
		$params = $this->_build_create_post($domain, BLOG_POST_TYPE_TEXT, $state, $tag, $slug, $markdown);
		$params['caption'] = $caption;
		$params['data'] = $img;
	}

	// --------------------------------------------------------------------


	// --------------------------------------------------------------------
	// ================================
	// = ========== 喜欢接口 ========== =
	// ================================

	/**
	 * -----------------------------
	 * 处理用户喜欢或取消喜欢操作
 	 * -----------------------------
 	 * 
 	 * @param method 	api方法
 	 * @param post_id 	博文id
 	 * @return array 	操作成功或错误信息	
	 */
	private function _like($method, $post_id)
	{
		$params = $this->_req_before($method);
		$params['id'] = $post_id;
		return $this->post($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 喜欢一篇博文
 	 * -----------------------------
 	 * 
 	 * @link http://doc.diandian.com/api/like/
 	 * @param post_id 	博文id
 	 * @return array 	操作成功或错误信息	
	 */
	public function like($post_id)
	{
		return $this->_like('user/like', $post_id);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 取消喜欢一篇博文
 	 * -----------------------------
 	 * 
 	 * @link http://doc.diandian.com/api/unlike/
 	 * @param post_id 	博文id
 	 * @return array 	操作成功或错误信息	
	 */
	public function unlike($post_id)
	{
		return $this->_like('user/unlike', $post_id);
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== 关注接口 ========== =
	// ================================

	/**
	 * -----------------------------
	 * 处理用户关注或取消关注操作
 	 * -----------------------------
 	 * 
 	 * @param method 	api方法
 	 * @param post_id 	博客cname
 	 * @return array 	操作成功或错误信息	
	 */
	private function _follow($method, $blog_cname)
	{
		$params = $this->_req_before($method);
		$params['blogCName'] = $blog_cname;
		return $this->post($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 关注一个博客
 	 * -----------------------------
 	 * 
 	 * @link http://doc.diandian.com/api/follow/
 	 * @param blog_cname 	博客cname
 	 * @return array 		操作成功或错误信息	
	 */
	public function follow($blog_cname)
	{
		return $this->_follow('user/follow', $blog_cname);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 取消关注一个博客
 	 * -----------------------------
 	 * 
 	 * @link http://doc.diandian.com/api/unfollow/
 	 * @param blog_cname 	博客cname
 	 * @return array 		操作成功或错误信息	
	 */
	public function unfollow($blog_cname)
	{
		return $this->_follow('user/unfollow', $blog_cname);
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== 标签接口 ========== =
	// ================================	

	private function _tag($method)
	{
		$params = $this->_req_before($method);
		return $this->post($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 订阅一个标签
 	 * -----------------------------
 	 * 
 	 * @link http://doc.diandian.com/api/watchtag/
 	 * @param blog_cname 	博客cname
 	 * @return array 		操作成功或错误信息	
	 */
	public function tag_watch($tag)
	{
		$method = 'tag/watch/'.$tag;
		return $this->_tag($method);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 取消订阅一个标签
 	 * -----------------------------
 	 * 
 	 * @link http://doc.diandian.com/api/unwatchtag/
 	 * @param blog_cname 	博客cname
 	 * @return array 		操作成功或错误信息	
	 */
	public function tag_unwatch()
	{
		$method = 'tag/unwatch/'.$tag;
		return $this->_tag($method);
	}

}