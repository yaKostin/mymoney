<?php
use yii\helpers\Html;
use yii\bootstrap\Carousel;
//use kartik\grid\GridView;
//use common\components\transactions\TransactionsWidget;
use common\modules\transactions\widgets\TransactionsWidget;
use yii\grid\GridView;
use common\modules\transactions;

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

	<!-- Generate a bootstrap responsive striped table with row highlighted on hover -->



	<?= TransactionsWidget::widget(['model' => $transactionsModel]) ?>