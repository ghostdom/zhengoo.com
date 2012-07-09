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
 * ZhenGoo Authorize Controller
 *
 *
 *
 * @package		ZhenGoo
 * @subpackage	controllers
 * @category	controllers
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */

class Authorize extends ZG_Controller {

	// --------------------------------------------------------------------

	public function weibo() 
	{
		$this->load->helper('url_helper');
		$this->load->library('oauth2');
		$weibo = $this->oauth2->provider('weibo');
	  	if (!$this->input->get('code')) {
            $weibo->authorize();
        }else{
        	try {
        		$token = $weibo->access($this->input->get('code'));
        		var_dump($token);
        	} catch (OAuth2_Exception $e) {
        		//redirect(base_url().'weibo');
        		echo '请重新授权新浪微博';
        	}
        	

        	
        }
	}

	// --------------------------------------------------------------------

	public function taobao() 
	{
		$this->load->helper('url_helper');
		$this->load->library('oauth2');
		$taobao = $this->oauth2->provider('taobao');
	  	if (!$this->input->get('code')) {
            $taobao->authorize();
        }else{
        	try {
	    		$token = $taobao->access($this->input->get('code'));
	    		$taobao->access_token = $token['access_token'];
	    		$result = $taobao->get_item(17766056045);
	   			 $this->_logger->info($result);
        	} catch (OAuth2_Exception $e) {
        		echo '请重新授权淘宝账号';
        	}
        	
        }

	}

	// --------------------------------------------------------------------

	public function pocket()
	{
		$this->load->library('oauth2');
		$pocket = $this->oauth2->provider('pocket');
		$result = $pocket->update_page_tag('tceisk9584', 'tceisk9584', array('http://www.google.com' => '河南,郑州', 'http://www.twitter.com' => '浙江,杭州'));
		$this->_logger->info($result);
	}

	// --------------------------------------------------------------------

	public function show(){
		$this->load->library('oauth2');
		$taobao = $this->oauth2->provider('taobao');


		$result = $taobao->get_item(17766056045);
	    $this->_logger->info($result);
	}
}