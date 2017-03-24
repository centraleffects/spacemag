

window.rebuyApp = angular.module('rebuy',[]);

// set constants
rebuyApp.run(['$rootScope', 'APP', function ($rootScope, APP) {
  $rootScope.APP = APP;
}]);

require('./controllers/admin/user_controller');
