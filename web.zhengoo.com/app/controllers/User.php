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
	 * 初始化用户模型类
	 * ---------------------------
	 *
	 * @return void
	 */
	function __construct() 
	{
		parent::__construct();
		$this->load->model('user_model', 'user');
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 用户主页(自己)
	 * ---------------------------
	 *
	 * @link  /home
	 * @return void
	 */
	function home() 
	{
		$this->load->model('collect_model', 'collect');
		$this->load->model('comment_model', 'comment');
		$this->load->model('like_model', 'like');
		$collects = $this->collect->find_by_ufollow($this->sess_user['user_id'], $this->page);
		foreach ($collects as $i => $collect) {
			$collect['comments']      = $this->comment->find_by_cid_with_user($collect['collect_id'], 1, 2);
			$collect['comment_count'] = $this->comment->count(array('comment_cid' => $collect['collect_id']));
			$collect['like_count']    = $this->like->count(array('like_cid' => $collect['collect_id'])); 
			$collects[$i] = $collect;
		}
		$this->data['collects'] = $collects;
		$this->load->view('home', $this->data);
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 查看自己的所有收集
	 * ---------------------------
	 *
	 * @link  /{user_login_name}/inbox
	 * @return void
	 */
	function inbox($user_login_name)
	{
		if($user_login_name == $this->sess_user['user_login_name']){
			$this->load->library('pagination');
			$this->load->model('collect_model', 'collect');
			$this->data['collects'] = $this->collect->find_by_uid($this->sess_user['user_id'], $this->page);
			$this->data['collect_count'] = $this->collect->count(array('collect_user_id' => $this->sess_user['user_id']));
			$this->load->view('home_collects', $this->data);
		} else {
			echo '404';
		}
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 用户自己喜欢的应用收集
	 * ---------------------------
	 *
	 * @link  /{user_login_name}/likes
	 * @param user_login_name
	 * @return void
	 */
	function likes($user_login_name) 
	{
		if($user_login_name == $this->sess_user['user_login_name']){
			$this->load->library('pagination');
			$this->load->model('like_model', 'like');
			$this->data['collects']      = $this->like->find_by_uid_with_collect($this->sess_user['user_id'], $this->page);
			$this->data['collect_count'] = $this->like->count(array('like_uid' => $this->sess_user['user_id']));
			$this->load->view('home_collects', $this->data);
		}else{
			echo '404';
		}
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 查看用户被评论的信息和自己评论过的应用
	 *
	 * - inbox 	收到的评论
	 * - outbox 发出的评论
	 * ---------------------------
	 *
	 * @link  /{user_login_name}/commnet/(inbox|outbox)
	 * @param user_login_name 用户登录名
	 * @param type 	数据类型（收到的评论|发出的评论）
	 * @return void
	 */
	function comment($user_login_name, $type = 'inbox')
	{
		if($user_login_name == $this->sess_user['user_login_name']){
			$this->load->library('pagination');
			$this->load->model('comment_model', 'comment');
			$this->data['inbox_comment_count'] = $this->comment->count(array('comment_whom' => $this->sess_user['user_id'], 'comment_uid != comment_whom' => NULL));
			$this->data['outbox_comment_count'] = $this->comment->count(array('comment_uid' => $this->sess_user['user_id'], 'comment_uid != comment_whom' => NULL));
			if($type == 'inbox'){
				$this->data['comments'] = $this->comment->find_by_whom_with_user($this->sess_user['user_id'], $this->page);
			}else{
				$this->data['comments'] = $this->comment->find_by_uid_with_user($this->sess_user['user_id'], $this->page);
			}
			$this->load->view('home_comment', $this->data);
		} else {
			echo '404';
		}
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 个人首页 展示所有收集 （默认）
	 * ---------------------------
	 *
	 * @link /{user_login_name}
	 * @return void
	 */
	function personal($user_login_name)
	{
		$user = $this->_personal_top_data($user_login_name);
		$this->data['collects'] = $this->collect->find_by_uid($user['user_id'], $this->page);
		$this->load->view('personal', $this->data);
	}
	
	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 个人首页 - 我的关注 
	 * ---------------------------
	 *
	 * @link /{user_login_name}/following
	 * @return void
	 */
	function personal_following($user_login_name)
	{
		$user = $this->_personal_top_data($user_login_name);
		$this->data['followers'] = $this->ufollow->get_following_with_user($user['user_id'], $this->page);
		$this->load->view('personal_follower', $this->data);
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 个人首页 - 我的粉丝 
	 * ---------------------------
	 *
	 * @link /{user_login_name}/followers
	 * @return void
	 */
	function personal_followers($user_login_name)
	{
		$user = $this->_personal_top_data($user_login_name);
		$this->data['followers'] = $this->ufollow->get_followers_with_user($user['user_id'], $this->page);
		$this->load->view('personal_follower', $this->data);
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 个人首页 顶部公共信息（用户信息） 
	 * ---------------------------
	 *
	 * @param  user_login_name 	用户登录名
	 * @return user 			用户信息
	 */
	function _personal_top_data($user_login_name)
	{
		$user = $this->get_user_by_login_name($user_login_name);
		if($user){
			$this->load->model('ufollow_model', 'ufollow');
			$this->load->model('collect_model', 'collect');
			$this->data['user']            = $user;
			$this->data['collect_count']   = $this->collect->count(array('collect_user_id' 	=> $user['user_id']));
			$this->data['following_count'] = $this->ufollow->count(array('ufollow_who' 		=> $user['user_id']));
			$this->data['followers_count'] = $this->ufollow->count(array('ufollow_whom' 	=> $user['user_id']));
			if($this->sess_user && $user['user_id'] != $this->sess_user['user_id']){
				$this->data['ufollow_regard'] = $this->ufollow->get_regard($this->sess_user['user_id'], $user['user_id']);
			}
			return $user;
		} else {
			echo "404";
			exit();
		}
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 关注用户
	 * ---------------------------
	 *
	 * @link /follow/$user_login_name
	 * @return void
	 */
	function follow($user_login_name)
	{
		$user = $this->get_user_by_login_name($user_login_name);
		$whom         = $user['user_id'];
		$sess_user_id =  $this->sess_user['user_id'];
		
		if($user && $whom != $sess_user_id){
			$this->load->model('ufollow_model', 'ufollow');
			$regard = $this->ufollow->get_regard($sess_user_id, $whom);
			switch ($regard) {
				case UFOLLOW_REGARD_ACTIVE:
					echo $this->ufollow->cancel($sess_user_id, $whom);
					break;
				case UFOLLOW_REGARD_PASSAVE:
					echo $this->ufollow->change_regard($sess_user_id, $whom, UFOLLOW_REGARD_ACTIVE);
					break;
				case UFOLLOW_REGARD_NONE:
					echo $this->ufollow->add($sess_user_id, $whom);
					break;
			}
		}else {
			echo "404";
		}
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
	 * @link /m_login
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
				$redirect_url = '/home';
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
			$auth       = $this->session->userdata(SESSION_AUTH);
			$oauth_user = $this->session->userdata(SESSION_AUTH_USER);

			$user                       = $_POST + $oauth_user;
			$user['user_passwd']        = md5($user['user_passwd']);
			$user['user_register_time'] = time();
			$user['user_oauths']        = $auth['auth_source'];
			if($auth['auth_source'] == AUTH_SOURCE_QQ){
				$user['user_avatar'] = $user['user_avatar'].'/180';
			}
			$user_id = $this->user->insert($user);
			if($auth){
				$this->load->model('auth_model','auth');
				$auth['auth_uid'] = $user_id;
				$auth['auth_time'] = time();
				$this->auth->insert($auth);
			}
			$user['user_id'] = $user_id;
			$this->session->set_userdata(SESSION_USER, $user);
			redirect('/home');
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

}