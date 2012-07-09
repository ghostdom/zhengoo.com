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
 * ZhenGoo Dcenter Model
 *
 * ZhenGoo 数据中心模型
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.pintutu.com
 */
define('DCENTER_SOURCE_APPLE',		1);  /* 数据来源: app store 			*/
define('DCENTER_SOURCE_ANDROID', 	2);  /* 数据来源: android				*/
define('DCENTER_STATUS_READY',		0);  /* 数据状态: 准备就绪 可获取数据		*/
define('DCENTER_STATUS_STOP', 		1);	 /*	数据状态: 停止		不可获取数据	*/
class Dcenter_Model extends ZG_Model {
	
	// --------------------------------------------------------------------
	// =============================
	// = ========== ADD ========== =
	// =============================

	/**
	 *---------------------------------
	 * 添加数据来源
	 *---------------------------------
	 *
	 * @access	public
	 */
	function add($dcenter) {
		$this->load->config('appstore');
		$app_store_category_ids = $this->config->item('app_store_category_ids');
		$dcenter_url = preg_replace('(#category_alias#)', $dcenter['dcenter_category_alias'], $this->config->item('appstore_category_url_tpl'));
		$dcenter_url = preg_replace('(#category_id#)', $app_store_category_ids[$dcenter['dcenter_category_alias']], $dcenter_url);
		$dcenter['dcenter_url'] = $dcenter_url;
		$dcenter['dcenter_last_time'] = time();
		$this->db->trans_begin();
		for($i = 65; $i <= 91; $i++) {
			if($i == 91){
				$dcenter['dcenter_letter'] = '*';
			} else{
				$dcenter['dcenter_letter'] = chr($i);
			}
			$this->insert($dcenter);
		}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return false;
		} else {
    		$this->db->trans_commit();
			return true;
		}
	}

	// --------------------------------------------------------------------
	// =============================
	// = ========== GET ========== =
	// =============================



	// --------------------------------------------------------------------
	// =============================
	// = ========== Update ========== =
	// =============================
	
	/**
	 *---------------------------------
	 * 修改数据中心分页页码
	 * - 当 page = 0 表示在元字段值基础上加 1
	 * - 当 page != 0 将page值修改为传入的值 
	 *---------------------------------
	 *
	 * @param dcenter_id 		数据中心编号
	 * @param dcenter_count		数据总数
	 * @param dcenter_status 	数据状态 默认: 准备就绪
	 * @param page 		 		要修改的页码, 默认 "0"
	 * @return int 		 		影响的行数
	 */
	function updateDcenter($dcenter_id, $dcenter_count, $dcenter_status, $page = 0) {
		if($page == 0){
			$this->db->set('dcenter_page', 'dcenter_page + 1', FALSE);
		}else{
			$this->db->set('dcenter_page', $page);
		}
		$this->db->set('dcenter_count', 'dcenter_count + ' . $dcenter_count, FALSE);
		$this->db->set('dcenter_status', $dcenter_status);
		$this->db->set('dcenter_last_time', time());
		$this->db->where('dcenter_id', (int)$dcenter_id);
		$this->db->update($this->_table);
		return $this->db->affected_rows();
	}
}