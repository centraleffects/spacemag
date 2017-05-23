
rebuyApp.controller('UserController', function($scope, userService, $timeout, $templateCache, $http) {

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
                $scope.selectedUser.password = '';
                $scope.selectedUserKey = 0;
              });
        },1000);
	  }

    $scope.events = {
        viewUser : function(key,value){
           /* if(key==0){
                $scope.selectedUserKey = null;
                value.password = '';
                $scope.selectedUser = {};
                location.hash = '#!';
            }else{
                $scope.selectedUserKey = key;
                value.password = '';
                $scope.selectedUser = value;
                location.hash = '#!/'+value.id;
            }*/

            $scope.selectedUserKey = key;
            value.password = '';
            $scope.selectedUser = value;
            location.hash = '#!/'+value.id;
            
            materializeInit();
            $timeout(function () {
              materializeInit();
            },500);
        }
    }

    //watch our collection and sending changes to server
    //@TODO push back to server
    $scope.$watchCollection( $scope.selectedUser, function(newVal, oldVal) {
        $timeout(function () {
            materializeInit();
        },1500);
    }); 

    updateUserList = function(){
      $timeout(function () {
           userService.userList().then(function(response) {
                $scope.users = response.data;
                $scope.selectedUser = $scope.users.data[0];
                $scope.selectedUser.password = '';
                $scope.selectedUserKey = 0;
              });
        },1000);
    }

    displayError = function(response){
        angular.element('.input-field .error-field').each(function(i,e){
            angular.element(e).remove();
        });
        angular.forEach(response.data, function(v,k) {
            angular.element('#'+ k).closest('div').append('<small class="error-field red-text">' + v[0] + '</small>');
        });
        materializeInit();
    }
    materializeInit = function(){
        Materialize.updateTextFields();
        angular.element('select').material_select();
    } 
    newUser = function(form){
       angular.element('#clientDetails #resetdetails').trigger('click');
       angular.element('.input-field .error-field').each(function(i,e){
            angular.element(e).remove();
        });
       $scope.selectedUser = {};
       $scope.selectedUser.password = '';
       $scope.selectedUserKey = null;
    }

    hideError =  function(){
      angular.element('.input-field .error-field').each(function(i,e){
            angular.element(e).remove();
        });
    }

    updateInfo = function(){
        var url = '/api/users/update';
        $scope.selectedUser['_method'] = 'PATCH';
        if(!$scope.selectedUser.id){
            url = '/api/users/store';
            $scope.selectedUser['_method'] = 'POST';
        }
        hideError();
        $http({
              method: 'POST',
              url: url + '?api_token=' + window.adminJS.me.api_token,
              data: $.param($scope.selectedUser),
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              cache: $templateCache
        }).then(function(response) {
            console.log(response);
          if(!$scope.selectedUser.id){
             updateUserList();
             window.reBuy.toast('User details have been created! Thank you.');
          }else{
             window.reBuy.toast('User details have been updated! Thank you.');
          }
          
        }, function(response) {
            console.warn(response);
            displayError(response);
        });
    }

    deleteUser = function(){
        var url = '/api/users/delete/'+$scope.selectedUser.id;
        $http({
              method: 'POST',
              url: url + '?api_token=' + window.adminJS.me.api_token,
              data: $scope.selectedUser,
              headers: {'Content-Type': 'application/x-www-form-urlencoded'},
              cache: $templateCache
        }).then(function(response) {
            updateUserList();
            window.reBuy.toast('User details had been deleted! Thank you.');
        }, function(response) {
            window.reBuy.alert(response.data);
        });
        
    }

    $scope.init();
});
  