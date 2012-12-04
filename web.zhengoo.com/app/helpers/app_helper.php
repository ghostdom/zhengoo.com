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
 * ZhenGoo App Helpers
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
 * 获取应用图标地址， 图标有5种尺寸：
 * 
 * - 75x75 		
 * - 100x100 
 * - 175x175 
 * - 512x512
 * - 1024x1024 		
 * ---------------------------
 * @param app_icons json应用图片数据
 * @param size 所需尺寸 （75|100|512|1024）
 * @return 返回相应尺寸图片地址 
 */

if ( ! function_exists('app_icon'))
{
	function app_icon($app_icon, $size = 75)
	{
		if($app_icon){
			if($size == 1024){
				return $app_icon;
			}else{
				$sign = '-75';
				if($size == 75){
					$sign = '-65';
				}
				return substr_replace($app_icon, '.'.$size.'x'.$size.$sign.strrchr($app_icon, '.'), strripos($app_icon, '.'));
			}
		} else {
			$CI =& get_instance();
			return $CI->config->item('app_icon_default');
		}
		
	}
}

// ------------------------------------------------------------------------

/**
 * ---------------------------
 * 获取尺寸为75x75的应用图标	
 * ---------------------------
 * @param app_icons json应用图片数据
 * @return 75x75 图片地址 
 */

if ( ! function_exists('app_icon_75'))
{
	function app_icon_75($app_icon)
	{
		return app_icon($app_icon);
	}
}

// ------------------------------------------------------------------------

/**
 * ---------------------------
 *  获取尺寸为100x100的应用图标		
 * ---------------------------
 *
 * @param app_icon 最大图片地址
 * @return 100x100 图片地址 
 */
if ( ! function_exists('app_icon_100'))
{
	function app_icon_100($app_icon)
	{
		return app_icon($app_icon, 100);
	}
}

// ------------------------------------------------------------------------

/**
 * ---------------------------
 *  获取尺寸为175x175的应用图标		
 * ---------------------------
 *
 * @param app_icon 最大图片地址
 * @return 175x175 图片地址 
 */
if ( ! function_exists('app_icon_175'))
{
	function app_icon_175($app_icon)
	{
		return app_icon($app_icon, 175);
	}
}

// ------------------------------------------------------------------------

/**
 * ---------------------------
 *  获取尺寸为512x512的应用图标		
 * ---------------------------
 *
 * @param app_icon 最大图片地址
 * @return 512x512 图片地址 
 */
if ( ! function_exists('app_icon_512'))
{
	function app_icon_512($app_icon)
	{
		return app_icon($app_icon, 512);
	}
}

// ------------------------------------------------------------------------

/**
 * ---------------------------
 *  获取尺寸为512x512的应用图标		
 * ---------------------------
 *
 * @param app_icon   最大图片地址
 * @return 1024x1024 图片地址 
 */
if ( ! function_exists('app_icon_1024'))
{
	function app_icon_1024($app_icon)
	{
		return app_icon($app_icon, 1024);
	}
}

// ------------------------------------------------------------------------

/**
 * ---------------------------
 * 获取应用iphone截屏图片 尺寸
 *
 * -320x480
 * -640x960 (原图)	
 * ---------------------------
 *
 * @param screen_url 最大图片地址
 * @param size 图片
 * @return 处理后图片地址 
 */
if ( ! function_exists('iphone_screen'))
{
	function iphone_screen($screen_url, $size = 320)
	{
		if($screen_url)
		{
			if($size == 320){
				return str_replace(strrchr($screen_url, '.'), '.320x480-75.jpg', $screen_url);
			}else{
				return $screen_url;
			}
		}
	} 
}

// ------------------------------------------------------------------------

/**
 * ---------------------------
 * 获取应用iphone截屏图片 尺寸
 *
 * -320x480
 * ---------------------------
 *
 * @param screen_url 最大图片地址
 * @return 处理后图片地址 
 */
if ( ! function_exists('iphone_screen_320'))
{
	function iphone_screen_320($screen_url)
	{
		return iphone_screen($screen_url);
	}
}

// ------------------------------------------------------------------------

/**
 * ---------------------------
 * 获取应用ipad截屏图片 尺寸：
 * 
 * - 480x480 
 * - 1024x1024	
 * ---------------------------
 *
 * @param screen_url 最大图片地址
 * @param size 图片尺寸
 * @return 处理后图片地址 
 */
if ( ! function_exists('ipad_screen'))
{
	function ipad_screen($screen_url, $size = 480)
	{
		if($screen_url)
		{
			if($size == 480){
				return str_replace('.1024x1024-65', '.480x480-75', $screen_url);
			}else{
				return $screen_url;
			}
		}
	} 
}

// ------------------------------------------------------------------------

/**
 * ---------------------------
 * 获取应用ipad截屏图片 尺寸：
 * 
 * -480x480 	
 * ---------------------------
 *
 * @param screen_url 最大图片地址
 * @return 处理后图片地址 
 */
if ( ! function_exists('ipad_screen_480'))
{
	function ipad_screen_480($screen_url)
	{
		return ipad_screen($screen_url);
	} 
}

