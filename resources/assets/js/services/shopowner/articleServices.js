app.service('articleServices', function($http, $timeout) {
	this.articleList = function() {
   		var url = '/api/articles?api_token='+window.user.api_token;
        return $http.get(url).then(function(data) {
            return data;
        });
    }

    this.categoryList = function (){
    	var url = '/api/categories?api_token='+window.user.api_token;
        return $http.get(url).then(function(data) {
            return data;
        });
    }
});