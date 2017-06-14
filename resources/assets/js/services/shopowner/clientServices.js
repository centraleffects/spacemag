app.service('clientServices', function($http, $timeout) {

    var promiseclientList, promiseaddNote;

    var clientServices = {

    	clientList : function(){
    		 if ( !promiseclientList ) {
	              // $http returns a promise, which has a then function, which also returns a promise
	              promiseclientList = $http.get('/api/shops/'+window.selectedShop.id+'/clients?api_token='+window.user.api_token).then(function (response) {
	                // The then function here is an opportunity to modify the response
	                // The return value gets picked up by the then in the controller.
	                return response.data;
	            });
	          }
	            // Return the promise to the controller
	            return promiseclientList;
    	},

        addNote: function(data) {
            if ( !promiseaddNote ) {
              // $http returns a promise, which has a then function, which also returns a promise
              promiseaddNote = $http.post('/api/note/create?user_id='+window.user.id +'&api_token='+window.user.api_token, { data : data }).then(function (response) {
                // The then function here is an opportunity to modify the response
                // The return value gets picked up by the then in the controller.
                return response.data;
            });
          }
            // Return the promise to the controller
            return promiseaddNote;
        }

    };

    return clientServices;

 });