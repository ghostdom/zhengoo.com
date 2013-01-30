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
define('WEIBO_FEATURE_ALL', 		0);  	// 微博类型 : 全部
define('WEIBO_FEATURE_ORIGINAL', 	1);		// 微博类型 : 原创
define('WEIBO_FEATURE_PIC', 		2);		// 微博类型 : 图片
define('WEIBO_FEATURE_VIDEO', 		3);		// 微博类型 : 视频
define('WEIBO_FEATURE_MUSIC', 		4);		// 微博类型 : 音乐

define('ID_TYPE_WEIBO', 			1);		// ID类型 : 微博ID 
define('ID_TYPE_COMMENT', 			2);		// ID类型 : 评论ID
define('ID_TYPE_LETTER', 			3);		// ID类型 : 私信ID

define('EMOTION_TYPE_FACE',			'face');	//官方表情类型 : 普通表情
define('EMOTION_TYPE_ANI',			'ani');		//官方表情类型 : 魔法表情
define('EMOTION_TYPE_CARTOON', 		'cartoon');	//官方表情类型 : 动漫表情

class OAuth2_Provider_Weibo extends OAuth2_Provider 
{

	/**
	 * 第三方来源名称 - 新浪微博（weibo）
	 */
	public $source = AUTH_SOURCE_NAME_WEIBO;
	/**
	 * @var 第三方来源代号
	 */
	public $source_code = AUTH_SOURCE_WEIBO; 
	/**
	 * @var  string  the method to use when requesting tokens
	 */
	public $method = 'POST';
	/**
	 * @var   host
	 */
	public $host = "https://api.weibo.com/2/";
	/**
	 * @var   return data
	 */
	public $format = 'json';

	public $scope = 'email,follow_app_official_microblog';//friendships_groups_read,friendships_groups_write,statuses_to_me_read,



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
		return 'https://api.weibo.com/oauth2/authorize';
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 换取access_token 请求地址
 	 * -----------------------------
	 */
	public function url_access_token()
	{
		return 'https://api.weibo.com/oauth2/access_token';
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

	// --------------------------------------------------------------------
	// ================================
	// = ========== 用户接口 ========== =
	// ================================
	
	/**
	 * -----------------------------
	 * 根据用户ID获取用户信息以及用户最新的一条微博
 	 * -----------------------------
 	 * - HTTP请求方式 GET
	 * 
	 * @link 	http://open.weibo.com/wiki/2/users/show
	 * @param 	uid 需要查询的用户ID。 
	 * @return 	用户详细信息数组
	 */
	public function get_user($uid, $is_email = true)
	{
		$params        = $this->_req_before('users/show');
		$params['uid'] = $uid;
		$user_info = $this->get($params);
		// if($is_email){
		// 	$user_info['email'] = $this->get_user_email();
		// }
		return $user_info;
	}

	// --------------------------------------------------------------------

	
	/**
	 * -----------------------------
	 * 如果用户授权了 scope：email 
	 *  我们奖可以获取用户的email地址
 	 * -----------------------------
 	 * - HTTP请求方式 GET
	 * 
	 * @link 	http://open.weibo.com/wiki/2/account/profile/email
	 * @return string	用户邮件地址
	 */
	public function get_user_email()
	{
		$params = $this->_req_before('account/profile/email');
		$result = $this->get($params);
		var_dump($result);
		return $result['email'];
	}


	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据用户昵称获取用户信息以及用户最新
	 * 的一条微博
	 * - 如果用户昵称全部为数字,将直接返回传入的参数值
	 * 注:微博昵称不能全部为数字
 	 * -----------------------------
 	 * - HTTP请求方式 GET
	 * 
	 * @link 	http://open.weibo.com/wiki/2/users/show
	 * @param 	nick_name 需要查询的用户昵称。 
	 * @return 	用户详细信息数组
	 */
	public function get_user_by_nick_name($nick_name)
	{
		if(is_numeric($nick_name)){
			return $nick_name;
		}else{
			$params            		= $this->_req_before('users/show');
			$params['screen_name'] 	= $nick_name;
			return $this->get($params);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据用户昵称获取用户id
 	 * -----------------------------
 	 * - HTTP请求方式 GET
	 * 
	 * @link 	http://open.weibo.com/wiki/2/users/show
	 * @param 	nick_name 需要查询的用户昵称。 
	 * @return 	用户id
	 */
	public function get_user_id_by_nick_name($nick_name)
	{
		$user_info = $this->get_user_by_nick_name($nick_name);
		if(isset($user_info['id']))
		{
			return $user_info['id'];
		}else{
			return $user_info;		
		} 
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * OAuth授权之后，获取授权用户的UID
 	 * -----------------------------
 	 * - HTTP请求方式 GET
	 * 
	 * @link 	http://open.weibo.com/wiki/2/account/get_uid 
	 * @return 	用户id
	 */
	public function get_user_id_by_oauth()
	{
		$params = $this->_req_before('account/get_uid');
		$id_info = $this->get($params);
		return $id_info['uid'];
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 通过个性化域名获取用户资料以及用户最新的一条微博
 	 * -----------------------------
 	 * - HTTP请求方式 GET
 	 *
	 * @link  	http://open.weibo.com/wiki/2/users/domain_show
	 * @param 	domain 需要查询的用户ID。 
	 * @param 	access_token 
	 * @return 	array 用户详细信息数组
	 */
	public function get_user_by_domain($domain)
	{
		$params           = $this->_req_before('users/domain_show');
		$params['domain'] = $domain;
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 批量获取用户的粉丝数、关注数、微博数
 	 * -----------------------------
 	 * - HTTP请求方式 GET
 	 *
	 * @link  	http://open.weibo.com/wiki/2/users/counts
	 * @param 	uids 需要查询的用户ID, 多个id用 "," 分隔.
	 * @param 	access_token 
	 * @return 	array 用户粉丝数、关注数、微博数数组
	 */
	public function get_user_counts($uids)
	{
		$params         = $this->_req_before('users/counts');
		$params['uids'] = $uids;
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 批量获取用户的粉丝数
	 * - 单个用户, 返回该用户粉丝数(int)
	 * - 多个用户, 返回map array(uid => count);
 	 * -----------------------------
 	 * - HTTP请求方式 GET
 	 *
	 * @link  	http://open.weibo.com/wiki/2/users/counts
	 * @param 	uids 需要查询的用户ID, 多个id用 "," 分隔.
	 * @param 	access_token 
	 * @return 	用户粉丝数
	 */
	public function get_user_fans_count($uids)
	{
		$counts = $this->get_user_counts($uids);
		return $this->_get_count_by_key('followers_count', $counts);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 批量获取用户的关注数
	 * - 单个用户, 返回该用户关注数(int)
	 * - 多个用户, 返回map array(uid => count);
 	 * -----------------------------
 	 * - HTTP请求方式 GET
 	 *
	 * @link  	http://open.weibo.com/wiki/2/users/counts
	 * @param 	uids 需要查询的用户ID, 多个id用 "," 分隔.
	 * @param 	access_token 
	 * @return 	用户关注数
	 */
	public function get_user_follow_count($uids)
	{
		$counts = $this->get_user_counts($uids);
		return $this->_get_count_by_key('friends_count', $counts);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 批量获取用户的微博数
	 * - 单个用户, 返回该用户微博数(int)
	 * - 多个用户, 返回map array(uid => count);
 	 * -----------------------------
 	 * - HTTP请求方式 GET
 	 *
	 * @link  	http://open.weibo.com/wiki/2/users/counts
	 * @param 	uids 需要查询的用户ID, 多个id用 "," 分隔.
	 * @param 	access_token 
	 * @return 	用户微博数
	 */
	public function get_user_weibo_count($uids)
	{
		$counts = $this->get_user_counts($uids);
		return $this->_get_count_by_key('statuses_count', $counts);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 处理api返回的用户 粉丝数、关注数、微博数
	 * - 获取指定key 的值
	 * - counts 数组长度等于1时, 直接返回key的值
	 * - counts 数据长度大于1时, 返回map array(uid => count);
 	 * -----------------------------
	 *
	 * @param 	count_key  key (followers_count|friends_count|statuses_count)
	 * @param 	counts 用户粉丝数、关注数、微博数数组
	 * @return 	key对应值
	 */
	private function _get_count_by_key($count_key, $counts){
		if(count($counts) == 1){
			return $counts[0][$count_key];
		}else if(count($counts) > 1){
			foreach ($counts as $count)
			{
				$num[$count['id']] = $count[$count_key];
			}
			return $num;
		}
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== 微博接口 ========== =
	// ================================

	// /**
	//  * -----------------------------
	//  * 根据api相关参数获取用户微博数据, 如果未设定任何参数, 将返回最新的公共微博
	//  * - uid 			需要查询的用户ID
	//  * - screen_name 	需要查询的用户昵称
	//  * - page 			返回结果的页码, 默认为1
	//  * - count 			单页返回的记录条数, 默认为50
	//  * - max_id 		若指定此参数，则返回ID小于或等于max_id的微博，默认为0。
	//  * - since_id 		若指定此参数，则返回ID比since_id大的微博（即比since_id时间晚的微博），默认为0。
	//  * - base_app 		是否只获取当前应用的数据。0为否（所有数据），1为是（仅当前应用），默认为0。
	//  * - feature 		过滤类型ID，0：全部、1：原创、2：图片、3：视频、4：音乐，默认为0。
	//  * - trim_user 		返回值中user信息开关，0：返回完整的user信息、1：user字段仅返回user_id，默认为0。
 // 	 * -----------------------------
	//  *
	//  * @param 	Array options 查询条件
	//  * @return 	Array 微博数据数组 
	//  */
	// public function get_weibo(array $options = array())
	// {
	// 	if($options){
	// 		$params          = $this->_req_before('statuses/user_timeline');
	// 		$params['count'] = $this->page_count;

	// 		isset($options['uid']) and $params['uid']                 = $options['uid'];
	// 		isset($options['screen_name']) and $params['screen_name'] = $options['screen_name'];
	// 		isset($options['page']) and $params['page']               = $options['page'];
	// 		isset($options['since_id']) and $params['since_id']       = $options['since_id'];
	// 		isset($options['max_id']) and $params['max_id']           = $options['max_id'];
	// 		isset($options['base_app']) and $params['base_app']       = $options['base_app'];
	// 		isset($options['feature']) and $params['feature']         = $options['feature'];
	// 		isset($options['trim_user']) and $params['trim_user']     = $options['trim_user'];
	// 		return $this->get($params);
	// 	}else{
	// 		return $this->get_weibo_with_public();
	// 	}
	// } 

	// --------------------------------------------------------------------

	/*
	 * -----------------------------
	 * 获取用户微博数据 
	 * - 传入uid 查询改id用户的微博数据
	 * - 未传入uid, 查询当前登陆用户的微博数据
	 * - 可以设定 feature 参数 过滤类型 =>
	 *  0：全部(WEIBO_FEATURE_ALL)、
	 *  1：原创(WEIBO_FEATURE_ORIGINAL)、
	 *  2：图片(WEIBO_FEATURE_PIC)、
	 *  3：视频(WEIBO_FEATURE_VIDEO)、
	 *  4：音乐(WEIBO_FEATURE_MUSIC)，
	 * 默认为: 0。  
 	 * -----------------------------
	 *
	 * @param 	Int uid 用户id
	 * @param   Int page 页码
	 * @param   Int count 数量
	 * @param   Int feature 微博类型
	 * @param   Int refer_id 参照 微博id
	 * @param   boolean is_new  比参照微博id早的微博(false) | 比参照微博id晚的微博 
	 * @return 	Array 微博数据数组 
	 */
	public function get_weibo($uid = NULL, $page = 1, $feature = WEIBO_FEATURE_ALL, $refer_id = 0, $is_new = FALSE)
	{
		return $this->_get_weibo('statuses/user_timeline', $uid, NULL, $page, $feature, $refer_id, $is_new);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据用户id和since_id(某微博id), 获取该用户大于此id的微博数据(即比该微博id新的微博).
	 * - 可以设定 feature 参数 过滤类型   
 	 * -----------------------------
	 *
	 * @param 	Int uid 		用户id
	 * @param   Int since_id 	作对比的微博id
	 * @param   Int page 		页码
	 * @param   Int count 		数量
	 * @param   Int feature 	微博类型
	 * @return 	Array 微博数据数组 
	 */
	public function get_weibo_with_new($uid, $since_id, $page = 1, $feature = WEIBO_FEATURE_ALL)
	{
		return $this->get_weibo_by_uid($uid, $page, $feature, $since_id, TRUE);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据用户id和max_id(某微博id), 获取该用户小于或等于于此id的微博数据(即比该微博id旧的微博).
	 * - 可以设定 feature 参数 过滤类型   
 	 * -----------------------------
	 *
	 * @param 	Int uid 	用户id
	 * @param   Int max_id 	作对比的微博id
	 * @param   Int page 	页码
	 * @param   Int count 	数量
	 * @param   Int feature 微博类型
	 * @return 	Array 微博数据数组 
	 */
	public function get_weibo_with_old($uid, $max_id, $page = 1, $feature = WEIBO_FEATURE_ALL)
	{
		return $this->get_weibo_by_uid($uid, $page, $feature, $max_id);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据用户id 获取该用户图片类型微博数据   
 	 * -----------------------------
	 *
	 * @param 	Int uid 	用户id
	 * @param   Int page 	页码
	 * @param   Int count 	数量
	 * @return 	Array 微博数据数组 
	 */
	public function get_weibo_with_pic($uid, $page = 1)
	{
		return $this->get_weibo_by_uid($uid, $page, WEIBO_FEATURE_PIC);
	}

	// --------------------------------------------------------------------
	
	/**
	 * -----------------------------
	 * 根据用户id 获取该用户视频类型微博数据   
 	 * -----------------------------
	 *
	 * @param 	Int uid 	用户id
	 * @param   Int page 	页码
	 * @param   Int count 	数量
	 * @return 	Array 微博数据数组 
	 */
	public function get_weibo_with_video($uid, $page = 1)
	{
		return $this->get_weibo_by_uid($uid, $page, WEIBO_FEATURE_VIDEO);
	}

	// --------------------------------------------------------------------
	
	/**
	 * -----------------------------
	 * 根据用户id 获取该用户音乐类型微博数据   
 	 * -----------------------------
	 *
	 * @param 	Int uid 	用户id
	 * @param   Int page 	页码
	 * @param   Int count 	数量
	 * @return 	Array 微博数据数组 
	 */
	public function get_weibo_with_music($uid, $page = 1)
	{
		return $this->get_weibo_by_uid($uid, $page, WEIBO_FEATURE_MUSIC);
	}

	// --------------------------------------------------------------------
	
	/**
	 * -----------------------------
	 * 根据用户id 获取该用户原创类型微博数据   
 	 * -----------------------------
	 *
	 * @param 	Int uid 	用户id
	 * @param   Int page 	页码
	 * @param   Int count 	数量
	 * @return 	Array 微博数据数组 
	 */
	public function get_weibo_with_original($uid, $page = 1)
	{
		return $this->get_weibo_by_uid($uid, $page, WEIBO_FEATURE_ORIGINAL);
	}

	// --------------------------------------------------------------------
	
	/**
	 * -----------------------------
	 * 获取最新的公共微博  
 	 * -----------------------------
	 *
	 * @param   Int page 	页码
	 * @return 	Array 微博数据数组 
	 */
	public function get_weibo_with_public($page = 1)
	{
		$params          = $this->_req_before('statuses/public_timeline');
		$params['page']  = $page ;
		$params['count'] = $this->page_count;
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取当前登录用户及其所关注用户的最新微博  
 	 * -----------------------------
	 *
	 * @param   Int page 	页码
	 * @param   Int feature 微博类型
 	 * @param   Int refer_id 参照 微博id
	 * @param   boolean is_new  比参照微博id早的微博(false) | 比参照微博id晚的微博 
	 * @return 	Array 微博数据数组 
	 */
	public function get_weibo_with_follows($page = 1, $feature = WEIBO_FEATURE_ALL, $refer_id = 0, $is_new = false)
	{
		return $this->_get_weibo('statuses/friends_timeline', NULL, NULL,  $page, $feature, $refer_id, $is_new);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 *  获取当前登录用户及其所关注用户的最新微博的ID 
 	 * -----------------------------
	 *
	 * @param   Int page 	页码
	 * @param   Int feature 微博类型
 	 * @param   Int refer_id 参照 微博id
	 * @param   boolean is_new  比参照微博id早的微博(false) | 比参照微博id晚的微博 
	 * @return 	Array 微博数据数组 
	 */
	public function get_weibo_ids_with_follows($page = 1, $feature = WEIBO_FEATURE_ALL, $refer_id = 0, $is_new = false)
	{
		return $this->_get_weibo('statuses/friends_timeline/ids', NULL, NULL,  $page, $feature, $refer_id, $is_new);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 读取微博接口
	 * - 统一封装获取微博接口参数
 	 * -----------------------------
	 *
	 * @param   String method api方法
	 * @param   Int uid     微博用户id
	 * @param   Int screen_name   微博用户名称 		
	 * @param   Int page 	页码
	 * @param   Int feature 微博类型
 	 * @param   Int refer_id 参照 微博id
	 * @param   boolean is_new  比参照微博id早的微博(false) | 比参照微博id晚的微博 
	 * @return 	Array 微博数据数组 
	 */
	private function _get_weibo($method, $uid = NULL, $screen_name = NULL,  $page = 1, $feature = WEIBO_FEATURE_ALL, $refer_id = 0, $is_new = false){
		$params = $this->_req_before($method);
		
		if($uid) $params['uid']                 = $uid;
		if($screen_name) $params['screen_name'] = $screen_name;

		$params['page']    = $page;
		$params['count']   = $this->page_count;
		$params['feature'] = $feature;

		if($is_new){
			$params['since_id'] = $refer_id;
		}else if($refer_id > 0){
			$params['max_id'] 	= $refer_id;
		}
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 统一封装获取微博,评论,私信数据id接口
	 * - 支持批量模式, 最多不超过20个
 	 * -----------------------------
 	 * 
 	 * @param method   api方法
 	 * @param id_or_mid 需要转化的id 可以传入数组或以","分隔的字符穿 最大长度支持20个id
 	 * @param type 获取的id类型(微博, 评论, 私信) 默认: 微博
 	 * @return array 转换后的id集合
 	 */
	private function _get_ids($method, $id_or_mid, $type)
	{
		$this->_ci->load->helper('string');
		$num = segment_num($id_or_mid);
		$is_batch = 1;
		if($num > 0 && $num <= 20){
			if($num == 1) $is_batch = 0;
			if(is_array($id_or_mid)) $id_or_mid = implode(',', $id_or_mid);
			$params = $this->_req_before($method);
			$params['is_batch'] = $is_batch;
			$params['type'] = $type;
			if($method == 'statuses/queryid'){
				$params['mid']   = $id_or_mid;
				$params['isBase62'] = 1;
			}else {
				$params['id'] = $id_or_mid;
			}
			$ids = $this->get($params);
			if(count($ids)  == 1){
				return array_shift($ids);
			}else{
				return $ids;
			}
		}else{
			return false;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 通过微博（评论、私信）MID获取其ID
	 * - 支持批量模式, 最多不超过20个
 	 * -----------------------------
 	 *
  	 * @param mids 需要转化的mid 可以传入数组或以","分隔的字符穿 最大长度支持20个id
 	 * @param type 获取的id类型 (微博, 评论, 私信) 默认: 微博
 	 * @return array 转换后的id集合
 	 */
	public function mid_to_id($mids, $type = ID_TYPE_WEIBO)
	{
		return $this->_get_ids('statuses/queryid', $mids, $type);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 通过评论MID获取其ID
	 * - 支持批量模式, 最多不超过20个
 	 * -----------------------------
 	 *
  	 * @param mids 需要转化的评论mid 可以传入数组或以","分隔的字符穿 最大长度支持20个id
 	 * @return array 转换后的id集合
 	 */
	public function mid_to_id_with_comment($mids)
	{
		return $this->mid_to_id($mids, ID_TYPE_COMMENT);
	}

	// --------------------------------------------------------------------
	
	/**
	 * -----------------------------
	 * 通过私信MID获取其ID
	 * - 支持批量模式, 最多不超过20个
 	 * -----------------------------
 	 *
  	 * @param mids 需要转化的私信mid 可以传入数组或以","分隔的字符穿 最大长度支持20个id
 	 * @param type 获取的id类型 (微博, 评论, 私信) 默认: 微博
 	 * @return array 转换后的id集合
 	 */
	public function mid_to_id_with_letter($mids)
	{
		return $this->mid_to_id($mids, ID_TYPE_LETTER);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 通过微博（评论、私信）ID获取其MID
	 * - 支持批量模式, 最多不超过20个
 	 * -----------------------------
 	 *
  	 * @param ids 需要转化的id 可以传入数组或以","分隔的字符穿 最大长度支持20个id
 	 * @param type 获取的id类型 (微博, 评论, 私信) 默认: 微博
 	 * @return array 转换后的id集合
 	 */
	public function id_to_mid($ids, $type = ID_TYPE_WEIBO)
	{
		return $this->_get_ids('statuses/querymid', $ids , $type);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 通过评论ID获取其MID
	 * - 支持批量模式, 最多不超过20个
 	 * -----------------------------
 	 *
  	 * @param ids 需要转化的评论id 可以传入数组或以","分隔的字符穿 最大长度支持20个id
 	 * @return array 转换后的id集合
 	 */
	public function id_to_mid_with_comment($ids)
	{
		return $this->id_to_mid($ids, ID_TYPE_COMMENT);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 通过私信ID获取其MID
	 * - 支持批量模式, 最多不超过20个
 	 * -----------------------------
 	 *
  	 * @param ids 需要转化的私信id 可以传入数组或以","分隔的字符穿 最大长度支持20个id
 	 * @return array 转换后的id集合
 	 */
	public function id_to_mid_with_letter($ids)
	{
		return $this->id_to_mid($ids, ID_TYPE_LETTER);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据ID获取单条微博信息 
 	 * -----------------------------
	 *
	 * @param 	Int id 	微博id
	 * @return 	Array 该微博详细信息数组 
	 */
	public function get_weibo_by_id($id) 
	{
		$params         = $this->_req_before('statuses/show');
		$params['id']   = $id;
		return $this->get($params); 
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 批量获取指定微博的转发数评论数
	 * - 支持多个id 用 "," 分隔 最多不超过100个。
 	 * -----------------------------
	 *
	 * @param 	Int ids 微博id
	 * @return 	Array 微博转发数评论数数组集合 
	 */
	public function get_weibo_counts($ids)
	{
		$this->_ci->load->helper('string');
		$num = segment_num($ids);

		if($num > 0 && $num <= 100)
		{
			if(is_array($ids)) $ids = implode(',', $ids);
			$params        = $this->_req_before('statuses/count');
			$params['ids'] = $ids ;
			return $this->get($params);
		}else{
			return false;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 通过微博mid 获取指定微博的转发数评论数
	 * - 支持多个mid 用 "," 分隔 最多不超过100个。
 	 * -----------------------------
	 *
	 * @param 	Int ids 微博id
	 * @return 	Array 微博转发数评论数数组集合 
	 */
	public function get_weibo_counts_by_mid($mids)
	{
		$ids = $this->mid_to_id($mids);
		if(count($ids) > 1)
		{
			foreach ($ids as $value)
			{
				 $num_id[] = array_shift($value);
			}
		}else{
			$num_id = array_shift($ids);
		}

		return $this->get_weibo_counts($num_id);
	}

	// --------------------------------------------------------------------

	// public function get_weibo_repost_count($ids)
	// {

	// } 

	// --------------------------------------------------------------------

	// public function get_weibo_comment_count($ids)
	// {

	// }

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据评论id 获取该评论所对应的微博
	 * -----------------------------
	 *
	 * @param cid 		评论id
	 * @return array   	微博信息
	 */
	public function get_weibo_by_cid($cid)
	{
		$comment = $this->get_comment_by_ids($cid);
		if(!empty($comment)){
			return $comment[0]['status'];
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取微博官方表情的详细信息
	 * -----------------------------
	 *
	 * @param type 		表情类别，face：普通表情、ani：魔法表情、cartoon：动漫表情，默认为face
	 * @return array   	微博信息
	 */
	public function get_emotions($type = EMOTION_TYPE_FACE)
	{
		$params         = $this->_req_before('emotions');
		$params['type'] = $type;

		return $this->get($params); 
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 创建微博信息
	 * -----------------------------
	 *
	 * @param content 			发布微博内容 不超过140个汉字
	 * @param pic  				图片的地址 (可以是url或本地图片路径)
	 * @param repost_wb_id		要转发的微博id
	 * @param is_comment 		是否在转发的同时发表评论，0：否、1：评论给当前微博、2：评论给原微博、3：都评论，默认为0 
	 * @return array   			发布微博信息集合
	 */
	private function  _create_weibo($content, $pic = '', $repost_wb_id = '', $is_comment = 0)
	{
		$this->_ci->load->helper('string');
		$content_length = zh_strlen($content);
		if(empty($content) || $content_length == 0 || $content_length > 140) return false;

		if($pic)
		{
			$params           = $this->_req_before('statuses/upload');
			$params['status'] = $content;
			$params['pic']    = '@'.$pic;
			$params           = $this->_build_http_query_multi($params);

			$this->headers[] = 'Content-Type: multipart/form-data; boundary=' . self::$boundary;
		}else if($repost_wb_id) {
			$params               = $this->_req_before('statuses/repost');
			$params['id']         = $repost_wb_id;
			$params['status']     = $content;
			$params['is_comment'] = $is_comment;
		}else{
			$params           = $this->_req_before('statuses/update');
			$params['status'] = $content;
		}
		return $this->post($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 构建发送图片微博http请求参数
	 * -----------------------------
	 *
	 * @param params 	发送图片微博参数集合
	 * @return array   	处理后发送图片微博参数集合
	 */
	private function _build_http_query_multi($params)
	{
		if (!$params) return '';
		uksort($params, 'strcmp');
		$pairs = array();

		self::$boundary = $boundary = uniqid('------------------');
		$MPboundary = '--'.$boundary;
		$endMPboundary = $MPboundary. '--';
		$multipartbody = '';

		foreach ($params as $parameter => $value) 
		{

			if( in_array($parameter, array('pic', 'image')) && $value{0} == '@' ){
				$url = ltrim( $value, '@' );
				$content = file_get_contents( $url );
				$array = explode( '?', basename( $url ) );
				$filename = $array[0];

				$multipartbody .= $MPboundary . "\r\n";
				$multipartbody .= 'Content-Disposition: form-data; name="' . $parameter . '"; filename="' . $filename . '"'. "\r\n";
				$multipartbody .= "Content-Type: image/unknown\r\n\r\n";
				$multipartbody .= $content. "\r\n";
			} else {
				$multipartbody .= $MPboundary . "\r\n";
				$multipartbody .= 'content-disposition: form-data; name="' . $parameter . "\"\r\n\r\n";
				$multipartbody .= $value."\r\n";
			}
		}

		$multipartbody .= $endMPboundary;
		return $multipartbody;
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 发布一条新微博
	 * - 支持图片URL地址抓取后上传并同时发布一条新微博
	 * -----------------------------
	 *
	 * @param content 		发布微博内容 不超过140个汉字
 	 * @param pic  			图片的地址 (可以是url或本地图片路径)
	 * @return array   		发布成功的微博信息集合
	 */
	public function publish_weibo($content, $pic = '')
	{
		return $this->_create_weibo($content, $pic);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 转发一条微博
	 * -----------------------------
	 *
	 * @param content 	 发布微博内容 不超过140个汉字
	 * @param wb_id 	 转发的微博id 可以是mid
	 * @param is_comment 是否在转发的同时发表评论，0：否、1：评论给当前微博、2：评论给原微博、3：都评论，默认为0 
	 * @return array   	 转发的微博信息集合
	 */
	public function repost_weibo($content, $wb_id, $is_comment = 0)
	{
		if(!is_numeric($wb_id))
		{
			$wb_id = $this->mid_to_id($wb_id);
		}
		return $this->_create_weibo($content, '', $wb_id, $is_comment);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据微博id 删除该微博 (只能删除自己的微博)
	 * -----------------------------
	 *
	 * @param wb_id 	微博id或mid
	 * @return array   	所删除的微博信息
	 */
	public function delete_weibo($wb_id)
	{
		if(!is_numeric($wb_id))
		{
			$wb_id = $this->mid_to_id($wb_id);
		}
		$params       = $this->_req_before('statuses/destroy');
		$params['id'] = $wb_id;
		return $this->post($params);
	}


	// --------------------------------------------------------------------
	// ================================
	// = ========== 评论接口 ========== =
	// ================================

	/**
	 * -----------------------------
	 * 获取相应的评论数据
	 * -----------------------------
	 *
	 * @param method    获取评论api方法
	 * @param page 		页码
	 * @param since_id  返回ID比since_id大的评论 （即比since_id时间晚的评论）
	 * @param max_id 	返回ID小于或等于max_id的评论
	 * @param id_or_mid 微博id或mid
	 *
	 * @return array    评论列表集合
	 */
	private function _get_comments($method, $page = 1, $since_id = 0, $max_id = 0, $wb_id = ''){
		$params = $this->_req_before($method);
		if(!empty($wb_id)){
			$params['id'] = $wb_id;
		}
		$params['page'] = $page;
		$params['count'] = $this->page_count;
		$params['since_id'] = $since_id;
		$params['max_id']   = $max_id;
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据微博id 获取该微博的评论列表
	 * -----------------------------
	 *
	 * @param wb_id 	微博id或mid
	 * @param page 		页码
	 * @param since_id  返回ID比since_id大的评论 （即比since_id时间晚的评论）
	 * @param max_id 	返回ID小于或等于max_id的评论
	 *
	 * @return array    评论列表集合
	 */
	public function get_comment_by_wb_id($wb_id, $page = 1, $since_id = 0 , $max_id = 0)
	{
		if(!is_numeric($wb_id))
		{
			$wb_id = $this->mid_to_id($wb_id);
		} 

		if(!empty($wb_id) && $wb_id != '-1'){
			return $this->_get_comments('comments/show', $page, $since_id, $max_id, $wb_id);
		}else{
			return NULL;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取当前登录用户所"发出"的评论列表
	 * -----------------------------
	 *
	 * @param page 		页码
	 * @param since_id  返回ID比since_id大的评论 （即比since_id时间晚的评论）
	 * @param max_id 	返回ID小于或等于max_id的评论
	 * @return array    评论列表集合
	 */
	public function get_comment_with_me($page = 1, $since_id = 0, $max_id = 0) 
	{
		return $this->_get_comments('comments/by_me', $page, $since_id, $max_id);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取当前登录用户所"接收"到的评论列表
	 * -----------------------------
	 *
	 * @param page 		页码
	 * @param since_id  返回ID比since_id大的评论 （即比since_id时间晚的评论）
	 * @param max_id 	返回ID小于或等于max_id的评论
	 * @return array    评论列表集合
	 */
	public function get_comment_to_me($page = 1, $since_id = 0, $max_id = 0)
	{
		return $this->_get_comments('comments/to_me', $page, $since_id, $max_id);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取当前登录用户的最新评论包括接收到的与发出的
	 * -----------------------------
	 *
	 * @param page 		页码
	 * @param since_id  返回ID比since_id大的评论 （即比since_id时间晚的评论）
	 * @param max_id 	返回ID小于或等于max_id的评论
	 * @return array    评论列表集合
	 */
	public function get_comment_timeline($page = 1, $since_id = 0, $max_id = 0)
	{
		return $this->_get_comments('comments/timeline', $page, $since_id, $max_id);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取最新的提到当前登录用户的评论，即@我的评论
	 * -----------------------------
	 *
	 * @param page 		页码
	 * @param since_id  返回ID比since_id大的评论 （即比since_id时间晚的评论）
	 * @param max_id 	返回ID小于或等于max_id的评论
	 * @return array    评论列表集合
	 */
	public function get_comment_with_mentions($page = 1, $since_id = 0, $max_id = 0)
	{
		return $this->_get_comments('comments/mentions', $page, $since_id, $max_id);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据评论ID批量返回评论信息
	 * -----------------------------
	 *
	 * @param page 		页码
	 * @param since_id  返回ID比since_id大的评论 （即比since_id时间晚的评论）
	 * @param max_id 	返回ID小于或等于max_id的评论
	 * @return array    评论列表集合
	 */
	public function get_comment_by_ids($cids)
	{
		$this->_ci->load->helper('string');
		$num = segment_num($cids);

		if($num > 0 && $num <= 50)
		{
			if(is_array($cids)) $cids = implode(',', $cids);
			$params         = $this->_req_before('comments/show_batch');
			$params['cids'] = $cids ;
			return $this->get($params);
		}else{
			return false;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * - 发表新的评论
	 * - 回复评论
	 * -----------------------------
	 *
	 * @param method        评论接口方法
	 * @param content  		评论内容 不超过140个汉字。
	 * @param wb_id 		微博id或mid
	 * @param cid  			评论id
	 * @param comment_ori 	当评论转发微博时，是否评论给原微博，0：否、1：是，默认为0。
	 * @return array    	评论信息集合
	 */
	private function _create_comment($method, $content, $wb_id = 0, $cid = 0, $comment_ori = 0)
	{
		$this->_ci->load->helper('string');
		$content_length = zh_strlen($content);
		if($content_length > 0 && $content_length <= 140){
			$params                = $this->_req_before($method);
			$params['id']          = $wb_id;
			$params['comment']     = $content;
			$params['comment_ori'] = $comment_ori;
			if($cid != 0 ) $params['cid'] = $cid;
			return $this->post($params);
		}else{
			return false;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 对一条微博进行评论
	 * -----------------------------
	 *
	 * @param wb_id 		微博id或mid
	 * @param content  		评论内容 不超过140个汉字。
	 * @param comment_ori 	当评论转发微博时，是否评论给原微博，0：否、1：是，默认为0。
	 * @return array    	发表的评论信息集合
	 */
	public function publish_comment($wb_id, $content, $comment_ori = 0)
	{
		if(!is_numeric($wb_id))
		{
			$wb_id = $this->mid_to_id($wb_id);
		}
		return $this->_create_comment('comments/create', $content, $wb_id, $comment_ori);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 回复一条评论
	 * -----------------------------
	 *
	 * @param cid  			回复的评论id
	 * @param content  		评论内容 不超过140个汉字。
	 * @param wb_id 		回复的微博id或mid
	 * @param comment_ori 	当评论转发微博时，是否评论给原微博，0：否、1：是，默认为0。
	 * @return array    	回复的评论信息集合
	 */
	public function reply_comment($cid, $content, $wb_id = 0, $comment_ori = 0)
	{
		if($wb_id == 0)
		{
			$weibo = $this->get_weibo_by_cid($cid);
			$wb_id = $weibo['id'];
		}
		return $this->_create_comment('comments/reply', $content, $wb_id, $cid, $comment_ori);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 删除评论
	 * - 支持批量删除
	 * -----------------------------
	 *
	 * @param cid  			删除的评论id
	 * @return array    	删除评论信息集合
	 */
	public function delete_comment($cid)
	{
		$this->_ci->load->helper('string');
		$num = segment_num($cid);
		if($num == 1){
			$params = $this->_req_before('comments/destroy');
			$params['cid'] = $cid;
		}else if($num > 1){
			if(is_array($cid)) $cid = implode(',', $cid);
			$params = $this->_req_before('comments/destroy_batch');
			$params['ids'] = $cid ;
		}else {
			return false;
		}
		return $this->post($params);
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== 关系接口 ========== =
	// ================================

	/**
	 * -----------------------------
	 * 构建用户关注关系数据查询
	 * -----------------------------
	 *
	 * @param method 		api方法
	 * @param uid_or_name 	用户id或昵称
	 * @param page 			页码
	 * @param cursor 		偏移量
	 * @param trim_status 	是否返回用户最新一条微博内容, ，0：返回完整status字段、1：status字段仅返回status_id，默认为1。
	 * @param suid 			需要获取共同关注关系的用户UID 默认为当前登录用户。
	 * @return array 		
  	 */
	private function _build_follow_data($method, $uid_or_name, $page = NULL, $cursor = NULL,  $trim_status = NULL, $suid = NULL)
	{
		if(empty($uid_or_name))
		{
			$uid_or_name = $this->get_user_id_by_oauth();
		}

		$params          = $this->_req_before($method);
		$params['count'] = $this->page_count;
		
		if(is_numeric($uid_or_name)){
			$params['uid'] = $uid_or_name;
		}else{
			$params['screen_name'] = $uid_or_name;
		}
		
		if($suid) 			$params['suid'] 	   = $suid;
		if($page) 			$params['page'] 	   = $page;
		if($cursor) 		$params['cursor']      = ($this->page_count * ($cursor - 1));
		if($trim_status) 	$params['trim_status'] = $trim_status;

		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取用户的关注列表
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/friendships/friends
	 * @param uid_or_name	用户id或用户昵称 
	 * @param page 			页码
	 * @param trim_status 	是否返回用户最新一条微博内容, ，0：返回完整status字段、1：status字段仅返回status_id，默认为1。
	 * @return array 		该用户关注列表集合 包含总数,上一页游标和下一页游标
	 */
	public function get_follows($uid_or_name = NULL, $page = 1, $trim_status = 1)
	{
		return $this->_build_follow_data('friendships/friends', $uid_or_name, NULL, $page, $trim_status);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取用户关注的用户UID列表
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/friendships/friends/ids
	 * @param uid_or_name	用户id或用户昵称 
	 * @param page 			页码
	 * @return array 		该用户关注列表id集合 包含总数,上一页游标和下一页游标
	 */
	public function get_follows_uids($uid_or_name = NULL, $page = 1)
	{
		return $this->_build_follow_data('friendships/friends/ids', $uid_or_name, NULL, $page );
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取当前登录用户的关注人中又关注了指定用户的用户列表
	 * 即 "这些人也关注他"
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/friendships/friends_chain/followers
	 * @param uid_or_name 	制定用户id或昵称
	 * @param page 			页码
	 * @return array   		我关注人中关注了指定用户的用户信息集合
	 */
	public function get_my_follows_chain($uid_or_name = NULL, $page = 1)
	{
		$uid = $this->get_user_id_by_nick_name($uid_or_name);
		return $this->_build_follow_data('friendships/friends_chain/followers', $uid, $page);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取两个用户之间的共同关注人列表
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/friendships/friends/in_common
	 * @param uid_or_name 	需要获取共同关注关系的用户UID或昵称
	 * @param suid_or_name	需要获取共同关注关系的用户UID，默认为当前登录用户。
	 * @param page 			页码
	 * @param trim_status	返回值中user字段中的status字段开关，0：返回完整status字段、1：status字段仅返回status_id，默认为1。
	 * @return array 		共同关注用户信息集合
	 */
	public function get_common_follows($uid_or_name, $suid_or_name = NULL, $page = 1, $trim_status = 1)
	{
		$uid  = $this->get_user_id_by_nick_name($uid_or_name);
		$suid = $this->get_user_id_by_nick_name($suid_or_name);
		return $this->_build_follow_data('friendships/friends/in_common', $uid, $page, NULL, $trim_status, $suid);
 	}

 	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取当前登陆用户和指定用户共同关注人列表
	 * 即 我和目标用户的共同关注
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/friendships/friends/in_common
	 * @param $uid_or_name 	需要获取共同关注关系的用户UID或昵称
	 * @param page 			页码
	 * @param trim_status 	返回值中user字段中的status字段开关，0：返回完整status字段、1：status字段仅返回status_id，默认为1。
	 * @return array 		共同关注用户信息集合
	 */
 	public function get_my_common_follows($uid_or_name, $page = 1, $trim_status = 1)
 	{
 		return $this->get_common_follows($uid_or_name, NULL, $page, $trim_status);
 	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取用户的双向关注列表，即互粉列表
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/friendships/friends/bilateral
	 * @link http://open.weibo.com/wiki/2/friendships/friends/bilateral/ids
	 * @param uid_or_name 	需要获取双向关注列表的用户UID或昵称
	 * @param page 			昵称
	 * @param is_ids 		是否只获取互粉UID 默认:false
	 * @return array 		互粉用户信息集合
	 */
	public function get_bilateral_follows($uid_or_name = NULL, $page = 1, $is_ids = false)
	{
		$uid = $this->get_user_id_by_nick_name($uid_or_name);
		if($is_ids){
			return $this->_build_follow_data('friendships/friends/bilateral/ids', $uid, $page);
		}else{
			return $this->_build_follow_data('friendships/friends/bilateral', $uid, $page);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取用户的粉丝列表
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/friendships/followers
	 * @param uid_or_name 	需要查询的用户UID或昵称
	 * @param page 			页码
	 * @param trim_status 	返回值中user字段中的status字段开关，0：返回完整status字段、1：status字段仅返回status_id，默认为1。
	 * @return array 		该用户粉丝用户信息集合
	 */
	public function get_fans($uid_or_name = NULL, $page = 1, $trim_status = 1)
	{
		return $this->_build_follow_data('friendships/followers', $uid_or_name, NULL, $page, $trim_status);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取用户粉丝的用户UID列表
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/friendships/followers/ids
	 * @param uid_or_name 	需要查询的用户UID或昵称
	 * @param page 			页码
	 * @return array 		该用户粉丝用户ID集合
	 */
	public function get_fans_uids($uid_or_name = NULL, $page = 1)
	{
		return $this->_build_follow_data('friendships/followers/ids', $uid_or_name, NULL, $page);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取用户的活跃粉丝列表 最大不超过200
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/friendships/followers/active
	 * @param uid_or_name 	需要查询的用户UID或昵称
	 * @return array 		用户优质粉丝用户信息集合
	 */
	public function get_grade_fans($uid_or_name = NULL)
	{
		$uid = $this->get_user_id_by_nick_name($uid_or_name);
		return $this->_build_follow_data('friendships/followers/active', $uid);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 构建关注用户或取消关注
	 * - 根据method 做不同的接口请求
	 * -----------------------------
	 *
	 * @param method 		api方法
	 * @param uid_or_name 	用户id或用户昵称
	 * @return array 		关注或取消的用户信息集合
	 */
	private function _build_follow_action($method, $uid_or_name)
	{
		$params = $this->_req_before($method);
		if(is_numeric($uid_or_name)){
			$params['uid'] = $uid_or_name;
		}else{
			$params['screen_name'] = $uid_or_name;
		}
		return $this->post($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 关注一个用户
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/friendships/create
	 * @param uid_or_name 用户id或用户昵称
	 * @return array 		关注的用户信息集合
	 */
	public function create_follow($uid_or_name)
	{
		return $this->_build_follow_action('friendships/create', $uid_or_name);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 取消关注一个用户
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/friendships/destroy
	 * @param uid_or_name 	用户id或用户昵称
	 * @return array 		取消的用户信息集合
	 */
	public function delete_follow($uid_or_name)
	{
		return $this->_build_follow_action('friendships/destroy', $uid_or_name);
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== 账号接口 ========== =
	// ================================

	/**
	 * -----------------------------
	 * 获取当前登录用户的隐私设置
	 * -----------------------------
	 *
	 */
	public function get_account_privacy()
	{
		$params = $this->_req_before('account/get_privacy');
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取当前登录用户的API访问频率限制情况
	 * -----------------------------
	 *
	 */
	public function get_api_status()
	{
		$params = $this->_req_before('account/rate_limit_status');
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 退出登录
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/account/end_session
	 * @return array  退出用户信息集合
	 */
	public function account_logout()
	{
		$params = $this->_req_before('account/end_session');
		return $this->get($params);
	}

	// --------------------------------------------------------------------
	// ================================
	// = ========== 收藏接口 ========== =
	// ================================

	private function _build_favorites_param($f_id = 0, $tag_id = -1, $page = 1, $is_ids = false)
	{
		if($f_id != 0)
		{
			$params = $this->_req_before('favorites/show');
			$params['id'] = $f_id;
		}else{
			if($tag_id >= 0)
			{
				if($tag_id != 0)
				{
					if($is_ids)
					{
						$params = $this->_req_before('favorites/by_tags/ids');
					}else{
						$params = $this->_req_before('favorites/by_tags');
					}
					$params['tid'] = $tag_id;
				}else{
					$params = $this->_req_before('favorites/tags');
				}
				
			}else{

				if($is_ids){
					$params = $this->_req_before('favorites/ids');
				}else{
					$params = $this->_req_before('favorites');
				}
			}
			$params['page'] = $page;	
			$params['count'] = $this->page_count;
		}		
		return $this->get($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取当前登录用户的收藏列表
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/favorites
	 * @param page 		页码
	 * @param is_ids 	是否只获取收藏id列表
	 * @return array  	收藏的微博信息集合
	 */
	public function get_favorites($page = 1, $is_ids = false)
	{
		return $this->_build_favorites_param(0, -1, $page, $is_ids);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据收藏ID获取指定的收藏信息
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/favorites/show
	 * @param id 		收藏id			
	 * @return array  	指定ID的收藏微博信息集合
	 */
	public function get_favorites_by_id($id)
	{
		return $this->_build_favorites_param($id);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 获取当前登录用户的收藏标签列表
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/favorites/tags
	 * @param page 		页码
	 * @return array  	收藏标签信息集合
	 */
	public function get_favorites_tags($page = 1)
	{
		return $this->_build_favorites_param(0, 0, $page);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 根据标签获取当前登录用户该标签下的收藏列表
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/favorites/by_tags
	 * @link http://open.weibo.com/wiki/2/favorites/by_tags/ids
	 * @param tag_id 	需要查询的标签ID
	 * @param page 		页码
	 * @param is_ids 	是否只获取收藏id列表
	 * @return array  	该标签下收藏的微博信息集合
	 */
	public function get_favorites_by_tag($tag_id, $page = 1, $is_ids = false)
	{
		return $this->_build_favorites_param(0, $tag_id, $page, $is_ids);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 添加一条微博到收藏里
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/favorites/create
	 * @param id_or_mid 要收藏的微博ID或MID。	
	 * @return array  	收藏微博信息集合
	 */
	public function create_favorites($id_or_mid)
	{
		if(!is_numeric($id_or_mid)) $id_or_mid = $this->mid_to_id($id_or_mid);
		$params = $this->_req_before('favorites/create');
		$params['id'] = $id_or_mid;
		return $this->post($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 取消收藏一条微博
	 * - 支持批量删除模式 用半角逗号分隔，最多不超过10个。
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/favorites/destroy
	 * @param id_or_mid 要收藏的微博ID或MID。	
	 * @return array  	删除收藏微博信息集合
	 */
	public function delete_favorites($id_or_mid)
	{
		if(is_array($id_or_mid)) $id_or_mid = implode(',', $id_or_mid);

		$this->_ci->load->helper('string');
		$num = segment_num($id_or_mid);
		if($num == 1){
			if(!is_numeric($id_or_mid)) $id_or_mid = $this->mid_to_id($id_or_mid);
			if($id_or_mid != -1){
				$params = $this->_req_before('favorites/destroy');
				$params['id'] = $id_or_mid;
			}else{
				return false;
			}
		}else if($num > 1 && $num <= 10){
			$params = $this->_req_before('favorites/destroy_batch');
			$params['ids'] = $id_or_mid;
		}else{
			return false;
		}
		return $this->post($params);
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 更新收藏标签
	 * -参数tags为空即为删除标签
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/favorites/tags/update
	 * @param id 	需要更新的收藏ID
	 * @param tags 	需要更新的标签内容，用半角逗号分隔，最多不超过2条。
	 * @return array 更新后收藏微博信息集合
	 */
	public function update_favorites_tag($id_or_mid, $tags)
	{
		if(is_array($tags)) $tags = implode(',', $tags);
		$this->_ci->load->helper('string');
		$num = segment_num($tags);
		if($num <= 2)
		{
			if(!is_numeric($id_or_mid)) $id_or_mid = $this->mid_to_id($id_or_mid);
			$params = $this->_req_before('favorites/tags/update');
			$params['id'] = $id_or_mid;
			$params['tags'] = $tags;
			// var_dump($params);
			return $this->post($params);
		}else{
			return false;
		}		
	}


	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 更新当前登录用户所有收藏下的指定标签
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/favorites/tags/update_batch
	 * @param tag_id 		需要更新的标签ID
	 * @param tag_title 	需要更新的标签内容
	 * @return array 		更新后收藏标签信息集合
	 */
	public function update_favorites_tag_by_id($tag_id, $tag_title)
	{
		$params = $this->_req_before('favorites/tags/update_batch');
		$params['tid'] = $tag_id;
		$params['tag'] = $tag_title;
		return $this->post($params);

	}


	// --------------------------------------------------------------------

	/**
	 * -----------------------------
	 * 删除当前登录用户所有收藏下的指定标签
	 * - 删除标签后，该用户所有收藏中，添加了该标签的收藏均解除与该标签的关联关系
	 * -----------------------------
	 *
	 * @link http://open.weibo.com/wiki/2/favorites/tags/destroy_batch
	 * @param tag_id 		需要删除的标签ID
	 * @return array 		true 成功, false 失败
	 */
	public function delete_favorites_tag_by_id($tag_id)
	{
		$params = $this->_req_before('favorites/tags/destroy_batch');
		$params['tid'] = $tag_id;
		return $this->post($params);
	}

	// --------------------------------------------------------------------








}