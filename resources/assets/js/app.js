
require('./bootstrap');

// init
(function (rebuy){
	rebuy(window.jQuery, window, document);
}(function rebuy($, window, document){
	$(function (){

		// initialization goes here
		$.reBuy.initMaterialize();
		

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

		$('.chips-tags').material_chip({
			data: [
				{ tag: 'Jogging' },
				{ tag: 'Running' },
			],
			autocompleteData: {
				'Cycling': null,
				'Jogging': null,
				'Running': null,
				'Swimming': null,
			}
		});


	});

}));
