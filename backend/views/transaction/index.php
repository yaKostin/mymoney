<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

    <p>
        <?= Html::a('Create Transaction', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php 
        echo ButtonAjax::widget([
            'name'=>'Create',
            'route'=>['create'],
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

    <?php Pjax::begin(['id' => 'main-grid']); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'card_id',
            'transactiontype_id',
            'trdate',
            'desciption',
            // 'amount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
