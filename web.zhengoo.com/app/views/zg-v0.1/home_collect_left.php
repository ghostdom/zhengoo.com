<div class="span9 main_box">
	<ul id="collect-list">
		<?php 
			if($collects){
				$this->load->helper('date');
				foreach ($collects as $collect) {	
		?>
		<li class="collect">
			<div class="collect-content">
				<span class="collect-date">
					<!-- <i  class="icon icon-time"></i> -->
					<?php 
						if($this->uri->segment(2) == 'likes'){
							$time = $collect['like_time'];
							$segment = 'unlike'; 
						}else {
							$time = $collect['collect_time'];
							$segment = 'remove';
						}
					?>
					<abbr><?=format_date($time)?></abbr>
				</span>
				<ul class="actions">
					<li>
        				<a rel="tooltip" data-original-title="iTunes中打开" href="<?=str_replace('https://','itms://', $collect['collect_link'])?>" >
        					<i class="icon icon-music"></i>
        				</a>
        			</li>
					<li>
        				<a rel="tooltip" data-original-title="分享" href="#" >
        					<i class="icon icon-share"></i>
        				</a>
        			</li>
        		
        			<li>
        				<a class="collect-delete" rel="tooltip" data-original-title="删除" href="/<?=$segment?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>">
        					<i class="icon icon-remove"></i>
        				</a>
        			</li>
        			<li></li>
    			</ul>

				<a title="<?=$collect['collect_title']?>" href="/<?=$sess_user['user_login_name']?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>">
					<img width="75" height="75" style="float:left" src="<?=app_icon_75($collect['collect_icon'])?>">
					<span class="mask"></span>
				</a>
				<div class="collect-info">
					<a class="collect-title" href="/<?=$sess_user['user_login_name']?>/<?=rawurlencode($collect['collect_title'])?>-<?=$collect['collect_store_id']?>-<?=$collect['collect_id']?>"><?=$collect['collect_title']?></a>
					<div class="content">
						<a href="#">
							 <?=$collect['collect_note']?>
						</a>
					</div>
					<!-- <p>
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
						
					</p> -->
				</div>
			</div>
		</li>
		<?php 
			}
			// echo current_url();
		} 
		?>
	</ul>
		<?php $this->load->view('common/pagination' , array('base_url' => uri_string(), 'total_rows' => $collect_count, 'sizes' => 'large')); ?>
</div>

