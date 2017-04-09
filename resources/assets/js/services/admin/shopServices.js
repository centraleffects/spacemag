rebuyApp.service('shopService', function($http, $timeout) {
   this.shopList = function() {
        return $http.get('/api/shops/list?api_token='+window.adminJS.me.api_token)
             .then(function(data) {
               return data;
              });
   }

   this.ownerList = function() {
        return $http.get('/api/shops/owners?api_token='+window.adminJS.me.api_token)
             .then(function(data) {
               return data;
              });
   }

 });