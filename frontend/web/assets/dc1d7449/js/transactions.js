$('form#Transaction').on('beforeSubmit', function(e) {
    var $form = $(this);
    $.post(
        $form.attr('action'),
        $form.serialize()
        )
    .done(function(result) {
            if(result == 1) {
                $(document).find('#main-modal').modal('hide');
                $($form).trigger("reset");
                $.pjax.reload({container:'#main-grid'});
            } else {
                $($form).trigger("reset");
                $("#message").html(result.message);
            }
        }).fail(function(){
            console.log("server error");
        });
return false;
});
