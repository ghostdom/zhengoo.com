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
 * ZhenGoo 收集列表模型
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.zhengoo.com
 */
define('LIST_LEVEL_USER', 			0);  // 列表级别: 用户自定义 
define('LIST_LEVEL_SYSTEM_DEF', 	1);  // 列表级别: 系统默认

define('LIST_PERMISSION_PUBLIC', 	0);	 // 列表权限: 公开
define('LIST_PERMISSION_PRIVATE', 	1);  // 列表权限: 私有
class List_Model extends ZG_Model {
	
	/**
	 * --------------------------------
	 * 初始化(新建)每个新用户默认收集列表
	 * - 采用事务处理
	 * --------------------------------
	 * 
	 * @param uid 	用户id
	 * @return boolean  true 成功, false 失败
	 */
	public function init_list($uid)
	{
		$this->load->config('web_default');
		$def_list_titles = $this->config->item('zg_list_default');
		$this->db->trans_begin();
		foreach ($def_list_titles as $list_title)
		{
			$list['list_uid'] = $uid;
			$list['list_title'] = $list_title;
			$list['list_level'] = LIST_LEVEL_SYSTEM_DEF;
			$list['list_create_time'] = time();
			$this->insert($list);
		}

		if ($this->db->trans_status() === FALSE){
		    $this->db->trans_rollback();
		    return false;
		}else{
		    $this->db->trans_commit();
		    return true;
		}
	}

	// --------------------------------------------------------------------

}