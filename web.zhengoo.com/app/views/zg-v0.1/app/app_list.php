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
 		<div class="span12" style="margin-top:30px">
 			<div class="row">

 				<?php $this->load->view('common/left');?>
 				<div class="span9 app_list main_box">
	 				<div class="app_list_head">
	 					<h3><?=$cur_category['category_name']?><h3>
	 				</div>
	 				<div class="app_list_container" id="app_list">
	 					<ul>
	 						<?php
	 							foreach ($apps as $app) {
	 							
	 						?>
	 						<li class="row">
	 							<div class="app_icon">
	 								<a href="#"><img src="<?=$app['app_icon']?>" width="80" height="80"/></a>
	 							</div>
	 							<div class="app_info">
	 								<div class="row">
	 									<div class="span4">
	 										<h4><a href="#"><?=$app['app_title']?></a></h4>
	 									</div>
	 									
	 									<div class="span3">
	 										<a href="#"><?=$app['app_category_name']?></a>
	 									</div>
	 									<div class="app_action">
	 										<a href="#" rel="tooltip" data-original-title="已安装"><i class="icon-check"></i></a>
											<a href="#" rel="tooltip" data-original-title="喜欢"><i class="icon-heart"></i></a> 
											<a href="#" rel="tooltip" data-original-title="分享"><i class="icon-share"></i></a>
											<a href="#" rel="tooltip" data-original-title="评论"><i class="icon-comment"></i></a>
											<!-- <a href="#" rel="tooltip" data-original-title="查看截图"><i class="icon-info-sign"></i></a> -->
	 									</div>
	 								</div>
	 								<div class="span8 app_desc">
	 										<?=mb_substr($app['app_desc'], 0 ,200)?>
	 										<a href="#" >查看详情</a>
	 								</div>				
	 							</div>	
	 						</li>
	 						<?php
	 							}
	 						?>
	 					</ul>
	 				</div>
	 				<?php $this->load->view('common/pagination')?>	 				
				</div>

 			</div> 
 		</div>
 		

	</div>
	 <?php $this->load->view('common/footer');?>
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(function (){
			$('#app_list li').hover(
				function () {
					$(this).find('.app_action').show();
				},
				function () {
					$(this).find('.app_action').hide();
				}
			);

			$('a[rel=tooltip]').tooltip();
		});
	</script>
</body>
</html>