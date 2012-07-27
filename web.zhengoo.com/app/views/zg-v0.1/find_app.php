<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>珍果网 - 珍惜每一个苹果软件</title>
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap-responsive.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/style.css">
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
</head>

<body>
	<?php $this->load->view('common/header');?>
	<div class="container">
		<div class="row lookup">
			<div class="main_box span12 columns">
				<div class="padding">
					<h1>寻找您感兴趣的应用</h1>
					<div class="subnav lookup">
					    <ul class="nav nav-pills">
					      <li class="dropdown">
					        <a class="dropdown-toggle" data-toggle="dropdown" href="#">图书 <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					          <li class="active"><a href="#buttonGroups">Button groups</a></li>
					          <li><a href="#buttonDropdowns">Button dropdowns</a></li>
					        </ul>
					      </li>
					      <li class="dropdown">
					        <a class="dropdown-toggle" data-toggle="dropdown" href="#">社交 <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					          <li><a href="#navs">Nav, tabs, pills</a></li>
					          <li><a href="#navbar">Navbar</a></li>
					          <li><a href="#breadcrumbs">Breadcrumbs</a></li>
					          <li><a href="#pagination">Pagination</a></li>
					        </ul>
					      </li>
					      <li><a href="#labels">教育</a></li>
					      <li><a href="#badges">娱乐</a></li>
					      <li><a href="#typography">参考</a></li>
					      <li><a href="#thumbnails">天气</a></li>
					      <li><a href="#alerts">报刊杂志</a></li>
					      <li><a href="#progress">健康健美</a></li>
					      <li><a href="#misc">效率</a></li>
					      <li><a href="#misc">游戏</a></li>
					    </ul>
  					</div>
  					<div class="app-items clearfix">
  						<?php 
  							for ($i=0; $i < 10 ; $i++) { 
  						?>
  						<div class="app-widget">
  							<button class="btn btn-danger collect">收集</button>
  							<img class="avatar" src="http://a3.mzstatic.com/us/r1000/080/Purple/v4/2c/68/12/2c6812d7-3333-6465-ddf2-6de934b4791e/Icon.png" width="60" height="60"/>
  							<div>
  								<h3> <a href="#">套真货</a> </h3>
  								“牛肉已经吃不起了，猪肉马上也要吃不起，
  							</div>
  						</div>
  						<?php 
  							}
  						?>
  					</div>
				</div>
			</div>
		</div>
		
	</div>
	<?php $this->load->view('common/footer');?>
</body>
<html>