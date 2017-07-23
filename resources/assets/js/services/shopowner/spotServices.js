app.factory('spotService', function($http, $timeout){
    var promiseSpotList, promiseCategoryList;
    var spotService = {

        spotList: function() {
            if ( !promiseSpotList ) {
              // $http returns a promise, which has a then function, which also returns a promise
              promiseSpotList = $http.get('/api/salespot/list/'+window.selectedShop.id+'?id='+window.user.id +'&api_token='+window.user.api_token).then(function (response) {
                // The then function here is an opportunity to modify the response
                // The return value gets picked up by the then in the controller.
                return response.data;
            });
          }
            // Return the promise to the controller
            return promiseSpotList;
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
            return $http.get('/api/users/'+userId+'/spots?api_token='+token);

        }

    };

    return spotService;
});