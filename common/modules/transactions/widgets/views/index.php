<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use prawee\widgets\ButtonAjax;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Транзакции';
?>
<div class="transaction-index">

    <?php
        Modal::begin([
        		'id' => 'main-modal',
        		'size' => 'modal-lg',
        	]);

        echo '<div id="main-content-modal"></div>';
        
        Modal::end();
    ?>

    <?php Pjax::begin(['id' => 'main-grid']); ?>

    <?php echo
	GridView::widget([
	    'dataProvider' => $transactionsDataProvider,
	    //'filterModel' => $model->$searchModel,
	    //'columns' => $model->gridColumns,
	    'export' => false,
        'rowOptions' => function($model) {  
                if ($model->transactiontype->name == 'доход' || 
                    $model->transactiontype->name == 'возврат') {
                    return ['class' => 'success'];
                } elseif ($model->transactiontype->name == 'расход') {
                    return ['class' => 'danger'];
                }
            },
	    'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['transactions'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
            ],
            '{toggleData}',
            '{export}',
        ],
        'pjax' => true,
        'pjaxSettings'=>[
            'neverTimeout'=>true,
        ],
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,	
        'hover' => true,
        'columns' => [
            //'id:text:Карта',
            'description:text:Описание',
            'amount:decimal:Сумма',
            'trdate:datetime:Дата',
            'transactiontype_id:text:Тип',
            'card.name:text:Карта',
            'transactiontype.name:text:Тип'
            //'transactionTags'
            //''
        ],
        //'resizableColumns' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => $this->title,
            'before' => ButtonAjax::widget([
				            'name'=>'Создать',
				            'route'=>['transactions/default/create'],
				            'modalId'=>'#main-modal',
				            'modalContent'=>'#main-content-modal',
				            'options'=>[
				                'class'=>'btn btn-success',
				                'title'=>'Button for create application',
				            ]
        				]),
        ],
		]);
?>

    <?php Pjax::end(); ?>

</div>
