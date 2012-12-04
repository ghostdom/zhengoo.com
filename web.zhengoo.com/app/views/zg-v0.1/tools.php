<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>珍果网 - 珍惜每一个苹果软件</title>
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/bootstrap-responsive.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<?=lib_url()?>css/style.css">
	<script type="text/javascript" src="<?=lib_url()?>/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?=lib_url()?>/js/bootstrap.min.js"></script>
</head>

<body>
	<?php $this->load->view('common/header');?>
	<div id="body" class="container">
		<div class="row" id="tools">
			<div class="main_box span12 columns">
				<div class="padding page">
					<h1>珍果 - 收录工具</h1>
					<div id="extension">
		                <img src="http://www.kippt.com/static/img/screen-chrome.png">
		                <h2>浏览器插件</h2>
		                <p>添加的珍果网的按钮，你的谷歌浏览器或Mozilla Firefox工具栏和开始保存保存的应用和看法。</p>
		                <p>
		                    <a href="#" class="btn chrome" target="_blank"><span>Install for Chrome</span></a>
		                    <a href="#" class="btn firefox" target="_blank"><span>Install for Firefox</span></a>
		                    <a href="#" class="btn opera" target="_blank"><span>Install for Opera</span></a>
		                </p>
		                <p><em><strong>使用苹果 Safari:</strong> 请使用下面 书签收集工具 进行应用收集。</em></p>
            		</div>
            		<hr>

            		<div>
            			<div id="bookmarklet">
                <img src="http://www.kippt.com//static/img/screen-bookmarklet.png">
                <h2>书签收集工具</h2>
                <p>书签收集工具 您可以使用浏览器的书签栏上的链接。首先，这个按钮拖动到书签栏，然后只需点击链接，它会打开一个新窗口，类似Chrome扩展。</p>  
                <div class="bookmarklets" style="width:220px; border:0;">
                    <a href="javascript:(function(){var w=window.open('<?=base_url()?>collect/add/?win=min&app='+encodeURIComponent(document.location.href)+'&title='+encodeURIComponent(document.getElementById('title').childNodes[1].childNodes[1].textContent)+'&icon='+encodeURIComponent(document.getElementById('left-stack').childNodes[1].childNodes[1].childNodes[0].firstChild.src)+'&desc='+ encodeURIComponent(document.getElementsByClassName('product-review')[0].childNodes[3].textContent)+'&source=<?=ZG_SOURCE_BOOKMARK?>&notes='+encodeURIComponent(''+(window.getSelection?window.getSelection():document.getSelection?document.getSelection():document.selection.createRange().text)),'zhengoo','width=400,height=225,top='+(window.screen.availHeight-30-225)/2+',left='+(window.screen.availWidth-10-400)/2 + ' location=0,links=0,scrollbars=0,toolbar=0'); if(w)setTimeout(function(){w.focus()},100);else{alert('您的浏览器开启了弹出式窗口拦截器。请按住Ctrl键并再次尝试')}})();" class="bookmarklet_button"> + 收录到珍果</a>
                    ← 拖动此 !
                </div>
            </div>
            		</div>


				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('common/footer');?>
</body>
<html>