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
	if($_ci->uri->segment(1) != ADMIN_PATH){
		$cur_url        = current_url();
		$cur_controller = $_ci->uri->slash_rsegment(1) . $_ci->uri->slash_rsegment(2);
		if(!in_array($cur_controller, $controllers))
		{
			$sess_user = $_ci->session->userdata(SESSION_USER);
			if(empty($sess_user))
			{		
				$login_url = '/login';
				if($_ci->input->get('win') === 'min')
				{
					$login_url = '/m_login';
				}
				if($_GET){
					$login_url .= '?next='.urlencode($cur_url.'?'.http_build_query($_GET));
				}else{
					$login_url .= '?next='.urlencode($cur_url); 
				}
				redirect($login_url);
				exit();
			}
		}
	}
}

// --------------------------------------------------------------------

/**
 * ---------------------------
 * 过滤注册用户登录名
 * - 不能注册系统已占用的的用户名称
 *  （如：weibo，taobao等）
 * - 通过配置传递参数
 * ---------------------------
 * 
 * @param @default_user 系统已占用的默认登录名
 * @return void
 *
 * @param controllers 无需用户session 可以访问的 controller 集合
 * @return void
 */
function filter_user_name($default_users)
{
	$_ci = &get_instance();
	if($_ci->uri->segment(1) == 'signup' && $_ci->input->post('user_login_name'))
	{
		if(in_array($_ci->input->post('user_login_name'), $default_users)){
			$_ci->session->set_flashdata('warning', md5(time()));
			redirect('/signup');
			exit();
		}
	}
}

// --------------------------------------------------------------------


function filter_auth($test_users)
{
	$_ci = &get_instance();
	$uri = $_ci->uri->ruri_string();
	if(strpos($uri, '/authorize/auth') === 0 && $_ci->session->userdata(SESSION_AUTH))
	{
		$auth_user = $_ci->session->userdata(SESSION_AUTH);
		$pass_user = $test_users[$auth_user['auth_source']];
		if(!in_array($auth_user['auth_user'], $pass_user)){
			$_ci->session->set_flashdata('msg', '为保证您可以使用一个完整的产品, 请给我们一些测试的时间，谢谢您对我们的支持...！');
			echo '<script type="text/javascript"> parent.location.href = "/message" </script>';
		}else{
			echo '<script type="text/javascript"> parent.location.href = "/signup" </script>';
		}
	}
}

