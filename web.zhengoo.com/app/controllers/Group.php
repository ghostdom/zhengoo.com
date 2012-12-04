<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo group Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class Group extends ZG_Controller {

	/**
	 * ---------------------------
	 * 
	 * ---------------------------
	 *
	 * @return void
	 */
	function __construct() {
		parent::__construct();
		$this->load->model('group_model', 'group');
	}

	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 创建新列表
	 * ---------------------------
	 *
	 * @return void
	 */
	public function create()
	{
		if($this->is_post())
		{
			$group = $_POST;
			if($this->is_user_login() && $group['group_title'])
			{
				$this->load->library('pinyin');
				$group['group_alias']       = $this->pinyin->str2py($group['group_title']); 
				$group['group_uid']         = $this->sess_user['user_id'];
				$group['group_create_time'] = time();

				$group_id = $this->group->insert($group);
				redirect('/home');
			}
		}

	}

	// --------------------------------------------------------------------
	/**
	 * ---------------------------
	 * 关注group
	 * ---------------------------
	 *
	 * @return void
	 */
	public function follow($user_login_name, $group_alias)
	{
		$user = $this->get_user_by_login_name($user_login_name);
		if($user && $user['user_id'] != $this->sess_user['user_id']) {
			$gfollow_uid = $user['user_id'];
			$sess_user_id = $this->sess_user['user_id'];
			$group = $this->group->find_where(array('group_uid' => $gfollow_uid, 'group_alias' => $group_alias));
			if($group)
			{
				$group_id = $group[0]['group_id'];
				$this->load->model('gfollow_model', 'gfollow');
				$gfollow_regard = $this->lfollow->get_regard($sess_user_id, $group_id);
				if($gfollow_regard == GFOLLOW_REGARD_NONE){
					echo $this->gfollow->add($sess_user_id, $gfollow_uid, $group_id);
				}else{
					echo $this->gfollow->cancel($sess_user_id, $group_id);
				}
			} else {
				echo '404';
			}
		} else {
			echo '404'; 
		}
	}

}