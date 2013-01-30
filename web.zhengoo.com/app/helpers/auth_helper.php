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
			case AUTH_SOURCE_NAME_WEIBO:
				return AUTH_SOURCE_WEIBO;
			case AUTH_SOURCE_NAME_DIANDIAN:
				return AUTH_SOURCE_DIANDIAN;
			case AUTH_SOURCE_NAME_RENREN:
				return AUTH_SOURCE_RENREN;
			case AUTH_SOURCE_NAME_POCKET:
				return AUTH_SOURCE_POCKET;
			case AUTH_SOURCE_NAME_TAOBAO:
				return AUTH_SOURCE_TAOBAO;
			case AUTH_SOURCE_NAME_QQ:
				return AUTH_SOURCE_QQ;
			case AUTH_SOURCE_NAME_EVERNOTE:
				return AUTH_SOURCE_EVERNOTE;
			case AUTH_SOURCE_NAME_WEIXIN:
				return AUTH_SOURCE_WEIBO;
			case AUTH_SOURCE_NAME_MKNOTE:
				return AUTH_SOURCE_MKNOTE;
			case AUTH_SOURCE_NAME_DOUBAN:
				return AUTH_SOURCE_DOUBAN;

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
				return AUTH_SOURCE_NAME_WEIBO;
			case AUTH_SOURCE_QQ:
				return AUTH_SOURCE_NAME_QQ;
			case AUTH_SOURCE_DIANDIAN:
				return AUTH_SOURCE_NAME_DIANDIAN;
			case AUTH_SOURCE_RENREN:
				return AUTH_SOURCE_NAME_RENREN;
			case AUTH_SOURCE_POCKET:
				return AUTH_SOURCE_NAME_POCKET;
			case AUTH_SOURCE_TAOBAO:
				return AUTH_SOURCE_NAME_TAOBAO;
			case AUTH_SOURCE_EVERNOTE:
				return AUTH_SOURCE_NAME_EVERNOTE;
			case AUTH_SOURCE_WEIXIN:
				return AUTH_SOURCE_NAME_WEIXIN;
			case AUTH_SOURCE_MKNOTE:
				return AUTH_SOURCE_NAME_MKNOTE;
			case AUTH_SOURCE_DOUBAN:
				return AUTH_SOURCE_NAME_DOUBAN;
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
