<div class="profile-lists">
	<?php 
	if(isset($lists)){
		foreach ($lists as $list) {
	?>
	<div class="list-widget">
		<a href="/<?$user['user_login_name']?>">
			<img style="float:left" class="avatar" width="42" height="42" src="<?=$user['user_avatar']?>">
		</a>
		<div class="list-head">
			<h3><a href="/<?=$user['user_login_name']?>/<?=$list['list_alias']?>/"><?=$list['list_title']?></a></h3>
			<div class="list-meta">by <a href="#"><?=$user['user_nice_name']?></a> · <?=$list['follow_count']?> 粉丝</div>
			<?php 
				if($sess_user){
					if($sess_user['user_id'] != $user['user_id']){
						$lfollow = $this->lfollow->find_where(array('lfollow_who' => $sess_user['user_id'], 'lfollow_list_id' => $list['list_id']))
			?>	
				<a class="list-follow btn <?php if($lfollow) echo 'following'; ?>" href="/follow/<?=$user['user_login_name']?>/<?=$list['list_alias']?>" data-api-uri="/follow/<?=$user['user_login_name']?>/<?=$list['list_alias']?>">
					<?php 
						if($lfollow){
					?>
						<span>✔</span> 已关注
					<?php 
						}else{
					?>
						<i class="icon-plus icon"></i> 关注
						
					<?php 
						}
					?>
				</a>
			<?php
					}
				} else {
			 ?>
			 <a class="btn" href="/login" >
				<i class="icon-plus icon"></i> 关注
			 </a>
			<?php 
				}
			?>
		</div>
		<div class="list-body">
			<ul>
				<?php 
					foreach ($list['collects'] as $collect) { 
				?>
				<li>
					<a title="<?=$collect['collect_title']?>" href="/<?=$user['user_login_name']?>/<?=$list['list_alias']?>/app/<?=$collect['collect_id']?>/">
						<div class="widget-app">
							<img width="75" height="75" src="<?=app_icon_75($collect['collect_icon'])?>"/>
							<span class="mask"></span>
							<p><?=substr($collect['collect_title'], 0, 44)?></p>
						</div>
					</a>
				</li>
				<?php } ?>
		
			</ul>
		<!-- <div class="list-view span5"> <a  href="#">查看所有 ›</a> </div> -->
		</div>
	</div>
	<?php 
		}
	}
	?>
	<!-- <div class="clearfix"></div> -->
</div>