<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\modules\reminders\models\Reminder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reminder-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duedate')->widget(DatePicker::classname(), [
                    //'id' => 'datepicker-trdate',
                    'inline' => false,
                    'language' => 'ru',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-m-d',
                        'todayHighlight' => true,
                        //'format' => 'd-M-yyyy',
                    ],    
                ])   
            ?> 

    <?= $form->field($model, 'repeattype_id')->textInput() ?>

    <?= $form->field($model, 'repeatcount')->textInput() ?>

    <?= $form->field($model, 'sendemail')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS

$('form#Reminder').on('beforeSubmit', function(e) {
    var \$formReminders = $(this);
    $.post(
        \$formReminders.attr('action'),
        \$formReminders.serialize()
        )
    .done(function(result) {
            if(result == 1) {
                $(document).find('#add-reminder-modal').modal('hide');
                $(\$formReminders).trigger("reset");
                $.pjax.reload({container:'#reminders-grid'});
            } else {
                $(\$formReminders).trigger("reset");
                $("#message").html(result.message);
            }
        }).fail(function(){
            console.log("server error");
        });
return false;
});

$('#add-reminder-modal').on('shown.bs.modal', function (e) {
    $('#add-reminder-modal').appendTo("body");    
});

$(function () {
    var dateNow = new Date();
    $('#reminder-duedate').parent().datepicker('update', new Date());
});

JS;
$this->registerJs($script);
?>