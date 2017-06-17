app.controller('articlesController', function($scope, articleServices, $http, $timeout, $rootScope){
	
	var vm = this;

	vm.img = false,
	vm.img2 = false;

	$scope.selectedShop = selectedShop;
	$scope.articles = [];
	$scope.hasSelectedArticle = false;
	$scope.currentlySelectedArticle = null;
	$scope.bindEvents = bindEvents;

	$scope.bindEvents();

	$scope.events = {
		addUpdate : function(form){
				data = form.serializeArray();
				var sample_picture = document.getElementById('sample_picture').files[0],
					label_design =  document.getElementById('label_design').files[0],
					sample_picture_data = null,
					label_design_data = null,
					reader = new FileReader(),
					label_design_reader = new FileReader(),
					addUpdate = $('.addUpdate');
					reader.onloadend = function(e) {
						sample_picture_data = e.target.result;

					}
					if(sample_picture){
						reader.readAsDataURL(sample_picture);
					}
					
					label_design_reader.onloadend = function(e) {
						label_design_data = e.target.result;
					}
					if(label_design){
						label_design_reader.readAsDataURL(label_design);
					}
					
					addUpdate.html('WAIT').attr('disable', 'disable');

					$timeout(function(){
						var formdata = {
						data : data,
						files : {
							sample_picture : sample_picture_data,
							label_design : label_design_data
						}
					};
					articleServices.addOrUpdate(form.attr('action') + '?&ajax=true', formdata ).then(function(addOrUpdate){
						addUpdate.html('UPDATE').removeAttr('disable');
						if(addOrUpdate.success){
			              	window.reBuy.toast('Article Information has been updated!');
			              	$timeout(function(){
			              		window.location.href= '/shop/articles/' + addOrUpdate.article_id;
			              	},1000);
			              }else{
			              	window.reBuy.toast('Error: Please complete the required information and try again.');
			              }
					 });	
					},3500);
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

			$(document)
				.on('change', '#sample_picture', function(){
					var reader = new FileReader(),
					sample_picture = document.getElementById('sample_picture').files[0];
					reader.onload = function (e) {
						vm.img = true;
				        var img = $('<img>').attr('src',e.target.result).css({'width' : 100, 'height' : 100});
				        $('#img-wrap').html(img);
				    };
				    reader.readAsDataURL(sample_picture);
				})
				.on('change', '#label_design', function(){
					var reader2 = new FileReader(),
					label_design = document.getElementById('label_design').files[0];
					reader2.onload = function (e) {
						vm.img2 = true;
				        var img = $('<img>').attr('src',e.target.result).css({'width' : 100, 'height' : 100});
				        $('#img-wrap2').html(img);
				    };
				    reader2.readAsDataURL(label_design);
				});

			$( "form" ).on( "submit", function( event ) {
			  event.preventDefault();
			  $scope.events.addUpdate($(this).closest('form'));
			  return false;
			});
    }

});
