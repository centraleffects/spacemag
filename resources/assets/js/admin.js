/*
  JS 
*/

window.rebuyApp = angular.module('rebuy', []);

window.rebuyApp.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.useXDomain = true;
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    }
]);

(function($){
	$.adminJS = {
		init : function(){
				if($.adminJS.me.id){
	        		return false;
	        	}
	           $.get('/me', function(response){
	           		$.adminJS.me = response;
	           });
		},
        me : []
	}
	 $.adminJS.init();
	 window.adminJS = $.adminJS;
})(jQuery);

require('./lib/jquery.panzoom');
require('./lib/jquery.mousewheel');
require('./lib/jquery-ui');

require('./services/admin/userServices');
require('./services/admin/shopServices');

require('./controllers/admin/user_controller');
require('./controllers/admin/shop_controller');
require('./controllers/admin/spots_controller');
