<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 *
 * 基于Codeigniter的
 * 
 * @package		ZhenGoo
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @copyright	Copyright (c) 20011 - 2012, pintutu.com.
 * @link		http://www.pintutu.com
 * @version		0.1.0
 */

// --------------------------------------------------------------------

/**
 * Zhengoo List Follow Model
 *
 * Zhengoo 列表集合关注模型
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.pintutu.com
 */
define('GFOLLOW_REGARD_NONE', 		-1);    // 关注关系： 无关系
define('GFOLLOW_REGARD_ACTIVE', 	0); 	// 关注关系: 主动关注
define('GFOLLOW_REGARD_PASSAVE', 	1);		// 关注关系: 被动关注
class Gfollow_Model extends ZG_Model {

	// --------------------------------------------------------------------

	/**
	 * ------------------------
	 * 主动关注单个list
	 * 
	 * - 如果关注者与被关注的list拥有者，
	 *   未存在关注关系，则建立两人间被动关注关系
	 * ------------------------
	 * 
	 * @param who 		关注者
	 * @param whom 		被关注者
	 * @param list_id 	list 编号
	 * @return int 		关注编号
	 */ 
	function add($who, $whom, $list_id)
	{
		$lfollow = array(
			'lfollow_who' => $who,
			'lfollow_list_id' => $list_id,
			'lfollow_list_uid' => $whom,
			'lfollow_time' => time(),
		);
		$lfollow_id = $this->insert($lfollow);
		if($lfollow_id){
			$this->load->model('ufollow_model', 'ufollow');
			$ufollow_regard = $this->ufollow->get_regard($who, $whom);
			if($ufollow_regard == UFOLLOW_REGARD_NONE) {
				$this->ufollow->add($who, $whom, UFOLLOW_REGARD_PASSAVE, FALSE);
			}
		}
		return $lfollow_id;
	}
	
	// --------------------------------------------------------------------

	/**
	 * ------------------------
	 * 同时关注被关注者的多个list
	 * 默认未被动关注
	 * ------------------------
	 * 
	 * @param who 		关注者
	 * @param whom 		被关注者
	 * @param regard 	关注关系 默认：被动关注
	 * @return void
	 */ 
	function inserts($who, $whom, $regard = LFOLLOW_REGARD_PASSAVE) 
	{
		$this->load->model('list_model', 'list');
		$list_ids = $this->list->find_by_uid_only_ids($whom);
		foreach ($list_ids as $list_id) 
		{
			$lfollow  = array(
				'lfollow_who'      => $who,
				'lfollow_list_id'  => $list_id['list_id'],
				'lfollow_list_uid' => $whom,
				'lfollow_time'     => time(),
				'lfollow_regard'   => $regard
			);
			$this->insert($lfollow);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * ------------------------
	 * 获取用户与list的关注关系
	 * 
	 * - 关注不存在，返回LFOLLOW_REGARD_NONE (不存在)
	 * ------------------------
	 * 
	 * @param who 		关注者
	 * @param list_id 	list编号
	 * @return int 		关注关系
	 */ 
	function get_regard($who, $list_id)
	{
		$lfollow = $this->find_where(array('lfollow_who' => $who, 'lfollow_list_id' => $list_id));
		if($lfollow){
			return $lfollow[0]['lfollow_regard'];
		}else{
			return LFOLLOW_REGARD_NONE;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * ------------------------
	 * 同时取消被关注者的所有list
	 * 
	 * - 物理删除关注关系
	 * ------------------------
	 * 
	 * @param who 		关注者
	 * @param whom 		被关注者
	 * @return int 		被删除的数量
	 */ 
	function cancel_user_all($who, $whom)
	{
		return $this->delete_where(array('lfollow_who'  => $who, 'lfollow_list_uid' => $whom));
	}

	// --------------------------------------------------------------------

	/**
	 * ------------------------
	 * 取消用户和指定list的关注关系
	 * 
	 * - 物理删除关注关系
	 * ------------------------
	 * 
	 * @param who 		关注者
	 * @param list_id 	list编号
	 * @return int 		被删除的数量
	 */ 
	function cancel($who, $list_id)
	{
		return $this->delete_where(array('lfollow_who' => $who, 'lfollow_list_id' => $list_id));
	}
	
	// --------------------------------------------------------------------

	/**
	 * ------------------------
	 * 根据list编号分页查询所有关注该
	 * list的用户信息
	 * ------------------------
	 * 
	 * @param list_id 	list编号
	 * @param page  	页码
	 * @param page_num 	分页数量
	 * @return array 	关注该list的用户信息
	 */
	function get_follow_users($list_id, $page = 1, $page_num = 20)
	{
		$this->db->join('user', 'user.user_id = lfollow.lfollow_who');
		$this->db->order_by('lfollow_time', 'desc');
		return $this->find_by_list_id($list_id, $page, $page_num);
	}
}