app.service('workerTodoService', function($http, $timeout) {
	return {
		addNew: function (todo){
			return $http({
				url: '/api/tasks/store?api_token='+window.user.api_token,
				method: 'post',
				data: todo
			});
		},

		unAssign: function (taskId){
			return $http({
				url: '/api/tasks/'+taskId+'/unassign?api_token='+window.user.api_token,
				method: 'delete'
			});
		},

		assignTodo: function (userId, taskId){
			return $http({
				url: '/api/tasks/'+taskId+'/assign/'+userId+'?api_token='+window.user.api_token,
				method: 'post'
			});
		},

		markAsDone: function (taskId){
			return $http({
				url: '/api/tasks/'+taskId+'/finish?api_token='+window.user.api_token,
				method: 'post',
				data: {
					status: 'finished',
					done: 1
				}
			});
		},

		update: function (taskId){
			return $http({
				url: '/api/tasks/'+taskId+'/update?api_token='+window.user.api_token,
				method: 'post',
				data: {
					status: 'finished',
					done: 1
				}
			});
		},

		delete: function (taskId){
			return $http({
				url: '/api/tasks/'+taskId+'/delete?api_token='+window.user.api_token,
				method: 'delete',
				data: {
					status: 'finished'
				}
			});
		},
	};

});