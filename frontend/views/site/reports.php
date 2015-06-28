<?php
use yii\helpers\Html;
use dosamigos\chartjs\ChartJs;

use yii\web\JsExpression;
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Отчеты</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
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
		
		<div class="col-md-4">
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

		<div class="col-md-4">
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
                    Затраты по картам
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
                    Поступления по картам
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php if (count($cardsIncomeChartConfig['data']) == 0): ?>
                                <h1>Нет поступлений</h1>
                            <?php else: ?>
                                <?= ChartJs::widget($cardsIncomeChartConfig) ?>
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
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"> </i>
                    Затраты по тегам
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php if (count($expenseChartConfig['data']) == 0): ?>
                                <h1>Нет расходов с тегами</h1>
                            <?php else: ?>
                                <?= ChartJs::widget($expenseChartConfig) ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-xs-1">
                            <div id="chartLegend_w2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"> </i>
                    Поступления по тегам
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php if (count($incomeChartConfig['data']) == 0): ?>
                                <h1>Нет поступлений с тегами</h1>
                            <?php else: ?>
                                <div class="col-xs-6">
                                    <?= ChartJs::widget($incomeChartConfig) ?>
                                </div>
                            <?php endif; ?>
                        <div class="col-xs-1">
                            <div id="chartLegend_w3"></div>
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
                    Количество затрат по картам
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php if (count($cardsExpenseCountChartConfig['data']) == 0): ?>
                                <h1>Нет расходов</h1>
                            <?php else: ?>
                                <?= ChartJs::widget($cardsExpenseCountChartConfig) ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-xs-1">
                            <div id="chartLegend_w4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"> </i>
                    Количество поступлений по картам
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php if (count($cardsIncomeCountChartConfig['data']) == 0): ?>
                                <h1>Нет поступлений</h1>
                            <?php else: ?>
                                <?= ChartJs::widget($cardsIncomeCountChartConfig) ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-xs-1">
                            <div id="chartLegend_w5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>