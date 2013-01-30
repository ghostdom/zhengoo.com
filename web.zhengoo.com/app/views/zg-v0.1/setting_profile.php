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
						<h3>个人资料</h3>
						<hr>
						<div class="avatar">
		                    <img width="180" height="180" style="display:block; min-height: 180px;" title="<?=$sess_user['user_nice_name']?>" src="<?=$sess_user['user_avatar']?>">
		                    <p>
		                    	<a href=""><i class="logo-btn-min logo-btn-min-weibo"></i></a>
		                    	<a href=""><i class="logo-btn-min logo-btn-min-qq"></i></a> 
		                    	<a href=""><i class="logo-btn-min logo-btn-min-weixin"></i></a>  
		                    </p>
		                </div>

		                <form action="/settings/profile" method="post">
		                	<div>
		                		<label><i class="icon-leaf"></i> 个人简介</label>
		                		<div class="input">
		                			<textarea name="user_signature" cols="40" rows="10" id="user_signature"><?=trim($sess_user['user_signature'])?></textarea>
		                			<div class="footnote">
		                				<small>最多不能超过 <strong>160</strong> 个字符</small></div>
		                			</div>
		                	</div>

		                	<div>
		                		<label><i class="icon-envelope"></i> 电子邮件</label>
		                		<div class="input-append">
		                			<span class="input-xlarge uneditable-input"><?=$sess_user['user_email']?></span>
		                			<!-- <a href="">修改邮箱</a> -->
		                			<button class="btn" type="button" style="line-height:24px;">
		                				<i class="icon-edit"></i>
		                			</button>
		                		</div>
		                	</div>

		                	<div>
		                		<label><i class=" icon-user"></i> 昵 称</label>
		                		<div class="input " >
		                			<input type="text" name="user_nice_name" value="<?=$sess_user['user_nice_name']?>" />
		                		</div>
		                	</div>

		                	<div>
		                		<label><i class="icon-signal"></i> 电 话</label>
		                		<div class="input">
		                			<input type="text" name="user_phone" value="<?=$sess_user['user_phone']?>" />

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