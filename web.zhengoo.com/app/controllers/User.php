<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo Index Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class User extends ZG_Controller {

	/**
	 * ---------------------------
	 * 
	 * ---------------------------
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('user_model', 'user');
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 用户主页
	 * ---------------------------
	 *
	 * @link 
	 * @return void
	 */
	function home($user_login_name = '') {

		if($this->is_user() && $this->sess_user['user_login_name'] == $user_login_name)
		{
			$user_id = $this->sess_user['user_id'];
			$this->data['cur_user'] = $this->sess_user;
		}else{
			$user = $this->user->find_by_login_name($user_login_name);
			if($user){
				$user = $user[0];
				$user_id = $user['user_id'];
				$this->data['cur_user'] = $user;
			}
		}
		
		if(isset($user_id))
		{
			$this->load->model('list_model', 'list');
			$lists = $this->list->find_where(array('list_uid' => $user_id));
			$this->data['lists'] = $lists;
			$this->load->view('home_timeline', $this->data);
		}
		
		
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 用户登陆
	 * ---------------------------
	 *
	 * @link /login
	 * @return void
	 */
	public function login()
	{
		if($this->is_post())
		{
			$login = $_POST;
			if(isset($login['next']))
			{
				$next_url = $login['next'];
				unset($login['next']);
			}
			$login['user_passwd'] = md5($login['user_passwd']);
			
			$user = $this->user->find_where($login);
			if($user){
				$user = $user[0];
				$this->session->set_userdata(SESSION_USER, $user);
				$redirect_url = '/'.$user['user_login_name'];
				if(isset($next_url))
				{
					$redirect_url = $next_url;
				}
				redirect($redirect_url);
			}else{
				$this->message_error('账号不存在或密码错误');
				$this->load->view('login', $this->data);
			}
		}else{
			$this->load->view('login', $this->data);
		}
	}
	// --------------------------------------------------------------------
	
	/**
	 * ---------------------------
	 * 用户注册
	 * - 支持通过email注册
	 * - 支持通过三方平台登陆注册
	 * ---------------------------
	 *
	 * @link /signup
	 * @return void
	 */
	public function signup()
	{
		if($this->is_post()){
			$this->load->model('user_model', 'user');
			$user = $_POST;
			$user['user_passwd']        = md5($user['user_passwd']);
			$user['user_register_time'] = time();
			$user_id = $this->user->insert($user);

			$auth = $this->session->userdata(SESSION_AUTH);
			if($auth){
				$this->load->model('auth_model','auth');
				$auth['auth_uid'] = $user_id;
				$this->auth->insert($auth);
			}
			redirect('/');
		}else{
			$this->load->view('signup', $this->data);
		}		
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 用户退出账号
	 * ---------------------------
	 *
	 * @link /logout
	 * @return void
	 */
	public function logout()
	{
		$this->session->unset_userdata(SESSION_USER);
		redirect('/');
	}

	// --------------------------------------------------------------------

	public function ajax_verify($user_field, $value)
	{

	}

	// --------------------------------------------------------------------

}