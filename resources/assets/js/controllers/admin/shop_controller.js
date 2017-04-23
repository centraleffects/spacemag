
rebuyApp.controller('adminShopController', function($scope, shopService, $timeout, $templateCache, $http) {
	
	  $scope.shops = {};
    $scope.selectedShop = {};
    $scope.selectedShopKey = null;

    $scope.countryOptions = [{'value': 'swe','text' : 'Sweden'}];
    $scope.currencyOptions = [{'value': 'usd','text' : 'US Dollar'}];
    $scope.langOptions = [{'value': 'en','text' : 'English'},{'value': 'se','text' : 'Swedish'}];
    $scope.owners = [];
    var promise;
    var vm = this;
    $scope.init = function() {
        $timeout(function () {
           vm.updateList();
        },1000);
      }

    $scope.events = {
        viewShop : function($this){
            if(!$this){
                var key = Object.keys($scope.shops.data).length;
                    id = parseInt($scope.shops.data[key-1].id) + 1;
                $scope.shops.data[key] = { name : 'New Shop', id : id, 'x_coordinate' : x, 'y_coordinate' : y, isNew : true };
                angular.element('#dashleft-sidebar ul li:first-child').click();
              return false;
            }
            shop = $this.shop;
            angular.element('.list-shops').removeClass('active');
            angular.element('#sh'+shop.id).addClass('active');
            $scope.selectedShopKey = $this.key;
            $scope.selectedShop = shop;
            if(shop.id){
              location.hash = '#!/' + shop.id;
            }else{
              location.hash = '#!/';
            }
            
            vm.materializeInit();
            $timeout(function () {
              vm.materializeInit();
            },500);
        },
        addShopSpot : function(x,y){
              
                var key = Object.keys($scope.shops.data).length;
                    id = parseInt($scope.shops.data[key-1].id) + 1;
                $scope.shops.data[key] = { name : 'New Shop', id : id, 'x_coordinate' : x, 'y_coordinate' : y, isNew : true };
                angular.element('#dashleft-sidebar ul li:first-child').click();
                angular.element('.tooltipped').tooltip({delay: 50, html : true});
                $timeout(function () {
                  angular.element('#dashleft-sidebar ul li#sh' + id).click();
                },500);
        },
        cancelSelectedIfNew: function(){
          if($scope.selectedShop.isNew){
            var data = [];
             for (var k in $scope.shops.data){
                 if (typeof $scope.shops.data[k] !== 'function') {
                  if($scope.shops.data[k].id !== $scope.selectedShop.id){
                    data.push($scope.shops.data[k]);
                  }
                }
              }
              $scope.shops.data = data;
              $timeout(function () {
                  angular.element('#dashleft-sidebar ul li:first-child').click();
                  $scope.selectedShop = $scope.shops.data[0];
                  $scope.selectedShopKey = 0;
                },500);
              
          }
        },
        updateSelected : function(){

            var url = '/api/shops/update';
            $http({
              method: 'POST',
              url: url + '?api_token=' + window.adminJS.me.api_token,
              data: $.param($scope.selectedShop),
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              cache: $templateCache
            }).then(function(response) {
              if($scope.selectedShop.isNew){
                 window.reBuy.toast('Shop details have been created! Thank you.');
              }else{
                 window.reBuy.toast('Shop details have been updated! Thank you.');
              }
              vm.updateList();
            }, function(response) {
                window.reBuy.toast('ERROR: Please complete all required fields. Thank you.');
            });
        },
        deleteSelected : function(){

            window.reBuy.confirm('Are you sure to delete this shop?', function(){
                var url = '/api/shops/delete';
                $http({
                  method: 'POST',
                  url: url + '?api_token=' + window.adminJS.me.api_token,
                  data: $.param($scope.selectedShop),
                  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                  cache: $templateCache
                }).then(function(response) {
                  window.reBuy.toast('Shop details have been deleted! Thank you.');
                  vm.updateList();
                }, function(response) {
                    window.reBuy.toast('ERROR: Unable to delete the selected shop.');
                });
            });
        }
    }

    vm.updateList = function(){
 
          shopService.ownerList().then(function(ownerList){
             $scope.owners =  [];
              Object.keys(ownerList).forEach(function(k) {
                $scope.owners.push({ id : ownerList[k].id, name : ownerList[k].first_name + ' ' + ownerList[k].last_name });
              });
              vm.materializeInit();
            });

          shopService.shopList().then(function(shopList) {
              $scope.shops = shopList;
              $scope.selectedShop = $scope.shops.data[0];
              $scope.selectedShopKey = 0;
              vm.materializeInit();
          });
    }

    vm.materializeInit = function(){
        Materialize.updateTextFields();
        angular.element('select').material_select();
    }

    $scope.init();
});