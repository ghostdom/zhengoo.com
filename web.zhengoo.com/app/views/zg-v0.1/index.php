<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="Keywords" content="<?=$this->config->item('seo_keywords')?>"/>
	<meta name="Description" content="<?=$this->config->item('seo_description')?>"/>
	<title><?=$this->config->item('seo_title')?></title>
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap-responsive.min.css">
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/style.css">
</head>
<body id="body">
	<?php $this->load->view('common/header');?>
	<div  class="container">
 		<div class="span12">
 			
 		</div>
	</div>
	 <?php $this->load->view('common/footer');?>
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
</body>
</html>