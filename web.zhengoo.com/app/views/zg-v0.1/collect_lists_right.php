<div class="span9 main_box">
	<ul id="collect-list">
		<?php 
			if($collects){
				$this->load->helper('date');
				foreach ($collects as $collect) {	
		?>
		<li class="collect">
			<div class="collect-content">
				<a class="collect-save btn btn-danger" href="javascript:;" 
					data-content="
					<form onsubmit='javascript:return false;'>
						<input type='hidden' name='collect_app_id' value='<?=$collect['app_id']?>'/>
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
						<input type='hidden' name='app_desc' value='<?=htmlspecialchars($collect['app_desc'])?>'>
						<textarea name='collect_note' rows='4' placeholder='为什么你要收录...？'></textarea>
						<div class='prpover-footer'>
							<select name='collect_list_id'>
								<?php
									foreach ($all_list as $list) {
								?>
		                			<option value='<?=$list['list_id']?>'><?=$list['list_title']?></option>
								<?php
									}
								?>
							</select>
							<input class='collect-save-btn btn ' type='submit' value='确定' />
						</div>
					</form>" title="">
					<i class="icon icon-plus icon-white"></i>
					收录
				</a>
				<span class="collect-date">
					<i  class="icon icon-time"></i>
					<abbr><?=format_date($collect['collect_time']) ?></abbr>
				</span>

				<a title="<?=$collect['app_title']?>" href="/<?=$user['user_login_name']?>/<?=$list['list_alias']?>/app/<?=$collect['collect_id']?>">
					<img width="75" height="75" style="float:left" src="<?=app_icon_75($collect['app_icon'])?>">
					<span class="mask"></span>
				</a>
				<div class="collect-info">
					<a class="collect-title" href="/<?=$user['user_login_name']?>/<?=$list['list_alias']?>/app/<?=$collect['collect_id']?>"><?=$collect['app_title']?></a>
					<div class="content">
						<a href="#">
							 <?=$collect['app_desc']?>
						</a>
					</div>
					<p>
						<span>
							<a href="#">
								<i class="icon icon-thumbs-up"></i>
								<span>赞</span>
							</a>
						</span>
						<span>
							<a href="#">
								<i class="icon icon-share-alt"></i>
								<span>分享</span>
							</a>
						</span>
						<span>
							<a href="#">
								<i class="icon icon-comment"></i>
								<span>评论</span>
							</a>
						</span>
						
					</p>
				</div>
			</div>
		</li>
		<?php 
			}
		} 
		?>
	</ul>