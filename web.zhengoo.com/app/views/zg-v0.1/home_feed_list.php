<?php 
	if($collects){
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
					<ul class="dropdown-menu collect-share" role="menu" >
				    	<li>
				    		<a href="http://v.t.sina.com.cn/share/share.php?url=<?=base_url()?><?=$collect['user_login_name']?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>&title=【<?=$collect['collect_title']?>】 - <?=$collect['collect_note']?>" title="分享到新浪微博" target="_blank"><i class="logo-min logo-min-weibo"></i> 新浪微博</a>
				    	</li>
				    	<li>
				    		<a href="http://v.t.qq.com/share/share.php?url=<?=base_url()?><?=$collect['user_login_name']?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>&title=【<?=$collect['collect_title']?>】 - <?=$collect['collect_note']?>" title="分享到腾讯微博" target="_blank"><i class="logo-min logo-min-tqq"></i> 腾讯微博</a>
				    	</li>

				    	<li>
				    		<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?=base_url()?><?=$collect['user_login_name']?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>" title="分享到QQ空间" target="_blank"><i class="logo-min logo-min-qzone"></i> QQ空间</a>
				    	</li>
				    	<li><a href="http://share.renren.com/share/buttonshare.do?link=<?=base_url()?><?=$collect['user_login_name']?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>&title=【<?=$collect['collect_title']?>】 - <?=$collect['collect_note']?>" title="分享到人人网" target="_blank"><i class="logo-min logo-min-renren"></i> 人人网</a></li>
				  	</ul>
				</span>
			</div>
		</div>
		<?php $this->load->view('home_feed_comment', array('collect' => $collect)); ?>
	</div>
</li>
<?php
	}
?>
<script type="text/javascript" src="<?=lib_url()?>js/zhengoo-actions.js"></script>
<script type="text/javascript">
		$(function () {
			$('.collect').hover(
				function () {
					$(this).find('.collect-save').show();
				},
				function () {
					$(this).find('.collect-save').hide();
				}
			);

			$('.collect-comment').click(function (e){
				$(this).parents('div.collect-item').find('.feed-comments .reply').show();
				$(this).parents('div.collect-item').find('.feed-comments .reply input[name="comment_body"]').focus();
				e.preventDefault();
			});

			$('.collect-like').click(function (e) {
				var like_str = $(this).find('span');
				var like_num = parseInt($(this).find('span').attr('like-data'));
				var uri = $(this).attr('href');
				$.post(uri, function (data) {
					like_num = like_num + parseInt(data);
					like_str.attr('like-data', like_num);
					if(like_num > 0){
						like_str.text('喜欢('+like_num+')');
					}else{
						like_str.text('喜欢');
					}
				});
				e.preventDefault();
			});

			$('.btn-comment').click(function (e){
				var comment_form      = $(this).parents('form');
				var comment_input     = comment_form.find('input[name="comment_body"]');
				var comment_input_box = $(this).parents('.reply')

				if(comment_input.val()){
					var commnet_param = comment_form.serializeArray();
					var comment_list  =  $(this).parents('div.collect-item').find('.feed-comments > ul');
					comment_input.attr('disabled',true);
					$.post(comment_form.attr('action'), commnet_param, function (data){
						$(data).filter('.home-item-comment').appendTo(comment_list);
						comment_input.removeAttr('disabled').val('');
						comment_input_box.find('.alert').alert('close');
					});
				}else{
					comment_input_box.find('.alert').alert('close');
					var tip = $('<div></div>').addClass('alert alert-error').html('<button type="button" class="close" data-dismiss="alert">×</button> <strong>提示：</strong>请正确填写评论!');
					comment_input_box.prepend(tip);
				}
				e.preventDefault();
			});

			
		});
	</script>
<?php 
	}
?>