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
				<?php $this->load->view('home_comment_left');?>
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer');?>
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
 	<script type="text/javascript">
 		$(function (){
 			$('[rel="tooltip"]').tooltip();
			$('li.collect').hover(
				function () {
					$(this).find('.collect-date').hide();
					$(this).find('.actions').show();
				},
				function () {
					$(this).find('.collect-date').show();
					$(this).find('.actions').hide();
				}
			);

			$('.comment-delete').click(function (e) {
				var delete_btn = $(this);
				if(window.confirm('你确定要删除该评论！')){
	            	$.get(delete_btn.attr('href'), function (data){
	            		if(data == 1){
	            			delete_btn.parents('li').remove();
	            		}
	            	});
            	}
            	e.preventDefault();
			});

 		});
 	</script>
</body>
<html>