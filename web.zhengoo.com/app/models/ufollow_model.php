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
 * Zhengoo User follow Model
 *
 * Zhengoo 用户关注模型
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.pintutu.com
 */
define('UFOLLOW_REGARD_NONE', 		-1);	// 关注关系: 无关系 
define('UFOLLOW_REGARD_ACTIVE', 	0); 	// 关注关系: 主动关注
define('UFOLLOW_REGARD_PASSAVE', 	1);		// 关注关系: 被动关注

class Ufollow_Model extends ZG_Model {
	

	// --------------------------------------------------------------------

	/**
	 * --------------------------
	 * 添加用户间关注关系
	 *
	 * 同时可选择是否建立关注者
	 * 和被关注者所有list（应用收藏列表）的关注关系
	 * - 默认：主动关注
	 * - 默认：与被关注者所有list建立被动关注关系
	 * --------------------------
	 *
	 * @param who 				关注者
	 * @param whom 				被关注者
	 * @param regard 			关注关系
	 * @param is_follow_lists 	是否关注 被关注者 所有的list 
	 * @return int  			用户关注关系编号 	
	 */
	function add($who, $whom, $regard = UFOLLOW_REGARD_ACTIVE, $is_follow_lists = TRUE)
	{
		$this->db->trans_begin();
		$ufollow = array(
			'ufollow_who'    => $who,
			'ufollow_whom'   => $whom,
			'ufollow_time'   => time(),
			'ufollow_regard' => $regard
		);
		$ufollow_id = $this->insert($ufollow);
		
		// if($is_follow_lists) {
		// 	$this->load->model('lfollow_model', 'lfollow');
		// 	$this->lfollow->inserts($who, $whom);
		// }

		if ($this->db->trans_status() === FALSE){
		    $this->db->trans_rollback();
		    return false;
		}else{
		    $this->db->trans_commit();
		    return $ufollow_id;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * --------------------------
	 * 获取两个用户间的关注关系
	 * 
	 * - 主动关注
	 * - 被动关注
	 * - 无关系
	 * --------------------------
	 *
	 * @param who 				关注者
	 * @param whom 				被关注者
	 * @param regard 			关注关系
	 * @return int  			用户关注关系编号 	
	 */
	function get_regard($who, $whom)
	{
		$where = array(
			'ufollow_who'  => $who,
			'ufollow_whom' => $whom 
		);
		$ufollow = $this->find_where($where);
		if($ufollow){
			return $ufollow[0]['ufollow_regard'];
		}else{
			return UFOLLOW_REGARD_NONE;
		}
	}

	// --------------------------------------------------------------------
	
	/**
	 * --------------------------
	 * 取消两个用户间的关注关系，同时
	 * 取消对该用户的所有list关注
	 * 
	 * - 物理删除用户间关系
	 * - 删除list关注关系
	 * --------------------------
	 *
	 * @param who 				关注者
	 * @param whom 				被关注者
	 * @return int  			删除数据量 （每次应该有且仅有1条） 	
	 */
	function cancel($who, $whom)
	{
		// $this->load->model('lfollow_model', 'lfollow');
		// $this->lfollow->cancel_user_all($who, $whom);
		return $this->delete_where(array('ufollow_who' => $who,'ufollow_whom' => $whom));
	}

	// --------------------------------------------------------------------

	/**
	 * --------------------------
	 * 修改两个用户间的关注关系
	 * --------------------------
	 *
	 * @param who 				关注者
	 * @param whom 				被关注者
	 * @param regard 			需修改的关注关系
	 * @return void 	
	 */
	function change_regard($who, $whom, $regard)
	{
		$this->update_where(array('ufollow_who' => $who,'ufollow_whom' => $whom), array('ufollow_regard' => $regard));	
	}

	// --------------------------------------------------------------------

	function get_following_with_user($user_id, $page, $page_num = 50)
	{
		return $this->_get_follow_user($user_id, 'ufollow_who', $page, $page_num);
	}
	
	// --------------------------------------------------------------------

	function get_followers_with_user($user_id, $page, $page_num = 50)
	{
		return $this->_get_follow_user($user_id, 'ufollow_whom', $page, $page_num);
	}

	// --------------------------------------------------------------------
	function _get_follow_user($user_id, $find_by = 'ufollow_who', $page, $page_num)
	{
		$this->db->select('user.*');
		$this->db->order_by('ufollow_time', 'desc');
		$this->db->join('user', 'ufollow.'.($find_by == 'ufollow_whom' ? 'ufollow_who' :'ufollow_whom').' = user.user_id');
		return $this->find_where(array($find_by => $user_id, 'ufollow_regard' => UFOLLOW_REGARD_ACTIVE), $page, $page_num);
	}
}