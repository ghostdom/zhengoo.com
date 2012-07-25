<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo Hooks
 *
 *
 * @package		ZhenGoo
 * @subpackage	Hooks
 * @category	Hooks
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */

// --------------------------------------------------------------------

/**
 * ---------------------------
 * 检查用户session是否存在
 * - 传入无需用户session 可以访问的 controller
 * - 当controller 需要用户 session 时, 
 *   如果session不存在 则调整到登陆页面, 
 * 	 并且带上之前用户访问的url地址,作为登录后的
 * 	 跳转地址(next) 
 * ---------------------------
 *
 * @param controllers 无需用户session 可以访问的 controller 集合
 * @return void
 */
function check_session_user(array $controllers) 
{
	$_ci = &get_instance(); 
	$cur_controller = $_ci->uri->slash_rsegment(1) . $_ci->uri->slash_rsegment(2);
	$cur_url        = current_url();
	if(!in_array($cur_controller, $controllers))
	{
		$sess_user = $_ci->session->userdata(SESSION_USER);
		if(empty($sess_user))
		{
			$login_url = '/login';
			if($_GET){
				$login_url .= '?next='.urlencode($cur_url.'?'.http_build_query($_GET));
			}else{
				$login_url .= '?next='.urlencode($cur_url); 
			}
			redirect($login_url);
		}
	}
}

// --------------------------------------------------------------------
