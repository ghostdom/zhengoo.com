<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>珍果网 - 珍惜每一个苹果软件</title>
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/style.css">
</head>

<body>
	<?php $this->load->view('common/header');?>
	<div id="body" class="container">
		<div class="app-bg clearfix">
			<div id="settings" class="row">
				<?php $this->load->view('setting_left'); ?>
				<div class="span9">
					<?php
						$oauths = explode('|', $sess_user['user_oauths']);
					?>
					<div class="padding">
						<h3>社区绑定</h3>
						<hr>
		               	<ul class="services">
		               		<?php 
		               			$is_weibo = in_array(AUTH_SOURCE_WEIBO, $oauths)
		               		?>
		               		<li class="weibo <?php if($is_weibo) { ?> active <?php } ?>">
		               			<i></i>
		               			<h3>新浪微博</h3>
		               			<small>将您喜欢的应用分享到新浪微博, 我们不会未经您的同意在您帐号里发布内容。</small>
		               			<?php 
		               				if($is_weibo){
		               			?>
		               				<a class="btn disabled unbind" href="#" url-data="<?=AUTH_SOURCE_WEIBO?>" style="cursor:pointer"> 解除绑定</a>
		               			<?php 
		               				}else{
		               			?>
		               				<a class="btn btn-green bind" herf="weibo" title="绑定新浪微博" height='550' width="900" centre="-460">+ 绑定</a>
		               			<?php 
		               				} 
		               			?>
		               		</li>
		               		
		               		<?php 
		               			$is_qq = in_array(AUTH_SOURCE_QQ, $oauths);
		               		?>
		               		<li class="qq <?php if($is_qq){ ?> active <?php } ?>">
		               			<i></i>
		               			<h3>腾讯QQ</h3>
		               			<small>Share clips to Facebook. We will never post anything without your action.</small>
		               			<?php 
		               				if($is_qq){
		               			?>
		               				<a class="btn disabled unbind" href="#" url-data="<?=AUTH_SOURCE_QQ?>" style="cursor:pointer"> 解除绑定</a>
		               			<?php 
		               				}else{
		               			?>
		               				<a class="btn btn-green bind" herf="qq" title="绑定腾讯QQ" height='413' width="700" centre="-360">+ 绑定</a>
		               			<?php 
		               				} 
		               			?>
		               		</li>

		               		<?php 
		               			$is_diandian = in_array(AUTH_SOURCE_DIANDIAN, $oauths);
		               		?>
		               		<li class="diandian <?php if($is_diandian){ ?> active <?php } ?>">
		               			<i></i>
		               			<h3>点点网</h3>
		               			<small>将您喜欢的应用分享到点点网, 我们不会未经您的同意在您帐号里发布内容。</small>
		               			<?php 
		               				if($is_diandian){
		               			?>
		               				<a class="btn disabled unbind" href="#" url-data="<?=AUTH_SOURCE_DIANDIAN?>" style="cursor:pointer"> 解除绑定</a>
		               			<?php 
		               				}else{
		               			?>
		               				<a class="btn btn-green bind" herf="diandian" title="绑定点点网" height='690' width="1000" centre="-500">+ 绑定</a>
		               			<?php 
		               				} 
		               			?>
		               		</li>

		               		<?php 
		               			$is_renren = in_array(AUTH_SOURCE_RENREN, $oauths);
		               		?>
		               		<li class="renren <?php if($is_renren){ ?> active <?php } ?>">
		               			<i></i>
		               			<h3>人人网</h3>
		               			<small>将您喜欢的应用分享到人人网, 我们不会未经您的同意在您帐号里发布内容。</small>
		               			<?php 
		               				if($is_renren){
		               			?>
		               				<a class="btn disabled unbind" href="#" url-data="<?=AUTH_SOURCE_RENREN?>" style="cursor:pointer"> 解除绑定</a>
		               			<?php 
		               				}else{
		               			?>
		               				<a class="btn btn-green bind" herf="renren" title="绑定人人网" height='450' width="600" centre="-250">+ 绑定</a>
		               			<?php 
		               				} 
		               			?>
		               		</li>
		               		<?php 
		               			$is_douban = in_array(AUTH_SOURCE_DOUBAN, $oauths);
		               		?>
		               		<li class="douban <?php if($is_douban){ ?> active <?php } ?>">
		               			<i></i>
		               			<h3>豆瓣网</h3>
		               			<small>将您喜欢的应用分享到豆瓣网, 我们不会未经您的同意在您帐号里发布内容。</small>
		               			<?php 
		               				if($is_douban){
		               			?>
		               				<a class="btn disabled unbind" href="#" url-data="<?=AUTH_SOURCE_DOUBAN?>" style="cursor:pointer"> 解除绑定</a>
		               			<?php 
		               				}else{
		               			?>
		               				<a class="btn btn-green bind" herf="douban" title="绑定豆瓣网" height='450' width="500" centre="-230">+ 绑定</a>
		               			<?php 
		               				} 
		               			?>
		               		</li>
		               		<?php 
		               			$is_pocket = in_array(AUTH_SOURCE_POCKET, $oauths);
		               		?>
		               		<li class="pocket <?php if($is_pocket){ ?> active <?php } ?>">
		               			<i></i>
		               			<h3>Pocket（稍后阅读）</h3>
		               			<small>将您感兴趣的应用记录到Pocket(稍后阅读)</small>
		               			<?php 
		               				if($is_pocket){
		               			?>
		               				<a class="btn disabled unbind" href="#" url-data="<?=AUTH_SOURCE_POCKET?>" style="cursor:pointer"> 解除绑定</a>
		               			<?php 
		               				}else{
		               			?>
		               				<a class="btn btn-green bind" herf="pocket" title="绑定Pocket" height='655' width="1000" centre="-500">+ 绑定</a>
		               			<?php 
		               				} 
		               			?>
		               		</li>

		               		<?php 
		               			$is_evernote = in_array(AUTH_SOURCE_EVERNOTE, $oauths)
		               		?>
		               		<li class="evernote <?php if($is_evernote){ ?> active <?php } ?>">
		               			<i></i>
		               			<h3>印象笔记</h3>
		               			<small>将您感兴趣的应用记录到印象笔记。</small>
		               			<?php 
		               				if($is_evernote){
		               			?>
		               				<a class="btn disabled unbind" href="#" url-data="<?=AUTH_SOURCE_EVERNOTE?>" style="cursor:pointer"> 解除绑定</a>
		               			<?php 
		               				}else{
		               			?>
		               				<a class="btn btn-green bind" herf="evernote" title="绑定印象笔记" height='710' width="1200" centre="-580">+ 绑定</a>
		               			<?php 
		               				} 
		               			?>
		               		</li>

		               		<?php 
		               			$is_mknote = in_array(AUTH_SOURCE_MKNOTE, $oauths);
		               		?>
		               		<li class="mknote <?php if($is_mknote){ ?> active <?php } ?>">
		               			<i></i>
		               			<h3>麦库笔记</h3>
		               			<small>将您感兴趣的应用记录到麦库笔记</small>
		               			<?php 
		               				if($is_mknote){
		               			?>
		               				<a class="btn disabled unbind" href="#" url-data="<?=AUTH_SOURCE_MKNOTE?>" style="cursor:pointer"> 解除绑定</a>
		               			<?php 
		               				}else{
		               			?>
		               				<a class="btn btn-green bind" herf="mknote" title="绑定麦库笔记" height='365' width="595" centre="-300">+ 绑定</a>
		               			<?php 
		               				} 
		               			?>
		               		</li>
		               		
		               	</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<div id="oauth_modal" class="modal hide fade">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4>授权登录</h4>
	</div>
	<div class="modal-body">

	</div>
	<div class="modal-footer">
	</div>
</div>
	<?php $this->load->view('common/footer');?>
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
	<script type="text/javascript">	 	
		$(function () {
			$('.services .bind').click(function (e) {
				uri = $(this).attr('herf');
				$('#oauth_modal').css({
					'height': 	$(this).attr('height'),
					'width': 	$(this).attr('width'),
					'margin': 	'-330px 0 0 ' + $(this).attr('centre') +'px'
				});
				var iframe = $('<iframe></iframe>').attr('src', '/' + uri + '?return=connections');
				iframe.height($(this).attr('height')).width($(this).attr('width')).attr('scrolling','no');
				$('#oauth_modal .modal-header h4').text($(this).attr('title'));
				$('#oauth_modal .modal-body').height($(this).attr('height')).width($(this).attr('width')).css('max-height', 'none').append(iframe);
				$('#oauth_modal').modal();
				$('#oauth_modal').on('hidden', function () {
					$(this).find('iframe').remove();
				});
				e.preventDefault();
			});

			$('.unbind').click(function (){
				if(window.confirm('你确定要解除绑定？')){
					$.get('/settings/connections/unbind', {auth_source: $(this).attr('url-data')}, function (data) {
						if(parseInt(data) == 1){
							location.reload();
						}
					});
				}
			});
		});
	</script>
</body>
<html>