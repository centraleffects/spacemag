window.app = angular.module('rebuy', []);

require('./lib/jquery.panzoom');
require('./lib/jquery.mousewheel');
require('./lib/jquery-ui');

require('./services/shopowner/customerServices');
require('./services/shopowner/articleServices');
require('./services/shopowner/workerServices');
require('./services/shopowner/shopServices.js');

require('./controllers/shopowner/dashboardController');
require('./controllers/shopowner/customersController');
require('./controllers/shopowner/clientsController');
require('./controllers/shopowner/workersController');
require('./controllers/shopowner/articlesController');

require('./controllers/shared/todoController');


/* below is shared between all controllers*/
app.run(function($rootScope, $http, $timeout) {
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
		var checkbox = $event.target,
			value = checkbox.checked, // let's do the reverse (if checkbox is checked, that means the user wants to uncheck it)
			url = '/api/shops/'+selectedShop.id+'/newsletter-subscription/'+$rootScope.selectedUser.id+
					'?api_token='+window.user.api_token,
			data = { newsletter_subscription: value },
			action = checkbox.checked ? "subscribed" : "unsubscribed";

		// trigger checkbox
		

		$http.post(url, data).then(function (response){
			if( response.data.success == 1 ){
				$rootScope.selectedUser.pivot.newsletter_subscribed = checkbox.checked;
				window.reBuy.toast(response.data.msg);
			}else{
				// reset checkbox toggle
				$rootScope.newsletter_subscribed = checkbox.checked ? false : true;
				window.reBuy.alert(response.data.msg);
			}
		}, function (response){
			console.warn(response);
			window.reBuy.alert("Something went wrong. Please try again later. If problem continue to exist, contact admin suppport.");
		});
	};

	/** @usage: the customService is actually customService.customList() function **/
	$rootScope.updateList = function ($scope, customService, resourceList){
 
		customService().then(function(response){
			$scope[resourceList] = response.data;
		});

		$timeout(function () {
			materializeInit();
		},1000);
	}
});


materializeInit = function (){
	Materialize.updateTextFields();
}
