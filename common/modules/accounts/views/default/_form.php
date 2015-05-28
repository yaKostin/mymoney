<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Card */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($card, 'user_id')->textInput() ?>

    <?= $form->field($card, 'cardtype_id')->textInput() ?>

    <?= $form->field($card, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($card, 'currency_id')->textInput() ?>

    <?= $form->field($card, 'bank_id')->textInput() ?>

    <?= $form->field($card, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($card->isNewRecord ? 'Create' : 'Update', ['class' => $card->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
