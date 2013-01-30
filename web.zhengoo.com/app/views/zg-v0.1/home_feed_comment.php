
<div class="feed-comments">
	<?php 
		if($collect['comment_count'] > 2){
	?>
		<div class="all-comments" style="display: block;">后面还有 <strong><?=$collect['comment_count'] - 2 ?></strong> 条评论, <a href="/<?=$collect['user_login_name']?>/<?=$collect['collect_title']?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>" class="clip-link" > 点击查看 >></a></div>
	<?php 
		}
	?>
	<ul>
		<?php 
			foreach ($collect['comments'] as $comment) {
		?>
		<li>
			<a title="<?=$comment['user_nice_name']?>" href="/<?=$comment['user_login_name']?>"><img title="<?=$comment['user_nice_name']?>" alt="<?=$comment['user_nice_name']?>" class="avatar" src="<?=$comment['user_avatar']?>"></a>
			<div class="body">
				<div style="float:right;"><span class="timestamp"><?=format_date($comment['comment_time'])?></span></div>
				<div class="body-text">
					<a href="/<?=$comment['user_login_name']?>"><?=$comment['user_nice_name']?>: </a>
					<?=$comment['comment_body']?>
				</div>
			</div>
		</li>
		<?php 
			} //end foreach
		?>
	</ul>
	<div class="reply" <?php if(empty($collect['comments'])) { ?> style="display:none" <?php } ?>  >
        <form action="/comment/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>" class="add-comment">
            <input type="hidden" name="comment_whom" value="<?=$collect['collect_user_id']?>"/>
            <input type="hidden" name="comment_title" value="<?=$collect['collect_title']?>"/>
            <img src="<?=$sess_user['user_avatar']?>" width="32" class="avatar">
            <input name="comment_body" type="text" placeholder="你敢发表下点自己的意见吗..." />
            <button class="btn btn-small btn-comment">评论</button>
        </form>
    </div>
</div>
