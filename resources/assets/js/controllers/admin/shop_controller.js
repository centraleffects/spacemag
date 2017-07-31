rebuyApp.controller('adminShopController', function($scope, shopService, $timeout, $templateCache, $http, $location, $rootScope) {

    $scope.currentTab = 'shop';

    $scope.shops = {};
    $scope.selectedShop = {};
    $scope.selectedShopKey = null;
    $scope.isUpdatingOwner = false;
    $scope.isUpdatingShop = false;

    $scope.countryOptions = [{
        'value': 'swe',
        'text': 'Sweden'
    }];
    $scope.currencyOptions = [{
        'value': 'usd',
        'text': 'US Dollar'
    }];
    $scope.langOptions = [{
        'value': 'en',
        'text': 'English'
    }, {
        'value': 'se',
        'text': 'Swedish'
    }];
    $scope.owners = [];
    $scope.categories = [];
    
    var vm = this,
        EMAIL_FORMAT = /^([\w-\.\+]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  
    vm.removeOwner =  function(email, $this){
        if($scope.selectedShop.removeOwner){
            $scope.selectedShop.removeOwner.push(email);
        }else{
            $scope.selectedShop.removeOwner = [];
            $scope.selectedShop.removeOwner.push(email);
        }
        var index = $scope.selectedShop.owner.indexOf($this);
        $scope.selectedShop.owner.splice(index,1);
        console.log($scope.selectedShop.owner);
    };
    $scope.init = function() {
        $timeout(function() {
            vm.updateList();
        }, 1000);
    }

    $scope.events = {
        viewShop: function($this) {
            console.log('test');
            if (!$this) {
                var key = Object.keys($scope.shops.data).length;
                id = parseInt($scope.shops.data[key - 1].id) + 1;
                $scope.shops.data[key] = {
                    name: 'New Shop',
                    id: id,
                    'x_coordinate': x,
                    'y_coordinate': y,
                    isNew: true
                };
                angular.element('#dashleft-sidebar ul li:first-child').click();
                return false;
            }
            shop = $this.shop;
            angular.element('.list-shops').removeClass('active');
            angular.element('#sh' + shop.id).addClass('active');
            $scope.selectedShopKey = $this.key;
            $scope.selectedShop = shop;
            $scope.selectedShop.newOwner = '';
            if (shop.id) {
                location.hash = '#!/' + shop.id;
            } else {
                location.hash = '#!/';
            }

            vm.materializeInit();
            $timeout(function() {
                vm.materializeInit();
            }, 500);
        },
        addShop: function() {

            var key = Object.keys($scope.shops.data).length;
            id = parseInt($scope.shops.data[key - 1].id) + 1;
            $scope.shops.data[key] = {
                name: 'New Shop',
                id: id,
                isNew: true
            };
            $timeout(function() {
                angular.element('#sh' + id).click();
            }, 500);
        },
        cancelSelectedIfNew: function() {
            if ($scope.selectedShop.isNew) {
                var data = [];
                for (var k in $scope.shops.data) {
                    if (typeof $scope.shops.data[k] !== 'function') {
                        if ($scope.shops.data[k].id !== $scope.selectedShop.id) {
                            data.push($scope.shops.data[k]);
                        }
                    }
                }
                $scope.shops.data = data;
                $timeout(function() {
                    angular.element('#dashleft-sidebar ul li:first-child').click();
                    $scope.selectedShop = $scope.shops.data[0];
                    $scope.selectedShopKey = 0;
                }, 500);

            }
        },
        updateSelected: function() {

            if (EMAIL_FORMAT.test($scope.selectedShop.newOwner) == false && $scope.selectedShop.newOwner) {
                window.reBuy.alert('Please correct the selected shop owner');
                return false;
            }
            
            $scope.isUpdatingOwner = true;

            var url = '/api/shops/update',
                data = $scope.selectedShop;
            $http({
                method: 'POST',
                url: url + '?api_token=' + window.adminJS.me.api_token,
                data: $.param(data),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function(response) {
               $scope.shops = response.data.shops;
                
                $timeout(function() {
                     var current = window.location.hash.split('/')[1];
                       if(current){
                           angular.element('#sh' + current).trigger('click');
                       }
                }, 500);

                window.reBuy.toast(response.data.msg);

            }, function(response) {
                if( response.data ){
                    window.reBuy.showErrors(response.data, $("#shop-tab"), 8000);
                }
            }).then(function (){
                $scope.isUpdatingOwner = false;
            });
        },
        deleteSelected: function() {

            window.reBuy.confirm('Are you sure to delete this shop?', function() {
                var url = '/api/shops/delete';
                $http({
                    method: 'POST',
                    url: url + '?api_token=' + window.adminJS.me.api_token,
                    data: $.param($scope.selectedShop),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    cache: $templateCache
                }).then(function(response) {
                    window.reBuy.toast(response.data.msg);
                    $scope.shops = response.data.shops;
                }, function(response) {
                    window.reBuy.toast('ERROR: Unable to delete the selected shop.');
                });
            });
        },
    
        changeOwner: function(email) {

            $scope.selectedShop.newOwner = email;

        },
        loginAsOwner: function(owner_id) {

            if (owner_id) {
                window.location = '/shop/login-as/' + owner_id + '/' + $scope.selectedShop.id;
            }
        }
    }

    $scope.bindEvents = function() {
        (function($) {

           var current = window.location.hash.split('/')[1];
           if(current){
                $timeout(function() {
                    angular.element('#sh' + current).trigger('click');
                }, 1400);
           }

        })(jQuery);
    }

    vm.updateList = function() {

        $scope.owners = [];
        shopService.ownerList().then(function(ownerList) {
            ownerList = ownerList.data;
            Object.keys(ownerList).forEach(function(k) {
                $scope.owners.push({
                    id: ownerList[k].id,
                    name: ownerList[k].first_name + ' ' + ownerList[k].last_name + ' (' + ownerList[k].email + ')',
                    email: ownerList[k].email
                });
            });
            vm.materializeInit();
        });

        shopService.shopList().then(function(shopList) {
            $scope.shops = shopList;
            if ($scope.shops) {
                $scope.selectedShop = $scope.shops.data[0];
                $scope.selectedShop.newOwner = '';
            } else {
                $scope.events.addShop();
            }
            $timeout(function() {
                vm.materializeInit();
            }, 1000);
        });
    }

    vm.materializeInit = function() {
        Materialize.updateTextFields();
        angular.element('select').material_select();
    }


    $scope.init();
    $scope.bindEvents();
});