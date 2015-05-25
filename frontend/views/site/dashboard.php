<?php
use yii\helpers\Html;
use yii\bootstrap\Carousel;
//use common\components\transactions\TransactionsWidget;
use common\modules\transactions\widgets\TransactionsWidget;
use common\modules\transactions;
use dosamigos\chartjs\ChartJs;
?>

	<div class="row">
		<div class="col-lg-4 col-md-6">
            <div class="panel panel-green">
            	<a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Баланс</span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-center">		
                            <div class="huge"><?= $budget->balance ?></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		
		<div class="col-lg-4 col-md-6">
            <div class="panel panel-red">
            	<a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Общие расходы</span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-center">		
                            <div class="huge"><?= $budget->expense ?></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>

		<div class="col-lg-4 col-md-6">
            <div class="panel panel-yellow">
            	<a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Поступления</span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-plus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-center">		
                            <div class="huge"><?= $budget->income ?></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>

	<div class="row">
	<div class="col-md-12">
	<?= ChartJs::widget([
    'type' => 'Doughnut',
    'options' => [
        'height' => 400,
        'width' => 400,
            //String - A legend template
    ],
    'data' => [
    	[
	        'value' => 300,
	        'color' => "#F7464A",
	        'highlight' => "#FF5A5E",
	        'label' => "Red"
    	],
	    [
	        'value' => 50,
	        'color' => "#46BFBD",
	        'highlight' => "#5AD3D1",
	        'label' => "Green"
	    ],
	    [
	        'value' => 100,
	        'color' => "#FDB45C",
	        'highlight' => "#FFC870",
	        'label' => "Yellow"
	    ]
]
]);
?>
</div>
</div>
	<?= TransactionsWidget::widget(['transactionsDataProvider' => $transactionsDataProvider]) ?>