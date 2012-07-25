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
			case MESSAGE_TYPE_WARN:
				$alert_class = 'alert-block';
				break;
			case MESSAGE_TYPE_ERROR:
				$alert_class = 'alert-error';
				break;
			default:
				$alert_class = 'alert-success';
				break;
		}
?>
<div class="alert <?=$alert_class?>">
	<a class="close">&times;</a>
	<?=$message['content']?>
</div>
<?php 
	}
?>