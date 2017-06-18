$(function (){

	function init(){
		if( $(".select-shop").length > 0 ){
			var shopId = $(".select-shop.active").attr("data-id");

			// let's get the active bookings for this shop
			$.ajax({
				url: 'api/users/bookings/active?api_token='+window.user.api_token,
				type: 'post',
				dataType: 'json',
				success: function (data){
					// console.log(data);
					// if(  )
				},
				error: function (data){
					console.warn(data);
				}
			});

			// let's get salespots for this shop
			$.ajax({
				url: 'api/shops/'+shopId+'/salespots/available?api_token='+window.user.api_token,
				type: 'post',
				dataType: 'json',
				success: function (data){
					console.log(data);
				},
				error: function (data){
					console.warn(data);
				}
			});
		}
	};

	init();

	$(document).on("click", ".select-shop", function (){
		init();
	});
});