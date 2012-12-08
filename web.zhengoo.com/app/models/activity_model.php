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
 * ZhenGoo Activity Model
 *
 * ZhenGoo 用户动态模型
 *
 * @package		ZhenGoo
 * @subpackage	Model
 * @category	Model
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.zhengoo.com
 */
define('ACTIVITY_SAVE', 	0); 	//动态类型: 保存
define('ACTIVITY_FOLLOW', 	1); 	//动态类型: 关注
define('ACTIVITY_COMMENT', 	2);		//动态类型: 评论
define('ACTIVITY_LIKE', 	3);		//动态类型: 喜欢
define('ACTIVITY_MARK', 	4);		//动态类型: 标记（标星）
define('ACTIVITY_MENTION',  5);		//动态类型: 提到	

define('ACTIVITY_STATE_UNREAD', 	0);		//动态状态：未读
define('ACTIVITY_STATE_READ', 		1);		//动态状态：已读


class Activity_Model extends ZG_Model {
	
	// --------------------------------------------------------------------

	/**
	 * -----------------------
	 * 魔术方法 处理添加各种动态信息
	 *
	 * - add_save 
	 * — add_follow
	 * - add_comment
	 * - add_like
	 * - add_mark
	 * - add_mention
	 * -----------------------
	 *
	 * @param name 	调用的方法名
	 * @param args 传递的参数
	 * @return  
	 */
	public function __call($name, $args)
	{
		if (preg_match('/^add_([^)]+)$/', $name, $type) AND count($type) == 2)
		{
			$args['type'] = $this->_get_type($type[1]);
			return call_user_func_array(array($this, '_add'), $args);
		}

	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------
	 * 添加用户动态信息
	 * -----------------------
	 *
	 * @param obj_id 动态所对应的对象（用户|收集）编号
	 * @param who  	 动态生成者
	 * @param whom   动态对应者
	 * @param type 	 动态类型 （参见 动态类型常量）
	 * @return int   插入后的编号
	 */
	function _add($obj_id, $who, $whom, $type)
	{
		// $activity['activity_obj_id'] = $obj_id;
		// $activity['activity_who']    = $who;
		// $activity['activity_whom']   = $whom;
		// $activity['activity_type']   = $type;
		// $activity['activity_time']   = time();
		// return $this->insert($activity);
		echo  $type;
	}

	// --------------------------------------------------------------------

	/**
	 * -----------------------
	 * 根据type字符串，获取对应动态
	 * 类型常量, 默认：类型为保存
	 * 为魔术方法服务
	 * 
	 * - save 
	 * — follow
	 * - comment
	 * - like
	 * - mark
	 * - mention
	 * -----------------------
	 *
	 * @param type 	调用的方法名
	 * @return  int 动态类型常量
	 */
	function _get_type($type)
	{
		switch ($type) 
		{
			case 'save':
				return ACTIVITY_SAVE;
			case 'follow':
				return ACTIVITY_FOLLOW;
			case 'cmment':
				return ACTIVITY_COMMENT;
			case 'like':
				return ACTIVITY_LIKE;
			case 'mark':
				return ACTIVITY_MARK;
			case 'mention':
				return ACTIVITY_MENTION;
			default:
				return ACTIVITY_SAVE;
		}
	}

	// --------------------------------------------------------------------

}