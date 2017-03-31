function WorkerCtrl ($scope, $http, $timeout, $rootScope){
	$scope.selectedShop = selectedShop;
	$scope.workers = [];
	$scope.hasSelectedWorker = false;
	$scope.selectedWorker = null;
	$scope.addNew = false;

	$scope.init = function (){
		$scope.getWorkers();
	};

	$scope.getWorkers = function (){
		var url = '/api/shops/'+selectedShop.id+'/users?api_token='+window.user.api_token;
		$http.get(url).then(function (response){
			console.log(response);
			$scope.workers = response.data;

			if( $scope.workers.length > 0 ){
				$rootScope.listIsEmpty = false;
			}else{
				$rootScope.listIsEmpty = true;
			}

		}, function (response){
			console.warn(response);
		});
	};

	$scope.viewWorker = function (index){
		$scope.hasSelectedWorker = true;
		$scope.selectedWorker = $scope.workers[index];
		Materialize.updateTextFields();
	};

	$scope.removeWorker = function (index){
		var customer = $scope.workers[index];
		var url = '/api/shops/'+selectedShop.id+'/users/'+customer.id+'/remove?api_token='+window.user.api_token;
		window.$.reBuy.confirm("Are you sure to remove this customer?", function (){
			$http.delete(url).then(function (response){
				// $scope.workers = response.data;
				console.log(response);
				if( response.data.success == 1 ){
					$scope.workers.splice(index);
				}

				if( $scope.workers.length < 1 ){
					$rootScope.listIsEmpty = true;
				}

			}, function (response){
				console.warn(response);
			});
		});
	};

	$scope.generatePassword = function (){
		if( $scope.hasSelectedWorker ){
			$http.post('/api/shops/'+selectedShop.id+'/users/sendpassword').then(function (response){
				console.warn(response);
			}, function (response){
				console.warn(response);
			});
		}
	};

	$scope.addNewWorker = function (){
		$scope.addNew = true;
		$("html, body").animate({ scrollTop: $('#add_new').offset().top }, 1000);
	};


	// init
	$scope.init();
}

app.controller('WorkerController', WorkerCtrl);