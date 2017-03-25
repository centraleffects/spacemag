
rebuyApp.service('userService', function($http, $timeout) {
   this.userList = function() {
        return $http.get('/api/users/list?api_token='+window.adminJS.me.api_token)
             .then(function(data) {
               return data;
              });
   }
 });

rebuyApp.controller('UserController', function($scope, userService, $timeout) {

    $scope.users = {};
    $scope.selectedUser = {};
    $scope.selectedUserKey = null;
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
           userService.userList().then(function(response) {
                $scope.users = response.data;
                $scope.selectedUser = $scope.users.data[0];
              });
        },1000);
        
	}
    $scope.events = {
        viewUser : function(key,value){
            $scope.selectedUserKey = key;
            $scope.selectedUser = value;
            materializeInit();
        }
    }

    //watch our collection and sending changes to server
    //@TODO push back to server
    $scope.$watchCollection( $scope.selectedUser, function() {
        $timeout(function () {
            materializeInit();
        },1500);
    }); 


    materializeInit = function(){
        Materialize.updateTextFields();
        angular.element('select').material_select();
    } 
    newUser = function(form){
       angular.element('#clientDetails #resetdetails').trigger('click');
    }
    updateInfo = function(){
        window.reBuy.alert('User details have been updated! Thank you.');
    }
    deleteUser = function(){
        window.reBuy.alert('User details had been deleted! Thank you.');
    }
    $scope.init();
});
  