<?php 
	$this->load->helper('date');
?>
<div  class="span9 main_box">
	<div id="collect-info">
		<div class="collect-main">
			<div class="app-info">
				<div class="app-icon">
					<img  src="<?=app_icon_175($collect['app_icon'])?>" style="float:left"/>
					<span class="mask"></span>
					<button class="btn">
						<i class="icon icon-music"></i> 连接到iTunes
					</button>
				</div>
				
				<div class="app-mate">
						<h1>
							<?=$collect['app_title']?>
						</h1>
						<a target="_blank" href="<?=$collect['app_official_web']?>"><?=$collect['app_official_web']?></a>
						<div class="app-desc">
							<?=$collect['app_desc']?>
						</div>
						<div class="mate-info">
							<!-- <span>收录人 by <strong><a title="" href="#">轩宇同学</a></strong></span> -->
							<span class="clip-date"><abbr title="收录时间:<?=date('Y-m-d H:m:s', $collect['collect_time'])?>" class="timeago"><i class="icon icon-time"></i> <abbr title="<?=date('Y-m-d H:m:s', $collect['collect_time'])?>" class="timeago"><?=format_date($collect['collect_time']) ?></abbr></abbr></span>
							<div class="action-buttons">
								<a href="#" class="btn btn-small"><i class="icon icon-thumbs-up"></i> 赞 (20)</a>
								
								<a href="javascript:;" data-content="
									<form onsubmit='javascript:return false;'>
										<input type='hidden' name='collect_app_id' value='<?=$collect['app_id']?>'/>
										<input type='hidden' name='collect_store_id' value='<?=$collect['app_store_id']?>'/>
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
										<textarea name='collect_note' rows='3' placeholder='为什么你要收集...？'></textarea>
										<div class='prpover-footer'>
											<input class='collect-save-btn btn-success btn ' type='submit' value='确定' />
										</div>
									</form>"class="btn btn-small btn-danger collect-save" style="color:#FFFFFF"><i class="icon icon-plus icon-white"></i> 收录
								</a>
							</div>
						</div>
				</div>
			</div>

			<?php 
				if($collect['app_screens']){
			?>
			<div id="app-screens" class="tabbable tabs-below">
				<ul class="nav nav-tabs ">
					<?php
						$app_screens    = json_decode($collect['app_screens'], true);
						$iphone_screens = $app_screens['iphone'];
						$ipad_screens   = $app_screens['ipad'];
						if($iphone_screens){
					?>
					<li class="active">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#iphone-screens">iPhone</a>
					</li>
					<?php 
						}

						if($ipad_screens){
					?>
					<li <?php if(!$iphone_screens){ ?> class="active" <?php } ?>>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#ipad-screens">iPad</a>
					</li>
					<?php 
						}
					?>
				</ul>
				
				<div class="app-screens tab-content">
				    <?php 
				    	if($iphone_screens){
				    		$iphone_screen_width = 320;
					    	if(count($iphone_screens) > 1)
							{
								$count = count($iphone_screens);
								$margin = 10 * ($count);
								$iphone_screen_width = $margin + ($iphone_screen_width * $count);
							}
				    ?>
				    <div class="tab-pane active" id="iphone-screens">
				      	<ul style="width:<?=$iphone_screen_width?>px">
							<?php 
								
								foreach ($iphone_screens as $iphone_screens_url) {
							?>
							<li><img  class="img-rounded" src="<?=iphone_screen_320($iphone_screens_url)?>" ></li>
							<?php 
								}
							?>
						</ul>
				    </div>
				    <?php 
						} //end if iphone_screens

						if($ipad_screens){
							$ipad_screen_width   = 480;
							if(count($ipad_screens) > 1)
							{
								$count = count($ipad_screens);
								$margin = 10 * ($count);
								$ipad_screen_width = $margin + ($ipad_screen_width * $count);
							}
					?>
				    <div class="tab-pane <?php if(!$iphone_screens){ ?> active <?php } ?>" id="ipad-screens">
				    	<ul style="width:<?=$ipad_screen_width?>px">
							<?php 
								
								foreach ($ipad_screens as $ipad_screens_url) {
							?>
							<li><img  class="img-rounded" src="<?=ipad_screen_480($ipad_screens_url)?>"></li>
							<?php 
								}
							?>
						</ul>
				    </div>
				    <?php 
				    	} //end if ipad_screens
				    ?>
  				</div>
			</div>
			<?php 
				} // end if app_screens
				$this->load->view('collect_info_comment.php');
			?>
				
		</div>
	</div>
</div>