<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Transactiontype;
/* @var $this yii\web\View */
/* @var $model common\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?= $form->field($model, 'card_id')->textInput() ?>

    <?= $form->field($model, 'transactiontype_id')->textInput() ?>
    <?= $form->field($model, 'transactiontype_id')->dropDownList(
            ArrayHelper::map(Transactiontype::find()->all(), 'id', 'naame'),
            ['prompt' => "Тип"]
        )
    ?>

    <?= $form->field($model, 'trdate')->textInput() ?>

    <?= $form->field($model, 'desciption')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS

$('form#{$model->formName()}').on('beforeSubmit', function(e) {
    var \$form = $(this);
    $.post(
        \$form.attr('action'),
        \$form.serialize()
        )
    .done(function(result) {
            if(result == 1) {
                $(document).find('#main-modal').modal('hide');
                $(\$form).trigger("reset");
                $.pjax.reload({container:'#main-grid'});
            } else {
                $(\$form).trigger("reset");
                $("#message").html(result.message);
            }
        }).fail(function(){
            console.log("server error");
        });
return false;
});

JS;
$this->registerJs($script);
?>
    