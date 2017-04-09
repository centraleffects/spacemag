window.app = angular.module('rebuy', []);

require('./controllers/shopowner/dashboardController');
require('./controllers/shopowner/customersController');
require('./controllers/shopowner/clientsController');
require('./controllers/shopowner/workersController');
require('./controllers/shopowner/articlesController');


app.run(function($rootScope) {
    $rootScope.currentUser =  window.user;
    $rootScope.currentlySelectedShop = window.shop;
	$rootScope.listIsEmpty = false;
});