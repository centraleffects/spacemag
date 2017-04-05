
rebuyApp.service('shopService', function($http, $timeout) {
   this.shopList = function() {
        return $http.get('/api/shops/?api_token='+window.adminJS.me.api_token)
             .then(function(data) {
               return data;
              });
   }
 });

rebuyApp.controller('adminShopController', function($scope, shopService, $timeout, $templateCache, $http) {
	
	$scope.shops = {};
    $scope.selectedShop = {};
    $scope.selectedShopKey = null;
    $scope.genderOptions = [{'value': 'm','text' : 'Male'},{'value':'f','text':'Female'}];
    $scope.roleOptions = [
                {'value': 'admin','text' : 'Administrator'},{'value':'owner','text':'Shop Owner'},
                {'value': 'worker','text' : 'Shop Worker'},{'value':'cliet','text':'Client'},
                {'value':'customer','text':'Customer'}
           ];
    $scope.countryOptions = [{'value': 'swe','text' : 'Sweden'}];
    $scope.langOptions = [{'value': 'en','text' : 'English'},{'value': 'se','text' : 'Swedish'}];

    $scope.init = function() {
        $timeout(function () {
           shopService.shopList().then(function(response) {
                $scope.shops = response.data;
                console.log(response);
              });
        },1000);
      }

    $scope.events = {
        viewShop : function(key,value){
            if(key==0){
                $scope.selectedShopKey = null;
                $scope.selectedShop = {};
                location.hash = '#!';
            }else{
                $scope.selectedShopKey = key;
                value.password = '';
                $scope.selectedShop = value;
                location.hash = '#!/'+value.id;
            }
            
            materializeInit();
            $timeout(function () {
              materializeInit();
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

              angular.element('img.panzoom').click(function(e) {

                var offset = angular.element(this).offset();
                $scope.events.addShopSpot(e.pageX,e.pageY);

              });

              $('.shopspot').draggable();

        })(jQuery);
    }


   $scope.init();
});