<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo Collect Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class Collect extends ZG_Controller {

	/**
	 * ---------------------------
	 * 
	 * 
	 * ---------------------------
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('collect_model', 'collect');
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 
	 * 
	 * ---------------------------
	 *
	 * @return void
	 */
	function add()
	{
		if(parent::is_post()){
			$this->load->model('app_model', 'app');
			$app['app_title']     = $this->input->post('app_title');
			$app['app_store_id']  = $this->input->post('app_store_id');
			$app['app_store_url'] = $this->input->post('app_store_url');
			$app_id = $this->app->insert_app($app);

			$collect_list_id = $this->input->post('collect_list_id');
 			if($collect_list_id == -1){
 				$this->load->model('list_model','list');
				$list['list_uid']         = $this->sess_user['user_id'];
				$list['list_title']       = $this->input->post('list_title');
				$list['list_create_time'] = time();
				$collect_list_id = $this->list->insert($list);
 			}

			$collect['collect_app_id']  = $app_id;
			$collect['collect_list_id'] = $collect_list_id;
			$collect['collect_note']    = $this->input->post('collect_note');
			$collect['collect_user_id'] = $this->sess_user['user_id'];
			$collect['collect_time']    = time();

			$this->collect->insert($collect);
		}else{
			$this->load->library('appstore');
			$url_or_id = $this->input->get('app');
			$app_store_id = $this->appstore->get_app_id($url_or_id);
			if($app_store_id != 0)
			{
				$this->load->model('list_model', 'list');
				$app['app_store_id']  = $app_store_id;
				$app['app_icon']      = $this->input->get('icon');
				$app['app_title']     = $this->input->get('title');
				$app['app_desc']      = $this->input->get('desc');
				$app['app_store_url'] = $this->input->get('app');
				$this->data['lists'] = $this->list->find_by_uid($this->sess_user['user_id']);
				$this->data['app']   = $app;
				$this->load->view('collect_add', $this->data);
			}else{


			}
		}
		
	}

	// --------------------------------------------------------------------
}