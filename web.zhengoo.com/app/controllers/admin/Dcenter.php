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
class Dcenter extends ZG_Admin_Controller {

	/**
	 *---------------------------
	 * 构造方法
	 *---------------------------
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('dcenter_model', 'dcenter');
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 数据来源中心,主界面
	 *---------------------------
	 *
	 * @return void
	 */
	function main() {
		$this->load->view('dcenter/dcenter_main');
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 初始化该分类的抓取数据
	 *---------------------------
	 *
	 * @param category_alias 分类拼音别名
	 * @param category_id    分类编号id 
 	 * @return void
	 */
	function init($category_alias, $category_id){
		$dcenter = array(
			'dcenter_category_id'    => $category_id,
			'dcenter_category_alias' => $category_alias,
			'dcenter_category_name'  => $this->input->get('category_name')

		);
		$this->dcenter->add($dcenter);
		$this->apple();
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 展示app store 分类数据获取列表
	 *---------------------------
	 *
	 * @return void
	 */
	function apple() {
		$this->load->model('category_model', 'category');
		$categorys = $this->category->find_all();
		$app_datas;
		foreach ($categorys as $category) {
			$data['dcenters'] = $this->dcenter->find_where(array('dcenter_category_id' => $category['category_id']));
			$data['category'] = $category;
			$app_datas[] = $data;
		}
		$this->data['app_datas'] = $app_datas;
		$this->load->view('admin/dcenter/dcenter_app_store', $this->data);
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 获取appStore分类列表数据
	 *---------------------------
	 *
	 * @param category_alias 分类拼音别名
	 * @param category_id    分类编号id 
 	 * @return void
	 */
	function getAppList() {
		$this->load->library('appstore');
		$this->load->model('app_model', 'app');
		$dcenter_id = $this->input->get('dcenter_id');
		$category_alias = $this->input->get('category_alias');
		if($dcenter_id){
			$dcenter = array_shift($this->dcenter->find_by_id($dcenter_id));
			if($dcenter['dcenter_status'] == DCENTER_STATUS_STOP){
				$this->page = $dcenter['dcenter_page'];
			}else{
				$this->page = $dcenter['dcenter_page'] + 1;
			}

			$apps = $this->appstore->getAppsByLetterAndPage($dcenter['dcenter_url'], $dcenter['dcenter_letter'], $this->page);
			
		}else if($category_alias){
			$this->load->config('appstore');
			$app_store_category_ids = $this->config->item('app_store_category_ids');
			$category_appstore_id = $app_store_category_ids[$category_alias];
			$app_hot_url = preg_replace('(#category_alias#)', $category_alias, $this->config->item('appstore_category_url_tpl'));
			$app_hot_url = preg_replace('(#category_id#)', $category_appstore_id, $app_hot_url);
			$apps = $this->appstore->get_hot_apps($app_hot_url);
		}

		if(isset($apps)){
			$result    = $this->app->addApp($apps, TRUE);
			$is_next   = $this->appstore->is_next($this->page);
			$app_count = count($apps) - count($result);
			$info['dcenter_id'] = $dcenter_id;
			$info['app_count']  = $app_count;
		
			$info['next_page']  = $is_next;
			$json['result'] = 1;
			$json['info']   = $info;

			if(count($apps) != count($result)) $this->dcenter->updateDcenter($dcenter_id, $app_count, $is_next);
		}else{
			$json['result'] = 0;
		}
		echo json_encode($json);
	}

	// --------------------------------------------------------------------

}