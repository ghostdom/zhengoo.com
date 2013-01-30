<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Keywords" content="<?=$this->config->item('seo_keywords')?>"/>
	<meta name="Description" content="<?=$this->config->item('seo_description')?>"/>
	<title>消息提示 - <?=$this->config->item('seo_title')?></title>
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap-responsive.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/style.css">
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
</head>

<body>
	<?php $this->load->view('common/header');?>
	<div id="body" class="container">
		<div class="row" id="message">
			<div class="main_box span12 columns">
				<div class="padding page">
					<!-- <h1>你好</h1> -->
					
            		<div>
            			<div>
			                <img src="<?=lib_url()?>/images/message_bulb_off.png">
			                <h4>提醒</h4>
			                <blockquote>
			                	<small><?=$msg?></small>  
           				 	</blockquote>
           				 </div>
            		</div>


				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer');?>
</body>
<html>