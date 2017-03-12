
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
		Materialize.updateTextFields();
		$('.button-collapse').sideNav();
		$('.do-nav-slideout').click(function(){
			$('.button-collapse').sideNav('show'); 
		});

	    $('.parallax').parallax();
	    $('#password').strength_meter();

	    //make restful the toolbar
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
    		reinitMaterialize();
    	});
	}

	function reinitMaterialize(){
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
	}
}));