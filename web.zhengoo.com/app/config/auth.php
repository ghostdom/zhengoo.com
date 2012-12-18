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
$config['weibo_app_key']    = 2862748413;
$config['weibo_app_secret'] = '563ff72a8a349d81af28103fa7f3101e';
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
| Pocket App相关配置
| -------------------------------------------------------------------
| 
| - pocket_app_key 
*/
$config['pocket_app_key']    = '6e3gfu1ap0Z02t9347T6182Q13A6p75d';

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
$config['diandian_app_key']    	= 'fEBLp5935A';
$config['diandian_app_secret']	= '91SMNdo8hTjubZda935YmnWc00qQ47HGnlt9';
$config['diandian_user_name']   = 'ghostdom.wj@gmail.com';
$config['diandian_password']    = 'wujun123';

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
	'auth_domain'  => 'id'
);

$config['qq_auth'] 	= array(
	'access_token' => 'auth_access_token',
	'expires_in'   => 'auth_expired_time',
	'auth_domain'  => 'name'
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
	'screen_name' => 'user_nice_name',
	'avatar_large' => 'user_avatar',
);

$config['qq_user'] = array(
	'nick' => 'user_nice_name',
	'head' => 'user_avatar'
);


