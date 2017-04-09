function CustomerCtrl ($scope, $http, $timeout, $rootScope){
	$scope.selectedShop = selectedShop;
	$scope.customers = [];
	$scope.hasSelectedCustomer = false;
	$scope.currentlySelectedCustomer = null;
	$scope.addNew = false;
	$scope.new_firstName = '';
	$scope.new_Email = '';
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
		$scope.hasSelectedCustomer = true;
		$scope.currentlySelectedCustomer = $scope.customers[index];
		Materialize.updateTextFields();
	};

	$scope.removeCustomer = function (index){
		var customer = $scope.customers[index];
		var url = '/api/shops/'+selectedShop.id+'/users/'+customer.id+'/remove?api_token='+window.user.api_token;
		window.$.reBuy.confirm("Are you sure to remove this customer?", function (){
			$http.delete(url).then(function (response){
				// $scope.customers = response.data;
				console.log(response);
				if( response.data.success == 1 ){
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

	$scope.generatePassword = function (){
		if( $scope.hasSelectedCustomer ){
			$http.post('/api/shops/'+selectedShop.id+'/users/sendpassword').then(function (response){
				console.warn(response);
			}, function (response){
				console.warn(response);
			});
		}
	};

	$scope.addNewCustomer = function (){
		$scope.addNew = true;
		$("html, body").animate({ scrollTop: $('#add_new').offset().top }, 1000);
	};

	$scope.invite = function (btn){
		var button = $(btn);
		var data = {
				name: $scope.new_firstName,
				email: $scope.new_Email
			},
			url = '/api/shops/'+selectedShop.id+'/invite?api_token='+window.user.api_token;
		$scope.isDisabled = true;

		$http.post(url, data).then(function (response){
			console.log(response);
			if( response.data.success == 1 ){
				Materialize.toast(data.email+" has been invited to subscribe to "+selectedShop.name, 8000);
			}else{
				if( response.data.msg ){
					Materialize.toast(response.data.msg, 8000);
				}else{
					Materialize.toast("Opps, something went wrong. Please try again later.", 8000);
				}
			}
			$scope.isDisabled = false;
		}, function (response){
			$scope.isDisabled = false;
			if( response.data ){
				window.$.reBuy.showErrors(response.data, $("#add_new"), 8000);
			}
		});
	} 


	// init
	$scope.init();
}

app.controller('CustomerController', CustomerCtrl);