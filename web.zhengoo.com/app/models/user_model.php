<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 *
 * 基于Codeigniter的
 * 
 * @package		ZhenGoo
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @copyright	Copyright (c) 20011 - 2012, zhengoo.com.
 * @link		http://www.zhengoo.com
 * @version		0.1.0
 */

// --------------------------------------------------------------------

/**
 * ZhenGoo List Model
 *
 * ZhenGoo 用户模型
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.zhengoo.com
 */
define('USER_STATUS_NORMAL', 	0); //用户状态： 正常
define('USER_STATUS_STOP', 		1); //用户状态： 停止（封停）
define('USER_STATUS_HOT', 		2); //用户状态： 热门（推荐）

class User_Model extends ZG_Model {
	

	// --------------------------------------------------------------------

	function _find_by_status($user_status, $page = 1, $page_num = 25, $is_collects = TRUE)
	{
		// $this->db->order_by('')
		$users = $this->find_where(array('user_type' => USER_TYPE_CLIENT, 'user_status' => $user_status), $page, $page_num);
		if($is_collects && $users)
		{
			$this->load->model('collect_model', 'collect');
			foreach ($users as $i => $user) {
				$this->db->order_by('collect_time', 'desc');
				$user['collects'] = $this->collect->find_by_user_id($user['user_id'], 1, 4);
				$users[$i] = $user;
			}
		}
		return $users;
	}

	// --------------------------------------------------------------------


	function get_hot_user($page = 1, $page_num = 25, $is_collects = TRUE)
	{
		return $this->_find_by_status(USER_STATUS_HOT, $page, $page_num, TRUE);
	}

	// --------------------------------------------------------------------

	function add_user_auth($user_id, $add_auth_source, $cur_auth_srouce = NULL)
	{
		$user_oauths = $cur_auth_srouce ? $cur_auth_srouce . '|' . $add_auth_source : $add_auth_source;
		return $this->update_by_id($user_id, array('user_oauths' => $user_oauths));
	}

	// --------------------------------------------------------------------

	function remove_user_auth($user_id, $remove_auth_source, $cur_auth_srouce = NULL)
	{
		if(strpos($cur_auth_srouce, '|')){
			$re = stripos($cur_auth_srouce, $remove_auth_source) == 0 && stripos($cur_auth_srouce, "|") == count($remove_auth_source) ? $remove_auth_source.'|' : '|'.$remove_auth_source;
			$user_oauths = str_replace($re, '', $cur_auth_srouce);
		}else{
			$user_oauths = str_replace($remove_auth_source, '', $cur_auth_srouce);
		}
		return $this->update_by_id($user_id, array('user_oauths' => $user_oauths));
	}


}