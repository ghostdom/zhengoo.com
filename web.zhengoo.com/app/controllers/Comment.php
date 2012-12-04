<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ZhenGoo Index Controller
 *
 *
 * @package		ZhenGoo
 * @subpackage	Controller
 * @category	Controller
 * @author		Ghostdom.wj <ghostdom.wj@gmail.com>
 * @link		http://www.ZhenGoo.com
 */
class Comment extends ZG_Controller {

	/**
	 * ---------------------------
	 * 
	 * ---------------------------
	 *
	 * @return void
	 */
	function __construct() 
	{
		parent::__construct();
		$this->load->model('comment_model', 'comment');
	}


	// --------------------------------------------------------------------

	/**
	 * ---------------------------
	 * 添加评论
	 * ---------------------------
	 *
	 * @return void
	 */
	function add($comment_store_id, $comment_cid) 
	{
		if($this->sess_user)
		{
			$comment['comment_uid']      = $this->sess_user['user_id'];
			$comment['comment_cid']      = $comment_cid;
			$comment['comment_store_id'] = $comment_store_id;
			$comment['comment_body']     = $this->input->post('comment_body');
			$comment['comment_time']     = time();
			$comment['comment_id']       = $this->comment->insert($comment);
			
			$this->data['comment'] = $comment;
			echo $this->load->view('comment_unit', $this->data, false);
		}
	}

	// --------------------------------------------------------------------

	/**
	 *
	 */
	function delete($comment_id)
	{
		if($this->sess_user){
			echo $this->comment->delete_where(array('comment_uid' => $this->sess_user['user_id'], 'comment_id' => $comment_id));
		}else{
			echo "404";
		}
		
	}
	// --------------------------------------------------------------------


}
