
<div class="profile-head row">
	<div class="span2">
		<img class="avatar" src="<?=$user['user_avatar']?>" />
	</div>
	<div class="profile-info span6">
		<h1><?=$user['user_nice_name']?></h1>
	    <p>
	    	<?php 

	    		if(isset($user['user_signature']) && $user['user_signature'])
	    			echo $user['user_signature'];
	    	?>
	    </p>

	</div>
	<div class="profile-extra">
		<?php
			$ufollow_class = ''; 
			if(isset($sess_user) && $user['user_id'] == $sess_user['user_id']){
		?>
			<a class="btn" href="#"> <i class="icon icon-cog"></i> 个人设置</a>
		<?php 
			} else {
				if(isset($ufollow_regard))
				{
					
					if($ufollow_regard == UFOLLOW_REGARD_ACTIVE)
					{
						$ufollow_class = 'following';
					}
				}
		?>
			<button class="user-follow btn btn-danger <?=$ufollow_class?>" data-api-uri="/follow/<?=$user['user_login_name']?>">
				<?php 
					if($ufollow_class){
				?>
					<span>✔</span> 已关注
				<?php 
					} else {
				?>
					<i class="icon icon-plus icon-white"></i> 关注他
				<?php 
					}
				?>
			</button>
		<?php 
			}
		?>

		<div>
			<?php 
				$oauths = explode('|', $user['user_oauths']);
				foreach ($oauths as $source) {
			?>
			<a href="/<?=$user['user_login_name']?>/<?=source_to_name($source)?>" class="logo-btn-min logo-btn-min-<?=source_to_name($source)?>" target="_blank"></a>
			<?php
				}
			?>
		</div>
	</div>
</div>

<div class="profile-tabs">
	<a <?php if( ! $this->uri->segment(2)) { ?>class="active" <?php } ?> href="/<?=$user['user_login_name']?>"><strong><?=$collect_count?></strong> 应用</a>
	<a <?php if($this->uri->segment(2) == 'following') {?>class="active" <?php } ?> href="/<?=$user['user_login_name']?>/following"><strong><?=$following_count?></strong> 关注</a>
	<a <?php if($this->uri->segment(2) == 'followers') {?>class="active" <?php } ?> href="/<?=$user['user_login_name']?>/followers"><strong><?=$followers_count?></strong> 粉丝</a>
</div>