<div id="feed" class="span9 main_box">
	<h1>我的动态</h1>
	<ul class="feed-list">
		<?php 
			$this->load->helper('date');
			foreach ($collects as $collect) {
		?>
		<li class="collect">
			<div class="collect-item">
				<a class="collect-save btn btn-danger" href="javascript:;" 
					data-content="
					<form onsubmit='javascript:return false;'>
						<input type='hidden' name='collect_app_id' value='<?=$collect['collect_app_id']?>'/>
						<input type='hidden' name='collect_store_id' value='<?=$collect['collect_store_id']?>'/>
						<input type='hidden' name='collect_form' value='<?=$collect['collect_id']?>'/>
						<?php
							$collect_root = $collect['collect_root'];
							if($collect['collect_root'] == 0){
								$collect_root = $collect['collect_id'];
							}
						?>
						<input type='hidden' name='collect_root' value='<?=$collect_root?>'/>
						<input type='hidden' name='collect_title' value='<?=$collect['collect_title']?>'>
						<input type='hidden' name='collect_icon' value='<?=$collect['collect_icon']?>'>
						<input type='hidden' name='collect_link' value='<?=$collect['collect_link']?>'>
						<input type='hidden' name='app_desc' value='<?=htmlspecialchars($collect['collect_note'])?>'>
						<textarea name='collect_note' rows='2' placeholder='为什么你要收录...？'></textarea>
						<div class='prpover-footer'>
							<input class='btn btn-success collect-save-btn ' type='submit' value='确定' />
						</div>
					</form>" title="">
					<i class="icon icon-plus icon-white"></i>
					保存
				</a>
				<div class="feed-avatar">
					<a href="/<?=$collect['user_login_name']?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>" title="<?=$collect['collect_title']?>"><img class="app-icon" src="<?=app_icon_75($collect['collect_icon'])?>" title="<?=$collect['collect_title']?>" alt="<?=$collect['collect_title']?>"/><span class="mask"></span></a>
					<a href="/<?=$collect['user_login_name']?>" title="<?=$collect['user_nice_name']?>"><img class="avatar" src="<?=$collect['user_avatar']?>" title="<?=$collect['user_nice_name']?>" alt="<?=$collect['user_nice_name']?>" /></a>
				</div>
				
				<div class="feed-event">
					<a href="/<?=$collect['user_login_name']?>"><?=$collect['user_nice_name']?></a> 
					<!-- 收录到 
					<a href="#">组名</a>  -->
					<span class="timestamp"><?=format_date($collect['collect_time'])?></span>
				</div>

				<div class="feed-content">
					<a href="/<?=$collect['user_login_name']?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>" class="feed-title" title="<?=$collect['collect_title']?>">
						<?=$collect['collect_title']?> 
					</a> 
					<div class="notes">
						<a href="/<?=$collect['user_login_name']?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>" class="clip-link">
							<div class="content">
								<?=$collect['collect_note']?>
							</div>
						</a>
					</div>
					<div class="feed-actions">
						<!-- <span><a href="<?=str_replace('https://','itms://', $collect['collect_link'])?>"><i class="icon icon-music"></i> iTunes中打开</a></span> -->
						<span>
							<a href="#" class="collect-comment">
								<i class="icon icon-comment"></i>
								 评论<?php if($collect['comment_count'] > 0 ) echo '('.$collect['comment_count'].')'; ?>
							</a>
						</span>
						<span>
							<a href="/like/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>" class="collect-like">
								<i class="icon icon-heart"></i> 
								<span like-data="<?=$collect['like_count']?>">喜欢<?php if($collect['like_count'] > 0 ) echo '('.$collect['like_count'].')';?></span>
							</a>
						</span>
						<span class="dropdown" >
							<a href="#" class="dropdown-toggle"  role="button" data-toggle="dropdown" ><i class="icon icon-share"></i> 分享<b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" >
						    	<li><a href="#"><i class="logo-min logo-min-weibo"></i> 新浪微博</a></li>
						    	<!-- <li><a href="#"><i class="logo-min logo-min-qzone"></i> QQ空间</a></li> -->
						    	<li><a href="#"><i class="logo-min logo-min-tqq"></i> 腾讯微博</a></li>
						    	<li><a href="#"><i class="logo-min logo-min-kaixin"></i> 开心网</a></li>
						    	<li><a href="#"><i class="logo-min logo-min-weixin"></i> 微信</a></li>
						    	
						  	</ul>
						</span>
					</div>
				</div>
				<!-- start comment -->

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
				<!-- end comment -->
			</div>
		</li>
		<?php
			}
		?>
	</ul>
	<div class="load-more" style="display: block; ">
	    <a href="#" class="load">查看更多<i class="icon icon-chevron-down"></i></a>
	    <span class="loading-feed">Loading...</span>
	</div>	
</div>