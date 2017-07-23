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

		markAsDone: function (task){
			return $http({
				url: '/api/tasks/'+task.id+'/finish?api_token='+window.user.api_token,
				method: 'post',
				data: {
					status: 'finished',
					done: !task.done
				}
			});
		},

		// update: function (taskId){
		// 	return $http({
		// 		url: '/api/tasks/'+taskId+'/update?api_token='+window.user.api_token,
		// 		method: 'post',
		// 		data: {
		// 			status: 'finished',
		// 			done: 1
		// 		}
		// 	});
		// },

		updateTodo: function (todo){
	    	var url = '/api/tasks/'+todo.id+'/update?api_token='+window.user.api_token;

	        return $http({
	        	url: url,
	        	method: 'post',
	        	data: {
	        		description: todo.description
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

		clear: function (shopId){
			return $http({
				url: '/api/tasks/clear?api_token='+window.user.api_token,
				method: 'post',
				data: {
					shop_id: shopId
				}
			});
		}
	};

});