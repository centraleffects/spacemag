app.controller('articlesController', function($scope, articleServices, $http, $timeout, $rootScope){
	
	var vm = this;

	vm.img = false,
	vm.img2 = false;
	vm.materializeInit = materializeInit;
	vm.bindEvents = bindEvents;

	$scope.selectedShop = selectedShop;
	$scope.articles = [];
	$scope.hasSelectedArticle = false;
	$scope.currentlySelectedArticle = null;

	vm.bindEvents();

	$scope.events = {
		addUpdate : function(form){
				var data = form.serializeArray(),
					addUpdate = $('.addUpdate');
										
					addUpdate.html('WAIT').attr('disable', 'disable');

					$timeout(function(){
						articleServices.addOrUpdate('/shop/articles/store?&ajax=true', data ).then(function(addOrUpdate){
							addUpdate.html('UPDATE').removeAttr('disable');
							if(addOrUpdate.success){
				              	window.reBuy.toast('Article Information has been updated!');
				              	/*$timeout(function(){
				              		window.location.href= '/shop/articles/' + addOrUpdate.article_id;
				              	},2000);*/
				              }else{
				              	window.reBuy.toast('Error: Please complete the required information and try again.');
				              }
						 });	
					},0);
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

			$timeout(function () {
				$("#categories").select2();

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
				

				$('.addUpdate').closest("form").on( "submit", function( event ) {
				  event.preventDefault();
				  $scope.events.addUpdate($(this).closest('form'));
				  return false;
				});

				/*$('#categories').selectize();

				$('#article-tags').selectize({
					    valueField: 'url',
					    labelField: 'name',
					    searchField: 'name',
					    create: false,
					    render: {
					        option: function(item, escape) {
					            return '<div>' +
					                '<span class="title">' +
					                    '<span class="name"><i class="icon ' + (item.fork ? 'fork' : 'source') + '"></i>' + escape(item.name) + '</span>' +
					                    '<span class="by">' + escape(item.username) + '</span>' +
					                '</span>' +
					                '<span class="description">' + escape(item.description) + '</span>' +
					                '<ul class="meta">' +
					                    (item.language ? '<li class="language">' + escape(item.language) + '</li>' : '') +
					                    '<li class="watchers"><span>' + escape(item.watchers) + '</span> watchers</li>' +
					                    '<li class="forks"><span>' + escape(item.forks) + '</span> forks</li>' +
					                '</ul>' +
					            '</div>';
					        }
					    },
					    score: function(search) {
					        var score = this.getScoreFunction(search);
					        return function(item) {
					            return score(item) * (1 + Math.min(item.watchers / 100, 1));
					        };
					    },
					    load: function(query, callback) {
					        if (!query.length) return callback();
					        $.ajax({
					            url: 'https://api.github.com/legacy/repos/search/' + encodeURIComponent(query),
					            type: 'GET',
					            error: function() {
					                callback();
					            },
					            success: function(res) {
					                callback(res.repositories.slice(0, 10));
					            }
					        });
					    }
					});*/
			 
		        vm.materializeInit();
		    },1000);

    }

     function materializeInit(){
        Materialize.updateTextFields();
        angular.element('select').material_select();
        angular.element('.tooltipped').tooltip({delay: 50, html : true});
    }

});
