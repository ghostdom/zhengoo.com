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
 * ZhenGoo App Model
 *
 * ZhenGoo 应用模型
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.pintutu.com
 */
define('APP_STATUS_UNDONE',		0);  	/* 应用状态: 未完成 		*/
define('APP_STATUS_SHOW', 		1);  	/* 应用状态: 已完成并显示	*/
define('APP_STATUS_HIDE', 		2);  	/* 应用状态: 已完成并隐藏	*/
define('APP_HOT_YES', 			TRUE);	/* 热门应用  				*/
define('APP_HOT_NO', 			FALSE); /* 非热门应用 				*/
class App_Model extends ZG_Model {

	// --------------------------------------------------------------------
	// =============================
	// = ========== ADD ========== =
	// =============================
	
	/**
	 *---------------------------------
	 * 新增app数据 
	 * - 抓取数据时,只新增 app_title, app_store_url
	 * - affair true 	多条记录
	 * - affair false 	单记录
	 *---------------------------------
	 *
	 * @param apps     应用对象或应用对象数组
	 * @param $affair  是否事务
	 * @return array\int  多数据新增,返回重复app应用名称 
	 * @access	public
	 */
	function addApp($apps, $affair = FLASE) {
		if($affair){
			$repeat = array();
			foreach ($apps as $app) {
				if(!$this->find_by_store_id($app['app_store_id'])){
					$this->insert($app);
				}else{
					$repeat[] = $app['app_title'];
				}
			}
			return $repeat;
		}else{
			return $this->insert($apps);
		}
	}

	// --------------------------------------------------------------------
	// =============================
	// = ========== GET ========== =
	// =============================



	// --------------------------------------------------------------------
	// =============================
	// = ======== UPDATE ========= =
	// =============================


	// --------------------------------------------------------------------s

}