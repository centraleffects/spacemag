function ClientCtrl ($scope, $http, $timeout, $rootScope){
	$scope.clients = [];
	$scope.hasselectedClient = false;
	$scope.selectedClient = null;

	$scope.init = function (){
		$scope.getClients();
	};

	$scope.getClients = function (){
		var url = '/api/shops/'+selectedShop.id+'/users?api_token='+window.user.api_token;
		$http.get(url).then(function (response){
			console.log(response);
			$scope.clients = response.data;

		}, function (response){
			console.warn(response);
		});
	};

	$scope.viewClient = function (index){
		$scope.hasselectedClient = true;
		$scope.selectedClient = $scope.clients[index];
		$rootScope.selectedClient = $scope.selectedClient;
		$rootScope.hasselectedClient = $scope.hasselectedClient;
		$rootScope.selectedClient.pivot.newsletter_subscribed = $scope.selectedClient.pivot.newsletter_subscribed == 1 ? true : false;
		
		Materialize.updateTextFields();
	};

	$scope.removeClient = function (index){
		var customer = $scope.clients[index];
		var url = '/api/shops/'+selectedShop.id+'/users/'+customer.id+'/remove?api_token='+window.user.api_token;
		window.$.reBuy.confirm("Are you sure to remove this customer?", function (){
			$http.delete(url).then(function (response){
				// $scope.clients = response.data;
				console.log(response);
				if( response.data.success == 1 ){
					$rootScope.selectedClient = null;
					$scope.clients.splice(index);
				}
			}, function (response){
				console.warn(response);
			});
		});
	};

	$scope.emptyList = function (){
		if( $scope.clients.length > 0 )
			return false;
		return true;
	}


	// init
	$scope.init();
}

app.controller('ClientController', ClientCtrl);