<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\modules\accounts\AccountsAsset;
/* @var $this yii\web\View */
/* @var $model common\models\Card */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-form">

    <?php $form = ActiveForm::begin(['id' => $card->formName()]); ?>

    <div class="row">
        <div class="col-md-12"> <?= $form->field($card, 'name')->textInput(['maxlength' => true]) ?> </div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <?= $form->field($card, 'cardtype_id')->dropDownList(
                    ArrayHelper::map($cardtypes, 'id', 'name')
                )
            ?>
        </div>

        <div class="col-md-2"> <?= $form->field($card, 'amount')->textInput(['maxlength' => true]) ?> </div>
        
        <div class="col-xs-3">
            <?= $form->field($card, 'currency_id')->dropDownList(
                    ArrayHelper::map($currencies, 'id', 'name')
                )
            ?>
        </div>

        <div class="col-md-4"> 
            <?= $form->field($card, 'bank_id')->dropDownList(
                    ArrayHelper::map($banks, 'id', 'name')
                )
            ?>
        </div>
    </div>
    <div class="form-group">

        <?= Html::submitButton($card->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $card->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS

$('form#Card').on('beforeSubmit', function(e) {
    console.log('accounts.js loaded');
    var \$formAccounts = $(this);
    $.post(
        \$formAccounts.attr('action'),
        \$formAccounts.serialize()
        )
    .done(function(result) {
            if(result == 1) {
                $(document).find('#add-account-modal').modal('hide');
                $(\$formAccounts).trigger("reset");
                $.pjax.reload({container:'#accounts-grid'});
            } else {
                $(\$formAccounts).trigger("reset");
                $("#message").html(result.message);
            }
        }).fail(function(){
            console.log("server error");
        });
return false;
});

$('#add-account-modal').on('shown.bs.modal', function (e) {
    $('#add-account-modal').appendTo("body");    
});

JS;
$this->registerJs($script);
?>