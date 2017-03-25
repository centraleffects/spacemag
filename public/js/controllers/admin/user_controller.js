/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "./";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 20);
/******/ })
/************************************************************************/
/******/ ({

/***/ 1:
/***/ (function(module, exports) {


rebuyApp.service('userService', function ($http, $timeout) {
    this.userList = function () {
        return $http.get('/api/users/list?api_token=' + window.adminJS.me.api_token).then(function (data) {
            return data;
        });
    };
});

rebuyApp.controller('UserController', function ($scope, userService, $timeout) {

    $scope.users = {};
    $scope.selectedUser = {};
    $scope.selectedUserKey = null;
    $scope.genderOptions = [{ 'value': 'm', 'text': 'Male' }, { 'value': 'f', 'text': 'Female' }];
    $scope.roleOptions = [{ 'value': 'admin', 'text': 'Administrator' }, { 'value': 'owner', 'text': 'Shop Owner' }, { 'value': 'worker', 'text': 'Shop Worker' }, { 'value': 'cliet', 'text': 'Client' }, { 'value': 'customer', 'text': 'Customer' }];
    $scope.countryOptions = [{ 'value': 'swe', 'text': 'Sweden' }];
    $scope.langOptions = [{ 'value': 'en', 'text': 'English' }, { 'value': 'se', 'text': 'Swedish' }];

    $scope.init = function () {

        $timeout(function () {
            userService.userList().then(function (response) {
                $scope.users = response.data;
                $scope.selectedUser = $scope.users.data[0];
            });
        }, 1000);
    };
    $scope.events = {
        viewUser: function viewUser(key, value) {
            $scope.selectedUserKey = key;
            $scope.selectedUser = value;
            materializeInit();
        }
    };

    //watch our collection and sending changes to server
    //@TODO push back to server
    $scope.$watchCollection($scope.selectedUser, function () {
        $timeout(function () {
            materializeInit();
        }, 1500);
    });

    materializeInit = function materializeInit() {
        Materialize.updateTextFields();
        angular.element('select').material_select();
    };
    newUser = function newUser(form) {
        angular.element('#clientDetails #resetdetails').trigger('click');
    };
    updateInfo = function updateInfo() {
        window.reBuy.alert('User details have been updated! Thank you.');
    };
    deleteUser = function deleteUser() {
        window.reBuy.alert('User details had been deleted! Thank you.');
    };
    $scope.init();
});

/***/ }),

/***/ 20:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(1);


/***/ })

/******/ });