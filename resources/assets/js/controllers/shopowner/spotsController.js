app.controller('spotsController', function($scope, shopService, $timeout, $templateCache, $http, $location) {

    $scope.selectedShop = window.selectedShop;

    $scope.countryOptions = [{'value': 'swe','text' : 'Sweden'}];
    $scope.currencyOptions = [{'value': 'usd','text' : 'US Dollar'}];
    $scope.langOptions = [{'value': 'en','text' : 'English'},{'value': 'se','text' : 'Swedish'}];
    $scope.owners = [];
    $scope.categories = [];
    $scope.spotStatusOptions = [{'value': 'rebuilding','text' : 'Rebuilding'},{'value': 'painting','text' : 'Painting'},{'value': 'on repair','text' : 'On Repair'}];;

    $scope.spots = {};
    $scope.spots.data = {};
    $scope.selectedSpot = {};
    $scope.selectedSpotKey = null;
    $scope.changeSpotLocation = false;

    var vm = this;

    $scope.init = function() {
        $timeout(function () {
            vm.updateList();
        },1000);
    }

    $scope.events = {
        viewShop : function($this){
            if(!$this){
                var key = Object.keys($scope.spots.data).length;
                id = parseInt($scope.spots.data[key-1].id) + 1;
                $scope.spots.data[key] = { name : 'New Spot', id : id, 'x_coordinate' : x, 'y_coordinate' : y, isNew : true };
                angular.element('#dashleft-sidebar ul li:first-child').click();
                return false;
            }
            spots = $this.spots;
            angular.element('.list-spots').removeClass('active');
            angular.element('#sp'+spot.id).addClass('active');
            $scope.selectedSpotKey = $this.key;
            $scope.selectedSpot = spot;
            if(spot.id){
                location.hash = '#!/' + spot.id;
            }else{
                location.hash = '#!/';
            }

            vm.materializeInit();
            $timeout(function () {
                vm.materializeInit();
            },500);
        },
        updateSelected : function(){

            var url = '/api/salespot/update';
            if($scope.selectedSpot.isNew){
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
                if($scope.selectedShop.isNew){
                    window.reBuy.toast('Spot details have been created! Thank you.');
                }else{
                    window.reBuy.toast('Spot details have been updated! Thank you.');
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
                    data: $.param($scope.selectedSpot),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    cache: $templateCache
                }).then(function(response) {
                    window.reBuy.toast('Shop details have been deleted! Thank you.');
                    vm.updateList();
                }, function(response) {
                    window.reBuy.toast('ERROR: Unable to delete the selected shop.');
                });
            });
        },

        viewTab: function(tab){
            if(!tab){
                $scope.currentTab = 'shop';
            }else{
                $scope.currentTab = tab;
            }

        },

        addSaleSpot : function(x,y){
            
            if($scope.selectedSpot.isNew)
            {
                window.reBuy.toast('Please complete the information for the selected salespot before adding a new one');
                vm.materializeInit();
                return false;
            }

            if(Object.keys($scope.spots.data).length && !$scope.changeSpotLocation){
                var key = Object.keys($scope.spots.data).length;
                id = parseInt($scope.spots.data[key-1].id) + 1;
            }else{
                var key = 0, id = 1;
            }

            if($scope.changeSpotLocation){
                 $scope.selectedSpot.spot_location = x + ',' + y;
                 $scope.selectedSpot.x_coordinate = x;
                 $scope.selectedSpot.y_coordinate = y;
                 $scope.spots.data[$scope.selectedSpotKey].x_coordinate = x;
                 $scope.spots.data[$scope.selectedSpotKey].y_coordinate = y;
                 $scope.changeSpotLocation = false;
                 $scope.events.locationUpdated();
                 vm.materializeInit();
                 $timeout(function () {
                    vm.materializeInit();
                 },300);
                 return false;
            }

            $scope.spots.data[key] = { name : 'New Spot', id : id, 'x_coordinate' : x, 'y_coordinate' : y, isNew : true, };
            if(x && y){
                $scope.spots.data[key].spot_location =  x + ',' + y;
            }
            $scope.selectedSpot = $scope.spots.data[key];
            $scope.selectedSpotKey = key;

            angular.element('.tooltipped').tooltip({delay: 50, html : true});
            $timeout(function () {
                angular.element('.list-spots a#sh' + $scope.selectedSpot.id).click();
                vm.materializeInit();
            },200);
        },

        viewSpot : function(key,value){

            $scope.selectedSpotKey = key;
            if($scope.selectedSpot.id){
                location.hash = '#!/' + $scope.selectedSpot.id;
            }else{
                location.hash = '#!/';
            }

            vm.materializeInit();
            $timeout(function () {
                vm.materializeInit();
                angular.element('.shopspot').removeClass('green');
                angular.element('#spt'+$scope.selectedSpot.id).addClass('green');
            },500);
        },

        doDrag : function($this){
            console.log($this);
            angular.element('.panzoom').panzoom({ disableZoom : true });
        },

        cancelSelectedSpotIfNew : function(){

            if($scope.selectedSpot.isNew){
                var data = [];
                 for (var k in $scope.spots.data){
                     if (typeof $scope.spots.data[k] !== 'function') {
                      if($scope.spots.data[k].id !== $scope.selectedSpot.id){
                        data.push($scope.spots.data[k]);
                      }
                    }
                  }
                  $scope.spots.data = data;
               $scope.selectedSpot = [];   
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

            var $section = $('#mapsection').first(),
            $panzoom = $section.find('.panzoom');
            $panzoom.panzoom();

            angular.element('#spot-panzoom').dblclick(function(e) {

                var parentOffset = $(this).offset(); 
                var relX = (e.pageX - parentOffset.left) - 12;
                var relY = (e.pageY - parentOffset.top) - 12;
                
                $scope.events.addSaleSpot(relX,relY);

            });

            angular.element('body')
            .on('mouseover click', '.shopspot', function(e){
                var $this = angular.element(this);
                $panzoom.panzoom("disable");
                $(this).css('cursor','pointer');
                $(this).resizable();
                $(this).draggable();
            })
            .on('mousedown', '.panzoom', function(e){
                $timeout(function () {
                    $panzoom.panzoom("enable");
                    $('.shopspot').draggable();
                },500);
            })
            .on('mouseout', '.shopspot', function(e){

            })
            .on('click', '.panzoom', function(e){

            })

            //@TODO: should use $watch to handle model changes
            angular.element('input[name="name"]').keyup(function(){
                angular.element('.tooltipped').tooltip({delay: 50, html : true});
            });


        })(jQuery);
    }

    vm.updateList = function(){

        shopService.categoryList().then(function(categoryList){
             $scope.categories = categoryList;
        });

        shopService.shopList().then(function(shopList) {
            $scope.shops = shopList;
            if($scope.shops){
                $scope.selectedShop = $scope.shops.data[0];
                $scope.selectedShopKey = 0;
            }else{
                $scope.events.addShop();
            }
            $timeout(function () {
                vm.materializeInit();
            },1000);
        });
    }

    vm.materializeInit = function(){
        Materialize.updateTextFields();
        angular.element('select').material_select();
    }


    $scope.init();
    $scope.bindEvents();
});