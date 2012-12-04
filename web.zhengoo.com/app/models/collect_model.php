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
 * ZhenGoo Collect Model
 *
 * ZhenGoo 收集数据 模型
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.zhengoo.com
 */
class Collect_Model extends ZG_Model {
	

	/**
	 *---------------------------
	 * 根据列表编号分页获取该列表下的所有
	 * 应用,同时关联获取应用信息
	 *---------------------------
	 *
	 * @param list_id		列表编号
	 * @param page 			页码
	 */
	function find_by_group_with_app($group_id, $page = 1, $page_num = 25)
	{
		$this->db->where(array('collect_group_id' => $group_id));
		$this->db->join('app', 'app.app_id = collect.collect_app_id');
		$this->db->order_by('collect_time', 'desc');
		$this->set_limit($page, $page_num);
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 根据collect_id 获取该收集信息
	 * 同时获取该收集关联的 app 
	 * 详细信息
	 *---------------------------
	 *
	 * @param collect_id  收集id
	 * @return array 
	 */
	function find_by_id_with_app($collect_id) 
	{
		$this->db->join('app', 'app.app_id = collect.collect_app_id');
		$collect = $this->find_by_id($collect_id);		
		return $collect[0];
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 根据用户关注的list分页获取collect
	 * 
	 * 
	 *---------------------------
	 *
	 * @param $user_id  用户id
	 * @param page 		页码
	 * @param page_num 	分页数量
	 * @return array 	
	 */
	function find_by_ufollow($user_id, $page = 1, $page_num = 40)
	{
		$this->db->join('user', 'collect_user_id = user.user_id');
		$this->db->select('collect.*, user.user_id, user.user_login_name, user.user_nice_name, user.user_avatar');
		$this->db->where('collect_user_id in (select ufollow_whom from zg_ufollow where ufollow_who = '.$user_id.')', NULL);
		$this->db->order_by('collect_time', 'desc');
		return $this->find_all($page, $page_num);
	}

	// --------------------------------------------------------------------

	/**
	 *---------------------------
	 * 分页获取用户 所有收集， 默认：倒序
	 *---------------------------
	 *
	 * @param $user_id  用户id
	 * @param page 		页码
	 * @param page_num 	分页数量
	 * @return array  	收集集合
	 */
	function get_by_user_id($user_id, $page = 1, $page_num = 40)
	{
		$this->db->order_by('collect_time', 'desc');
		return $this->find_by_user_id($user_id, $page, $page_num);
	}

}