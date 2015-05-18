<?php
use yii\helpers\Html;
use yii\bootstrap\Carousel;
//use kartik\grid\GridView;
use yii\grid\GridView;

?>

	<div class="row">
		<div class="col-md-12 danger">
		кличка 
		<?= Yii::$app->user->identity->username ?>
		<?= $banks[0]->name ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">100</div>
		<div class="col-md-3">444</div>
		<div class="col-md-3">444</div>
		<div class="col-md-3">44</div>
	</div>
	<?php echo Carousel::widget ( [
    'items' => [
        [
            'content' => '<img style="width:474px;height:296px" src="http://nix-tips.ru/wp-content/uploads/2014/11/carousel003.jpg"/>',
            'caption' => '<h2>Yii Gii</h2><p>Удобный встроенный генератор кода. Модули, модели на основе таблиц в БД и, конечно же, CRUD</p>',
            'options' => [ ]
        ],
 
        [
            'content' => '<img style="width:474px" src="http://nix-tips.ru/wp-content/uploads/2014/11/carousel002.jpg"/>',
            'caption' => '<h2>Отличный отладчик</h2><p>Легко подключается, помнит все запросы http, БД и логи</p>',
            'options' => [ ]
        ],
 
        [
            'content' => '<img style="width:474px" src="http://nix-tips.ru/wp-content/uploads/2014/11/carousel001.jpg"/>',
            'caption' => '<h2>Быстрый старт</h2><p>Установка и обновление через composer</p>',
            'options' => [ ]
        ]
    ],
    'options' => [
        'style' => 'width:474px;' // set the width of the container if you like
    ]
] ); 
?>
	<!-- Generate a bootstrap responsive striped table with row highlighted on hover -->
	<?php 
	echo GridView::widget([
		    'dataProvider' => $model->dataProvider,
		    //'filterModel' => $model->$searchModel,
		    'columns' => $model->gridColumns,
		    //'responsive'=>true,
		    //'export' => false,
		    //'hover'=>true
			]);
	?>

	<?php 
	echo GridView::widget([
			'dataProvider' => $model->transactions,
			]);
	?>