<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use prawee\widgets\ButtonAjax;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\grid\ActionColumn;
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
        'hover' => true,
        'columns' => [
            ['class' => '\kartik\grid\CheckboxColumn'],
            //'id:text:Карта',
            'description:raw:Описание',
            'columns' => [
                'attribute' => 'amount',
                'label' => 'Сумма',
                'format' => 'raw',
                'contentOptions' =>function ($model, $key, $index, $column){
                    if ($model->transactiontype_id == 1) {
                        return ['class' => 'danger'];
                    }
                    else {
                        return ['class' => 'success'];
                    }
                },
                'value' => function ($model, $index, $widget) {
                        $sign = $model->transactiontype_id == 1 ? '-' : '+';
                        return $sign . ' ' . $model->amount;
                    }
                ],
            [
                'attribute' => 'trdate',
                'label' => 'Дата',
                'value' => function($model, $index, $widget) {
                    $date = new DateTime($model->trdate);
                    return  $date->format("d-M");// $tagsStr;                    
                },
            ],
            'card.name:raw:Карта',
            //'transactiontype.name:raw:Тип',
            [
                'attribute' => 'transactionTags',
                'label' => 'Теги',
                'value' => function($model, $index, $widget) {
                    if (count($model->transactionTags)) {
                        $tagsStr = '';
                        foreach ($model->transactionTags as $tag) {
                            $tagsStr .= $tag->getIdTag()->one()->name . '; ';
                        }
                        return $tagsStr;                    
                    }
                },
            ],
            [
                'class' => ActionColumn::className(),
                'controller' => 'transactions/default'
            ],
            //''
        ],
        //'resizableColumns' => true,
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => $this->title,
            'before' => ButtonAjax::widget([
				            'name'=>'Создать',
				            'route'=>['/transactions/default/create'],
				            'modalId'=>'#main-modal',
				            'modalContent'=>'#main-content-modal',
				            'options'=>[
				                'class'=>'btn btn-success',
				                'title'=>'Добавить новую транзакцию',
				            ]
        				]),
        ],
		]);
?>

    <?php Pjax::end(); ?>

</div>
