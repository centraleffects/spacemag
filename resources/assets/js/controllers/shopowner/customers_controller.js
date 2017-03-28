console.log(selectedShop);
app.controller('CustomerController', function ($scope, $http){
	$scope.customers = function (){

		$http({
			method: 'GET',
			url: '/api/shops/'+selectedShop.id+'/users?api_token='+window.user.api_token
		}).then(function successCallback(response) {
		    // this callback will be called asynchronously
		    // when the response is available
		    console.log(response);
		   return response; 
		}, function errorCallback(response) {
		    // called asynchronously if an error occurs
		    // or server returns response with an error status.
		    console.warn(response);
		    return [];
		});
	}
});