<?php
use common\modules\transactions\widgets\TransactionsWidget;

$this->title = $tag->name;
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> <p class="text-capitalize"> <?= $tag->name ?> </p> </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
		<div class="col-lg-4 col-md-6">
            <div class="panel panel-yellow">
            	<a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Лимит</span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-minus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-center">		
                            <div class="huge">+ <?= $tagStats->limit ?></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		<div class="col-lg-4 col-md-6">
            <div class="panel panel-red">
            	<a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Расходы</span>
                        <div class="clearfix"></div>
                    </div>
                </a>
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-minus fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-center">		
                            <div class="huge">- <?= $tagStats->expense ?></div>
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
                            <div class="huge">+ <?= $tagStats->income ?></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>

	</div>

<?= TransactionsWidget::widget(['transactionsDataProvider' => $transactionsDataProvider]) ?>