function WorkerCtrl ($scope, workerServices, $http, $timeout, $rootScope){
	$scope.selectedShop = selectedShop;
	$scope.workers = [];
	$scope.hasSelectedUser = false;
	$scope.selectedUser = null;
	$scope.addNew = false;
	$scope.newUser = {
		first_name: '',
		email: ''
	};

	$scope.shops = [];

	$scope.isDisabled = false;

	$scope.init = function (){
		// $scope.workers = workerServices.workerList();
		$rootScope.updateList($scope, workerServices.workerList, "workers");
		/*$timeout(function () {
           $rootScope.updateList($scope, workerServices.workerList, "workers");
        },1500);*/

        $(function (){
        	$scope.shops = window.shops;
        });
	};

	$scope.viewWorker = function (index){
		$scope.hasSelectedUser = true;
		$scope.selectedUser = $scope.workers[index];
		$rootScope.selectedUser = $scope.selectedUser;
		$rootScope.hasSelectedUser = $scope.hasSelectedUser;
		$rootScope.selectedUser.pivot.newsletter_subscribed = $scope.selectedUser.pivot.newsletter_subscribed == 1 ? true : false;
		Materialize.updateTextFields();
	};

	$scope.removeWorker = function (index){
		var worker = $scope.workers[index];
		var url = '/api/shops/'+selectedShop.id+'/users/'+worker.id+'/remove?api_token='+window.user.api_token;
		window.$.reBuy.confirm("Are you sure to remove this worker?", function (){
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

	$scope.addNewWorker = function (){
		$scope.addNew = true;
		$scope.resetUser();
		setTimeout(function() {
			$("html, body").animate({ scrollTop: $('#add_new').offset().top }, 1000);
		}, 500);
	};

	$scope.resetUser = function (){
		$scope.newUser = {
			first_name: '',
			email: ''
		}
	};

	$scope.invite = function (btn){
		var button = $(btn);
		var data = {
				name: $scope.newUser.first_name,
				email: $scope.newUser.email
			},
			url = '/api/shops/'+selectedShop.id+'/workers/invite?api_token='+window.user.api_token;
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
			$scope.isDisabled = false;
		}).then(function (){
			$scope.isDisabled = false;
		});
	};


	// init
	$scope.init();
}

app.controller('WorkerController', WorkerCtrl);