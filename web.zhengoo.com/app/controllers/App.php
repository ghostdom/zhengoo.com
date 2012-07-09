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
class App extends ZG_Controller {

	/**
	 *---------------------------
	 * 构造方法
	 *---------------------------
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('app_model', 'app');
		$this->load->model('category_model', 'category');
		$this->data['categorys'] = $this->category->find_all();
	}

	// --------------------------------------------------------------------

	function index() {
		$this->load->view('app/app_list', $this->data);
	}

	// --------------------------------------------------------------------

	function category($category_alias){
		$cur_category               = array_shift($this->category->find_by_alias($category_alias));
		$category_id                = $cur_category['category_id'];
		$params['app_category_id']  = $category_id;
		$params['app_status']       = APP_STATUS_SHOW;
		$this->data['cur_category'] = $cur_category;
		$this->data['apps']         = $this->app->find_where($params);
		$this->load->view('app/app_list', $this->data);
	}

}