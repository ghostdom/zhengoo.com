<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * www.ZhenGoo.com 
 *
 * 基于Codeigniter的
 * 
 * @package		ZhenGoo
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @copyright	Copyright (c) 20011 - 2012, ZhenGoo.com.
 * @link		http://www.ZhenGoo.com
 * @version		0.1.0
 */

// --------------------------------------------------------------------

/**
 * ZhenGoo Category Model
 *
 * ZhenGoo 分类模块  模型类
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
define('CATEGORY_DEFAULT_USER', 	0);		/* 表示分类所属用户为: 系统默认 */
define('CATEGORY_PARENT', 			0);		/* 父分类默认值 */

define('CATEGORY_STATUS_SHOW', 		0);		/* 表示分类状态：显示 */
define('CATEGORY_STATUS_HIDE', 		1);		/* 表示分类状态：隐藏 */
class Category_Model extends ZG_Model {
	
	
}
