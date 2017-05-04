app.factory('shopService', function($http, $timeout){
    var promiseShopList, promiseOwnerList, promiseCategoryList;
    var shopService = {

        shopList: function() {
            if ( !promiseShopList ) {
              // $http returns a promise, which has a then function, which also returns a promise
              promiseShopList = $http.get('/api/shops/list/'+window.adminJS.me.id +'?api_token='+window.adminJS.me.api_token).then(function (response) {
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
                promiseCategoryList = $http.get('/api/shops/categories?api_token='+window.adminJS.me.api_token)
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

    return shopService;
});