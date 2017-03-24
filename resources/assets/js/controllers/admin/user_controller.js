
rebuyApp.controller('UserController', function($scope, $http) {

    $scope.users = [];

    $scope.init = function() {

		$scope.users = reBuy.angularGet($http,'/api/users/list');


	}

    $scope.init();
});