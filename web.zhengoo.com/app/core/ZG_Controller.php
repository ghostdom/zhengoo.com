<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * www.ZhenGoo.com 
 *
 * 
 * 
 * @package		ZhenGoo
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @copyright	Copyright (c) 20012 - 2013, ZhenGoo.com.
 * @link		http://www.ZhenGoo.com
 * @version		0.1.0
 */

// --------------------------------------------------------------------

/**
 * ZhenGoo Core Controller
 *
 * ZhenGoo核心控制器类 实现公用控制器方法
 *
 * @package		ZhenGoo
 * @subpackage	Core
 * @category	Core
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class ZG_Controller extends CI_Controller {	

	/**
	 * view data
	 */
	protected $data = array();

	/**
	 * 页码
	 */
	protected $page = 1;

	/**
	 * 
	 */
	protected $sess_user;

	/*
	 * 日志对象
	 */
	protected $_logger;



	// --------------------------------------------------------------------
	
	/**
	 *---------------------------------
	 * 构造函数
	 *---------------------------------
	 *
	 * @access	public
	 */
	function __construct() 
	{
		parent::__construct();
		$this->sess_user = $this->session->userdata(SESSION_USER);
		if($this->sess_user) $this->data['sess_user'] = $this->sess_user;
		$this->load->theme_on($this->config->item('theme'));
		if($this->input->get('page')) $this->page = $this->input->get('page');
		$this->_logger = $this->logger->getLogger('Controller: ' . get_class($this));
	}

	// --------------------------------------------------------------------
	
	/**
	 * ---------------------------------
	 * 判断是否属于post请求
	 * ---------------------------------
	 *
	 * @access	protected
	 */
	function is_post()
	{
	 	if($_SERVER['REQUEST_METHOD']=='POST'){
	 		return TRUE;
	 	}else {
	 		return FALSE;
	 	}	
	}

	// --------------------------------------------------------------------
	
	/**
	 * ---------------------------------
	 * 判断用户是否登录
 	 * ---------------------------------
 	 *
 	 * @return boolean true 已登录 false 未登陆
	 */
	function is_user()
	{
		$this->sess_user ? $is_user = TRUE : $is_user = FALSE ;
		return $is_user;
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------------
	 * 信息提示
	 * - 支持类型: 成功, 信息, 警告, 错误 
	 * ---------------------------------
	 * 
	 * @param msg  提示的信息文字
	 * @param type 提示类型
	 * @return void
	 */
	function message($msg, $type)
	{
		if($msg)
		{
			$message['content'] = $msg;
			$message['type'] = $type;
			$this->data['message'] = $message;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------------
	 * 信息提示
	 * - 支持类型: 成功, 普通, 警告, 错误 
	 * ---------------------------------
	 * 
	 * @param msg  提示的信息文字
	 * @param type 提示类型
	 * @return void
	 */
	function message_success($msg)
	{
		$this->message($msg, MESSAGE_TYPE_SUCCESS);
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------------
	 * 普通信息提示
	 * ---------------------------------
	 * 
	 * @param msg  提示的信息文字
	 * @return void
	 */
	function message_info($msg)
	{
		$this->message($msg, MESSAGE_TYPE_INFO);
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------------
	 * 警告信息提示
	 * ---------------------------------
	 * 
	 * @param msg  提示的信息文字
	 * @return void
	 */
	function message_warn($msg)
	{
		$this->message($msg, MESSAGE_TYPE_WARN);
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------------
	 * 错误信息提示
	 * ---------------------------------
	 * 
	 * @param msg  提示的信息文字
	 * @return void
	 */
	function message_error($msg)
	{
		$this->message($msg, MESSAGE_TYPE_ERROR);
	}

	// --------------------------------------------------------------------

	

	// --------------------------------------------------------------------
}

/************************************************************************************
 * 																					*
 *								后台Controller 父类									*
 *																					*
 ************************************************************************************/

/**
 * ZhenGoo Core Admin Controller
 *
 * ZhenGoo核心控制器类 实现公用控制器方法
 *
 * @package		ZhenGoo
 * @subpackage	Core
 * @category	Core
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class ZG_Admin_Controller extends ZG_Controller{
	

	protected $sess_admin ;
	/**
	 *---------------------------------
	 * 构造函数
	 * - 恢复views
	 *---------------------------------
	 *
	 * @access	public
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->theme_off();
		if($this->uri->segment(2) != 'login')
		{
			$this->sess_admin = $this->session->userdata(SESSION_ADMIN);
			if($this->sess_admin){
				$this->data['sess_admin'] = $this->sess_admin;
			}else{
				redirect('/'.ADMIN_PATH.'/login');
			}
		}
		
	}

	// --------------------------------------------------------------------
}



/* End of file ZG_Controller.php */
/* Location: ./core/ZG_Controller.php */