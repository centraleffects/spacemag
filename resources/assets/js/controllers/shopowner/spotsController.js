app.controller('spotsController', function($scope, spotService, $timeout, $templateCache, $http, $location) {

    $scope.selectedShop = window.selectedShop;

    $scope.countryOptions = [{'value': 'swe','text' : 'Sweden'}];
    $scope.currencyOptions = [{'value': 'usd','text' : 'US Dollar'}];
    $scope.langOptions = [{'value': 'en','text' : 'English'},{'value': 'sv','text' : 'Swedish'}];
    $scope.owners = [];
    $scope.categories = [];
    $scope.spotStatusOptions = [{'value': 'active','text' : 'Active'},{'value': 'blocked','text' : 'Blocked'},{'value': 'deleted','text' : 'Deleted'}];
    $scope.spotTypeOptions = [{'value': 'hanger','text' : 'Hanger'},{'value': 'shelves','text' : 'Shelves'},{'value': 'standard','text' : 'Standard'}, {'value': 'wall section','text' : 'Wall Section'}];
    $scope.spots = {};
    $scope.spots.data = null;
    $scope.selectedSpot = null;
    $scope.selectedSpotKey = null;
    $scope.changeSpotLocation = false;
    $scope.selectedSpotCategories = [];

    var vm = this;

    vm.spotquery = null;
    vm.FilterSpotDisplay = null;
    vm.spotTypeColors = {
        'hanger' : 'pink',
        'shelves' : 'orange',
        'standard' : 'yellow',
        'wall section' : 'blue'
    };
    vm.addNew = false;

    vm.updateList = function(){

        spotService.categoryList().then(function(categoryList){
             $scope.categories = categoryList;
        });

        spotService.spotList().then(function(spotList) {
            $scope.spots.data = [];
            $scope.spots.data = spotList;
            $timeout(function () {
                vm.materializeInit();
                console.log('updateList',$scope.spots.data);
            },1000);
        });
    }

    vm.materializeInit = function(){
        Materialize.updateTextFields();
        angular.element('select').material_select();
        angular.element('.tooltipped').tooltip({delay: 50, html : true});
    }

    $scope.init = function() {
        $timeout(function () {
            vm.updateList();
        },1000);
    }

    $scope.events = {

        updateSelected : function(){

            var url = '/api/salespot/update';
            if( vm.addNew ){
                url = '/api/salespot/create';
            }
            $scope.selectedSpot.shop = $scope.selectedShop;

            $http({
                method: 'POST',
                url: url + '?api_token=' + window.adminJS.me.api_token,
                data: $.param($scope.selectedSpot),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                cache: $templateCache
            }).then(function(response) {
                if( vm.addNew ){
                    window.reBuy.toast('Spot details have been created! Thank you.');
                }else{
                    window.reBuy.toast('Spot details have been updated! Thank you.');
                }
                vm.updateList();
                vm.addNew = false;
                $scope.selectedShop.isNew = null;
            }, function(response) {
                window.reBuy.toast('ERROR: Please complete all required fields. Thank you.');
            });
        },

        deleteSelectedSpot : function(){

            window.reBuy.confirm('Are you sure to delete this spot?', function(){
                var url = '/api/salespot/delete';
                $http({
                    method: 'POST',
                    url: url + '?api_token=' + window.adminJS.me.api_token,
                    data: $.param($scope.selectedSpot),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function(response) {
                    window.reBuy.toast('Spot details have been deleted! Thank you.');
                    $timeout(function () {
                        window.location.reload();
                    },500);
                }, function(response) {
                    window.reBuy.toast('ERROR: Unable to delete the selected spot.');
                });
            });
            
        },

        addSaleSpot : function(x,y){

            if( vm.addNew)
            {
                window.reBuy.toast('Please complete the information for the selected salespot before adding a new one');
                vm.materializeInit();
                return false;
            }

            

            if(Object.keys($scope.spots.data).length){
                var key = Object.keys($scope.spots.data).length;
                id = parseInt($scope.spots.data[key-1].id) + 1;
            }else{
                var key = 0, id = 1;
            }

            vm.addNew = id;

            $scope.spots.data[key] = { name : 'New Spot', id : id, 'spot_x' : x, 'spot_y' : y, isNew : true };
            if(x && y){
                $scope.spots.data[key].spot_location =  x + ',' + y;
                $scope.spots.data[key].spot_x = x;
                $scope.spots.data[key].spot_y = y;
            }
            console.log($scope.spots.data);
            $scope.selectedSpot = $scope.spots.data[key];
            $scope.selectedSpotKey = key;

            angular.element('.tooltipped').tooltip({delay: 50, html : true});
            $timeout(function () {
                angular.element('.list-spots a#sh' + $scope.selectedSpot.id).click();
                vm.materializeInit();
            },200);
        },

        updateSelectedSpotLocation : function(x,y){
            console.log('updateSelectedSpotLocation');
            console.log(x,y);
            if($scope.selectedSpot){
                 $scope.selectedSpot.spot_location = x + ',' + y;
                 $scope.selectedSpot.spot_x = x;
                 $scope.selectedSpot.spot_y = y;
                 $scope.spots.data[$scope.selectedSpotKey].spot_x = x;
                 $scope.spots.data[$scope.selectedSpotKey].spot_y = y;
                 $scope.changeSpotLocation = false;
                 vm.materializeInit();
                 $timeout(function () {
                    vm.materializeInit();
                 },300);
                 
            }
            return false;
        },

        viewSpot : function(spot){

            $scope.selectedSpotKey = spot.key;
            $scope.selectedSpot = spot.spot;
            
            if($scope.selectedSpot.id){
                location.hash = '#!/' + $scope.selectedSpot.id;
            }else{
                location.hash = '#!/';
            }
            
            $timeout(function () {
                vm.materializeInit();
            });

        },

        cancelSelectedSpotIfNew : function(){

            if( vm.addNew = true ){
                var data = [];
                 for (var k in $scope.spots.data){
                     if (typeof $scope.spots.data[k] !== 'function') {
                      if($scope.spots.data[k].id !== $scope.selectedSpot.id){
                        data.push($scope.spots.data[k]);
                      }
                    }
                  }
                  $scope.spots.data = data;
               $scope.selectedSpot = null; 
                vm.addNew = false;  
               vm.materializeInit();
            }
        },

        changeSpotLocation : function(){
            $scope.changeSpotLocation = true;
            window.reBuy.alert('Double click on the map to select new location.');
        },

        locationUpdated : function(){
            vm.materializeInit();
        }
    }

    $scope.bindEvents = function(){
        (function($) {
            angular.element('body')
            .on('mouseover', '.shopspot', function(e){
                var $this = angular.element(this);
                $(this).css('cursor','pointer');
                $(this).resizable();
                $(this).draggable();
            })
            .on('mouseout', '.shopspot', function(e){

            })
            .on('dblclick', '#spot-panzoom', function(e){
                var parentOffset = $(this).offset(); 
                var relX = (e.pageX - parentOffset.left) - 12;
                var relY = (e.pageY - parentOffset.top) - 12;

                console.log('dblclick');
                console.log(relX,relY);
                if(!$scope.selectedSpot){
                    $scope.events.addSaleSpot(relX,relY);
                }else{
                    $scope.events.updateSelectedSpotLocation(relX,relY);
                }

                
            })

            //@TODO: should use $watch to handle model changes
            angular.element('input[name="name"]').keyup(function(){
                angular.element('.tooltipped').tooltip({delay: 50, html : true});
            });

        })(jQuery);
    }

    $scope.init();
    $scope.bindEvents();
});