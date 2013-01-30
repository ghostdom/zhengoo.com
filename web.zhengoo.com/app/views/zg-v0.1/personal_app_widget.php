<div class="profile-apps">
<?php 
	if($collects){
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
<?php 
	} 
} 
?>
</div>