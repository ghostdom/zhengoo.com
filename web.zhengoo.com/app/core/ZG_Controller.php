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
	 *
	 */
	protected $data = array();

	/**
	 *
	 */
	protected $page = 1;

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
	function __construct() {
		parent::__construct();
		$this->load->theme_on();
		if($this->input->get('page')) $this->page = $this->input->get('page');
		$this->_logger = $this->logger->getLogger('Controller: ' . get_class($this));
	}

	// --------------------------------------------------------------------
	
	/**
	 *---------------------------------
	 * 判断是否属于post请求
	 *---------------------------------
	 *
	 * @access	protected
	 */
	 function is_post() {
	 	if($_SERVER['REQUEST_METHOD']=='POST'){
	 		return TRUE;
	 	}else {
	 		return FALSE;
	 	}	
	}
}


// --------------------------------------------------------------------
// --------------------------------------------------------------------
// --------------------------------------------------------------------
// --------------------------------------------------------------------

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
	
	/**
	 *---------------------------------
	 * 构造函数
	 * - 恢复views
	 *---------------------------------
	 *
	 * @access	public
	 */
	function __construct() {
		parent::__construct();
		$this->load->theme_off();
	}

	// --------------------------------------------------------------------
}



/* End of file ZG_Controller.php */
/* Location: ./core/ZG_Controller.php */