/*
  JS 
*/

window.rebuyApp = angular.module('rebuy', [], function ($httpProvider){
	$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
});

window.rebuyApp.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.useXDomain = true;
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
    }
]);

(function($){
	$.adminJS = {
		init : function(){
	   		$.adminJS.me = window.user;
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

