<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo WinXin Controller
 * 
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class Cgi extends ZG_Controller {

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
	function weixin()
	{
		$echostr   = $this->input->get('echostr');
		$signature = $this->input->get('signature');
		$timestamp = $this->input->get('timestamp');
		$nonce     = $this->input->get('nonce');
		$this->load->library('weixin');
		if($this->weixin->check_signature($signature, $timestamp, $nonce)){
			$this->load->view('weixin', array('echostr' => $echostr));
			// $this->output->set_content_type('text/json')->set_output(trim($echostr));
		}
	}


}