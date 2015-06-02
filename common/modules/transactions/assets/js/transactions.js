   
$("form#Transaction").submit(function() {
        $(".form-group").removeClass("has-error");      //remove error class
        $(".help-block").html("");                      //remove existing error messages

        var form_data = $("form#Transaction").serialize();
        var action_url = $("form#Transaction").attr("action");

        $.ajax({
            method: "POST",
            url: action_url,
            data: form_data
        })
        .done(function( data ) {
            console.log(data);
            if(data.success == 1)    {       //data saved successfully 
                $(document).find('#main-modal').modal('hide');
                $($form).trigger("reset");
                $.pjax.reload({container:'#main-grid'});
            }
        });
        return false;
    }