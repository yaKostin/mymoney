<?php
use Yii\app;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use kartik\select2\Select2;
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
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'tags')->widget(Select2::className(), [
                    'id' => 'select2-tags',
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => [
                        'style' => 'width:100%',
                    ],        
                    'data' => ArrayHelper::map($tagArray, 'id', 'name'),
                    'options' => ['placeholder' => 'Выберите теги'],
                    'pluginOptions' => [
                        'tags' => true,
                        'tokenSeparators' => [',', ' '],
                        'maximumInputLength' => 3,
                        'maximumSelectionSize' => 3,
                        'maximumSelectionLength' => 5,
                    ],
                ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS
   
$('form#Transaction').on('beforeSubmit', function(e) {
    console.log('transactions.js loaded');
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

$('#main-modal').on('shown.bs.modal', function (e) {
     $("#select2-tags").select2();
     console.log('fff');
     if ( $('.select2-container').hasClass('select2-container--default') ) {
        var failedSpan = $('.select2-container')[0];
        $(failedSpan).removeClass('select2-container--default').addClass('select2-container--krajee');
     }
});

$(function () {
    var dateNow = new Date();
    $('#transaction-trdate').parent().datepicker('update', new Date());
});
JS;

$this->registerJs($script); 
?> 