function CustomerCtrl ($scope, $http, $timeout, $rootScope){
	$scope.customers = [];
	$scope.addNew = false;
	$scope.newUser = {
		first_name: '',
		email: ''
	};

	$scope.selectedUser = null;
	$scope.hasSelectedUser = false;

	$scope.isDisabled = false;

	$scope.init = function (){
		$scope.getCustomers();
	};

	$scope.getCustomers = function (){
		var url = '/api/shops/'+selectedShop.id+'/users?api_token='+window.user.api_token;
		$http.get(url).then(function (response){
			console.log(response);
			$scope.customers = response.data;

		}, function (response){
			console.warn(response);
		});
	};

	$scope.$watch('customers', function() {	    
        if( $scope.customers.length > 0 ){
			$scope.listIsEmpty = false;
		}else{
			$scope.listIsEmpty = true;
		}
        console.log('hey, myVar has changed!');
    });

	$scope.viewCustomer = function (index){
		$scope.hasSelectedUser = true;
		$scope.selectedUser = $scope.customers[index];
		$rootScope.selectedUser = $scope.selectedUser;
		$rootScope.hasSelectedUser = $scope.hasSelectedUser;
		Materialize.updateTextFields();
	};

	$scope.removeCustomer = function (index){
		var customer = $scope.customers[index];
		var url = '/api/shops/'+selectedShop.id+'/users/'+customer.id+'/remove?api_token='+window.user.api_token;
		window.reBuy.confirm("Are you sure to remove this customer?", function (){
			$http.delete(url).then(function (response){
				// $scope.customers = response.data;
				console.log(response);
				if( response.data.success == 1 ){
					$scope.selectedUser = null;
					$scope.customers.splice(index);
				}

				if( $scope.customers.length < 1 ){
					$rootScope.listIsEmpty = true;
				}

			}, function (response){
				console.warn(response);
			});
		});
	};

	$scope.emptyList = function (){
		if( $scope.customers.length > 0 )
			return false;
		return true;
	}

	$scope.addNewCustomer = function (){
		$scope.addNew = true;
		$scope.resetUser();
		$("html, body").animate({ scrollTop: $('#add_new').offset().top }, 1000);
	};

	$scope.resetUser = function (){
		$scope.newUser = {
			first_name: '',
			email: ''
		};
	}

	$scope.invite = function (btn){
		var button = $(btn);
		var data = {
				name: $scope.newUser.first_name,
				email: $scope.newUser.email
			},
			url = '/api/shops/'+selectedShop.id+'/invite?api_token='+window.user.api_token;
		$scope.isDisabled = true;

		$http.post(url, data).then(function (response){
			console.log(response);
			if( response.data.success == 1 ){
				$scope.resetUser();
				window.reBuy.toast(data.email+" has been invited to subscribe to "+selectedShop.name, 8000);
			}else{
				if( response.data.msg ){
					window.reBuy.alert(response.data.msg);
				}else{
					window.reBuy.alert("Opps, something went wrong. Please try again later.");
				}
			}
		}, function (response){
			if( response.data ){
				window.reBuy.showErrors(response.data, $("#add_new"), 8000);
			}
		}).then(function (){
			$scope.isDisabled = false;
		});
	} 


	// init
	$scope.init();
}

app.controller('CustomerController', CustomerCtrl);