<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * www.ZhenGoo.com 
 *
 * 
 * 
 * @package		ZhenGoo
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @copyright	Copyright (c) 20012 - 2013, ZhenGoo.com.
 * @link		http://www.ZhenGoo.com
 * @version		0.1.0
 */

// --------------------------------------------------------------------

/**
 * ZhenGoo Auth Helpers
 *
 *
 *
 * @package		ZhenGoo
 * @subpackage	helpers
 * @category	helpers
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */

// ------------------------------------------------------------------------

/**
 * ---------------------------
 * 根据第三方平台名称, 换取相
 * 应的来源标示
 * - 详情 		config/constants.php
 * - 新浪微博  	AUTH_SOURCE_WEIBO
 * - QQ 		AUTH_SOURCE_QQ
 * - 点点网 		AUTH_SOURCE_DIANDIAN
 * - 人人网		AUTH_SOURCE_RENREN
 * - pocket 	AUTH_SOURCE_POCKET
 * - 淘宝 		AUTH_SOURCE_TAOBAO
 * ---------------------------
 */

if ( ! function_exists('source_to_name'))
{
	function name_to_source($name)
	{
		switch ($name)
		{
			case 'weibo':
				return AUTH_SOURCE_WEIBO;
			case 'diandian':
				return AUTH_SOURCE_DIANDIAN;
			case 'renren':
				return AUTH_SOURCE_RENREN;
			case 'pocket':
				return AUTH_SOURCE_POCKET;
			case 'taobao':
				return AUTH_SOURCE_TAOBAO;
			case 'qq':
				return AUTH_SOURCE_QQ;
		}
	}
}

// ------------------------------------------------------------------------

/**
 * ---------------------------
 * 根据第三方来源标识, 换取相
 * 应的平台名称
 * - 详情 		config/constants.php
 * - 新浪微博  	AUTH_SOURCE_WEIBO
 * - QQ 		AUTH_SOURCE_QQ
 * - 点点网 		AUTH_SOURCE_DIANDIAN
 * - 人人网		AUTH_SOURCE_RENREN
 * - pocket 	AUTH_SOURCE_POCKET
 * - 淘宝 		AUTH_SOURCE_TAOBAO
 * ---------------------------
 */

if ( ! function_exists('source_to_name'))
{
	function source_to_name($source)
	{
		switch ($source)
		{
			case AUTH_SOURCE_WEIBO:
				return 'weibo';
			case AUTH_SOURCE_QQ:
				return 'qq';
			case AUTH_SOURCE_DIANDIAN:
				return 'diandian';
			case AUTH_SOURCE_RENREN:
				return 'renren';
			case AUTH_SOURCE_POCKET:
				return 'pocket';
			case AUTH_SOURCE_TAOBAO:
				return 'taobao';
			;
		}
	}
}

// ------------------------------------------------------------------------

/**
 * ---------------------------
 * 处理第三方平台头像url
 * 
 * - 新浪微博  
 * - 腾讯 		
 * ---------------------------
 */
if ( ! function_exists('auth_avatar'))
{
	function auth_avatar($avatar_url, $source_constant = AUTH_SOURCE_WEIBO)
	{
		switch ($source_constant) {
			case AUTH_SOURCE_WEIBO:
				return $avatar_url;
			case AUTH_SOURCE_QQ:
				return $avatar_url.'/180';
			default:
				return $avatar_url;
		}
	}
}

// ------------------------------------------------------------------------
