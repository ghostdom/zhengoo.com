<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        	<a class="brand" href="/">珍果网</a>
          <ul class="nav">
            <li class="active"><a href="/"> 首页 </a></li>
          </ul>
          <form class="navbar-search pull-left" action="">
          	<input type="text" class="search-query span2" placeholder="搜索应用"/>
      	</form>
      	<ul class="nav pull-right">
            <li><a href="/app/lists">找应用</a></li>
             <li class="divider-vertical"></li>
            <?php 
              if(isset($sess_user)){
            ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $sess_user['user_login_name']?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">配置</a> </li>
                  <li class="divider"></li>
                  <li><a href="/tools">工具</a> </li>
                  <li><a href="/logout">退出</a> </li>
                </ul>
              </li>
            <?php
              }else{
            ?>  
              <li><a href="/login">登录</a></li>
              <!-- <li class="divider-vertical"></li> -->
              <li><a href="/signup">注册</a></li>
            <?php 
              }
            ?>
        	</ul>
      </div>
    </div>
</div> 