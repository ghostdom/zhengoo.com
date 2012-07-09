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
	<div  class="container">
 		<div class="span12">
 			<div class="row">
 				<?php $this->load->view('common/left');?>
 				<div class="span10">
<!-- 	 				<div class="well">
	 					珍果网 - 让应用, 应用得更广泛.
	 					<div class="pull-right" style="margin-top:-5px">
	 					<a href="assets/bootstrap.zip" class="btn btn-primary">腾讯账号登陆</a>
	 					<a href="assets/bootstrap.zip" class="btn btn-danger">新浪微博登录</a>
	 					</div>
	 				</div>	 -->
	 				<div class="hot-items">
	 					<h3>限时免费</h3>
	 					<?php foreach ($apps as $app) { ?>
	 					<div class="app_item span1 main_box">
	 						<div class="span1 app_item_icon">
	 							<a href="#"><img src="<?=$app['app_icon']?>" width="70px" height="70px"/></a>
	 						</div>
	 						<div class="span1 app_item_info">
	 							<ul>
	 								<li><a href=""><strong><?=mb_substr($app['app_title'], 0 ,18)?></strong></a></li>
	 								<li style="margin-top:5px"><em><?=$app['app_category_name']?></em></li>
	 								<li><em>v<?=$app['app_version']?></em></li>
	 							</ul>	
	 						</div>
	 					</div>
	 					<?php } ?>
	 				</div>
	 				<div class="hot-items">
	 					<h3>限时免费</h3>
	 					<?php foreach ($apps as $app) { ?>
	 					<div class="app_item span1 main_box">
	 						<div class="span1 app_item_icon">
	 							<a href=""#><img src="<?=$app['app_icon']?>" width="70px" height="70px"/></a>
	 						</div>
	 						<div class="span1 app_item_info">
	 							<ul>
	 								<li><a href=""><strong><?=mb_substr($app['app_title'], 0 ,18)?></strong></a></li>
	 								<li style="margin-top:5px"><em><?=$app['app_category_name']?></em></li>
	 								<li><em>v<?=$app['app_version']?></em></li>
	 							</ul>	
	 						</div>
	 					</div>
	 					<?php } ?>
	 				</div>
				</div>
 			</div> 
 		</div>
 		

	</div>
	 <?php $this->load->view('common/footer');?>
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
</body>
</html>