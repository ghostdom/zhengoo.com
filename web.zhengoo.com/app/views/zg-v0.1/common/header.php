<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        	<a class="brand" href="/">珍果网</a>
          <ul class="nav">
            <li class="active"><a href="/"> 首页 </a></li>
            <li class="dropdown"><a href="./index.html" class="dropdown-toggle" data-toggle="dropdown">类别 <b class="caret"></b></a>
            	<ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li class="nav-header">Nav header</li>
              <li><a href="#">Separated link</a></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
            </li>
          </ul>
          <form class="navbar-search pull-left" action="">
          	<input type="text" class="search-query span2" placeholder="搜索应用"/>
      	</form>
      	<ul class="nav pull-right">

            <?php 
              if(isset($sess_user)){
            ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $sess_user['user_login_name']?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">配置</a> </li>
                  <li class="divider"></li>
                  <li><a href="#">配置</a> </li>
                  <li><a href="logout">退出</a> </li>
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