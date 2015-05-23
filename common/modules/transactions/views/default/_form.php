<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\transactions\TransactionsAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <div class="row">
        <div class="col-md-3"> <?= $form->field($model, 'desciption')->textInput(['maxlength' => true]) ?> </div>
        <div class="col-md-2"> <?= $form->field($model, 'amount')->textInput() ?> </div>
        <div class="col-md-2"> <?= $form->field($model, 'trdate')->textInput() ?> </div>
        <div class="col-md-2"> <?= $form->field($model, 'transactiontype_id')->textInput()->label('Тип') ?> </div>
        <div class="col-md-3"> <?= $form->field($model, 'card_id')->textInput() ?> </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
TransactionsAsset::register($this);
?>
    