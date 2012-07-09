<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo Admin App Manger Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class App extends ZG_Admin_Controller {

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
	}

	// --------------------------------------------------------------------
	
	/**
	 *---------------------------
	 * app管理列表
	 *---------------------------
	 *
	 * @return void
	 */
	function grid() {
		$this->load->library('pagination');
		$apps = $this->app->find_all($this->page);
		$apps_count = $this->app->count();
		$this->data['apps'] = $apps;
		$this->data['apps_count'] = $apps_count;
		$this->load->view('admin/app/app_grid', $this->data);
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 添加app详细信息
	 *---------------------------
	 *
	 * @return void
	 */
	function add(){
		$this->load->library('appstore');
		$id_or_url = $this->input->get('id_or_url');
		$app = $this->appstore->get_app_info($id_or_url);
		if(!empty($app)){
			$app_store_id = $this->appstore->get_appstore_id();
			$is_app = array_shift($this->app->find_by_store_id($app_store_id));
			$iphone_screen = $app['iphone_screen'];
			$ipad_screen   = $app['ipad_screen'];
			unset($app['iphone_screen']);
			unset($app['ipad_screen']);
			if($this->input->get('app_id')){
				$app_id = $this->input->get('app_id');
				$app['app_id'] = $app_id;
			}else if($is_app) {
				$app_id = $is_app['app_id'];
				$app['app_id'] = $app_id;
			}
			$save_result = $this->app->save($app);
			if(!isset($app_id)){
				$app_id = $save_result;
				$app['app_id'] = $app_id;
			}
			$this->_add_screen($iphone_screen, $app);
			$this->_add_screen($ipad_screen, $app, APP_DEVICE_IPAD);
			$json['result'] = 1;
			$json['app'] = $app;
		}else{
			$json['result'] = 0;
		}
		echo json_encode($json);
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 设置/取消 热门应用
	 *---------------------------
	 *
	 * @return void
	 */
	function hot() {
		$app_id = $this->input->get('app_id');
		$result = $this->app->update($app_id, array('app_hot' => $this->input->get('app_hot')));
		if($result > 0){
			$json['result'] = 1;
		}else{
			$json['result'] = 0;
		}
		echo json_encode($json);
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 通过关键字 搜索应用
	 * - 从app store api 中搜索
	 * - 从搜索结果中分类出本地已存在的
	 *---------------------------
	 *
	 * @return void
	 */
	function seach() {
		$keyword = $this->input->get('keyword');
		if($keyword){
			$this->load->library('appstore');
			$seach_apps = $this->appstore->seach_app($keyword);
			foreach ($seach_apps as $app) {
				$local_app = array_shift($this->app->find_by_store_id($app['app_store_id']));
				if($local_app){
					$apps[] = $local_app;
				}else{
					$apps[] = $app;
				}
			}
			$this->data['apps'] = $apps;
			$this->load->view('admin/app/app_grid', $this->data);
		}else{
			redirect('/admin/app/grid');
		}
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 添加应用时,同时添加官方应用截屏图片
	 * - 截屏图片有 ipad 和 ipohne
	 *---------------------------
	 *
	 * @return void
	 */
	private function _add_screen($screens, $app, $app_device = APP_DEVICE_IPHONE){
		$this->load->model('pin_model', 'pin');
		$d_where = array(
				'pin_app_id' => $app['app_id'],
				'pin_type'   => PIN_TYPE_MAST,
				'pin_device' => $app_device
			);
		$this->pin->delete_where($d_where);
		foreach ($screens as $value) {
			$pin['pin_app_id']      = $app['app_id'];
			$pin['pin_image']       = $value;
			$pin['pin_category_id'] = $app['app_category_id'];
			$pin['pin_content']     = $app['app_desc'];
			$pin['pin_price']       = $app['app_price'];
			$pin['pin_link']        = $app['app_store_url'];
			$pin['pin_type']        = PIN_TYPE_MAST;
			$pin['pin_device']      = $app_device;
			$pin['pin_time']        = time();
			$pin['pin_source']      = PIN_SOURCE_OFFICIAL;
			$this->pin->insert($pin);
		}
	}
}

/* End of file App.php */
/* Location: ./controllers/App.php */