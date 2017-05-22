rebuyApp.controller('adminShopController', function($scope, shopService, $timeout, $templateCache, $http, $location, $rootScope) {

    $scope.currentTab = 'shop';

    $scope.shops = {};
    $scope.selectedShop = {};
    $scope.selectedShopKey = null;

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

    $scope.spots = {};
    $scope.spots.data = {};
    $scope.selectedSpot = {};
    $scope.selectedSpotKey = null;

    var vm = this,
        EMAIL_FORMAT = /^[_a-z0-9]+(\+\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;

    $scope.init = function() {
        $timeout(function() {
            vm.updateList();
        }, 1000);
    }

    $scope.events = {
        viewShop: function($this) {
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
            if (EMAIL_FORMAT.test($scope.selectedShop.owner.email) === false && !$scope.selectedShop.owner.email) {
                window.reBuy.alert('Please correct the selected shop owner');
                return false;
            }

            var url = '/api/shops/update';
            $http({
                method: 'POST',
                url: url + '?api_token=' + window.adminJS.me.api_token,
                data: $.param($scope.selectedShop),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(function(response) {
                console.log(response.data.shops);
                $timeout(function() {
                    $scope.shops = response.data.shops;
                    $scope.selectedShop = response.data.shop;
                    ownerList = response.data.owners.data;
                    $scope.owners = [];
                    Object.keys(ownerList).forEach(function(k) {
                        $scope.owners.push({
                            id: ownerList[k].id,
                            name: ownerList[k].first_name + ' ' + ownerList[k].last_name + ' (' + ownerList[k].email + ')',
                            data: ownerList[k]
                        });
                    });
                    vm.materializeInit();
                }, 1000);
                if ($scope.selectedShop.isNew) {
                    window.reBuy.toast('Shop details have been created! Thank you.');
                } else {
                    window.reBuy.toast('Shop details have been updated! Thank you.');
                }
            }, function(response) {
                console.warn(response);
                window.reBuy.toast('ERROR: Please complete all required fields. Thank you.');
            });
            //$timeout(function () { $rootScope.vm.updateList(); }, 500);
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
                    window.reBuy.toast('Shop details have been deleted! Thank you.');
                    vm.updateList();
                }, function(response) {
                    window.reBuy.toast('ERROR: Unable to delete the selected shop.');
                });
            });
        },

        viewTab: function(tab) {
            if (!tab) {
                $scope.currentTab = 'shop';
            } else {
                $scope.currentTab = tab;
            }

        },

        addSaleSpot: function(x, y) {
            console.log(x, y);
            if (Object.keys($scope.spots.data).length) {
                var key = Object.keys($scope.spots.data).length;
                id = parseInt($scope.spots.data[key - 1].id) + 1;
            } else {
                var key = 0,
                    id = 1;
            }

            $scope.spots.data[key] = {
                name: 'New Spot',
                id: id,
                'x_coordinate': x,
                'y_coordinate': y,
                isNew: true
            };
            if (key == 0) {
                $scope.selectedSpot = $scope.spots.data[key];
                $scope.selectedSpotKey = 0;
            }

            angular.element('#dashleft-sidebar #salespot ul li:first-child').click();
            angular.element('.tooltipped').tooltip({
                delay: 50,
                html: true
            });


            $timeout(function() {
                angular.element('#dashleft-sidebar #salespot  ul li#sp' + id).click();
            }, 200);
        },

        viewSpot: function(key, value) {

            $scope.selectedSpotKey = key;
            $scope.selectedSpot = value;
            if (value.id) {
                location.hash = '#!/' + value.id;
            } else {
                location.hash = '#!/';
            }

            vm.materializeInit();
            $timeout(function() {
                vm.materializeInit();
                angular.element('.shopspot').removeClass('green');
                angular.element('#spt' + value.id).addClass('green');
            }, 500);
        },

        doDrag: function($this) {
            console.log($this);
            angular.element('.panzoom').panzoom({
                disableZoom: true
            });
        },
        changeOwner: function(owner) {
            console.log(owner);
            $scope.selectedShop.owner = owner;

        },
        loginAsOwner: function() {
            if ($scope.selectedShop.owner.id) {
                window.location = '/shop/login-as/' + $scope.selectedShop.owner.id + '/' + $scope.selectedShop.id;
            }
        }
    }

    $scope.bindEvents = function() {
        (function($) {

            var $section = $('#mapsection').first(),
                $panzoom = $section.find('.panzoom');
            $panzoom.panzoom();

            angular.element('#spot-panzoom').dblclick(function(e) {

                var parentOffset = $(this).offset();
                var relX = (e.pageX - parentOffset.left) - 12;
                var relY = (e.pageY - parentOffset.top) - 12;

                $scope.events.addSaleSpot(relX, relY);

            });

            angular.element('body')
                .on('mouseover click', '.shopspot', function(e) {
                    var $this = angular.element(this);
                    $panzoom.panzoom("disable");
                    $(this).css('cursor', 'pointer');
                    $(this).resizable();
                    $(this).draggable();
                })
                .on('mousedown', '.panzoom', function(e) {
                    $timeout(function() {
                        $panzoom.panzoom("enable");
                        $('.shopspot').draggable();
                    }, 500);
                })
                .on('mouseout', '.shopspot', function(e) {

                })
                .on('click', '.panzoom', function(e) {

                })
                .on('change', '#owner_email', function(e) {
                    angular.element('#listofowners-autocomplete').find('a').removeClass('active');
                })

            //@TODO: should use $watch to handle model changes
            angular.element('input[name="name"]').keyup(function() {
                angular.element('.tooltipped').tooltip({
                    delay: 50,
                    html: true
                });
            });

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
                    data: ownerList[k]
                });
            });
            vm.materializeInit();
        });

        shopService.shopList().then(function(shopList) {
            console.log('updating list...');
            $scope.shops = shopList;
            if ($scope.shops) {
                $scope.selectedShop = $scope.shops.data[0];
                $scope.selectedShopKey = 0;
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