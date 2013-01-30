<?php 
	if(isset($message)){
		$type = $message['type'];
		switch ($type) {
			case MESSAGE_TYPE_SUCCESS:
				$alert_class = 'alert-success';
				break;
			case MESSAGE_TYPE_INFO:
				$alert_class = 'alert-info';
				break;
			case MESSAGE_TYPE_ERROR:
				$alert_class = 'alert-error';
				break;
			default:
				$alert_class = '';
				break;
		}
?>
<div id="zg-message" class="alert alert-block <?=$alert_class?>">
	<a class="close" data-dismiss="alert" type="button">&times;</a>
	<p><?=$message['content']?></p>
</div>
<?php 
	}
?>