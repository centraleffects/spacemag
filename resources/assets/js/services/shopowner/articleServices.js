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
app.factory('articleServices', function($http, $timeout){
    var promiseaddOrUpdate;
    var articleService = {

        shopList: function() {
            if ( !promiseShopList ) {
              // $http returns a promise, which has a then function, which also returns a promise
              promiseShopList = $http.get('/api/shops/list/?id='+window.user.id +'&api_token='+window.user.api_token).then(function (response) {
                // The then function here is an opportunity to modify the response
                // The return value gets picked up by the then in the controller.
                return response.data;
            });
          }
            // Return the promise to the controller
            return promiseShopList;
        },
        
        categoryList : function(){
            if ( !promiseCategoryList ) {
                promiseCategoryList = $http.get('/api/categories/list?id='+window.user.id +'&api_token='+window.user.api_token)
                .then(function(response) {
                 return response.data;
             });
            }
            return promiseCategoryList;
        },
        
        userShopList: function (userId, token){
            return $http.get('/api/users/'+userId+'/shops?api_token='+token);

        }

    };

    return articleService;
});