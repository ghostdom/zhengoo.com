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
		$this->load->library('appstore');

		$url_or_id = $this->input->get('app');
		$app_store_id = $this->appstore->get_app_id($url_or_id);
		if($app_store_id != 0)
		{
			$this->load->model('app_model', 'app');
			$app = $this->app->find_by_store_id($app_store_id);
			if(empty($app))
			{
				$app = $this->appstore->get_app_info($app_store_id);
			}
			$app['app_title'] = $this->input->get('title');
			$this->data['app'] = $app;
			$this->load->view('collect_add', $this->data);
		}else{


		}
		
	}

	// --------------------------------------------------------------------
}