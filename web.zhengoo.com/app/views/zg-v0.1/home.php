<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>珍果网 - 珍惜每一个苹果软件</title>
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap-responsive.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/style.css">
	
</head>

<body>
	<?php $this->load->view('common/header');?>
	<div id="body" class="container">
		<div class="app-bg">
			<div class="row">
				<?php $this->load->view('home_left');?>
				<?php $this->load->view('home_right');?>
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer');?>
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>js/zhengoo-actions.js"></script>
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

			$('.comment').click(function (e){
				$(this).parents('div.collect-item').find('.feed-comments .reply').show();
				$(this).parents('div.collect-item').find('.feed-comments .reply input').focus();
				e.preventDefault();
			});

			$('.btn-comment').click(function (e){
				var comment_form      = $(this).parents('form');
				var comment_input     = comment_form.find('input');
				var comment_input_box = $(this).parents('.reply')

				if(comment_input.val()){
					var commnet_param = comment_form.serializeArray();
					var comment_list  =  $(this).parents('div.collect-item').find('.feed-comments > ul');
					comment_input.attr('disabled',true);
					$.post(comment_form.attr('action'), commnet_param, function (data){
						$(data).filter('.home-item-comment').appendTo(comment_list);
						comment_input.removeAttr('disabled').val('');
						comment_input_box.find('.alert').alert('close');
					});
				}else{
					comment_input_box.find('.alert').alert('close');
					var tip = $('<div></div>').addClass('alert alert-error').html('<button type="button" class="close" data-dismiss="alert">×</button> <strong>提示：</strong>请正确填写评论!');
					comment_input_box.prepend(tip);
				}
				e.preventDefault();
			});
		});
	</script>
</body>
<html>