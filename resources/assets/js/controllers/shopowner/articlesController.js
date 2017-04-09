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
		var url = '/api/shops/'+selectedShop.id+'/users?api_token='+window.user.api_token;
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
		var customer = $scope.articles[index];
		var url = '/api/shops/'+selectedShop.id+'/users/'+customer.id+'/remove?api_token='+window.user.api_token;
		window.$.reBuy.confirm("Are you sure to remove this customer?", function (){
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

	$scope.generatePassword = function (){
		if( $scope.hasSelectedArticle ){
			$http.post('/api/shops/'+selectedShop.id+'/users/sendpassword').then(function (response){
				console.warn(response);
			}, function (response){
				console.warn(response);
			});
		}
	};

	$scope.addNewArticle = function (){
		$scope.addNew = true;
		$("html, body").animate({ scrollTop: $('#add_new').offset().top }, 1000);
	};

	$scope.invite = function (){
		var data = {
				name: $scope.new_firstName,
				email: $scope.new_Email
			},
			url = '/api/shops/'+selectedShop.id+'/invite?api_token='+window.user.api_token;
		$http.post(url, data).then(function (response){
			console.log(response);
		}, function (response){
			if( response.data ){
				window.$.reBuy.showErrors(response.data, $("#add_new"), 8000);
			}
		})
	} 


	// init
	$scope.init();
}

app.controller('ArticleController', ArticleCtrl);