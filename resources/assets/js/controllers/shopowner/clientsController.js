function ClientCtrl ($scope, $http, $timeout, $rootScope, clientServices){
	
	var vm = this;

	vm.addNote = addNote;
	vm.newnote = null;

	$scope.clients = [];
	$scope.hasSelectedUser = false;
	$scope.selectedUser = null;


	


	$scope.init = function (){
		$scope.getClients();
	};

	$scope.getClients = function (){
		var url = '/api/shops/'+selectedShop.id+'/users/client?api_token='+window.user.api_token;
		$http.get(url).then(function (response){
			console.log(response);
			$scope.clients = response.data;

		}, function (response){
			console.warn(response);
		});
	};

	$scope.viewClient = function (index){
		$scope.hasSelectedUser = true;
		$scope.selectedUser = $scope.clients[index];
		$rootScope.selectedUser = $scope.selectedUser;
		$rootScope.hasSelectedUser = $scope.hasSelectedUser;
		$rootScope.selectedUser.pivot.newsletter_subscribed = $scope.selectedUser.pivot.newsletter_subscribed == 1 ? true : false;
		
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
					$rootScope.selectedUser = null;
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

	function addNote(){
		if(vm.newnote === null){
			return false;
		}
		var data = {
			note : vm.newnote,
			client_id : $rootScope.selectedUser.id
		}
		clientServices.addNote(data).then(function(response){
				vm.newnote = null;
				if(response.success === 1){
					window.reBuy.toast('Note has been added');
				}else{
					window.reBuy.toast('Problem occured while adding a notes');
				}
		});
		
	}

	// init
	$scope.init();
}

app.controller('ClientController', ClientCtrl);