$(function (){
	$(document).on("click", ".add-remove-shop", function (){
		var $this = $(this), 
			shopId = $this.attr("data-id")
			action = $this.attr("data-action"),

			$search_results = $("#search_results"),
			$myshops_list = $("#myshops_list");

		$.ajax({
			url: '/api/users/'+window.user.id+'/shop-add-remove/'+shopId+'?api_token='+window.user.api_token,
			type: 'post',
			dataType: 'json',
			data: {
				action: action
			},
			success: function (data){
				console.log(data);
				if( data.success ){
					window.reBuy.toast(data.msg);

					var source = $search_results,
						target = $myshops_list,
						icon = "close",
						newAction = action == "add" ? "remove" : "add",
						itemIcon = $('<i class="material-icons circle">location_city</i>'),
						newClass = "avatar";

					if( action == "remove" ){
						source = $myshops_list;
						target = $search_results;
						icon = "add";
						newAction = "add";
						itemIcon = "";

						target.find('li.empty-result').hide();
					}


					var li = source.find("li[data-id='"+shopId+"']");
					var newLI = li.clone();

					if( itemIcon != "" ){
						newLI.prepend(itemIcon);
						newLI.addClass(newClass);
					}else{
						newLI.find('i.material-icons.circle').remove();
						newLI.removeClass(newClass);
					}

					newLI.find('a.add-remove-shop').attr("data-action", newAction);
					newLI.find("a.add-remove-shop i.material-icons").html(icon);

					li.fadeOut(function (){ $(this).remove() });

					target.append(newLI);

				}else{
					window.reBuy.alert(data.msg);
				}

			},
			error: function (data){
				console.warn(data);
			}
		});
	});

});