<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 *
 * 基于Codeigniter的
 * 
 * @package		ZhenGoo
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @copyright	Copyright (c) 20011 - 2012, pintutu.com.
 * @link		http://www.pintutu.com
 * @version		0.1.0
 */

// --------------------------------------------------------------------

/**
 * Zhengoo Pin Model
 *
 * Zhengoo pin图(app相关图片) 模型
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.pintutu.com
 */
define('PIN_STATUS_AUDITED', 		0);			//已审核
define('PIN_STATUS_UNAUDITED', 		1);			//未审核
define('PIN_STATUS_AUDIT', 			2);			//审核中
define('PIN_STATUS_ILLEGAL', 		3);			//不合法

define('PIN_TYPE_MAST', 			0);			//截屏类型: 普通
define('PIN_TYPE_UI', 				1);			//截屏类型: 界面
define('PIN_TYPE_SHOW_OFF',			2);			//截屏类型: 炫耀
class Pin_Model extends ZG_Model {
	
}