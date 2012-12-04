<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>珍果网 - 珍惜每一个苹果软件</title>
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/style.css">
</head>
<?php 
	$user = $this->session->userdata(SESSION_AUTH_USER);
	$auth = $this->session->userdata(SESSION_AUTH);
?>
<body>
	<?php $this->load->view('common/header');?>
	<div class="container">
		<div id="signup" class="accounts-form">
				<div class="span3 user-mate">
					<img class="avatar" width="160" height="160" src="<?= auth_avatar($user['user_avatar'], $auth['auth_source'])?>" />
					<h1><?=$user['user_nice_name']?></h1>
				</div>
				
	   			<form id="auth-form" method="post" action="/signup">
	   				<div class="all-errors">
						<ul class="errorlist muted">
							<li>欢迎你！<strong class="text-error"><abbr title="<?=$user['user_nice_name']?>"><?=$user['user_nice_name']?></abbr></strong>，完善以下信息，以后你就可以使用<abbr title="您填写的登录名">登录名</abbr>或<abbr title="您设置的邮箱">邮箱</abbr>进行登录</li>
						</ul>
	    			</div>
	    			<div class="input">
	    				<input type="text"  name="user_login_name" placeholder="登录名" />
	    				<ul class="errorlist text-error">
							<li></li>
						</ul>
	    			</div>
	    			<div class="input">
	    				<input type="text" name="user_email" placeholder="邮箱" />
	    				<ul class="errorlist text-error">
							<li></li>
						</ul>
	    			</div>
	    			<div class="input">
	    				<input type="password" name="user_passwd" placeholder="密码" />
	    				<ul class="errorlist text-error">
							<li></li>
						</ul>
	    			</div>
	    			<label class=" input checkbox inline">
	    				<input type="checkbox" name=""/> <span class="muted">告诉我的朋友们，我来珍果了。</span>
	    			</label>
	    			<div class="actions clearfix">
	   					 <input type="submit" class="btn btn-green" value="完成">
					</div>
	   			</form>
			</div>
			<p class="note">
				已拥有珍果帐号?
				<a href="/login">立即登录</a>
			</p>
	</div>
	<?php $this->load->view('common/footer');?>
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
</body>

</html>