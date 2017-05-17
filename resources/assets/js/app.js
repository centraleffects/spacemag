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
				{
				    tag: 'Jogging',
				    image: 'http://localhost:8000/images/bg.jpg', //optional
				    id: 1, //optional
				},
				{
				    tag: 'Running',
				    image: 'http://localhost:8000/images/office.jpg', //optional
				    id: 2, //optional
				}
			],
			autocompleteData: {
				'Cycling': null,
				'Jogging': null,
				'Running': null,
				'Swimming': null,
			}
		});

		/* for session flash messages */
		$("div.alert").not(".alert-important").delay(5000).slideUp(function(){
	        $(this).remove();
	    });

	    $(document).on("click", ".collection-item", function (){
	    	$(".collection-item").removeClass("active");
	    	$(this).addClass("active");
	    });

	    $(document).on("click", ".close-card", function (){
	    	$(".collection-item").removeClass("active");
	    });

	    $('.dropdown-button').dropdown({
			inDuration: 300,
			outDuration: 225,
			constrainWidth: false, // Does not change width of dropdown to that of the activator
			hover: false, // Activate on hover
			gutter: 0, // Spacing from edge
			belowOrigin: true, // Displays dropdown below the button
			alignment: 'left', // Displays dropdown with edge aligned to the left of button
			stopPropagation: false // Stops event propagation
		});
	});

}));


