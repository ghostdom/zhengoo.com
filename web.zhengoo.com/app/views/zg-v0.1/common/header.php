<div class="navbar-fixed-top navbar">
    <div class="navbar-inner">
      <div class="container">
        	<h3 class="logo">
            <a href="/home">珍果网</a>
          </h3>
          <ul class="nav">
            <li class="nav-discover"><a href="/discover"> 发现 </a></li>
          </ul>
          <form class="navbar-search pull-left" action="">
          	<input id="search" type="text" name="q" placeholder="搜: 稍后阅读..."/>
      	  </form>
      	<ul class="nav pull-right">
            
            <?php 
              if(isset($sess_user)){
            ?>
              <!-- <li><a href="/app/lists">朋友</a></li>
              <li><a href="/app/lists">反馈</a></li> -->
              <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <span><img class="avatar" width="32" height="32" title="<?=$sess_user['user_nice_name']?>" src="<?=$sess_user['user_avatar']?>"></span>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="/home">Home</a></li>
                  <li class="divider"></li>
                  <li><a href="/<?=$sess_user['user_login_name']?>">个人主页</a></li>
                  <li><a href="/settings/profile">设置</a></li>
                  <li><a href="/tools">工具</a> </li>
                  <li><a href="/logout">退出</a> </li>
                </ul>
              </li>
            <?php
              }else{
            ?>  
              <!-- <li><a href="/app/lists">意见反馈</a></li> -->
              <!-- <li class="actions"><a href="/signup">注册珍果帐号 <span class="caret"></span></a></li> -->
              <li class="actions"><a href="/login">登录 <!-- <span class="caret"></span> --></a></li>
            <?php 
              }
            ?>
        	</ul>
      </div>
    </div>
    <?php 
    $this->load->view('common/message');
?>
</div>

 
