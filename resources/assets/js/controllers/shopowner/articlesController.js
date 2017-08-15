app.controller('articlesController', function($scope, articleServices, $http, $timeout, $rootScope){
	
	var vm = this;

	vm.img = false,
	vm.img2 = false;
	vm.materializeInit = materializeInit;
	vm.bindEvents = bindEvents;
	vm.updateSelectedShop = updateSelectedShop;

	vm.selectedShop = null;

	$scope.articles = [];
	$scope.hasSelectedArticle = false;
	$scope.currentlySelectedArticle = null;

	vm.bindEvents();

	function updateSelectedShop(){
		articleServices.updateSelectedShop('/shop/updateSelectedShop/'+vm.selectedShop).then(function(data){
			window.location.reload();
		});
	}

	$scope.events = {
		addUpdate : function(form){
				var data = form.serializeArray(),
					addUpdate = $('.addUpdate');
										
					addUpdate.html('WAIT').attr('disable', 'disable');

					$timeout(function(){
						articleServices.addOrUpdate('/articles/store?&ajax=true', data ).then(function(addOrUpdate){
							addUpdate.html('UPDATE').removeAttr('disable');
							window.reBuy.toast(addOrUpdate.message);
						 });	
					},0);
		}
	}

	function  bindEvents(){
			function formatTag (tag) {
			  if (!tag.id) { return tag.text; }
			  var $tags = $(
			    '<span>' + tag.text + '</span>'
			  );
			  
			  return $tags;
			};
 			
 			

			angular.element('.addUpdate').closest("form").on( "submit", function( event ) {
				  event.preventDefault();
				  $scope.events.addUpdate($(this).closest('form'));
				  return false;
				});

			$timeout(function () {
				$("#article-tags").select2({
				    templateResult: formatTag,
					ajax: {
					    url: '/shop/tags/query?api_token='+window.user.api_token,
					    dataType: 'json',
					    delay: 250,
					    data: function (params) {
					      return {
					        q: params.term,
					      };
					    },
					    processResults: function (data, params) {

					      return {
					        results: data
					      };
					    },
					    cache: true
					  },
					escapeMarkup: function (markup) { return markup; },
					minimumResultsForSearch : 1
				});
		        vm.materializeInit();
		    },1000);

    }

     function materializeInit(){
        Materialize.updateTextFields();
        angular.element('select').material_select();
        angular.element('.tooltipped').tooltip({delay: 50, html : true});
    }

});
