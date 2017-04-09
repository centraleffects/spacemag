rebuyApp.service('userService', function($http, $timeout) {
   this.userList = function() {
        return $http.get('/api/users/list?api_token='+window.adminJS.me.api_token)
             .then(function(data) {
               return data;
              });
   }
 });
