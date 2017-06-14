window.app = angular.module('rebuy', ["angucomplete-alt"], function ($httpProvider){
	// Use x-www-form-urlencoded Content-Type
	$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

	/**
	* The workhorse; converts an object to x-www-form-urlencoded serialization.
	* @param {Object} obj
	* @return {String}
	*/ 
	var param = function(obj) {
		var query = '', name, value, fullSubName, subName, subValue, innerObj, i;

		for(name in obj) {
		  value = obj[name];

		  if(value instanceof Array) {
		    for(i=0; i<value.length; ++i) {
		      subValue = value[i];
		      fullSubName = name + '[' + i + ']';
		      innerObj = {};
		      innerObj[fullSubName] = subValue;
		      query += param(innerObj) + '&';
		    }
		  }
		  else if(value instanceof Object) {
		    for(subName in value) {
		      subValue = value[subName];
		      fullSubName = name + '[' + subName + ']';
		      innerObj = {};
		      innerObj[fullSubName] = subValue;
		      query += param(innerObj) + '&';
		    }
		  }
		  else if(value !== undefined && value !== null)
		    query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
		}

		return query.length ? query.substr(0, query.length - 1) : query;
	};

	// Override $http service's default transformRequest
	$httpProvider.defaults.transformRequest = [function(data) {
		return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
	}];
});

require('./lib/jquery.panzoom');
require('./lib/jquery.mousewheel');
require('./lib/jquery-ui');
require('./lib/select2.min');

require('./directives/all')

require('./services/shopowner/customerServices');
require('./services/shopowner/articleServices');
require('./services/shopowner/workerServices');
require('./services/shopowner/shopServices');
require('./services/shopowner/workerTodoServices');
require('./services/shopowner/couponServices');
require('./services/shopowner/clientServices');

require('./controllers/shopowner/dashboardController');
require('./controllers/shopowner/customersController');
require('./controllers/shopowner/clientsController');
require('./controllers/shopowner/workersController');
require('./controllers/shopowner/articlesController');
require('./controllers/shopowner/spotsController');
require('./controllers/shopowner/couponsController');

require('./controllers/shared/workersTodoController');

(function($){
	$.adminJS = {
		init : function(){
				if($.adminJS.me.id){
	        		return false;
	        	}
	        	
	           	$.adminJS.me = window.user;
		},
        me : []
	}
	 $.adminJS.init();
	 window.adminJS = $.adminJS;
})(jQuery);

/* below is shared between all controllers*/

app.run(function($rootScope, $http, $timeout) {
	$rootScope.selectedUser = null;
	$rootScope.hasSelectedUser = false;
	$rootScope.isGeneratingPassword = false;
	$rootScope.selectedShop = window.selectedShop;
	$rootScope.newsletter_subscription = false;
	$rootScope.focusTodo = null;

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

	$rootScope.setFocusTodo = function (todo){
        $rootScope.focusTodo = todo;
    };

	$rootScope.loginAs = function (){
		console.log($rootScope.selectedUser);
		if( $rootScope.selectedUser != null ){
			window.location = '/shop/login-as/'+$rootScope.selectedUser.id;
		}
	};

	$rootScope.newsletterSubscription = function ($event){
		var checkbox = $event.target,
			value = checkbox.checked,
			url = '/api/shops/'+selectedShop.id+'/newsletter-subscription/'+$rootScope.selectedUser.id+
					'?api_token='+window.user.api_token,
			data = { newsletter_subscription: value },
			action = checkbox.checked ? "subscribed" : "unsubscribed";

		// trigger checkbox
		

		$http.post(url, data).then(function (response){
			if( response.data.success == 1 ){
				// $rootScope.selectedUser.pivot.newsletter_subscribed = checkbox.checked;
				$rootScope.selectedUser.pivot.newsletter_subscribed = value;
				window.reBuy.toast(response.data.msg);
			}else{
				// reset checkbox toggle
				$rootScope.newsletter_subscribed = checkbox.checked ? false : true;
				window.reBuy.alert(response.data.msg);
			}
		}, function (response){
			console.warn(response);
			$rootScope.newsletter_subscribed = checkbox.checked ? false : true;
			window.reBuy.alert("Something went wrong. Please try again later. If problem continue to exist, contact admin suppport.");
		});
	};

	/** @usage: the customService is actually customService.customList() function **/
	$rootScope.updateList = function ($scope, customService, resourceList){
 
		customService().then(function(response){
			$scope[resourceList] = response.data;
		});

		$timeout(function () {
			Materialize.updateTextFields();
		},1000);
	}
});

bindEvents = function($){
	$('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrainWidth: true, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: false, // Displays dropdown below the button
      alignment: 'left', // Displays dropdown with edge aligned to the left of button
      stopPropagation: false // Stops event propagation
    });

    $('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
	});
};
