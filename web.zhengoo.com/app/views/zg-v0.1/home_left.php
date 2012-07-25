<div class="span3 well" id="sidebar" >
	<ul class="nav nav-list">
  		<li><a href="#"><i class="icon icon-home"></i> 我的首页 </a></li>
  		<li class="divider"></li>
  		<!-- class="active" -->
  		<li> <a href=""><i class="icon icon-inbox"></i> 所有应用</a></li>
  		<li> <a href=""><i class="icon icon-star"></i> 已加标星</a></li>
  		<li> <a href=""><i class="icon icon-heart"></i> 喜欢</a></li>
      <li> <a href=""><i class="icon icon-comment"></i> 评论</a></li>
  		<li class="divider"></li>
  		<?php 
        foreach ($lists as $list) {
       
      ?>
      <li> <a href="/<?=$cur_user['user_login_name']?>/<?=$list['list_id']?>"><i class="icon icon-folder-open"></i> <?=$list['list_title']?></a></li>
      <?php 
        }
      ?>
  		
      <li class="divider"></li>
  		<a class="btn" data-toggle="modal" href="#add_list"><i class="icon-plus icon"></i>新建列表</a>
	</ul>
</div>
<?php $this->load->view('list_add'); ?>