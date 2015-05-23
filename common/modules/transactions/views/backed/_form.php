<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-4'> <?= $form->field($model, 'desciption')->textInput(['maxlength' => 90])->label('Описание') ?> </div>
        <div class='col-md-2'> <?= $form->field($model, 'amount')->textInput()->label('Сумма') ?> </div>
        <div class='col-sm-2'> <?= $form->field($model, 'transactiontype_id')->textInput()->label('Тип') ?> </div>
        <div class='col-sm-2'> <?= $form->field($model, 'trdate')->textInput()->label('Дата') ?> </div>
    </div>

    <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
