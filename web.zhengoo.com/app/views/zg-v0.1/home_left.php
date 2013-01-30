
<div class="span3 sidebar">
	<ul class="nav nav-list" data-spy="affix" data-offset-top="50">
  		<li><a href="/home"><i class="icon icon-home"></i> 我的首页 </a></li>
  		<div class="divider"></div>
  		<!-- class="active" -->
  		<li><a href="/<?=$sess_user['user_login_name']?>/inbox"><i class="icon icon-inbox"></i> 所有应用</a></li>
  		<li><a href="/<?=$sess_user['user_login_name']?>/likes"><i class="icon icon-heart"></i> 喜欢</a></li>
      <li><a href="/<?=$sess_user['user_login_name']?>/comment/inbox"><i class="icon icon-comment"></i> 评论</a></li>
  		<div class="divider"></div>
  		
<!--       <li><a href="#"><i class="icon icon-list-alt"></i> 分组</a></li>

  		
      <li class="divider"></li>
  		<a class="btn btn-danger btn-block " data-toggle="modal" href="#add_list">
        <i class="icon icon-plus icon-white"></i>新建应用分组
      </a> -->
	</ul>
</div>
<?php $this->load->view('list_add'); ?>