window.app = angular.module('rebuy', []);


require('./services/shopowner/customerServices');

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
	$rootScope.newsletter_subscription = false;

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

	$rootScope.loginAs = function (){
		console.log($rootScope.selectedUser);
		if( $rootScope.selectedUser != null ){
			window.location = '/shop/login-as/'+$rootScope.selectedUser.id;
		}
	};

	$rootScope.newsletterSubscription = function ($event){
		var checkbox = $event.target;
		var url = '/api/shops/'+selectedShop.id+'/newsletter-subscription/'+$rootScope.selectedUser.id+
					'?api_token='+window.user.api_token,
			data = { newsletter_subscription: checkbox.checked ? true : false },
			action = checkbox.checked ? "subscribed" : "unsubscribed";

		$http.post(url, data).then(function (response){
			if( response.data.success == 1 ){
				$rootScope.selectedUser.pivot.newsletter_subscribed = checkbox.checked ? 1 : 0;
				window.reBuy.toast("User successfully "+action+" to "+selectedShop.name+" newsletter.");
			}else{
				window.reBuy.alert("Unable to process your request right now.");
			}
		}, function (response){
			console.warn(response);
			window.reBuy.alert("Something went wrong. Please try again later. If problem continue to exist, contact admin suppport.");
		});
	};

});