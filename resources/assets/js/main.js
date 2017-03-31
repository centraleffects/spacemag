window.app = angular.module('rebuy', []);

require('./controllers/shopowner/dashboardController');
require('./controllers/shopowner/customers_controller');
require('./controllers/shopowner/clients_controller');
require('./controllers/shopowner/workers_controller');


app.run(function($rootScope) {
    $rootScope.currentUser =  window.user;
    $rootScope.currentlySelectedShop = window.shop;
	$rootScope.listIsEmpty = false;
});