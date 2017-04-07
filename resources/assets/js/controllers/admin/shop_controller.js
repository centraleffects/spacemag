
rebuyApp.service('shopService', function($http, $timeout) {
   this.shopList = function() {
        return $http.get('/api/shops/list?api_token='+window.adminJS.me.api_token)
             .then(function(data) {
               return data;
              });
   }
 });

rebuyApp.controller('adminShopController', function($scope, shopService, $timeout, $templateCache, $http) {
	
	  $scope.shops = {};
    $scope.selectedShop = {};
    $scope.selectedShopKey = null;

    $scope.countryOptions = [{'value': 'swe','text' : 'Sweden'}];
    $scope.langOptions = [{'value': 'en','text' : 'English'},{'value': 'se','text' : 'Swedish'}];

    $scope.init = function() {
        $timeout(function () {
           shopService.shopList().then(function(response) {
                $scope.shops = response.data;
                $scope.selectedShop = $scope.shops.data[0];
                $scope.selectedShopKey = 0;
              });
        },1500);

        $scope.bindEvents();
      }

    $scope.events = {
        viewShop : function(key,value){

            $scope.selectedShopKey = key;
            value.password = '';
            $scope.selectedShop = value;
            if(value.id){
              location.hash = '#!/' + value.id;
            }else{
              location.hash = '#!/';
            }
            
            
            $timeout(function () {
              //materializeInit();
              angular.element('.shopspot').removeClass('green');
              angular.element('#sp'+value.id).addClass('green');
            },500);
        },
        addShopSpot : function(x,y){
              
                var key = Object.keys($scope.shops.data).length;
                    id = parseInt($scope.shops.data[key-1].id) + 1;
                $scope.shops.data[key] = { name : 'New Shop', id : id, 'x_coordinate' : x, 'y_coordinate' : y };
                angular.element('#dashleft-sidebar ul li:first-child').click();
                angular.element('.tooltipped').tooltip({delay: 50, html : true});
                $timeout(function () {
                  angular.element('#dashleft-sidebar ul li#sh' + id).click();
                },500);
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

              $('.shopspot').draggable();

        })(jQuery);
    }

    //watch our collection and sending changes to server
    //@TODO push back to server
    $scope.$watchCollection( $scope.selectedShop, function(newVal, oldVal) {
        $timeout(function () {
           // / materializeInit();
            angular.element('.tooltipped').tooltip({delay: 50, html : true});
        },1500);
    }); 


   $scope.init();
});