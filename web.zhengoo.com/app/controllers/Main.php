<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo Admin Data Center Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class Main extends ZG_Controller {


	/**
	 * ---------------------------
	 * 
	 * ---------------------------
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 网站主页
	 * ---------------------------
	 *
	 * @return void
	 */
	function welcome()
	{
		$this->load->view('index', $this->data);
	}

	// --------------------------------------------------------------------


	/**
	 * ---------------------------
	 * 网站工具页面
	 * ---------------------------
	 *
	 * @return void
	 */
	function tools() 
	{
		$this->load->view('tools', $this->data);
	}

}