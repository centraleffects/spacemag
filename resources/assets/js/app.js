
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
		console.log("hello world!");
		// variable declaration goes here


		// initialization goes here
		$('.button-collapse').sideNav();
	});

	// The rest of the codes goes here
}));
