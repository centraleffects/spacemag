
app.factory('articleServices', function($http, $timeout){
    var promiseaddOrUpdate;
    var articleService = {

        addOrUpdate: function(url, data) {
            if ( !promiseaddOrUpdate ) {
              // $http returns a promise, which has a then function, which also returns a promise
              promiseaddOrUpdate = $http.post(url + '&user_id='+window.user.id +'&api_token='+window.user.api_token, { data : data }).then(function (response) {
                // The then function here is an opportunity to modify the response
                // The return value gets picked up by the then in the controller.
                return response.data;
            });
          }
            // Return the promise to the controller
            return promiseaddOrUpdate;
        }

    };

    return articleService;
});