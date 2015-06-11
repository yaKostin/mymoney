<?php
use yii\helpers\Html;
use yii\bootstrap\Carousel;
//use common\components\transactions\TransactionsWidget;
use common\modules\transactions\widgets\TransactionsWidget;
use common\modules\transactions;
use dosamigos\chartjs\ChartJs;

use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\bootstrap\Panel;
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Общие сведения</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
	<div class="row">
		<div class="col-lg-4 col-md-6">
            <div class="panel panel-yellow">
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
                            <i class="fa fa-minus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-center">		
                            <div class="huge">- <?= $budget->expense ?></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>

		<div class="col-lg-4 col-md-6">
            <div class="panel panel-green">
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
                            <div class="huge">+ <?= $budget->income ?></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>

	<div class="row">
    	<div class="col-lg-4">
            <?= lagman\bootstrap\Panel::widget([
                'type' => 'warning',
                'header' => '<i class="fa fa-bar-chart-o fa-fw"> </i>
                        Затраты по тегам',
                'content' => ChartJs::widget($expenseChartConfig),
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= lagman\bootstrap\Panel::widget([
                'type' => 'danger',
                'header' => '<i class="fa fa-bar-chart-o fa-fw"> </i>
                        Затраты по тегам',
                'content' => ChartJs::widget($expenseChartConfig),
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= lagman\bootstrap\Panel::widget([
                'type' => 'success',
                'header' => '<i class="fa fa-bar-chart-o fa-fw"> </i>
                        Поступления по тегам',
                'content' => ChartJs::widget($expenseChartConfig),
            ]) ?>
        </div>
    </div>
	<?= TransactionsWidget::widget(['transactionsDataProvider' => $transactionsDataProvider]) ?>