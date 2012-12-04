$(function () {
	/**
	 * ----------------------------------
	 * 用户关注按钮点击事件
     *
	 * -  
	 * ----------------------------------
	 */
	$('.user-follow').click(function(e) {
		
		if($(this).hasClass('following')) {
			$(this).removeClass('following').addClass('btn-danger').html('<i class="icon icon-plus icon-white"></i> 关注他');
			$('.list-follow').removeClass('following').html('<i class="icon-plus icon"></i> 关注');
		} else {
			$(this).removeClass('btn-danger').addClass('following').html('<span>✔</span> 已关注');
			$('.list-follow').addClass('following').html('<span>✔</span> 已关注');
		}
		
		$.get($(this).attr('data-api-uri'), function (data){
			// alert(data);
		});
		e.preventDefault();
	});

	/**
	 * ----------------------------------
	 * List关注按钮事件
     *
	 * -  
	 * ----------------------------------
	 */
	$('.list-follow').click(function (e) {
		if($(this).hasClass('following')) {
			$(this).removeClass('following').html('<i class="icon-plus icon"></i> 关注');
		} else {
			$(this).addClass('following').html('<span>✔</span> 已关注');
		}
		$.get($(this).attr('data-api-uri'), function (data){
			// alert(data);
		});
		e.preventDefault();
	});

});