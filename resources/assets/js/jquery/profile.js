$(function (){
	$(document).on("click", '[data-toggle="tab"]', function (){
		var $this = $(this);
		$('.tab-content').removeClass("active").hide();
		$( $this.children('a:first').attr("href") ).show();
	});

	$("#save_profile_changes").click(function (){
		var $this = $(this),
			$form = $("#form_profile"),
			url = '/profile/update';
		processProfileUpdates($this, $form, url);
	
	});

	$("#save_security_settings").click(function (){
		var $this = $(this),
			$form = $("#form_security_settings"),
			url = 'profile/change/password';

		processProfileUpdates($this, $form, url, function (){
			$form.find("input").val("");
			Materialize.updateTextFields();
		});
	});

	$("#save_email_settings").click(function (){
		var $this = $(this),
			$form = $("#form_email_settings"),
			url = 'profile/change/email',
			$old_email = $form.find("input[name='old_email']"),
			$email = $form.find("input[name='email']"),
			$email_conf = $form.find("input[name='email_confirmation']");

		processProfileUpdates($this, $form, url, function (){
			$old_email.val($email.val());
			$email.val("");
			$email_conf.val("");
			Materialize.updateTextFields();
		});

	});

	$(".profile-avatar").click(function (){
		$("#change_avatar").click();
	});

	$("#change_avatar").change(function(){
	    reBuy.readURL(this, $("#avatar_holder"));
	});


	function processProfileUpdates($button, $form, url, successCallback){
		if( typeof(reBuy) == 'undefined' ){
			return console.error('reBuy library is not found.');
		}
		return $.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
			data: $form.serialize()+"&_token="+Laravel.csrfToken,
			beforeSend: function (){
				$button.addClass("disabled");
			},
			error: function (data){
				reBuy.showErrors(data.responseJSON, $form);
			},
			success: function (data){
				if( data.success ){
					reBuy.toast(data.msg);
					if( successCallback ) successCallback();
				}else{
					if( data.hasOwnProperty('errors') ){
						reBuy.showErrors(data.errors, $form);
					}
				}
			}
		}).complete(function (response){
			$button.removeClass("disabled");
		});
	}
});