<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo App Controller
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
	 * ---------------------------
	 * - 加载 App 和 分类 模型
	 * - 获取所有分类
	 * ---------------------------
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('app_model', 'app');
		// $this->load->model('category_model', 'category');
		// $this->data['categorys'] = $this->category->find_all();
	}

	// --------------------------------------------------------------------

	function lists()
	{
		
		$this->load->view('find_app', $this->data);
	}

	// --------------------------------------------------------------------



	// /**
	//  * -----------------------------
	//  * App 首页
	//  * -----------------------------
	//  * 
	//  * @link 
	//  * @return void
	//  */
	// function index() {
	// 	$this->load->view('app/app_list', $this->data);
	// }

	// // --------------------------------------------------------------------

	// /**
	//  * -----------------------------
	//  * 根据分类别名获取 App
	//  * -----------------------------
	//  * 
	//  * @link 
	//  * @param category_alias 分类别名
	//  * @return void
	//  */
	// function category($category_alias){
	// 	$cur_category               = array_shift($this->category->find_by_alias($category_alias));
	// 	$category_id                = $cur_category['category_id'];
	// 	$params['app_category_id']  = $category_id;
	// 	$params['app_status']       = APP_STATUS_SHOW;
	// 	$this->data['cur_category'] = $cur_category;
	// 	$this->data['apps']         = $this->app->find_where($params);
	// 	$this->load->view('app/app_list', $this->data);
	// }

	// // --------------------------------------------------------------------

}