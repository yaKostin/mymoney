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
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$('form#Tag').on('beforeSubmit', function(e) {
    var \$formTag = $(this);
    $.post(
        \$formTag.attr('action'),
        \$formTag.serialize()
        )
    .done(function(result) {
            if(result == 1) {
                $(document).find('#add-tag-modal').modal('hide');
                $(\$formTag).trigger("reset");
                $.pjax.reload({container:'#tag-grid'});
            } else {
                $(\$formTag).trigger("reset");
                $("#message").html(result.message);
            }
        }).fail(function(){
            console.log("server error");
        });
return false;
});

$('#add-tag-modal').on('shown.bs.modal', function (e) {
    $('#add-tag-modal').appendTo("body");    
});
JS;
$this->registerJs($script);
?>