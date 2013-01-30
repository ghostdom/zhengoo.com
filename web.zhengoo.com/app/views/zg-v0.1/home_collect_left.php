<div class="span9 main_box">
	<div id="list-head" class="clearfix">
    	<div id="list-info">
			<h3 title="Read Later" class="name">我的应用</h3>
			<ul class="list-actions unstyled">
			    <li>
			        <a href="#" data-toggle="dropdown" >
			            <i class="icon-cog"></i>
			            <span class="caret"></span>
			        </a>
			        <ul class="dropdown-menu pull-right">
			            <li><a title="List RSS feed" class="rss private" href="/Tceisk9584/read-later/feed/6638fa32f9f4934ff9e77acde75b74eb">RSS</a></li>
			        </ul>
			    </li>
			    
			</ul>
		</div>
		<!-- <div id="new-clip"><input type="text" placeholder="Add a link..."></div> -->
	</div>

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
				</div>
			</div>
		</li>
		<?php 
			}
		?>
	</ul>
	<?php 
		$this->load->view('common/pagination' , array('base_url' => uri_string(), 'total_rows' => $collect_count, 'sizes' => 'large'));
		} else { 
	?>
	<div class="no-datas no-datas-app">
        <p>
        	<strong>您还未收录任何应用程序</strong>
         	<small>您可以通过安装我们提供的 <a href="/tools/">收藏工具</a> 快速收录您感兴趣的应用， 同时可以分享给你的朋友们。</small>	
        </p>
    </div>
	<?php 
		}
	?>

</div>

