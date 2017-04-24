app.service('workerServices', function($http, $timeout) {
	this.workerList = function() {
   		var url = '/api/shops/'+selectedShop.id+'/workers?api_token='+window.user.api_token;
        return $http.get(url).then(function(data) {
            return data.data;
        });
    }

 });