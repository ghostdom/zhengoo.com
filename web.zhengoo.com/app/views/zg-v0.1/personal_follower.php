<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>珍果网 - 珍惜每一个苹果软件</title>
		<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/style.css">
		<script type="text/javascript" src="<?=lib_url()?>js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="<?=lib_url()?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=lib_url()?>js/zhengoo-follow.js"></script>
	</head>

	<body>
		<?php $this->load->view('common/header');?>
		<div id="body" class="container">
			<div class="app-bg">
				<div class="row">
					<div class="profile clearfix span12">
						<?php $this->load->view('personal_top'); ?>
						<?php $this->load->view('personal_people_widget.php')?>
						<div class="load-more">
    						<a class="load" href="#load-more" name="load-more">加载更多...</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('common/footer');?>
	</body>
</html>