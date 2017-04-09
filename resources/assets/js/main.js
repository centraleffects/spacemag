window.app = angular.module('rebuy', []);

require('./controllers/shopowner/dashboardController');
require('./controllers/shopowner/customersController');
require('./controllers/shopowner/clientsController');
require('./controllers/shopowner/workersController');
require('./controllers/shopowner/articlesController');

/* below is shared between all controllers*/
app.run(function($rootScope, $http) {
	$rootScope.selectedUser = null;
	$rootScope.hasSelectedUser = false;
	$rootScope.isGeneratingPassword = false;
	$rootScope.selectedShop = window.selectedShop;

	// @HeadsUp! selectedShop variable was declared in the ShopOwnerController using JavaScript Facade
	$rootScope.generatePassword = function (){
		if( $rootScope.selectedUser != null ){
			$rootScope.isGeneratingPassword = true;
			var url = '/api/shops/'+selectedShop.id+'/users/'+$rootScope.selectedUser.id+
						'/passwordreset?api_token='+user.api_token;
			$http.post(url).then(function (response){
				if( response.data.success == 1 ){
					window.reBuy.toast('A password for user with email '+$rootScope.selectedUser.email+" has been re-generated.", 8000);
				}else{
					if( response.data.msg ){
						window.reBuy.alert(response.data.msg, 8000);
					}else{
						window.reBuy.alert("Opps, something went wrong. Please try again later.");
					}
				}
			}, function (response){
				console.warn(response);
			}).then(function (){
				$rootScope.isGeneratingPassword = false;
			});
		}else{
			return false;
		}
	};

	$rootScope.newletterSubscription = function (){
		alert("hello fox");
		var url = '/api/shops/newsletter-subscription/'+$rootScope.selectedUser.id+
					'?api_token='+window.user.api_token;
		$http.post(url).then(function (response){
			if( response.data.success == 1 ){
				window.reBuy.toast(response.data.msg)
			}else{
				window.reBuy.alert(response.data.msg);
			}
		}, function (response){
			console.warn(response);
		});
	}

});