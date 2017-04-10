
rebuyApp.controller('adminSpotController', function($scope, shopService, $timeout, $templateCache, $http) {
	
	  $scope.shops = {};
    $scope.selectedShop = {};
    $scope.selectedShopKey = null;

    $scope.spots = {};
     $scope.spots.data = {};
    $scope.selectedSpot = {};
    $scope.selectedSpotKey = null;

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
        viewSpot : function(key,value){

            $scope.selectedSpotKey = key;
            $scope.selectedSpot = value;
            if(value.id){
              location.hash = '#!/' + value.id;
            }else{
              location.hash = '#!/';
            }
            
            materializeInit();
            $timeout(function () {
              materializeInit();
              angular.element('.shopspot').removeClass('green');
              angular.element('#spt'+value.id).addClass('green');
            },500);
        },
        addSaleSpot : function(x,y){
                console.log(x,y);
                if(Object.keys($scope.spots.data).length){
                    var key = Object.keys($scope.spots.data).length;
                        id = parseInt($scope.spots.data[key-1].id) + 1;
                  }else{
                     var key = 0, id = 1;
                  }
                
                $scope.spots.data[key] = { name : 'New Spot', id : id, 'x_coordinate' : x, 'y_coordinate' : y, isNew : true };
                if(key==0){
                  $scope.selectedSpot = $scope.spots.data[key];
                  $scope.selectedSpotKey = 0;
                }

                angular.element('#dashleft-sidebar #salespot ul li:first-child').click();
                angular.element('.tooltipped').tooltip({delay: 50, html : true});
               
                if(!angular.element('#salespot .collapsible-body').is(":visible")){
                  angular.element('#salespot .collapsible-header').trigger('click');
                }
                
                $timeout(function () {
                  angular.element('#dashleft-sidebar #salespot  ul li#sp' + id).click();
                },500);
        },
        cancelSelectedIfNew: function(){
          /*if($scope.selectedShop.isNew){
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
              
          }*/
        },
        updateSelected : function(){
           /* var url = '/api/shops/update';
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
            });*/
        },
        deleteSelected : function(){

           /* window.reBuy.confirm('Are you sure to delete this shop?', function(){
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
            });*/
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

              angular.element('#spot-panzoom').dblclick(function(e) {

                 var parentOffset = $(this).offset(); 
                 var relX = (e.pageX - parentOffset.left) - 12;
                 var relY = (e.pageY - parentOffset.top) - 12;

                 $scope.events.addSaleSpot(relX,relY);

              });

              //@TODO: should use $watch to handle model changes
              angular.element('input[name="name"]').keyup(function(){
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

                angular.element('#salespot .collapsible-header').trigger('click');

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