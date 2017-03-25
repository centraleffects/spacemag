/*
  JS 
*/

window.rebuyApp = angular.module('rebuy',[]);

window.rebuyApp.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.useXDomain = true;
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
    }
]);

(function($){
	$.adminJS = {
		init : function(){
				if($.adminJS.me.id){
	        		return false;
	        	}
	           $.get('/admin/me', function(response){
	           		$.adminJS.me = response;
	           });
		},
        me : []
	}
	 $.adminJS.init();
	 window.adminJS = $.adminJS;
})(jQuery);

require('./controllers/admin/user_controller');
