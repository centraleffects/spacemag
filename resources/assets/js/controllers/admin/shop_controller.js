
rebuyApp.controller('adminShopController', function($scope, shopService, $timeout, $templateCache, $http) {
	
	  $scope.shops = {};
    $scope.selectedShop = {};
    $scope.selectedShopKey = null;

    $scope.countryOptions = [{'value': 'swe','text' : 'Sweden'}];
    $scope.currencyOptions = [{'value': 'usd','text' : 'US Dollar'}];
    $scope.langOptions = [{'value': 'en','text' : 'English'},{'value': 'se','text' : 'Swedish'}];
    $scope.owners = [];

    var vm = this;

    $scope.init = function() {
        $timeout(function () {
           updateList();
        },1500);

        $scope.bindEvents();
      }

    $scope.events = {
        viewShop : function($this){
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
            
            materializeInit();
            $timeout(function () {
              materializeInit();
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
              updateList();
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
                  updateList();
                }, function(response) {
                    window.reBuy.toast('ERROR: Unable to delete the selected shop.');
                });
            });
        }
    }
    
    $scope.bindEvents = function(){
        (function($) {

              var $section = $('#mapsection').first();
                    $section.find('.panzoom').panzoom({
                    $zoomIn: $section.find(".zoom-in"),
                    $zoomOut: $section.find(".zoom-out"),
                    $zoomRange: $section.find(".zoom-range"),
                    $reset: $section.find(".reset")
                  });

              angular.element('.panzoom').dblclick(function(e) {

                 var parentOffset = $(this).offset(); 
                 var relX = (e.pageX - parentOffset.left) - 12;
                 var relY = (e.pageY - parentOffset.top) - 12;

                 $scope.events.addShopSpot(relX,relY);

              });

              //@TODO: should use $watch to handle model changes
              angular.element('input[name="shop_name"]').keyup(function(){
                angular.element('.tooltipped').tooltip({delay: 50, html : true});
              });

        })(jQuery);
    }

    updateList = function(){
 
            shopService.ownerList().then(function(response){
             $scope.owners =  [];
              for (var k in response.data){
                $scope.owners.push({ id : response.data[k].id, name : response.data[k].first_name + ' ' + response.data[k].last_name });
              }
            });

            $timeout(function () {
              shopService.shopList().then(function(response) {
                $scope.shops = response.data;
                $scope.selectedShop = $scope.shops.data[0];
                $scope.selectedShopKey = 0;
              });
            },500);
            $timeout(function () {
              materializeInit();
            },1000);
            
        }
    materializeInit = function(){
        Materialize.updateTextFields();
        angular.element('select').material_select();
    } 

   $scope.init();
});