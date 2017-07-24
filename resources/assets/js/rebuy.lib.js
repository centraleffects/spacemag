(function($){

    $.reBuy = {
        disableBtn : function (btn){
            btn.attr("disabled", "disabled").addClass("disabled");
        },

        enableBtn : function (btn){
            btn.removeAttr("disabled").removeClass("disabled");
        },

        showErrors : function (errors, form, timeout){            
            if( form ){
                form.find('span.help-block').remove();
                $.each(errors, function (i, error){
                    var errorContainer = $('<span class="help-block red-text lighten-1">'+
                                    '<strong>'+error[0]+'</strong>'+
                                '</span>');
                    var el = form.find('[name="'+i+'"]');
                    el.parent("div").after(errorContainer);
                });
            }else{
                console.error("showErrors: no $(form) specified.");
            }

            var $timeout = 5000;

            if( timeout ){
                $timeout = timeout;
            }

            setTimeout(function() {
                $("span.help-block").fadeOut();
            }, $timeout);
        }, 

        alert : function (message, btnYesLabel, modalWidth, callback){
            var btnYesLabel = btnYesLabel || 'OK',
                modalWidth  = modalWidth  || '300px',
                callback    = callback    || 'function(){ return false; }',
                modalId     = 'alertDialog',
                html =
                    '<div id="'+modalId+'" class="modal" style="width:' + modalWidth + '">\
                        <div class="modal-content">\
                          <p>'+ message +'</p>\
                        </div>\
                        <div class="modal-footer">\
                          <a href="#!" class=" modal-action btn-yes-label waves-effect waves-green btn-flat">' + btnYesLabel + '</a>\
                        </div>\
                      </div>';

                if ($('#' + modalId).length == 0) {
                    $('body').append(html);
                }else{
                     $('#' + modalId).html(html);
                }
                $('.modal').modal();
                $('#' + modalId).modal('open');
                $('#' + modalId).find('.btn-yes-label').on('click', function(){
                    $('#' + modalId).modal('close');
                    $('#' + modalId).remove();
                    try {
                      callback();
                    }catch(e){}
                    
                });

        },
        confirm : function (message, doCallback,  btnYesLabel,  btnNoLabel, modalWidth, cancelCallBack){
            var btnYesLabel = btnYesLabel || 'OK',
                btnNoLabel  = btnNoLabel  || 'Cancel',
                modalWidth  = modalWidth  || '300',
                doCallback  = doCallback  || 'function(){ return false; }',
                cancelCallBack  = cancelCallBack  || 'function(){ return false; }',
                modalId     = 'confirmDialog',
                alertDialogModal = $('#' + modalId),
                $body       = $('body'),
                html =
                    '<div id="'+modalId+'" class="modal" style="width:' + modalWidth + 'px">\
                        <div class="modal-content">\
                          <p>'+ message +'</p>\
                        </div>\
                        <div class="modal-footer">\
                          <a href="#!" class=" modal-action btn-no-label waves-effect waves-green btn-flat">' + btnNoLabel + '</a>\
                          <a href="#!" class=" modal-action btn-yes-label waves-effect waves-green btn-flat">' + btnYesLabel + '</a>\
                        </div>\
                      </div>';

                if ($('#' + modalId).length == 0) {
                    $('body').append(html);
                }else{
                     $('#' + modalId).html(html);
                }
                $('.modal').modal()
                $('#' + modalId).modal('open');
                $('#' + modalId).find('.btn-yes-label').on('click', function(){
                    $('#' + modalId).modal('close');
                    $('#' + modalId).remove();
                    try {
                      doCallback();
                    }catch(e){ }
                });
                $('#' + modalId).find('.btn-no-label').on('click', function(){
                    $('#' + modalId).modal('close');
                    $('#' + modalId).remove();
                    try {
                      cancelCallBack();
                    }catch(e){ }
                });
        },
        
        initMaterialize : function(){

            Materialize.updateTextFields(); // auto toogle textfields which are pre-filled

            $('.dropdown-button').dropdown({"hover": false});
            $('ul.tabs').tabs();
            $('.tab-demo').show().tabs();
            $('.parallax').parallax();
            $('.modal').modal();
            $('.tooltipped').tooltip({"delay": 45});
            $('.collapsible-accordion').collapsible();
            $('.collapsible-expandable').collapsible({"accordion": false});
            $('.materialboxed').materialbox();
            $('.scrollspy').scrollSpy();
            $('.button-collapse').sideNav();
            $('.datepicker').pickadate();
            $('.do-nav-slideout').click(function(){
                $('.button-collapse').sideNav('show'); 
            });
            $('.chips').material_chip();
            $('select:not(".select2")').material_select();
            // $('#password').strength_meter();

            $(document).on("click", ".alert .close", function (){
                $(this).parents("div:first").fadeOut(function (){
                    $(this).remove();
                });
            })
    
        },

        toast : function(message, timeout){
            if( typeof(timeout) == 'undefined' ){
                timeout = 4000;
            }
           Materialize.toast(message, timeout);
        },

        readURL: function(input, $targetImage) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $targetImage.attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    }

    window.reBuy = $.reBuy;

    var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
      };
    })();

    $(document).on("keyup", ".sidebar-search-field", function (e){
        var $this = $(this), 
            $target = $( $this.attr("data-target-result") ),
            source_url = $this.attr("data-source"),
            keyword = $(this).val();

        delay(function(){
            $.ajax({
                url: source_url,
                type: 'post',
                dataType: 'json',
                data: {
                    keyword: keyword
                },
                success: function (data){
                    console.log(data);
                    // we'll expect that the data we will be fetching should be paginated
                    $target.find("li.orig-data").hide();

                    if( !data.msg ){
                        $target.find('li.empty-result').hide();

                        $.each(data, function (i, shop){
                            var item = $('<li class="collection-item search-result-item" data-id="'+shop.id+'">'+
                                    '<a  href="/shops/view/'+shop.id+'" target="_blank" data-field="name">'+shop.name+'</a>'+
                                    '<a  href="javascript:void(0);" class="add-remove-shop secondary-content" data-id="'+shop.id+'" data-action="add" data-field="do_action">'+
                                        '<i class="material-icons">add</i>'+
                                    '</a>'+
                                '</li>');
                            if( $target.find('li.search-result-item[data-id="'+shop.id+'"]').length < 1 ){
                                $target.append(item);
                            }
                        });
                    }else{
                        // show no results
                        $target.find('li.search-result-item').remove();
                        if( $target.find('li.empty-result').length < 1 ){
                            var item = $('<li class="collection-item empty-result">'+data.msg+'</li>');
                            $target.append(item);
                        }else{
                            $target.find('li.empty-result').show();
                        }
                    }
                   
                },
                error: function (data){
                    console.warn(data);
                    reBuy.alert("Error 500. Something went wrong while processing your request.")
                }

            });
        }, 500 );
       
        if( e.which == 27 ){ // esc key
            $('.clear-search-field').trigger('click');
        }
        
    });

    $(document).on("click", ".clear-search-field", function (){
        $e1 = $("#search");

        if( $e1.length > 0 ){
            $e1.val("").trigger("change");
        }

        $el = $("#search_results");

        if( $el.length > 0 ){
            if( $el.find('li.orig-data').length > 0 ){
                $el.find('li.orig-data').show();
                $el.find('li.empty-result').hide();
            }else{
                $el.find('li.empty-result').show();
            }
            
            $el.find('li.search-result-item').remove();
        }
    });

})(jQuery);