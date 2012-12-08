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
 * Zhengoo Pin Model
 *
 * Zhengoo 喜欢数据 模型
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.pintutu.com
 */

class like_Model extends ZG_Model {
	
	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 分页获取用户like的收集集合
	 * ---------------------------
	 *
	 * @param user_id 	用户编号
	 * @param page 		页码
	 * @param page_num	分页数量
	 * @return array 所有喜欢的收集集合
	 */
	function find_by_uid_with_collect($user_id, $page = 1 , $page_num = DEFAULT_PAGE_NUM)
	{
		$this->db->join('collect', 'like_cid = collect.collect_id');
		$this->db->order_by('like_time', 'desc');
		return $this->find_by_uid($user_id, $page, $page_num);
	}

	// --------------------------------------------------------------------
}