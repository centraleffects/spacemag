window.app = angular.module('rebuy', []);

(function (admin){
	admin(window.jQuery, window, document);
}(function admin($, window, document){
	$(function (){
		$.adminJS = {
			init : function(){
				//make the toolbar restful
			    $('.toolbar').on('click', 'li a', function(e){
			    	
			    	var page = $(this).attr('href').replace('#/','/admin/');
			    	$.adminJS.loadsubpage(page);
			    });

			    //redirect hash to proper location
			    var hash = window.location.hash;
			    if($('.page-admin').length > 0){
			    	if(hash.length < 3 ){ return false; }
			    	var page = hash.replace('#/','/admin/');
			    	if(window.loadsubpage !== page){
			    		$.adminJS.loadsubpage(page);
			    		window.loadsubpage = page;
			    	}
			    }
			},
			// The rest of the codes goes here
			loadsubpage : function(page){
				$.get(page, function( result ){
		    		if(page === "/admin/dashboard"){
		    			$('body').html(result);
		    		}else{
		    			$('.content-wrap').html(result);
		    		}
		    		reBuy.initMaterialize();
		    	}).fail(function(result){
		    		if(page === "/admin/dashboard"){
		    			$('body').html(result.responseText);
		    		}else{
		    			$('.content-wrap').html(result.responseText);
		    		}
		    	});
			}
		}

		$.adminJS.init();

	});

}));

require('./controllers/admin/user_controller');