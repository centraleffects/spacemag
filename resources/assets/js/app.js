
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
	});

	// The rest of the codes goes here
}));