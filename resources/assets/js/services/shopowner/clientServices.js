app.service('clientServices', function($http, $timeout) {
	this.customerList = function() {
   		var url = '/api/shops/'+window.selectedShop.id+'/clients?api_token='+window.user.api_token;
        return $http.get(url).then(function(data) {
            return data;
        });
    }

 });