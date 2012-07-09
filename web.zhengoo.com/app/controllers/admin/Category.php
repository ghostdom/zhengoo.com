<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo Admin Category Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class Category extends ZG_Admin_Controller {

	/**
	 *---------------------------
	 * 构造方法
	 *___________________________
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('category_model', 'category');
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 数据来源中心,主界面
	 *___________________________
	 *
	 * @return void
	 */
	function main() {
		$this->data['category'] = $this->category->find_all();
		$this->load->view('admin/category/category_main', $this->data);
	}

	// --------------------------------------------------------------------
	
}