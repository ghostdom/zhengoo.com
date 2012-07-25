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
 * ZhenGoo Core Loader
 *
 * ZhenGoo核心读取类 实现主题功能
 *
 * @package		ZhenGoo
 * @subpackage	Core
 * @category	Core
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class ZG_Loader extends CI_Loader {

	/**
	 * ----------------------------
	 * 
	 * ----------------------------
	 */
	function theme_on($theme) {
		$CI =& get_instance();
		$this->_ci_view_paths = array(APPPATH . 'views' . DIRECTORY_SEPARATOR . $theme . DIRECTORY_SEPARATOR => TRUE);
	}

	// --------------------------------------------------------------------

	/**
	 * ----------------------------
	 * 
	 * ----------------------------
	 */
	function theme_off() {
		$this->_ci_view_paths = array(APPPATH.'views/'	=> TRUE);
	}

}