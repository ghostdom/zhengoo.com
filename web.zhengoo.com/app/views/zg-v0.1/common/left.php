<!-- category_list -->
<div class="span2">
	<div class="left-top">
		<h4>类别</h4>
		<div class="line"></div>
		<ul class="nav nav-list">
			<!-- <li class="active"><a href="#"><i class="icon-home icon-white"></i> 首页</a></li> -->
			<li><a href="#"><i class="icon-align-justify"></i> 全部</a></li>
			<?php 
				$this->load->config('appstore');
				$icons = $this->config->item('app_icons');
				foreach ($categorys as $category) {
			?>
	    	<li <?php if(isset($cur_category) && $cur_category['category_id'] == $category['category_id']) echo 'class="active" '?> ><a href="/app/<?=$category['category_alias']?>"><i class="<?=$icons[$category['category_alias']]?>  <?php if(isset($cur_category) && $cur_category['category_id'] == $category['category_id']) echo 'icon-white'?> "></i> <?=$category['category_name']?></a></li>
			<?php 
				} 
			?>
		</ul>

		

	</div>

	<div class="left-top" style="margin-top:20px">
		<h4>关注我们</h4>
		<div class="line"></div>
			<ul class="nav nav-list">
				<li><a href="">新浪微博</a></li>
				<li><a href="">腾讯微博</a></li>
				<li><a href="">人人小站</a></li>
				<li><a href="">QQ空间</a></li>
			</ul>

	</div>
	
</div>