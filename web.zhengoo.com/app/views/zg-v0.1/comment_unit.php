<?php $this->load->helper('date')?>
<!--  -->

	<li class="collect-info-comment">
		<a title="<?=$sess_user['user_nice_name']?>" href="/<?=$sess_user['user_login_name']?>"><img alt="<?=$sess_user['user_nice_name']?>" class="avatar" src="<?=$sess_user['user_avatar']?>"></a>
		<div>
		    <div class="user">
		        <strong><a title="<?=$sess_user['user_nice_name']?>" href="/<?=$sess_user['user_login_name']?>"><?=$sess_user['user_nice_name']?></a></strong>
		        <span class="timestamp"><abbr title="<?=date('Y-m-d H:m:s', $comment['comment_time'])?>" class="timeago"><?=format_date($comment['comment_time'])?></abbr></span>
		        <?php 
		        	if($sess_user['user_id'] = $comment['comment_uid']){
		        ?>
		        <a class="delete" data-placement="right" data-original-title="删除" href="/comment/delete/<?=$comment['comment_id']?>"><i class="icon icon-remove"></i></a>
		        <?php 
		        	}
		        ?>
		    </div>
		    <div class="comment">
		    	<?=$comment['comment_body']?>
		    </div>
		</div>
	</li>
<!-- end -->

<!--  -->

<li class="home-item-comment">
	<a href="/<?=$sess_user['user_login_name']?>"><img class="avatar" src="<?=$sess_user['user_avatar']?>"></a>
	<div class="body">
		<div style="float:right;"><span class="timestamp"><?=format_date($comment['comment_time'])?></span></div>
		<div class="body-text">
			<a href="/<?=$sess_user['user_login_name']?>"><?=$sess_user['user_nice_name']?>: </a>
			<?=$comment['comment_body']?>
		</div>
	</div>
</li>

<!--  -->



