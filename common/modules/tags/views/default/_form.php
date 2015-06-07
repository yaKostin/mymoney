<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\tags\models\Tag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$script = <<< JS

$('form#Tag').on('beforeSubmit', function(e) {
    var \$formTags = $(this);
    $.post(
        \$formTags.attr('action'),
        \$formTags.serialize()
        )
    .done(function(result) {
            if(result == 1) {
                $(document).find('#add-tag-modal').modal('hide');
                $(\$formTags).trigger("reset");
                $.pjax.reload({container:'#tags-grid'});
            } else {
                $(\$formTags).trigger("reset");
                $("#message").html(result.message);
            }
        }).fail(function(){
            console.log("server error");
        });
return false;
});


$('#add-tag-modal').on('shown.bs.modal', function (e) {
    $('#add-tag-modal').appendTo("body");    
    console.log('Присоеденил к бади');
});

JS;

$this->registerJs($script);

?>
