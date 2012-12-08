<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>珍果网 - 珍惜每一个苹果软件</title>
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/style.css">
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>js/zhengoo-follow.js"></script>
</head>

<body>
	<?php $this->load->view('common/header');?>
	<div id="body" class="container">
		<div class="app-bg clearfix">
			<div class="row">
				<div class="span12 columns explore">
					<div class="explore">
						<i class="">›</i>
						<!-- <span class="type">类别</span> -->
						<a class="active" href="/discover/staff-picks/">精选</a>
						<a href="/discover/popular/">流行</a>
						<a href="/discover/recent/">最新</a>
					</div>

					<div class="discover clearfix">
						<?php 
							if($users){
								foreach ($users as $user) {	
									$collect_count = $this->collect->count(array('collect_user_id' => $user['user_id']));
									$followers_count = $this->ufollow->count(array('ufollow_whom' => $user['user_id']));
						?>
						<div class="list-widget">
							<a href="/<?=$user['user_login_name']?>">
								<img style="float:left" class="avatar" width="42" height="42" src="<?=$user['user_avatar']?>">
							</a>
							<div class="list-head">
        						<h3><a href="/<?=$user['user_login_name']?>"><?=$user['user_nice_name']?></a></h3>
        						<div class="list-meta"><a href="/<?=$user['user_login_name']?>"><?=$collect_count?> 应用</a> · <a href="/<?=$user['user_login_name']?>/followers"><?=$followers_count?> 粉丝</a></div>
        						<?php 
        							$ufollow_btn_class = 'user-follow btn ';
        							$ufollow_btn_val = '<i class="icon icon-plus icon-white"></i>  关注他';
        							$ufollow_btn_herf = '/follow/'.$user['user_login_name'];
        							if(isset($sess_user)){
        								if($sess_user['user_id'] != $user['user_id']){
        									$ufollow_regard = $this->ufollow->get_regard($sess_user['user_id'], $user['user_id']);
        									if($ufollow_regard == UFOLLOW_REGARD_ACTIVE){
        										$ufollow_btn_class = $ufollow_btn_class.' following';
        										$ufollow_btn_val = '<span>✔</span> 已关注';
        									}else{
        										$ufollow_btn_class .= ' btn-danger';
        									}
        								}else{
        									$ufollow_btn_class = 'btn disabled';
        									$ufollow_btn_val = '我自己';
        									$ufollow_btn_herf = 'javascript:;';
        								}
        							}else{
        								$ufollow_btn_class = 'btn btn-danger';
        								$ufollow_btn_herf = '/login';
        							}
        						?>	
    							<a class="<?=$ufollow_btn_class?>" href="<?=$ufollow_btn_herf?>" data-api-uri="<?=$ufollow_btn_herf?>">
    								<?=$ufollow_btn_val?>
    							</a>
							</div>
							<div class="list-body">
								<ul>
									<?php 
										foreach ($user['collects'] as $collect) { 
									?>
									<li>
										<a title="<?=$collect['collect_title']?>" href="/<?=$user['user_login_name']?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>">
											<div class="widget-app">
												<img width="75" height="75" src="<?=app_icon_75($collect['collect_icon'])?>"/>
												<span class="mask"></span>
												<p><?=substr($collect['collect_title'], 0, 44)?></p>
											</div>
										</a>
									</li>
									<?php } ?>
							
								</ul>
							</div>
						</div>
						<?php 
							} 
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer');?>
</body>
</html>