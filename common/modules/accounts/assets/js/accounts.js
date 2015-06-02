$('form#Card').on('beforeSubmit', function(e) {
    console.log('accounts.js loaded');
    var $form = $(this);
    $.post(
        $form.attr('action'),
        $form.serialize()
        )
    .done(function(result) {
            if(result == 1) {
                $(document).find('#add-account-modal').modal('hide');
                $($form).trigger("reset");
                $.pjax.reload({container:'#accounts-grid'});
            } else {
                $($form).trigger("reset");
                $("#message").html(result.message);
            }
        }).fail(function(){
            console.log("server error");
        });
return false;
});
