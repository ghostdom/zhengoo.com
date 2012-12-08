<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('DEFAULT_PAGE_NUM', 						40);

define('ADMIN_PATH', 							'admin');

/*
|--------------------------------------------------------------------------
| user type
|--------------------------------------------------------------------------
|
| 
*/
define('USER_TYPE_CLIENT', 0);				// 用户类型: 普通用户
define('USER_TYPE_ADMIN',  1);				// 用户类型: 管理员

/*
|--------------------------------------------------------------------------
| message type
|--------------------------------------------------------------------------
|
| 
*/
define('MESSAGE_TYPE_SUCCESS', 	'message_type_success');
define('MESSAGE_TYPE_INFO', 	'message_type_info');
define('MESSAGE_TYPE_WARN', 	'message_type_warn');
define('MESSAGE_TYPE_ERROR', 	'message_type_error');

/*
|--------------------------------------------------------------------------
| 常用session值,key
|--------------------------------------------------------------------------
|
| 
*/
define('SESSION_ADMIN', 		'session_admin'); 		// 后台用户 session key 
define('SESSION_USER', 			'session_user');		// 前台用户 session key
define('SESSION_AUTH', 			'session_auth'); 		// 第三方授权信息 session key
define('SESSION_AUTH_USER', 	'session_auth_user'); 	// 第三方授权用户信息 session key

/*
|--------------------------------------------------------------------------
| App设备常量
|--------------------------------------------------------------------------
|
| 
*/
define('APP_DEVICE_ALL', 	0);
define('APP_DEVICE_IPHONE', 1);
define('APP_DEVICE_IPAD', 	2);

/*
|--------------------------------------------------------------------------
| 来源常量
|--------------------------------------------------------------------------
|
| 
*/
define('ZG_SOURCE_ZHENGOO', 					0);			//珍果web上传
define('ZG_SOURCE_OFFICIAL', 					1);			//官方获取
define('ZG_SOURCE_BOOKMARK', 					2);			//书签插件
define('ZG_SOURCE_BROWSER', 					3);			//浏览器插件
define('ZG_SOURCE_REPRODUCED', 					4);			//网络转载
define('ZG_SOURCE_IPHONE', 						5);			//iphone
define('ZG_SOURCE_ANDROID', 					6);			//android

/*
|--------------------------------------------------------------------------
| 第三方接入平台
|--------------------------------------------------------------------------
|
| 
*/
define('AUTH_SOURCE_WEIBO', 	1); // 第三方平台: 新浪微博
define('AUTH_SOURCE_QQ', 		2); 	// 第三方平台: 淘宝网
define('AUTH_SOURCE_RENREN', 	3); // 第三方平台: 人人网
define('AUTH_SOURCE_POCKET', 	4); // 第三方平台: Pocket
define('AUTH_SOURCE_TAOBAO', 	5); // 第三方平台: 淘宝网
define('AUTH_SOURCE_DIANDIAN', 	6); // 第三方平台: 点点


/* End of file constants.php */
/* Location: ./application/config/constants.php */