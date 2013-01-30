<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="Keywords" content="<?=$this->config->item('seo_keywords')?>"/>
		<meta name="Description" content="<?=$this->config->item('seo_description')?>"/>
		<title>用户登录 - <?=$this->config->item('seo_title')?></title>
		<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/style.css">
	</head>

	<body>
		<?php $this->load->view('common/header');?>
		<div id="body" class="container">
			<div id="login" class="accounts-form">
				<h2>登录到您的帐户</h2>
				<hr class="small">
				<div class="connect-buttons">
	       			<a id="sina_button" class="btn" href="/weibo" height='550' width="900" centre="-460" title="用微博帐号登录">
	       				<span>用<strong>微博帐号</strong>登录</span>
	       			</a>
	       			<a id="qq_button" class="btn" href="/qq"  height='413' width="700" centre="-360"  title="用QQ帐号登录">
	       				<span>用<strong>QQ</strong>帐号登录</span>
	       			</a>
	   			</div>
	   			<form id="auth-form" method="post" action="/login">
	   				<div class="all-errors">
						<ul class="errorlist">
							<li></li>
						</ul>
	    			</div>
	    			<div class="input">
	    				<input type="text"  name="user_login_name" placeholder="登录名/邮箱" />
	    				<ul class="errorlist">
							<li></li>
						</ul>
	    			</div>
	    			<div class="input">
	    				<input type="password" name="user_passwd" placeholder="密码" />
	    				<ul class="errorlist">
							<li></li>
						</ul>
	    			</div>
	    			<div class="actions clearfix">
	   					 <input type="submit" class="btn btn-green" value="马上登录">
					</div>
					<?php 
					  	if($this->input->get('next')){
					?>
					  <input type="hidden" name="next" value="<?=$this->input->get('next')?>"/>
				  	<?php 
						} 
				  	?>
	   			</form>
			</div>
			<p class="note">
				<!-- <a href="#">忘记密码?</a>
				· 没有帐号?
				<a href="/signup">立即注册</a> -->
			</p>
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
			$(function (){
				$('#sina_button, #qq_button').click(function (e) {
					var iframe = $('<iframe></iframe>').attr('src',  $(this).attr('href')).attr('scrolling','no').height($(this).attr('height')).width($(this).attr('width'));
					$('#oauth_modal').css({
						'height': 	$(this).attr('height'),
						'width': 	$(this).attr('width'),
						'margin': 	'-330px 0 0 ' + $(this).attr('centre') +'px'
					});
					$('#oauth_modal .modal-header h4').text($(this).text());
					$('#oauth_modal .modal-body').height($(this).attr('height')).width($(this).attr('width')).css('max-height', 'none').append(iframe);
					$('#oauth_modal').modal();
					$('#oauth_modal').on('hidden', function () {
						$(this).find('iframe').remove();
					});
					e.preventDefault();
				});
			});
		</script>
		
	</body>
</html>





			  

