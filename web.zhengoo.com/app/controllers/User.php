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
	function home() 
	{
		$this->load->model('collect_model', 'collect');
		// $collects = $this->collect->find
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * web 主登陆页面
	 * ---------------------------
	 *
	 * @link /login
	 * @return void
	 */
	public function login()
	{
		$this->_login('login');
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 插件 min登陆页面
	 * ---------------------------
	 *
	 * @link /login
	 * @return void
	 */
	public function m_login() 
	{
		$this->_login('mini_login');
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 处理用户登陆操作
	 * ---------------------------
	 *
	 * @link /login
	 * @return void
	 */
	public function _login($page) 
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
				$this->load->view($page, $this->data);
			}
		}else{
			$this->load->view($page, $this->data);
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