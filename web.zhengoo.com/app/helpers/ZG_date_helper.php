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
 * ZhenGoo Date Helpers
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
 * 格式化传入的unix时间 和 当前时间 的距离
 * - 支持 秒
 * - 支持 分
 * - 支持 小时
 * - 支持 天
 * - 超过 3天现实time的日期 （需根据is_show_date）
 * ----------------------------- 
 *
 * @access	public
 * @param	time 需格式化的时间
 * @param   is_show_data 时间较长时是否需要现实时间字符串
 * @return	string  距离当前时间字符串
 */
if ( ! function_exists('format_date'))
{
	function format_date($time, $is_show_date = TRUE)
	{
		$limit = time() - $time;
		if($limit == 0)
		{
			return '刚刚';
		}
	    if($limit < 60)
	    {
	        return $limit . '秒之前';
	    }
	    if($limit >= 60 && $limit < 3600)
	    {
	        return floor($limit/60) . '分前';
	    }
	    if($limit >= 3600 && $limit < 86400)
	    {
	        return floor($limit/3600) . '小时前';
	    }
	    if($limit >= 86400 and $limit<259200)
	    {
	        return floor($limit/86400) . '天前';
	    }
	    if($limit >= 259200 and $is_show_date)
	    {
	        return date('Y-m-d', $time);
	    }else{
	        return '';
	    }
	}
}
// ------------------------------------------------------------------------