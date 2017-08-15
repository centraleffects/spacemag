app.factory('couponService', function($http, $timeout){
    var promiseAddUpdate, promiseupdateSelectedShop;
    var couponService = {

        addUpdate: function(url, data) {
            if ( !promiseAddUpdate ) {
              // $http returns a promise, which has a then function, which also returns a promise
              promiseAddUpdate = $http.post(url + '?user_id='+window.user.id +'&api_token='+window.user.api_token, { data : data } ).then(function (response) {
                // The then function here is an opportunity to modify the response
                // The return value gets picked up by the then in the controller.
                return response.data;
            });
          }
            // Return the promise to the controller
            return promiseAddUpdate;
        },

        updateSelectedShop : function(url){
            if ( !promiseupdateSelectedShop ) {
                  // $http returns a promise, which has a then function, which also returns a promise
                  promiseupdateSelectedShop = $http.get(url + '&user_id='+window.user.id +'&api_token='+window.user.api_token).then(function (response) {
                    // The then function here is an opportunity to modify the response
                    // The return value gets picked up by the then in the controller.
                    return response.data;
                });
              }
                // Return the promise to the controller
                return promiseupdateSelectedShop;
        }

    };

    return couponService;
});