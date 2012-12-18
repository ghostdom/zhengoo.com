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
	public function find_by_cid_with_user($comment_cid, $page = 1, $page_num = DEFAULT_PAGE_NUM)
	{
		$this->db->join('user', 'comment.comment_uid = user.user_id')->order_by('comment_time', 'desc');
		return $this->find_by_cid($comment_cid, $page, $page_num);
	}

	// --------------------------------------------------------------------

	/** 
	 * -----------------------
	 * 根据用户id 查询该用户收到的评论
	 * 同时关联获取到发表评论的用户信息
	 * 
	 * - 不显示自己的评论
	 * -----------------------
	 *
	 * @param whom 			被评论人
	 * @param page 			页码
	 * @param page_num		分页数量
	 * @param is_self 		是否现实自己的评论
	 * @param array 		评论集合
	 */
	public function find_by_whom_with_user($whom, $page = 1, $page_num = DEFAULT_PAGE_NUM, $is_self = TRUE)
	{
		if($is_self)
		{
			$this->db->where('comment_uid != comment_whom', null);
		}
		$this->db->join('user', 'comment.comment_uid = user.user_id')->order_by('comment_time', 'desc');
		return $this->find_by_whom($whom, $page, $page_num);
	}

	// --------------------------------------------------------------------

	/** 
	 * -----------------------
	 * 根据用户id 查询该用户发出的评论
	 * 同时关联获取到被评论的用户信息
	 * 
	 * - 不显示自己对自己的评论
	 * -----------------------
	 *
	 * @param uid 			评论人
	 * @param page 			页码
	 * @param page_num		分页数量
	 * @param is_self 		是否现实自己的评论
	 * @param array 		评论集合
	 */
	public function find_by_uid_with_user($uid, $page = 1, $page_num = DEFAULT_PAGE_NUM, $is_self = TRUE)
	{
		if($is_self)
		{
			$this->db->where('comment_uid != comment_whom', null);
		}
		$this->db->join('user', 'comment.comment_whom = user.user_id')->order_by('comment_time', 'desc');
		return $this->find_by_uid($uid, $page, $page_num);
	}

	// --------------------------------------------------------------------

	/** 
	 * -----------------------
	 * 根据评论id删除评论
	 * 
	 * - 只能删除自己的评论或别人发布在自己应用下（对你的评论）的评论
	 * -----------------------
	 *
	 * @param comment_id 	评论id
	 * @param $user_id 		删除评论人
	 * @param int 			删除的行数
	 */
	public function delete_comment($comment_id, $user_id)
	{
		$this->db->or_where(array('comment_whom' => $user_id, 'comment_uid' => $user_id));
		return $this->delete_by_id($comment_id);
	}

	// --------------------------------------------------------------------

}