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

define('DEFAULT_PAGE_NUM', 25);
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
| pin 来源常量
|--------------------------------------------------------------------------
|
| 
*/
define('PIN_SOURCE_ZHENGOO', 					0);			//珍果web上传
define('PIN_SOURCE_OFFICIAL', 					1);			//官方获取
define('PIN_SOURCE_BOOKMARK', 					2);			//书签插件
define('PIN_SOURCE_BROWSER', 					3);			//浏览器插件
define('PIN_SOURCE_REPRODUCED', 				4);			//网络转载
define('PIN_SOURCE_IPHONE', 					5);			//iphone
define('PIN_SOURCE_ANDROID', 					6);			//android
/* End of file constants.php */
/* Location: ./application/config/constants.php */