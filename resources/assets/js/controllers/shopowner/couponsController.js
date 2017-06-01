
function couponsController ($scope, couponService, $http, $timeout, $rootScope){


	$scope.init = function (){
		
		bindEvents();
	};

    
    function bindEvents(){

    	angular.element('#couponform').submit(function(e){
    		e.preventDefault();
    		var form = angular.element('#couponform');
    		data = form.serializeArray();
            couponService.addUpdate(form.attr('action') + '?&ajax=true', data).then(function(addUpdate){
	              if(addUpdate.success){
	              	window.reBuy.toast('Coupon Information has been updated!');
	              	$timeout(function(){
	              		window.location.href= '/shop/coupons/' + addUpdate.coupon_id;
	              	},1000);
	              }else{
	              	window.reBuy.toast('Error: Please complete the required information and try again.');
	              }
	        });


    	});
    }

	// init
	$scope.init();
}

app.controller('couponsController', couponsController);