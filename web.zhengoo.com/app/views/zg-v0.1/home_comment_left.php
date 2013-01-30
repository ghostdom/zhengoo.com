<div class="span9 main_box">
	<?php 
		$view = $this->uri->segment(3);
	?>
	<div style="padding:20px 10px 0">
		<ul class="nav nav-tabs" style="margin:0px;">
		  <li <?php if($view == 'inbox'){ ?> class="active" <?php } ?>><a href="/<?=$sess_user['user_login_name']?>/comment/inbox">收到的评论(<strong><?=$inbox_comment_count?></strong>)</a></li>
		  <li <?php if($view == 'outbox'){ ?> class="active" <?php } ?>><a href="/<?=$sess_user['user_login_name']?>/comment/outbox">发出的评论(<strong><?=$outbox_comment_count?></strong>)</a></li>
		</ul>
	</div>
		<ul id="collect-list">
		<?php 
			if($comments){
				$this->load->helper('date');
				foreach ($comments as $comment) {	
		?>
		<li class="collect" style="min-height: 50px; height:auto; padding:20px 20px 10px">
			<div class="collect-content">
				<span class="collect-date">
					<abbr><?=format_date($comment['comment_time'])?></abbr>
				</span>
				<ul class="actions">
					
					<?php 
						if($view == 'inbox'){
					?>
					<li>
        				<a rel="tooltip" data-original-title="回复" href="#" >
        					<i class="icon icon-repeat"></i>
        				</a>
        			</li>
        			<?php } ?>
        		
        			<li>
        				<a class="comment-delete" rel="tooltip" data-original-title="删除" href="/comment/delete/<?=$comment['comment_id']?>">
        					<i class="icon icon-remove"></i>
        				</a>
        			</li>
        			<li></li>
    			</ul>

				<a title="<?=$comment['user_nice_name']?>" href="/<?=$comment['user_login_name']?>">
					<img class="avatar" width="42" height="42" style="float:left" src="<?=$comment['user_avatar']?>">
				</a>
				<div class="comment-info">
					<?php 
						if($view == 'inbox'){
							$count = $inbox_comment_count;
					?>
					<a href="/<?=$comment['user_login_name']?>" style="" ><?=$comment['user_nice_name']?></a>：
					<span><?=$comment['comment_body']?></span>
					<div class="content">
						评论了我的：<a href="/<?=$sess_user['user_login_name']?>/<?=rawurlencode($comment['comment_title'])?>-<?=$comment['comment_store_id']?>-<?=$comment['comment_cid']?>">"<?=$comment['comment_title']?>"</a>
					</div>
					<?php 
						}else{
							$count = $outbox_comment_count;
					?>
						<span style="color: #666666"><?=$comment['comment_body']?></span>
						<div class="content">
							评论 <a href="/<?=$comment['user_login_name']?>"><?=$comment['user_nice_name']?></a>
							的 <a href="/<?=$comment['user_login_name']?>/<?=rawurlencode($comment['comment_title'])?>-<?=$comment['comment_store_id']?>-<?=$comment['comment_cid']?>">"<?=$comment['comment_title']?>"</a>
						</div>
					<?php 
						} 
					?>
				
				</div>
			</div>
		</li>
		<?php 
				}
		
		?>
	</ul>
	<?php 
		$this->load->view('common/pagination' , array('base_url' => uri_string(), 'total_rows' => $count)); 
		} else {

	?>
	<div class="no-datas no-datas-comment">
        <p>
        	<strong>未发现评论信息</strong>
         	<small>当你在浏览朋友分享的应用时， 您可以多和他们聊聊您对应用的看法和意见，也许会让我们对该应用更加了解哦！~</small>	
        </p>
    </div>
	<?php 
		}
	?>
</div>