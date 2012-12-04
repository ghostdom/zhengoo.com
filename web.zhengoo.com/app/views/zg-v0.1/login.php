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
		<div class="container">
			<div id="login" class="accounts-form">
				<h2>登录到您的帐户</h2>
				<hr class="small">
				<div class="connect-buttons">
	       			<a id="sina_button" class="btn"  href="/weibo"><span>用<strong>微博帐号</strong>登录</span></a>
	       			<a id="qq_button" class="btn" href="/qq"><span>用<strong>QQ</strong>帐号登录</span></a>
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
				<a href="#">忘记密码?</a>
				· 没有帐号?
				<a href="/signup">立即注册</a>
			</p>
		</div>
		<?php $this->load->view('common/footer');?>
		<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
	</body>
</html>





			  

