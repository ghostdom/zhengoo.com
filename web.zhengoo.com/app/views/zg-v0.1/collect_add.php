<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>珍果网</title>
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
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
    
    input[type=text], textarea {
        font-family:"Helvetica Neue", Helvetica, Arial, sans-serif;
        border:1px solid #d0d0d0;
        padding:6px 8px;
        font-size:13px;
        width:343px;
        margin:5px 0;
        -webkit-box-shadow:0 1px 0px #eee inset;
        -moz-box-shadow:0 1px 0px #eee inset;
        -o-box-shadow:0 1px 0px #eee inset;
        box-shadow:0 1px 0px #eee inset;
        -webkit-border-radius:2px;
        -moz-border-radius:2px;
        -o-border-radius:2px;
        border-radius:2px;
    }
    
    textarea {height:80px;}
    
    input:focus, textarea:focus {
        outline: none;
        border-color: rgba(0,0,0, 0.3);
        -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        -o-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    
    .button, input[type=submit] {
        border:1px solid #d2d2d2;
        width: 89px;
        padding-top: 5px;
        padding-bottom: 5px;
        background:#efefef;
        float:right;
        font-size:13px;
        font-weight:bold;   
        text-shadow:0 1px 0px #fff;
        margin:0;
        text-align:center;
        cursor:pointer;
        background-image: -moz-linear-gradient(white, #EEE);
        background-image: -o-linear-gradient(white, #EEE);
        background-image: -ms-linear-gradient(white, #EEE);
        background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, white), color-stop(1, #EEE));
        background-image: -webkit-linear-gradient(white, #EEE);
        -webkit-transition:all 0.5s;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        -o-border-radius: 3px;
        border-radius: 3px;
    }
    
    #new_list_name { 
        display:none;
        width: 132px;
        margin: 0;
    }
    
    #h .button:hover, input[type=submit]:hover  {
        border:1px solid #bbb;
        opacity:1;
        -webkit-box-shadow:0 0 2px #ccc;     
        -moz-box-shadow:0 0 2px #ccc;
        -o-box-shadow:0 0 2px #ccc;     
        box-shadow:0 0 2px #ccc;
    }
    
    select {
        width:150px;
        margin:6px 0 0 0;
    }
    
    #h {
        padding:5px 0 5px; 
        font-size:14px; 
        text-shadow:0 1px 0px #fff; 
        height:20px;
    }
    
    #h img {
        padding:0px 12px 0 0; 
        margin-right:12px;
        float:left; 
        border-right:1px solid #ddd;
    }

    #h .button {
        margin-top:-3px;
        padding:3px 10px;
        margin-left:10px;
        width:10px;
        height:13px;
        background:url(/static/img/chrome-icons.png) 9px 3px no-repeat;
        opacity:0.8;
    }
    
    #h .button.read {
        background-position:6px -20px;
    }
    
    .sharing {
        border-left:1px solid #ddd;
        display:inline-block;
        padding-left:10px;
        margin-left:10px;
    }
    
    .toggle {
        display:inline-block;
        width:20px;
        height:20px;
        background:url(/static/img/extension-icons.png) center 0 no-repeat #c5c5c5;
        text-align:center;
        margin-left:4px;
        border-radius:2px;
        line-height:18px;
        vertical-align:middle;
        -webkit-transition:0.12s background-color linear;
        -moz-transition:0.12s background-color linear;
    }
    
    .toggle:hover {
        background-color:#bbb;
    }
    
    .toggle.twitter {background-position:center -30px;}
    .toggle.tumblr {background-position:center -60px;}
    
    .toggle.tumblr.selected {background-color:#2B4660;}
    .toggle.facebook.selected {background-color:#405C9E;}
    .toggle.twitter.selected {background-color:#00A7D8;}
	</style>
</head>

<body>
	<div id="frame-container">
	<div id="kippt-frame">
	<div id="h">
	    <img width="42" height="18" alt="珍果网" src="/static/img/kippt-small.png">
	    <strong>添加收集</strong>
	    <a id="read-later" title="Read Later" class="button read" href="#"></a>
	    <a target="_blank" title="Open Kippt" class="button" href="https://kippt.com"></a>
	</div>

	<div>
	    <?=$app['app_title']?>
	</div>
	<div>
	    <textarea placeholder="Enter notes and #tags here..." name="notes" cols="40" rows="10" id="id_notes"></textarea>
	</div>

	<select id="id_list" class="lists">
		<option value="18468">Inbox</option>
		<option value="84182">app</option>
		<option value="87120">CCTV</option>
		<option value="87135">你好</option>
		<option value="--new-list--" id="new-list">-- 新建 --</option>
	</select>
	<input type="text" name="new_list" id="new_list_name" placeholder="New list" style="display: none;">

	<div class="sharing">
	    <a target="_blank" title="Share to Twitter" class="toggle twitter " href="/accounts/settings/connections/"></a>
	    <a target="_blank" title="Share to Facebook" class="toggle facebook " href="/accounts/settings/connections/"></a>
	    <a target="_blank" title="Share to Tumblr" class="toggle tumblr " href="/accounts/settings/connections/"></a>
	</div>
	<input type="submit" id="submit_clip" value="保存">
	</div>
	</div>
</body>

</html>