<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo Admin Index Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class Index extends ZG_Admin_Controller {

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
	 * ---------------------------
	 * 后台登录
	 * ---------------------------
	 *
	 * @return /admin/login
	 * @return void
	 */
	public function login() {
		if(parent::is_post()) {
			$this->load->model('user_model', 'user');
			$where = $_POST;
			$where['user_passwd'] = md5($where['user_passwd']);
			$where['user_type'] = USER_TYPE_ADMIN;
			$admin = $this->user->find_where($where);
			if($admin){
				$this->session->set_userdata(SESSION_ADMIN, $admin[0]);
				redirect('/'.ADMIN_PATH.'/index/dashboard');
			}else{
				$this->message_error('账号错误');
				redirect('/'.ADMIN_PATH.'/login'); 
			}
		}else{
			$this->load->view('admin/login');
		}
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 管理员退出登陆
	 * ---------------------------
	 *
	 * @return /admin/logout
	 * @return void
	 */
	public function logout()
	{
		$this->session->unset_userdata(SESSION_ADMIN);
		redirect('/'.ADMIN_PATH.'/login');
	}

	// --------------------------------------------------------------------

	function dashboard() {
		$this->load->view('admin/index');
	}
	
}