
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


// require('angular');


// window.app = angular.module('rebuy', []);	



// init
(function (rebuy){
	rebuy(window.jQuery, window, document);
}(function rebuy($, window, document){
	$(function (){
		// dom is now ready!
		
		// variable declaration goes here
		

		// initialization goes here
		initMaterialize();
		

	    // instantiation goes here
	    $('.chips-salesspots').material_chip({
			data: [{
				tag: 'A1',
			}, 
			{
				tag: 'C4',
			}],
			autocompleteData: {
				'A1': null,
				'A2': null,
				'A3': null,
				'A4': null,
				'B1': null,
				'B2': null,
				'B3': null,
				'B4': null,
				'C1': null,
				'C2': null,
				'C3': null,
				'C4': null 
		    }
		});

	    //make the toolbar restful
	    $('.toolbar').on('click', 'li a', function(){
	    	var page = $(this).attr('href').replace('#/','/admin/');
	    	loadsubpage(page)
	    });

	    //redirect hash to proper location
	    var hash = window.location.hash;
	    if($('.page-admin').length > 0){
	    	if(hash.length < 3 ){ return false; }
	    	var page = hash.replace('#/','/admin/');
	    	if(window.loadsubpage !== page){
	    		loadsubpage(page);
	    		window.loadsubpage = page;
	    	}
	    }
	});

	// The rest of the codes goes here
	function loadsubpage(page){
		$.get(page, function( result ){
    		if(page === "/admin/dashboard"){
    			$('body').html(result);
    		}else{
    			$('.content-wrap').html(result);
    		}
    		initMaterialize();
    	});
	}

	function initMaterialize(){
		Materialize.updateTextFields(); // auto toogle textfields which are pre-filled

		$('.dropdown-button').dropdown({"hover": false});
	    $('ul.tabs').tabs();
	    $('.tab-demo').show().tabs();
	    $('.parallax').parallax();
	    $('.modal').modal();
	    $('.tooltipped').tooltip({"delay": 45});
	    $('.collapsible-accordion').collapsible();
	    $('.collapsible-expandable').collapsible({"accordion": false});
	    $('.materialboxed').materialbox();
	    $('.scrollspy').scrollSpy();
	    $('.button-collapse').sideNav();
	    $('.datepicker').pickadate();
		$('.do-nav-slideout').click(function(){
			$('.button-collapse').sideNav('show'); 
		});
		$('.chips').material_chip();
		$('select').material_select();
	    // $('#password').strength_meter();
	}
}));