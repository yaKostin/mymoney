<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\transactions\TransactionsAsset;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
//use common\models\Transactiontype;  
/* @var $this yii\web\View */
/* @var $model common\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">
    <h1>Добавить транзакцию</h1>
    
    <?php $form = ActiveForm::begin(['id' => $model->formName()]); ?>

    <div class="row">
        <div class="col-md-3"> <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?> </div>
        <div class="col-md-2"> <?= $form->field($model, 'amount')->textInput() ?> </div>
        <div class="col-md-2"> 
            <?= $form->field($model, 'trdate')->widget(DatePicker::classname(), [
                    'inline' => false,
                    'language' => 'ru',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-m-d',
                        //'format' => 'd-M-yyyy',
                    ],    
                ])   
            ?> 
        </div>
        <div class="col-md-2"> 
            <?= $form->field($model, 'transactiontype_id')->dropDownList(
                    ArrayHelper::map($transactiontypeArray, 'id', 'name')
                )
            ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'card_id')->dropDownList(
                    ArrayHelper::map($cardArray, 'id', 'name')
                )
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
TransactionsAsset::register($this);
?>
    