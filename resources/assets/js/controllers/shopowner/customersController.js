function CustomerCtrl ($scope, customerServices, $http, $timeout, $rootScope){
	$scope.customers = [{}];
	$scope.addNew = false;
	$scope.newUser = {
		first_name: '',
		email: ''
	}

	$scope.selectedUser = null;
	$scope.hasSelectedUser = false;

	$scope.isDisabled = false;

	$scope.init = function (){
		$scope.customers = customerServices.customerList();
		$timeout(function () {
           $rootScope.updateList($scope, customerServices.customerList, "customers");
        },1500);
	}

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
		$rootScope.selectedUser.pivot.newsletter_subscribed = $scope.selectedUser.pivot.newsletter_subscribed == 1 ? true : false;
		materializeInit();
	}

	$scope.removeCustomer = function (index){
		var customer = $scope.customers[index];
		var url = '/api/shops/'+selectedShop.id+'/users/'+customer.id+'/remove?api_token='+window.user.api_token;
		window.reBuy.confirm("Are you sure to remove this customer?", function (){
			$http.delete(url).then(function (response){
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
	}

	// checks if the resource is empty
	$scope.emptyList = function (){
		if( $scope.customers.length > 0 )
			return false;
		return true;
	}

	$scope.addNewCustomer = function (){
		$scope.addNew = true;
		$scope.resetUser();
		$("html, body").animate({ scrollTop: $('#add_new').offset().top }, 1000);
	}

	$scope.resetUser = function (){
		$scope.newUser = {
			first_name: '',
			email: ''
		}
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
				window.reBuy.toast(response.data.msg, 8000);
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