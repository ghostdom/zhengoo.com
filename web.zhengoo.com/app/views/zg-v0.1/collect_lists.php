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
				<?php $this->load->view('collect_lists_left');?>
				<?php $this->load->view('collect_lists_right');?>
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
			$('.collect').hover(
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
<html>