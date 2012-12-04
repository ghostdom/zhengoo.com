<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>珍果网 - 珍惜每一个苹果软件</title>
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/m-styles.min.css">
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/style.css">
</head>

<body>
	<?php $this->load->view('common/header');?>
	<div id="body" class="container">
		<div class="app-bg">
			<div class="row">
				<?php $this->load->view('collect_info_left');?>
				<?php $this->load->view('collect_info_right');?>
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer');?>
	
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/zhengoo-actions.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/zhengoo-follow.js"></script>
	<script type="text/javascript">
		$(function (){

			$('.delete, #info-left-followers .avatar').tooltip();
			
			$('#app-screens ul.nav li a').click(function (e) {
				$(this).tab('show');
				e.preventDefault();
			});

			$('#comment-list li').hover(
				function () { comment_hover($(this), 'enter') },
				function () { comment_hover($(this)) }
			);

			$('.delete').click(function(e){
				del_comment($(this));
				e.preventDefault();
			});

			$('input.comment').click(function (e){ 
				var comment_box = $(this).parents('form').find('textarea');
				var comment_param = $(this).parents('form').serializeArray();
				comment_box.attr('disabled',true);
				$.post($(this).parents('form').attr('action'), comment_param, function (data){
					$(data).filter('.collect-info-comment').appendTo('#comment-list');
					$('#comment-list .collect-info-comment').hover(
						function () { comment_hover($(this), 'enter') },
						function () { comment_hover($(this)) }
					);
					$('#comment-list .collect-info-comment .delete').click(function (e) {
						del_comment($(this));
						e.preventDefault();
					});
					$('#comment-list li').removeClass('collect-info-comment');
					comment_box.removeAttr('disabled').val('');
				});
				e.preventDefault()
			});
		});

		
		//
		// 删除评论
		//
		function del_comment(delete_btn)
		{
			if(window.confirm('你确定要删除该评论！')){
            	$.get(delete_btn.attr('href'), function (data){
            		if(data == 1){
            			delete_btn.parents('li').remove();
            		}
            	});
            }
		}

		//
		// 评论列表鼠标移入和离开事件
		//
		function comment_hover(comment_unit, event)
		{
			if(comment_unit.find('.delete').is('.delete'))
			{
				if(event == 'enter'){
					comment_unit.find('.timestamp').hide();
					comment_unit.find('.delete').show();
				}else{
					comment_unit.find('.timestamp').show();
					comment_unit.find('.delete').hide();
				}
			}
		}
	</script>
</body>
<html>