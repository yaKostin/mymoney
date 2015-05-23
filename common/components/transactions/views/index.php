<?php 
use yii\helpers\Html;
use yii\bootstrap\Button;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use prawee\widgets\ButtonAjax;
?>
<div class="row">
	<div class="col-md-4"><h3> <?= $model->title ?></h3></div>
</div>

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
            'before' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('app', ' Добавить транзакцию'), ['value' => Url::to("index.php?r=transactions/default/create"), 'id' => 'modalBtn', 'class' => 'btn btn-success']),
        ],
		]);
?>
<?php Pjax::end(); ?>
<?php 
    echo ButtonAjax::widget([
        'name'=>'Create',
        'route'=>['?r=transaction/create'],
        'modalId'=>'#main-modal',
        'modalContent'=>'#main-content-modal',
        'options'=>[
            'class'=>'btn btn-success',
            'title'=>'Button for create application',
        ]
    ]);
?>

<?php
    Modal::begin(['id'=>'main-modal']);
    echo '<div id="main-content-modal"></div>';
    Modal::end();
?>