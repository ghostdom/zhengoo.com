<div class="span3 sidebar">
	<ul class="nav nav-list">
  		<li><a href="/home"><i class="icon icon-home"></i> 我的首页 </a></li>
  		<li class="divider"></li>
  		<!-- class="active" -->
  		<li><a href=""><i class="icon icon-inbox"></i> 所有应用</a></li>
  		<li><a href=""><i class="icon icon-star"></i> 已加标星</a></li>
  		<li><a href="/<?=$sess_user['user_login_name']?>/likes"><i class="icon icon-heart"></i> 喜欢</a></li>
      <li><a href=""><i class="icon icon-comment"></i> 评论</a></li>
  		<li class="divider"></li>
  		
<!--       <li><a href="#"><i class="icon icon-list-alt"></i> 分组</a></li>

  		
      <li class="divider"></li>
  		<a class="btn btn-danger btn-block " data-toggle="modal" href="#add_list">
        <i class="icon icon-plus icon-white"></i>新建应用分组
      </a> -->
	</ul>
</div>
<?php $this->load->view('list_add'); ?>