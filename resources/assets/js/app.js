
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
		Materialize.updateTextFields(); // auto toogle textfields which are pre-filled
		$('.button-collapse').sideNav();
		$('.do-nav-slideout').click(function(){
			$('.button-collapse').sideNav('show'); 
		});

		$('.chips').material_chip();
		$('select').material_select();
	    $('.parallax').parallax();
	    $('#password').strength_meter();

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
	});

	// The rest of the codes goes here
}));