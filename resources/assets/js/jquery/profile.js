$(function (){
	$("#save_profile_changes").click(function (){
		var $this = $(this),
			$form = $("#form_profile");

		$.ajax({
			url: '/profile/update',
			type: 'post',
			dataType: 'json',
			data: $form.serialize(),
			beforeSend: function (){
				$this.addClass("disabled");
			},
			success: function (data){
				console.log(data);
				if( data.success ){
					reBuy.toast(data.msg);
				}
			},
			error: function (data){
				console.warn(data);
			}
		}).complete(function (data){
			$this.removeClass("disabled");
			console.warn(data.status);
			if( data.status == 422 ){
				reBuy.showErrors(data.responseJSON, $form);
			}
		});
	});

	$(document).on("click", '[data-toggle="tab"]', function (){
		var $this = $(this);
		$('.tab-content').removeClass("active").hide();
		$( $this.children('a:first').attr("href") ).show();
	});
});