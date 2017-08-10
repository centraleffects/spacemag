$(function (){
	if( typeof(user) == 'undefined' ){
		console.error('No specified user.');
		return;
	}
	var _token = user.api_token,
		_url = '/api/salespot/',
		_dragicon = '<svg class="svgIcon itemRow-dragIcon fill-grey" viewBox="0 0 32 32" title="drag handle">'+
				'<path d="M 14 5.5 a 3 3 0 1 1 -3 -3 A 3 3 0 0 1 14 5.5 Z m 7 3 a 3 3 0 1 0 -3 -3 A 3 3 0 0 0 21 8.5 Z m -10 4 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 12.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 12.5 Z m -10 10 a 3 3 0 1 0 3 3 A 3 3 0 0 0 11 22.5 Z m 10 0 a 3 3 0 1 0 3 3 A 3 3 0 0 0 21 22.5 Z"></path>'+
			'</svg>',
		_checkbox = '<svg class="svgIcon " viewBox="0 0 32 32" title="checkmark"><polygon points="27.672,4.786 10.901,21.557 4.328,14.984 1.5,17.812 10.901,27.214 30.5,7.615 "></polygon></svg>',
		_template = $('<li class="collection-item row todo-item" autofocus>'+
			'<span class="col">'+
				_dragicon+
				'<label class="mark-as-complete circular-button-view">'+
				_checkbox+
				'</label>'+
				'<input type="checkbox" style="display: none;" />'+
			'</span>'+
			'<span class="col s8 m8 l8">'+
				'<span title="Double click to edit" class="description"></span>'+
			'</span>'+
			'<span class="col right"></span>'+
		'</li>'),
		$todoList = $(".todo-list"),
		$activeSalespot = $(".active-salespot");

	fetchTodoCount(selectedShop.id, _token);

	$(document).on("click", ".salespot", function (){
		var $this = $(this), id = $this.attr("data-id");

		$activeSalespot.text(" - "+$this.find(".name").text());

		$.ajax({
			url: _url+id+'/tasks?api_token='+_token,
			type: 'get',
			dataType: 'json',
			success: function (data){
				console.log(data.length);
				console.log(data);
				if( data.length > 0 ){
					$todoList.html("");
					$.each(data, function (i, row){
						console.log(row);
						template = _template.clone();
						$todoList.prepend(generateTodoHtml(row, template));
					});
				}else{
					$todoList.html('<div class="alert alert-info" style="margin-left: 15px;">No task on this salespot yet.</div>');
				}
			},
			error: function (data){
				console.log("Something went wrong.");
				console.warn(data);
			}
		});

		fetchTodoCount(selectedShop.id, _token);
	});


	$(document).on("click", ".mark-as-complete", function (){
		var $this = $(this), 
			id = $this.attr("data-id"),
			isDone = $this.hasClass("done") ? true : false;

		$.ajax({
			url: '/api/tasks/'+id+'/finish?api_token='+user.api_token,
			type: 'post',
			dataType: 'json',
			data: {
				status: 'finished',
				done: !isDone
			},
			success: function (data){
				if( data.success ){
					var $spanDesc = $this.parent("span").next("span");
						
					$li = $(".todo-item[data-id='"+id+"']");

					if( isDone ){
						$this.removeClass("done");
						$spanDesc.find('.description').removeClass("done");
						$li.children("span:last").html("");
					}else{
						// task is marked as completed \
						appendUserAvatar($li, window.user);

						$this.addClass("done");
						$spanDesc.find('.description').addClass("done");
					}

					data.hasOwnProperty('msg') ? reBuy.toast(data.msg) : '';
					
				}else{
					data.hasOwnProperty('msg') ? reBuy.alert(data.msg) : console.warn(data);
				}
			},
			complete: function (){
				fetchTodoCount(selectedShop.id, _token);
			},
			error: function (data){
				reBuy.alert("Something went wrong.");
			}
		});
	});

	// 
	function generateTodoHtml(todo, template){
		var checkbox = template.find(".mark-as-complete");
		checkbox.attr("data-id", todo.id);
		template.attr("data-id", todo.id);

		if(todo.done){
			checkbox.addClass("done");
			appendUserAvatar(template, todo.completor);
		}else{
			template.children("span:last").html("");
			checkbox.removeClass("done");
		}

		template.find(".description").text(todo.description)
			.addClass(todo.done ? "done" : "");

		return template;
	}

	function appendUserAvatar(li, user){
		if( typeof(user) == 'undefined' ){
			console.warn("No user specified.");
			return;
		}

		var userName = user.first_name+' '+user.last_name,
			el = li.children("span:last");
		var template = '<div class="chip" title="Completed by '+userName+'">'+
		    '<img src="'+user.avatar+'" alt="Assigned">'+userName+'</div>';

		el.html(template);
	}

	function fetchTodoCount(shopId, token){
		$.ajax({
			url: '/api/shops/'+shopId+'/tasks/count?api_token='+token,
			type: 'get',
			dataType: 'json',
			success: function (data){
				var spot = "";
				if( data.length ){
					$.each(data, function (i, row){
						spot = $(".salespot[data-id='"+row.id+"']").children("span.badge");
						if( row.tasks > 0 ){
							spot.addClass("new").addClass("orange").html(row.tasks);
						}else{
							spot.removeClass("new orange").html("");
						}
					});
				}
			}
		});
	}

});