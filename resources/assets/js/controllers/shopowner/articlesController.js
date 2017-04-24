function ArticleCtrl ($scope, $http, $timeout, $rootScope){
	$scope.selectedShop = selectedShop;
	$scope.articles = [];
	$scope.hasSelectedArticle = false;
	$scope.currentlySelectedArticle = null;
	$scope.addNew = false;
	$scope.new_firstName = '';
	$scope.new_Email = '';

	$scope.init = function (){
		$scope.getArticles();
	};

	$scope.getArticles = function (){
		var url = '/api/articles?api_token='+window.user.api_token;
		$http.get(url).then(function (response){
			console.log(response);
			$scope.articles = response.data;

			if( $scope.articles.length > 0 ){
				$rootScope.listIsEmpty = false;
			}else{
				$rootScope.listIsEmpty = true;
			}

		}, function (response){
			console.warn(response);
		});
	};

	$scope.viewArticle = function (index){
		$scope.hasSelectedArticle = true;
		$scope.currentlySelectedArticle = $scope.articles[index];
		Materialize.updateTextFields();
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


	// init
	$scope.init();
}

app.controller('ArticleController', ArticleCtrl);