<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo Admin Index Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class Index extends ZG_Admin_Controller {

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 *
	 *___________________________
	 *
	 * @return void
	 */
	function __construct() {
		 parent::__construct();
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 后台登录
	 *___________________________
	 *
	 * @return void
	 */
	function login() {
		if(parent::is_post()) {
			$this->index();
		}else{
			$this->load->view('admin/login');
		}
	}

	// --------------------------------------------------------------------

	function index() {
		$this->load->view('index');
	}
	
}