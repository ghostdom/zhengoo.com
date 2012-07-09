<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo Index Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class Index extends ZG_Controller {

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
	 * 首页
	 *___________________________
	 *
	 * @return void
	 */
	function home() {
		$this->load->model('app_model', 'app');
		$this->load->model('category_model', 'category');
		$this->data['categorys'] = $this->category->find_all();
		$this->data['apps']      = $this->app->find_by_status(APP_STATUS_SHOW, $this->page);
		$this->load->view('index', $this->data);
	}

	// --------------------------------------------------------------------
	
}