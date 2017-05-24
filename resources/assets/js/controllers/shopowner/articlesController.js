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
				console.log(data);
				var config = {
	                headers : {
	                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
	                }
	            }

	          /*  $http.post(form.attr('action'), data, config)
	            .success(function (data, status, headers, config) {
	                console.log(data);
	            })
	            .error(function (data, status, header, config) {
	                window.reBuy.toast("Data: " + data +
	                    "<hr />status: " + status +
	                    "<hr />headers: " + header +
	                    "<hr />config: " + config)
	            });*/
	            $http.post(form.attr('action'), data).then(function(msg){
			        if(msg.loginSucceeded==="true"){
			            console.log("opa")
			        }else{
			            console.log("den");
			        }
			    });    
	            console.log(data);
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
