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
                $.each(errors, function (i, error){
                    var errorContainer = $('<span class="help-block red-text lighten-1">'+
                                    '<strong>'+error[0]+'</strong>'+
                                '</span>');

                    form.find('[name="'+i+'"]').parent("div").after(errorContainer);
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
        confirm : function (message, doCallback,  btnYesLabel,  btnNoLabel, modalWidth){
            var btnYesLabel = btnYesLabel || 'OK',
                btnNoLabel  = btnNoLabel  || 'Cancel',
                modalWidth  = modalWidth  || '300',
                doCallback  = doCallback  || 'function(){ return false; }',
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
                    }catch(e){}
                });
                $('#' + modalId).find('.btn-no-label').on('click', function(){
                    $('#' + modalId).modal('close');
                    $('#' + modalId).remove();
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
            $('select').material_select();
            // $('#password').strength_meter();
    
        },
        toast : function(message){
           Materialize.toast(message, 4000);
        }
    }

    window.reBuy = $.reBuy;

})(jQuery);