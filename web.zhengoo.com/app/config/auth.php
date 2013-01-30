<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| 第三方开放平台App应用 相关配置
| -------------------------------------------------------------------
| 
| 
| 
| 
|
*/

// --------------------------------------------------------------------

/*
| -------------------------------------------------------------------
| 新浪微博 App相关配置
| -------------------------------------------------------------------
| 
| - weibo_app_key 
| - weibo_app_secret
| - weibo_user_name
| - weibo_password
*/
$config['weibo_app_key']    = 3128652323;
$config['weibo_app_secret'] = '10eceee9346fa845ae763365a45cb9a0';
$config['weibo_user_name']  = 'sns@zhengoo.com';
$config['weibo_password']   = 'zhengoo_sns';
$config['weibo_home_url']   = 'http://www.weibo.com/';

// --------------------------------------------------------------------

/*
| -------------------------------------------------------------------
| QQ互联 App相关配置
| -------------------------------------------------------------------
| 
| - qq_app_key 
| - qq_app_secret 
*/
$config['qq_app_key']    = 100330084; //qq互联
$config['qq_app_secret'] = 'b05407ad5d5c4677deb462076479cf7a'; 
// $config['qq_app_key']    = 100627363;
// $config['qq_app_secret'] = '452735d1d591c14c84e6556375466188';
$config['qq_home_url']   = 'http://t.qq.com/';

// --------------------------------------------------------------------

/*
| -------------------------------------------------------------------
| 微信 App相关配置
| -------------------------------------------------------------------
| 
| - weixin_app_key 
| - weixin_app_secret 
*/
$config['weixin_app_key']    = 'wx9e3fefadac23914e';
$config['weixin_app_secret'] = '82fbb368b8bd98d1f1ea5049403328e3'; 

// --------------------------------------------------------------------

/*
| -------------------------------------------------------------------
| 淘宝网 App相关配置
| -------------------------------------------------------------------
| 
| - taobao_app_key 
| - taobao_app_secret 
*/
$config['taobao_app_key']    = 21044830;
$config['taobao_app_secret'] = '8a53af1a02eafc9e7d0daf78214f43b9';

// --------------------------------------------------------------------

/*
| -------------------------------------------------------------------
| 人人网 App相关配置
| -------------------------------------------------------------------
| 
| - renren_app_key 
| - renren_app_secret 
*/
$config['renren_app_key']    = '6da0a54d844f4407b0ec1589b838fe10';
$config['renren_app_secret'] = 'c85b1d32c7e047389c4b08f2322f9f60';

// --------------------------------------------------------------------

/*
| -------------------------------------------------------------------
| Pocket App相关配置
| -------------------------------------------------------------------
| 
| - pocket_app_key 
*/
$config['pocket_app_key']    = '11493-356029104538cedaacb2c3e9';

// --------------------------------------------------------------------

/*
| -------------------------------------------------------------------
| 点点网 App相关配置
| -------------------------------------------------------------------
| 
| - diandian_app_key 
| - diandian_app_secret
| - diandian_user_name
| - diandian_user_password
*/
$config['diandian_app_key']    	= '4QmYMlAHNN';
$config['diandian_app_secret']	= '04lj9oaEFoGjqbjeev4AT2WFjp8DAN5z5QGI';
$config['diandian_user_name']   = 'sns@zhengoo.com';
$config['diandian_password']    = 'zhengoo_sns';

// --------------------------------------------------------------------

/*
| -------------------------------------------------------------------
| 500px App相关配置
| -------------------------------------------------------------------
| 
| - 500px_app_key 
| - 500px_app_secret
*/
$config['500px_app_key']    	= 'bF3ZmX2snwPDj4oPyxXlxZESEc1plz10xMfuO5hB';
$config['500px_app_secret']		= 'LXuUjh4yDpv1vsvQOZac9MH5i9hVcGDJf2h0xoOW';
// $config['500px_user_name']   = 'ghostdom.wj@gmail.com';
// $config['500px_password']    = 'wujun123';

// --------------------------------------------------------------------

/*
| -------------------------------------------------------------------
| evernote App相关配置
| -------------------------------------------------------------------
| 
| - evernote_app_key 
| - evernote_app_secret
*/
$config['evernote_app_key']    		= 'zhengoo';
$config['evernote_app_secret']		= 'b9ce0a5f1747fa4a';

// --------------------------------------------------------------------

/*
| -------------------------------------------------------------------
| 麦库笔记 App相关配置
| -------------------------------------------------------------------
| 
| - mknote_app_key 
| - mknote_app_secret
*/
$config['mknote_app_key']    		= '1ed5';
$config['mknote_app_secret']		= 'c9c09066f422';

/*
| -------------------------------------------------------------------
| 豆瓣 App相关配置
| -------------------------------------------------------------------
| 
| - douban_app_key 
| - douban_app_secret
*/
$config['douban_app_key'] 		= '035ec9f0164a21680a1c5dd042de6438';
$config['douban_app_secret'] 	= '6445a5e3c06459a9';
$config['douban_home_url'] 		= 'http://www.douban.com/people/';


/*
| -------------------------------------------------------------------
| 大众点评 App相关配置
| -------------------------------------------------------------------
| 
| - dianping_app_key 
| - dianping_app_secret
*/
$config['dianping_app_key']    = '2962775321';
$config['dianping_app_secret'] = '13aad3d108734741a081b769b10b7aaa';



// --------------------------------------------------------------------
// --------------------------------------------------------------------
// --------------------------------------------------------------------



/*
| -------------------------------------------------------------------
| 针对每一个开放平台对应换取 access_token 不同的参数, 以下配置对应相应的 
| -------------------------------------------------------------------
| 
| - 新浪微博 
| - 腾讯
| - 淘宝
| - 点点
*/

$config['weibo_auth'] 	= array(
	'access_token' => 'auth_access_token',
	'expires_in'   => 'auth_expired_time',
	'uid'          => 'auth_user',
);

$config['qq_auth'] 	= array(
	'access_token' => 'auth_access_token',
	'expires_in'   => 'auth_expired_time',
);

$config['renren_auth'] = array(
	'access_token' 	=> 'auth_access_token',
	'refresh_token' => 'auth_refresh_token',
 	'expires_in'   	=> 'auth_expired_time',
 	'user|id'      	=> 'auth_user'
);

$config['taobao_auth'] 	= array(
	'access_token'   => 'auth_access_token',
	'expires_in'     => 'auth_expired_time',
	'taobao_user_id' => 'auth_user',
	'refresh_token'  => 'auth_refresh_token'
);

$config['diandian_auth'] = array(
	'access_token'  => 'auth_access_token',
	'refresh_token' => 'auth_refresh_token',
	'expires_in'    => 'auth_expired_time',
	'uid'           => 'auth_user'
);

$config['pocket_auth'] = array(
	'access_token' => 'auth_access_token',
	'username'     => 'auth_user'
);

$config['douban_auth'] = array(
	'access_token'   => 'auth_access_token',
	'refresh_token'  => 'auth_refresh_token',
	'expires_in'     => 'auth_expired_time',
	'douban_user_id' => 'auth_user'
);
// --------------------------------------------------------------------
/*
| -------------------------------------------------------------------
| 针对每一个开放平台用户 domain 信息
| -------------------------------------------------------------------
| 
| - 新浪微博 
| - 腾讯
| - 淘宝
| - 点点
*/
$config['oauths_domain_key'] = array(
		'weibo'    => 'profile_url',
		'qq'       => 'name',
		'renren'   => 'uid',
		'diandian' => 'blogs',
		'douban'   => 'uid'
 	);

// --------------------------------------------------------------------

/*
| -------------------------------------------------------------------
| 针对每一个开放平台对应 用户信息 不同的参数, 以下配置对应相应的 
| -------------------------------------------------------------------
| 
| - 新浪微博 
| - 腾讯
| - 淘宝
| - 点点
*/

$config['weibo_user'] = array(
	// 'email' 	  => 'user_email',
	'screen_name' => 'user_nice_name',
	'avatar_large' => 'user_avatar',

);

$config['qq_user'] = array(
	'nick' => 'user_nice_name',
	'head' => 'user_avatar'
);


// --------------------------------------------------------------------
