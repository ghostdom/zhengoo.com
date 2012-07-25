<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>珍果网 - 珍惜每一个苹果软件</title>
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap-responsive.min.css">
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/style.css">
</head>

<body>
	<?php $this->load->view('common/header');?>
	<div class="container">
		<div class="span5" style="margin: 90px auto 30px;">
			<form class="well" method="post" action="/signup">
			  <label>登录:</label>
			  <input type="text" class="span3" name="user_login_name" placeholder="登录名">
			  <input type="text" class="span3" name="user_email" placeholder="电子邮件">
			  <input type="password" class="span3" name="user_passwd" placeholder="密码">
			  <span class="help-block">
			  	<!-- <a href="/weibo">通过新浪微博登陆</a> -->
			  </span>
			 
			  <button type="submit" class="btn">注册</button>
			</form>
			
		</div>
	</div>
	<?php $this->load->view('common/footer');?>
</body>

</html>