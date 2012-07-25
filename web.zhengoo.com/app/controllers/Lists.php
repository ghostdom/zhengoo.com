<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo List Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class Lists extends ZG_Controller {

	/**
	 * ---------------------------
	 * 
	 * ---------------------------
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('list_model', 'list');
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 创建新列表
	 * ---------------------------
	 *
	 * @return void
	 */
	public function create()
	{
		if($this->is_post())
		{
			$list = $_POST;
			if($this->is_user() && $list['list_title'])
			{
				$list['list_uid']         = $this->sess_user['user_id'];
				$list['list_create_time'] = time();
				$list_id = $this->list->insert($list);
				redirect('/'.$this->sess_user['user_login_name']);
			}
		}

	}

	// --------------------------------------------------------------------

	public function collect_list($user_login_name, $list_id)
	{
		// var_dump($list_title);
		if($this->is_user() && $this->sess_user['user_login_name'] == $user_login_name)
		{
			$user_id = $this->sess_user['user_id'];
		}else{
			$this->load->model('user_model', 'usre');
			$user = $this->user->find_by_login_name($user_login_name);
			if($user){
				$user_id = $user[0]['user_id'];
			}
		}

		if(isset($user_id)){
			$lists = $this->list->find_where(array('list_uid' => $user_id, 'list_title', $list_title));
		
		}else{
			echo "404";
		}
	}
}