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
		<div class="col-md-4">
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
		
		<div class="col-md-4 ">
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

		<div class="col-md-4 ">
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
    	<div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"> </i>
                    Расходы по картам
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php if (count($cardsExpenseChartConfig['data']) == 0): ?>
                                <h1>Нет расходов</h1>
                            <?php else: ?>
                                <?= ChartJs::widget($cardsExpenseChartConfig) ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-xs-1">
                            <div id="chartLegend_w0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"> </i>
                    Расходы по тегам
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php if (count($incomeChartConfig['data']) == 0): ?>
                                <h1>Нет расходов</h1>
                            <?php else: ?>
                                <?= ChartJs::widget($expenseChartConfig) ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-xs-1">
                            <div id="chartLegend_w1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?= TransactionsWidget::widget(['transactionsDataProvider' => $transactionsDataProvider]) ?>