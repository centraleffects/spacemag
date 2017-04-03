
rebuyApp.controller('adminShopController', function($scope, $http) {
	
	
	$scope.shops = [
        {name:'Jani',country:'Norway'},
        {name:'Hege',country:'Sweden'},
        {name:'Kai',country:'Denmark'}
    ];

    $scope.events = {
        addShopSpot : function(x,y){

                var $floorplan = angular.element('#floorplan-container'),
                    $shopspot = angular.element('<div class="shopspot"></div>'),
                    $map = angular.element('#floorplan-container img');

                $floorplan.append($shopspot.css({ left : x+'px', top : y+'px' }));
         }
    }

    $scope.init = function() {
        
        $scope.bindEvents();

        /*
		$http.get('/api/shops/list')
    	 .then( function(response){
    	 	$scope.shops.list = response;
    	 });*/
	}
    
    $scope.bindEvents = function(){
        (function($) {

               /* var $section = $('#mapsection').first();
                $section.find('.panzoom').panzoom({
                $zoomIn: $section.find(".zoom-in"),
                $zoomOut: $section.find(".zoom-out"),
                $zoomRange: $section.find(".zoom-range"),
                $reset: $section.find(".reset")
              });
*/
              angular.element('img.panzoom').click(function(e) {

                var offset = angular.element(this).offset();
                $scope.events.addShopSpot(e.pageX,e.pageY);

              });

              $('.shopspot').draggable();

        })(jQuery);
    }


   $scope.init();
});