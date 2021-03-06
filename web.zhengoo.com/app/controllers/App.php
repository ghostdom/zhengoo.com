<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo App Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class App extends ZG_Controller {

	/**
	 * ---------------------------
	 * - 加载 App 和 分类 模型
	 * - 获取所有分类
	 * ---------------------------
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('app_model', 'app');
	}

	// --------------------------------------------------------------------


}