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
		<div class="app-bg">
			<div class="row">
				<div class="profile clearfix span12">
					<?php $this->load->view('personal_top'); ?>
					<?php $this->load->view('personal_app_widget'); ?>
				</div>
				<?php  $this->load->view('common/pagination' , array('base_url' => uri_string(), 'total_rows' => $collect_count)); ?>
			</div>
		</div>

	</div>
	<?php $this->load->view('common/footer');?>
	<script type="text/javascript" src="<?=lib_url()?>js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>js/zhengoo-actions.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>js/zhengoo-follow.js"></script>
	<script type="text/javascript">
	$(function () {
		$('.app-widget').hover(
			function () {
				$(this).find('.collect-save').show();
			},
			function () {
				$(this).find('.collect-save').hide();
			}
		);

	});
</script>
	
</body>
</html>