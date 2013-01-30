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
					<div class="padding">
						<h3>修改密码</h3>
						<hr>
		                <form action="/settings/profile" method="post">
		                	<div>
		                		<label> 原密码</label>
		                		<div class="input " >
		                			<input type="text" name="user_nice_name" value="" />
		                		</div>
		                	</div>

		                	<div>
		                		<label> 新密码</label>
		                		<div class="input">
		                			<input type="text" name="user_password" value="" />

		                		</div>
		                	</div>

		                	<div>
		                		<label> 确认密码</label>
		                		<div class="input">
		                			<input type="text" name="user_password" value="" />

		                		</div>
		                	</div>

		                	<div class="actions">
                        		<input type="submit" class="btn btn-large" value="保存">
                    		</div>
		                </form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer');?>
	
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
</body>
<html>