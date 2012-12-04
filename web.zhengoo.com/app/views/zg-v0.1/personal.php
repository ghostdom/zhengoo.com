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
				<div class="profile clearfix span12">
					<?php $this->load->view('personal_top'); ?>
					<div class="profile-apps">
						
						<?php 
							foreach ($collects as $collect) {
						?>
						<div class="app-widget">
  							<a class="collect-save btn btn-danger" href="javascript:;"
  								data-content="
								<form onsubmit='javascript:return false;'>
									<input type='hidden' name='collect_app_id' value='<?=$collect['collect_app_id']?>'/>
									<input type='hidden' name='collect_store_id' value='<?=$collect['collect_store_id']?>'/>
									<input type='hidden' name='collect_form' value='<?=$collect['collect_id']?>'/>
									<?php
										$collect_root = $collect['collect_root'];
										if($collect['collect_root'] == 0){
											$collect_root = $collect['collect_id'];
										}
									?>
									<input type='hidden' name='collect_root' value='<?=$collect_root?>'/>
									<input type='hidden' name='collect_title' value='<?=$collect['collect_title']?>'>
									<input type='hidden' name='collect_icon' value='<?=$collect['collect_icon']?>'>
									<input type='hidden' name='collect_link' value='<?=$collect['collect_link']?>'>
									<input type='hidden' name='app_desc' value='<?=htmlspecialchars($collect['collect_note'])?>'>
									<textarea name='collect_note' rows='2' placeholder='为什么你要收录...？'></textarea>
									<div class='prpover-footer'>
										<input class='btn btn-success collect-save-btn' type='submit' value='确定' />
									</div>
								</form>" >
  								<i class="icon icon-plus icon-white"></i>
  								收录
  							</a>
  							
  							<a title="<?=$collect['collect_title']?>" href="/<?=$user['user_login_name']?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>">
  								<img class="app-icon" src="<?=app_icon_100($collect['collect_icon'])?>" title="<?=$collect['collect_title']?>" alt="<?=$collect['collect_title']?>"/>
  								<span class="mask">
  									<!-- <i class="icon-plus-sign" style="right:0;"></i> -->
  								</span>
  							</a>
  							<div class="app-desc">
  								<h3><a title="<?=$collect['collect_title']?>" href="/<?=$user['user_login_name']?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>"><?=$collect['collect_title']?></a></h3>
  								<?=$collect['collect_note']?>
  							</div>
  						</div>
  						<?php } ?>
  						
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer');?>
	<script type="text/javascript" src="<?=lib_url()?>js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>js/zhengoo-actions.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>js/zhengoo-follow.js"></script>
	<script type="text/javascript">
		$(function () {
			$('.app-widget').hover(
				function () {
					$(this).find('.collect-save').show();
				},
				function () {
					$(this).find('.collect-save').hide();
				}
			);
		});
	</script>
</body>
</html>