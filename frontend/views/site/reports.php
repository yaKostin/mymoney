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
    	<div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"> </i>
                    Затраты по картам
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <?= ChartJs::widget($cardsExpenseChartConfig) ?>
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
                        <div class="col-xs-4">
                            <?= ChartJs::widget($cardsIncomeChartConfig) ?>
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
                        <div class="col-xs-4">
                            <?= ChartJs::widget($expenseChartConfig) ?>
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
                        <div class="col-xs-4">
                            <?= ChartJs::widget($incomeChartConfig) ?>
                        </div>
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
                        <div class="col-xs-4">
                            <?= ChartJs::widget($cardsExpenseCountChartConfig) ?>
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
                        <div class="col-xs-4">
                            <?= ChartJs::widget($cardsIncomeCountChartConfig) ?>
                        </div>
                        <div class="col-xs-1">
                            <div id="chartLegend_w5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>