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
 * 根据第三方平台名称字符串, 换取相
 * 应的标示
 * - 详情 		config/constants.php
 * - 新浪微博  	AUTH_SOURCE_WEIBO
 * - 点点网 		AUTH_SOURCE_DIANDIAN
 * - 人人网		AUTH_SOURCE_RENREN
 * - pocket 	AUTH_SOURCE_POCKET
 * - 淘宝 		AUTH_SOURCE_TAOBAO
 * ---------------------------
 */

if ( ! function_exists('auth_source_constant'))
{
	function auth_source_constant($source)
	{
		switch ($source)
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
		}
	}
}

// ------------------------------------------------------------------------
