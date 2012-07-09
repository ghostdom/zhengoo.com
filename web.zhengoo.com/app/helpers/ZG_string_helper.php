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
 * ZhenGoo String Helpers
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
 * -----------------------------
 * 获取字符被指定的分隔符,总共分割为多少段
 * - 如果传入数组 直接返回数组长度
 * - 默认分隔符为 ","
 * ----------------------------- 
 *
 * @access	public
 * @param	str 需要计算的字符串
 * @param   separator 分割符号
 * @return	int 段数
 */
if ( ! function_exists('segment_num'))
{
	function segment_num($str, $separator = ',')
	{
		if(is_array($str)){
			return count($str);
		}else{
			if(!empty($str)){
				return count(explode($separator, $str));
			}else{
				return 0;
			}
				
		}
	}
}
// ------------------------------------------------------------------------

/**
 * 计算字符串长度, 非中文２个字符算一个长度
 */
if ( ! function_exists('zh_strlen'))
{
	function zh_strlen($str)
	{
	    if ($str === null) { return 0; }

	    #/^[\x80-\xff]/ 匹配GB中文
	    #  /[\x{4e00}-\x{9fff}]/u 匹配utf-8中文
	    $charset = mb_detect_encoding($str, "UTF-8,GBK,GB2312");
	    if ($charset == 'UTF-8') {
	        //中文
	        $c = preg_replace('/[^\x{4e00}-\x{9fff}]+/u','', $str);
	        //非中文
	        $e = preg_replace('/[\x{4e00}-\x{9fff}]+/u','', $str);
	    } elseif ($charset == 'GBK' || $charset == 'GB2312'|| $charset=='CP936') {
	        //中文
	        $c = preg_replace('/[^\x80-\xff]+/','', $str);
	        //非中文
	        $e = preg_replace('/[\x80-\xff]+/','',  $str);
	    } else {
	        //按英文计算长度
	        return  intval(ceil(strlen($str)/2));
	    }

	    return mb_strlen($c, $charset) + intval(ceil(mb_strlen($e, $charset)/2));
	}
}

