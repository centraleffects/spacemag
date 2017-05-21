function ArticleCtrl ($scope, articleServices, $http, $timeout, $rootScope){
	$scope.selectedShop = selectedShop;
	$scope.articles = [];
	$scope.hasSelectedArticle = false;
	$scope.currentlySelectedArticle = null;
	$scope.addNew = false;
	$scope.new_firstName = '';
	$scope.new_Email = '';
	$scope.test = 'testing';
	$scope.tags =  [{ id: 0, text: 'enhancement' }, { id: 1, text: 'bug' }, { id: 2, text: 'duplicate' }, { id: 3, text: 'invalid' }, { id: 4, text: 'wontfix' }];


	$scope.init = function (){
		$timeout(function () {
           //$rootScope.updateList($scope, articleServices.articleList, "articles");
        },1500);
	}

	$scope.$watch('articles', function() {	    
        if( $scope.articles.length > 0 ){
			$scope.listIsEmpty = false;
		}else{
			$scope.listIsEmpty = true;
		}
        console.log('hey, myVar has changed!');
    });

	$scope.$watch('articles', function() {	    
        if( $scope.articles.length > 0 ){
			$scope.listIsEmpty = false;
		}else{
			$scope.listIsEmpty = true;
		}
        console.log('hey, myVar has changed!');
    });

	$scope.viewArticle = function (index){
		$scope.hasSelectedArticle = true;
		$scope.currentlySelectedArticle = $scope.articles[index];
		materializeInit();
	};

	$scope.removeArticle = function (index){
		var article = $scope.articles[index];
		var url = '/api/articles/'+article.id+'/remove?api_token='+window.user.api_token;
		window.$.reBuy.confirm("Are you sure to remove this article?", function (){
			$http.delete(url).then(function (response){
				// $scope.articles = response.data;
				console.log(response);
				if( response.data.success == 1 ){
					$scope.articles.splice(index);
				}

				if( $scope.articles.length < 1 ){
					$rootScope.listIsEmpty = true;
				}

			}, function (response){
				console.warn(response);
			});
		});
	};

	$scope.addNewArticle = function (){
		$scope.addNew = true;
		$("html, body").animate({ scrollTop: $('#add_new').offset().top }, 1000);
	};

	$scope.bindEvents = function(){

			function formatState (tag) {
			  if (!tag.id) { return tag.text; }
			  var $tags = $(
			    '<span><img src="/images/bg.jpg" class="img-flag circle" style="width:20px; height:20px;" /> ' + tag.text + '</span>'
			  );
			  
			  return $tags;
			};

			$("#article-tags").select2({
			  templateResult: formatState,
			  //data : $scope.tags
			  /*ajax : {
				    url: '/shop/tags/query?api_token='+window.user.api_token,
				    cache: true,
				    delay: 250,
				    data: function (params) {
				      return {
				        q: params.term, // search term
				        page: params.page
				      };
				    }
				  }*/
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
/*			$('.select2-search').on('keypress', 'input', function(e){
				console.log('change');
			});*/
    }

   
	// init
	$scope.init();

	$scope.bindEvents();
}

app.controller('ArticleController', ArticleCtrl);
