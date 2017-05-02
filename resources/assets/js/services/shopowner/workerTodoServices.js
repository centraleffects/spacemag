app.service('workerTodoService', function($http, $timeout) {
	return {
		addNew: function (todo){
			return $http({
				url: '/api/tasks/store?api_token='+window.user.api_token,
				method: 'post',
				data: todo,
				// headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			});
		}
	};

});