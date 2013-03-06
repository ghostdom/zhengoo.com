<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Zhengoo Winxin Public Class
 * 微信公众平台类库
 *
 * This class enables the creation of calendars
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/calendar.html
 */
define('WEIXIN_PUBLIC_TOKEN', '82fbb368b8bd98d1f1ea5049403328e3');

class Weixin {

	/**
	 * 日志
	 */
	private $_logger;

	// --------------------------------------------------------------------

	/**
	 * ------------------------------
	 * 
	 * ------------------------------
	 */
	public function __construct()
	{
		$this->_logger = $this->_logger = Logger::getLogger(get_class($this));
	}

	// --------------------------------------------------------------------

	/**
	 * ------------------------------
	 * 
	 * ------------------------------
	 */
	public function check_signature($signature, $timestamp, $nonce)
	{
		// $this->_logger->debug('signature => '.$signature);
		// $this->_logger->debug('timestamp => '.$timestamp);
		// $this->_logger->debug('nonce => '.$nonce);
		$result = false;
		$tmp_array = array(WEIXIN_PUBLIC_TOKEN, $timestamp, $nonce);
		sort($tmp_array);
		$cur_signature = implode($tmp_array);
		$cur_signature = sha1($cur_signature);
		// $this->_logger->debug('cur_signature => '.$cur_signature);
		if($cur_signature == $signature){
			$result = true;
		}
		return $result;
	}
}