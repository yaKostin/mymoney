<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use prawee\widgets\ButtonAjax;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
	    'dataProvider' => $model->dataProvider,
	    //'filterModel' => $model->$searchModel,
	    //'columns' => $model->gridColumns,
	    'export' => false,
	    'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['customer/index'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
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
