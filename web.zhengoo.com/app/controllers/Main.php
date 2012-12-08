<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo Main Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class Main extends ZG_Controller {

	// function __construct() {
	// 	parent::__construct();
	// }

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 网站主页
	 * ---------------------------
	 * @link {base_url}
	 * @return void
	 */
	function welcome()
	{
		$this->load->view('index', $this->data);
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 发现频道 所包含类型：
	 *
	 * - 精选 ：Staff Picks
	 * - 流行 ：Popular
	 * - 最新 ：Recent
	 * ---------------------------
	 *
	 * @link {base_url}/discover/(staff-picks|popular|recent)
	 * @return void
	 */

	function discover($type)
	{
		$this->load->model('user_model', 'user');
		$this->load->model('ufollow_model', 'ufollow');
		$this->load->model('collect_model', 'collect');
		$this->data['users'] = $this->user->get_hot_user($this->page);
		$this->load->view('discover', $this->data);
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 网站工具页面
	 * ---------------------------
	 *
	 * @link {base_url}/tools 
	 * @return void
	 */
	function tools() 
	{
		$this->load->view('tools', $this->data);
	}

}