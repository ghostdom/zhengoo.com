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
		
		<div class="span5" style="margin:5% 30%">
			
			<form class="well" method="post" action="/login">
				<?php
					$this->load->view('common/message');
				?>
			  <label>登录:</label>
			  <input type="text" class="span3" name="user_login_name" placeholder="邮箱" />
			  <input type="password" class="span3" name="user_passwd" placeholder="密码" />
			  <span class="help-block">
			  	<a href="/weibo">通过新浪微博登陆</a>
			  </span>
			 
			  <button type="submit" class="btn">登录</button>

			  <?php 
			  	if($this->input->get('next')){
			  ?>
			  <input type="hidden" name="next" value="<?=$this->input->get('next')?>"/>
			  <?php 
				} 
			  ?>
			</form>
			
		</div>
	</div>
	<?php $this->load->view('common/footer');?>
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
</body>

</html>