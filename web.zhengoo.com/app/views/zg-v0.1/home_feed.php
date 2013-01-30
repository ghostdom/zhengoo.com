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
				<?php $this->load->view('home_left');?>
				<div id="feed" class="span9 main_box">
				<h1>我的动态</h1>
				<ul class="feed-list">
					<?php //$this->load->view('home_feed_list'); ?>
				</ul>
				<div class="load-more">
					<a id="load-more" class="load" href="javascript:;" >加载更多...</a>
				</div>
			</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer');?>
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	var page = <?=$page?> ;

	$(function (){
		app_timeline();
		$('#load-more').click(function (e){
			app_timeline();
			e.preventDefault();
		});
	});
	function app_timeline(){
		$.get('/home?page=' + page, function (data){
			$('#feed .feed-list').css('background-image', 'none');
				if($.trim(data).length > 0 ){
					$(data).appendTo('#feed .feed-list');
					page = ++page;
				}else{
					$('.load-more').hide();
				}
		});
	}
	</script>
</body>
<html>