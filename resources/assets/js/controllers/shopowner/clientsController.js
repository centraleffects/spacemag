function ClientCtrl ($scope, $http, $timeout, $rootScope){
	$scope.selectedShop = selectedShop;
	$scope.clients = [];
	$scope.hasSelectedClient = false;
	$scope.selectedClient = null;
	$scope.addNew = false;
	$scope.noClientAvailable = false;

	$scope.init = function (){
		$scope.getClients();
	};

	$scope.getClients = function (){
		var url = '/api/shops/'+selectedShop.id+'/users?api_token='+window.user.api_token;
		$http.get(url).then(function (response){
			console.log(response);
			$scope.clients = response.data;

			if( $scope.clients.length > 0 ){
				$rootScope.listIsEmpty = false;
			}else{
				$rootScope.listIsEmpty = true;
			}

		}, function (response){
			console.warn(response);
		});
	};

	$scope.viewClient = function (index){
		$scope.hasSelectedClient = true;
		$scope.selectedClient = $scope.clients[index];
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
					$scope.clients.splice(index);
					if( $scope.clients.length < 1 ){
						$rootScope.listIsEmpty = true;
					}
				}
			}, function (response){
				console.warn(response);
			});
		});
	};

	$scope.generatePassword = function (){
		if( $scope.hasSelectedClient ){
			$http.post('/api/shops/'+selectedShop.id+'/users/sendpassword').then(function (response){
				console.warn(response);
			}, function (response){
				console.warn(response);
			});
		}
	};

	$scope.addNew = function (){
		$scope.addNew = true;
		$("html, body").animate({ scrollTop: $('#new_customer').offset().top }, 1000);
	};


	// init
	$scope.init();
}

app.controller('ClientController', ClientCtrl);