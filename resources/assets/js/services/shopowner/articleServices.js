app.service('articleServices', function($http, $timeout) {
	this.articleList = function() {
   		var url = '/api/articles?api_token='+window.user.api_token;
        return $http.get(url).then(function(response) {
            return response.data;
        });
    }

    this.categoryList = function (){
    	var url = '/api/categories?api_token='+window.user.api_token;
        return $http.get(url).then(function(response) {
            return response;
        });
    }

    this.tagsList = function (){
    	var url = '/api/tags/api_token='+window.user.api_token;
    	return $http.get(url).then(function (response){
    		return response;
    	});
    }
});