
function couponsController ($scope, couponService, $http, $timeout, $rootScope){

	var vm =  this;
	vm.updateSelectedShop = updateSelectedShop;

	$scope.init = function (){
		
		bindEvents();
	};

    function updateSelectedShop(){
		/*couponService.updateSelectedShop('/shop/updateSelectedShop/'+vm.selectedShop).then(function(data){
			window.location.reload();
		});*/
	}

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
	              	window.reBuy.alert('Error: Please complete the required information and try again.');
	              }
	        });


    	});
    }

	// init
	$scope.init();
}

app.controller('couponsController', couponsController);