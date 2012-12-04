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
 * ZhenGoo group Model
 *
 * ZhenGoo 收集列表模型
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.zhengoo.com
 */
define('GROUP_LEVEL_USER', 			0);  // 列表级别: 用户自定义 
define('GROUP_LEVEL_SYSTEM_DEF', 	1);  // 列表级别: 系统默认

define('GROUP_PERMISSION_PUBLIC', 	0);	 // 列表权限: 公开
define('GROUP_PERMISSION_PRIVATE', 	1);  // 列表权限: 私有

define('GROUP_TYPE_DEFAULT', 		0);	 // 列表类型：默认
define('GROUP_TYPE_STAFF-PICKS', 	1);  // 列表类型：精选
define('GROUP_TYPE_POPULAR', 		2);  // 列表类型：流行
define('GROUP_TYPE_RECENT',			3);  // 列表类型：近期
class group_Model extends ZG_Model {
	
	
	// --------------------------------------------------------------------

	/**
	 * --------------------------------
	 * 根据用户id分页获取用户groups，同时
	 * 获取收录在该group中的最后的collect
	 * --------------------------------
	 * 
	 * @param uid 		用户id
	 * @param page 		页码
	 * @param page_num  分页数量
	 * @return array groups
	 */
	function find_by_uid_with_collects($uid, $page = 1, $page_num = DEFAULT_PAGE_NUM)
	{
		$this->db->order_by('group_create_time', 'desc');
		// $this->db->join('lfollow', 'group.group_id = lfollow.lfollow_group_id','right outer');
		$groups = $this->find_by_uid($uid, $page, $page_num);
		
		return $this->_get_collects_and_follows($groups) ;
	}

	// --------------------------------------------------------------------

	/**
	 * --------------------------------
	 * 根据用户id分页获取用户groups，同时
	 * 获取收录在该group中的最后的collect
	 * --------------------------------
	 * 
	 * @param uid 		用户id
	 * @param page 		页码
	 * @param page_num  分页数量
	 * @return array groups
	 */
	function find_by_type_with_user($type = group_TYPE_DEFAULT, $page = 1, $page_num = 40)
	{
		$this->db->join('user', 'user.user_id = group.group_uid'); 
		$groups = $this->find_by_type($type, $page, $page_num);
		
		return $this->_get_collects_and_follows($groups);
	}

	// --------------------------------------------------------------------

	/**
	 * --------------------------------
	 * 获取groups集合中每个group包含的collect（最后3个）
	 * 以及关注情况
	 * - collect 倒序
	 * - 关注总数以及用户id
	 * --------------------------------
	 *
	 * @param groups groups集合
	 * @return array groups_collects 
	 */
	function _get_collects_and_follows($groups) 
	{
		if($groups){
			$this->load->model('collect_model', 'collect');
			$this->load->model('lfollow_model', 'lfollow');
			$groups_collects = array();
			foreach ($groups as $group) {
				$this->db->order_by('collect_time', 'desc');
				$group['collects']  = $this->collect->find_by_group_id($group['group_id'], 1,  $this->config->item('zg_group_collect_num'));
				$group['follow_count'] = $this->lfollow->count(array('lfollow_group_id' => $group['group_id']));
				$groups_collects[] = $group;
			}
			return $groups_collects;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * --------------------------------
	 * 根据用户id获取该用户列表（group） 
	 * 的group_id 集合 
	 * --------------------------------
	 *
	 * @param $group_uid 用户id
	 * @return array group_id 
	 */
	function find_by_uid_only_ids($group_uid)
	{
		$this->db->select('group_id');
		return $this->find_by_uid($group_uid);
	}

	// --------------------------------------------------------------------

}