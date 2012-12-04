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
			$app['app_icon']	  = str_replace('.175x175-75', '', $this->input->post('app_icon'));
			$app['app_title']     = $this->input->post('app_title');
			$app['app_store_id']  = $this->input->post('app_store_id');
			$app['app_store_url'] = $this->input->post('app_store_url');
			$app['app_desc']      = $this->input->post('app_desc');
			$app_id = $this->app->insert_app($app);

			// $collect_list_id = $this->input->post('collect_list_id');
 		// 	if($collect_list_id == -1){
 		// 		$this->load->model('list_model','list');
			// 	$list['list_uid']         = $this->sess_user['user_id'];
			// 	$list['list_title']       = $this->input->post('list_title');
			// 	$list['list_create_time'] = time();
			// 	$collect_list_id = $this->list->insert($list);
 		// 	}

 			$collect_note = $this->input->post('collect_note');
			$collect['collect_app_id']   = $app_id;
			$collect['collect_store_id'] = $app['app_store_id'];
			$collect['collect_note']     = $collect_note ? $collect_note : $this->input->post('app_desc');
			$collect['collect_user_id']  = $this->sess_user['user_id'];
			$collect['collect_title']    = $app['app_title'];
			$collect['collect_icon']     = $app['app_icon'];
			$collect['collect_link']     = $app['app_store_url']; 
			$collect['collect_time']     = time();
			$this->collect->insert($collect);
		}else{
			$this->load->library('appstore');
			$url_or_id = $this->input->get('app');
			$app_store_id = $this->appstore->get_app_id($url_or_id);
			if($app_store_id != 0){
				$app['app_store_id']  = $app_store_id;
				$app['app_icon']      = $this->input->get('icon');
				$app['app_title']     = $this->input->get('title');
				$app['app_desc']      = $this->input->get('desc');
				$app['app_store_url'] = $this->input->get('app');

				$this->data['app']   = $app;
				$this->load->view('collect_add', $this->data);
			}else{
				echo  "404";
			}

		}
		
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
	function save_as()
	{
		$collect = $_POST;
		$app_desc = $collect['app_desc'];
		unset($collect['app_desc']);
		$collect['collect_user_id'] = $this->sess_user['user_id'];
		$collect['collect_time']    = time();
		$collect['collect_note'] 	= $collect['collect_note'] ? $collect['collect_note'] : $app_desc;
		$collect_id = $this->collect->save($collect);
		echo $collect_id;
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
	// function lists($user_login_name, $list_alias)
	// {
	// 	$user = $this->get_user_by_login_name($user_login_name);
	// 	if(isset($user)){
	// 		$this->load->model('list_model', 'list');
	// 		$list = $this->list->find_where(array('list_uid' => $user['user_id'], 'list_alias'=> $list_alias));
	// 		$this->_collect_left_data($list[0], $user);
	// 		$this->data['collects'] = $this->collect->find_by_list_with_app($list[0]['list_id'], $this->page);
	// 		$this->load->view('collect_lists', $this->data);
	// 	}else{
	// 		echo "404";
	// 	}
	// }

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 
	 * 
	 * ---------------------------
	 *
	 * @return void
	 */
	function info($user_login_name, $collect_id)
	{
		$user = $this->get_user_by_login_name($user_login_name);
		if($user){
			// $this->data['following_count'] = $this->ufollow->count(array('ufollow_who' => $user['user_id']));

			$this->load->model('ufollow_model', 'ufollow');
			$this->load->model('comment_model', 'comment');
			$this->data['user']            = $user;
			$this->data['collect']         = $this->collect->find_by_id_with_app($collect_id);
			$this->data['comments'] 	   = $this->comment->find_by_cid_with_user($collect_id, $this->page);
			$this->data['collect_count']   = $this->collect->count(array('collect_user_id' => $user['user_id']));
			$this->data['followers_count'] = $this->ufollow->count(array('ufollow_whom' => $user['user_id']));
			$this->data['followers'] 	   = $this->ufollow->get_followers_with_user($user['user_id'], 1, 30);
			if($this->sess_user && $user['user_id'] != $this->sess_user['user_id']){
				$this->data['ufollow_regard'] = $this->ufollow->get_regard($this->sess_user['user_id'], $user['user_id']);
			}

			$this->load->view('collect_info', $this->data);
		}else{
			echo "404";
		}
	}


	// --------------------------------------------------------------------

}