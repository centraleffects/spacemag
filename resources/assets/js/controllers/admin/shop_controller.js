
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
            location.hash = '#!/'+value.id;
            
            $timeout(function () {
              //materializeInit();
            },500);
        },
        addShopSpot : function(x,y){
            var $section = angular.element('#mapsection');
                $section.append('<div class="shopspot" style="left:' + x + 'px;top:' + y + 'px"></div>');
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

              angular.element('img.panzoom').click(function(e) {

                var offset = angular.element(this).offset();
                $scope.events.addShopSpot(e.pageX,e.pageY);

              });

              $('.shopspot').draggable();

        })(jQuery);
    }
   $scope.init();
});