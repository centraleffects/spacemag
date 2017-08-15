$(function (){
	var txt_pass = $("#password"),
		txt_confirmPass = $("#password_confirmation"),
		password_meter_text = $("#password_meter_text"),
		password_meter = $("#password_meter"),
		form_register = $("#form_register"),
		weak_password_confirmation = $("#weak_password_confirmation"),
		confirm_weak_password = $("#confirm_weak_password"),
		btn_submit = $("#btn_submit");

	var errors = {};
		errors.password_confirmation = ['Your passwords do not match.'];;

	window.passwordStrength = 1;

	txt_pass.on("keyup", function (){
		var $this = $(this);

		var strength = reBuy.testPassword($this.val());

		var lent = (strength * 20),
			txt = 'Very weak',
			color = 'red';

		switch(strength){
			case 1:
				color = 'red';
				txt = 'Very weak';
				break;
			case 2: 
				color = 'red';
				txt = 'Weak';
				break;
			case 3:
				color = 'pink';
				txt = 'Medium';
				break;
			case 4: 
				color = 'orange';
				txt = 'Strong';
				break;
			case 5: 
				color = 'green';
				txt = 'Very strong';
				break;
		}

		password_meter_text.text(txt);
		password_meter.removeAttr("class")
			.addClass('determinate')
			.addClass(color).css('width', lent+"%");

		window.passwordStrength = strength;

		if( $this.val() != "" ){
			password_meter_text.fadeIn();
			password_meter.parent('div').fadeIn();
		}else{
			password_meter_text.fadeOut();
			password_meter.parent('div').fadeOut();
			window.passwordStrength = 1;
		}

		if( window.passwordStrength < 3 ){
			// show checkbox to confirm password
			weak_password_confirmation.fadeIn();
			confirm_weak_password.attr("required", "required");
		}else{
			weak_password_confirmation.fadeOut();
			confirm_weak_password.removeAttr("required");
		}

		txt_confirmPass.val("");
	});

	txt_confirmPass.on("change", function (){
		if( txt_pass.val() != $(this).val() ){
			reBuy.showErrors(errors, form_register);
			btn_submit.addClass("disabled").attr("disabled", "disabled");
		}else{
			btn_submit.removeClass("disabled").removeAttr("disabled");
		}
	});

});