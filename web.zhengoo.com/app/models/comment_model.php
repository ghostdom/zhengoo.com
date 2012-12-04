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
 * ZhenGoo Comments Model
 *
 * ZhenGoo 用户模型
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.zhengoo.com
 */

class Comment_Model extends ZG_Model {


	// --------------------------------------------------------------------

	/** 
	 * -----------------------
	 * 根据collect编号分页获取相关评论
	 * 同时关联获取到发表评论的用户信息
	 * -----------------------
	 *
	 * @param comment_cid 	收集编号
	 * @param page 			页码
	 * @param page_num		分页数量
	 * @param array 		评论集合
	 */
	public function find_by_cid_with_user($comment_cid, $page, $page_num = 20)
	{
		$this->db->join('user', 'comment.comment_uid = user.user_id');
		$this->db->order_by('comment_time', 'desc');
		return $this->find_by_cid($comment_cid, $page, $page_num);
	}

}