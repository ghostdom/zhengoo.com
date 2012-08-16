<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>珍果网 - 用户登陆</title>
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
	<style type="text/css">

    body {
        font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
        -webkit-font-smoothing:antialiased;
        background-repeat:no-repeat;
        color:#333;
        width:360px;
        padding:10px;
        background-image: -moz-linear-gradient(white, #fafafa);
        background-image: -o-linear-gradient(white, #fafafa);
        background-image: -ms-linear-gradient(white, #fafafa);
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, white), color-stop(1, #fafafa));
        background-image: -webkit-linear-gradient(white, #fafafa);
    }
    
    input {
    box-shadow: 0 1px 1px #DDDDDD inset;
    color: #000000;
    font-size: 16px;
    padding: 0.5em;
    width: 300px;
    }

    #login-form {
        padding-top: 10px;
        width: 350px;

    }
    .input {
        margin-bottom: 10px;
        margin-left:30px;
    }
	</style>
</head>

<body>
	<div id="frame-container">
        <h2 style="text-align: center;">珍果网</h2>
        <form id="login-form"  method="post" action='/m_login'>
        <div class="input">
            <input type="text" name="user_login_name" placeholder="用户名 / 邮箱"/>
        </div>
        
        <div class="input">
            <input type="password" name="user_passwd" placeholder="密码"/>
        </div>  
        <?php 
            if($this->input->get('next')){
        ?>
            <input type="hidden" name="next" value="<?=$this->input->get('next')?>"/>
        <?php 
            } 
        ?>

        <div class="clearfix">
            <input class="btn btn-large btn-danger" type="submit" value="立即登录" style="float:right" />
        </div>
        </form>
	</div>
</body>

</html>