app.controller('articlesController', function($scope, articleServices, $http, $timeout, $rootScope){
	
	var vm = this;

	$scope.selectedShop = selectedShop;
	$scope.articles = [];
	$scope.hasSelectedArticle = false;
	$scope.currentlySelectedArticle = null;
	$scope.bindEvents = bindEvents;

	$scope.bindEvents();

	$scope.events = {
		addUpdate : function(form){
				data = form.serializeArray();

	            articleServices.addOrUpdate(form.attr('action') + '?&ajax=true', data).then(function(addOrUpdate){
		              if(addOrUpdate.success){
		              	window.reBuy.toast('Article Information has been updated!');
		              	$timeout(function(){
		              		window.location.href= '/shop/articles/' + addOrUpdate.article_id;
		              	},1000);
		              }else{
		              	window.reBuy.toast('Error: Please complete the required information and try again.');
		              }
		        });
		}
	}

	function  bindEvents(){

			function formatTag (tag) {
			  if (!tag.id) { return tag.text; }
			  var $tags = $(
			    '<span><img src="/images/bg.jpg" class="img-flag circle" style="width:20px; height:20px;" /> ' + tag.text + '</span>'
			  );
			  
			  return $tags;
			};

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
				  escapeMarkup: function (markup) { return markup; }
			});

			$( "form" ).on( "submit", function( event ) {
			  event.preventDefault();
			  $scope.events.addUpdate($(this).closest('form'));
			  return false;
			});
    }

});
