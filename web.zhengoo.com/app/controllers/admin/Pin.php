<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo Admin Pin Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class Pin extends ZG_Admin_Controller {
	/**
	 *---------------------------
	 * 构造方法
	 *---------------------------
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('pin_model', 'pin');
	}

	// --------------------------------------------------------------------

	function grid() {
		
	}


}