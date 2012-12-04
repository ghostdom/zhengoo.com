$('.collect-save').popover({
	animation: false,
	html: true,
	placement: 'left',
	trigger: 'click'
}).toggle(
	function () {
		var collect_save = $(this);
		$(this).parents('.collect,.app-widget').unbind('mouseleave');
		$('.popover-content textarea').focus();
		$(this).html('<i class="icon icon-remove icon-white "></i> 取消');

		$('.collect-save-btn').click(function (){
			$(this).addClass('disabled');
			var post_param = $(this).parents('form').serializeArray();
			$.post('/collect/save_as', post_param, function (collect_id) {
				if(collect_id > 0){
					collect_save.removeClass('btn-danger').addClass('btn-success').html('<i class="icon icon-ok icon-white "></i> 已收录');
					collect_save.popover('hide');
					collect_save.parents('.collect').mouseleave(function () {
						$(this).find('.collect-save').hide();
					});
					collect_save.unbind('click');
				}
			});
		});
	},
	function () {
		$(this).popover('hide');
		$(this).html('<i class="icon icon-plus icon-white "></i> 收录')
		$(this).parents('.collect,.app-widget').mouseleave(function () {
			$(this).find('.collect-save').hide();
		});
	}
);