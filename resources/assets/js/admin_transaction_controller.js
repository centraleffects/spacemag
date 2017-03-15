
var app = angular.module('rebuy', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

app.controller('adminTransactionController', function($scope, $http) {
	
	
	$scope.shops = [
        {name:'Jani',country:'Norway'},
        {name:'Hege',country:'Sweden'},
        {name:'Kai',country:'Denmark'}
    ];

    $scope.init = function() {
/*
		$http.get('/api/shops/list')
    	 .then( function(response){
    	 	$scope.shops.list = response;
    	 });*/
    	 console.log('init started');

	}
   /* 
    	console.log($scope.shops);*/
   $scope.init();
});