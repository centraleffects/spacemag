(function($){
    $.ReBuy = {
        alertDialog : function (message, btnYesLabel, modalWidth, callback){
             var btnYesLabel = btnYesLabel || 'OK',
                 modalWidth  = modalWidth  || '300',
                 callback    = callback    || 'function(){ return false; }',
                 modalId     = 'alertDialog',
                 html =
                    '<div id="'+modalId+'" class="modal" style="width:' + modalWidth + 'px">\
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
                        callback();
                    });

        },
        confirmDialog : function (message, doCallback,  btnYesLabel,  btnNoLabel, modalWidth){
             var btnYesLabel = btnYesLabel || 'OK',
                 btnNoLabel  = btnNoLabel  || 'Cancel',
                 modalWidth  = modalWidth  || '300',
                 doCallback    = doCallback    || 'function(){ return false; }',
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
                        doCallback();
                    })
                $('#' + modalId).find('.btn-no-label').on('click', function(){
                        $('#' + modalId).modal('close');
                        $('#' + modalId).remove();
                    });
        }
    }

})(jQuery);