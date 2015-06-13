<?php

use yii\helpers\Html;
use yii\grid\GridView;

use prawee\widgets\ButtonAjax;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="tags-default-index container-fluid">

    <?php
        Modal::begin([
                'id' => 'add-reminder-modal',
                'size' => 'modal-md',
            ]);

        echo '<div id="add-reminder-content-modal"></div>';
        
        Modal::end();
    ?>
    <div class="row">
        <div class="col-md-1"> <h3> Напоминания </h3></div>
    </div>

    <?php Pjax::begin(['id' => 'reminders-grid']); ?>

    <?= GridView::widget([
        'dataProvider' => $reminderDataProvider,
        'columns' => [
            'text',
            [
                'attribute' => 'duedate',
                'value' => function($model, $index, $widget) {
                    $nowDateTime = new DateTime();
                    $dueDateTime = new DateTime($model->duedate);
                    $remainsDateTime = $nowDateTime->diff($dueDateTime);
                    $remainsMonths = $remainsDateTime->m ? $remainsDateTime->m . ' месяцев ' : '';
                    $remainsDays = $remainsDateTime->d . ' дней';
                    return $remainsMonths . $remainsDays;                    
                },
            ],
            // 'repeatcount',
            // 'sendemail:email',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    <?= ButtonAjax::widget([
            'name' => 'Добавить',
            'route' => ['/reminders/default/create'],
            'modalId' => '#add-reminder-modal',
            'modalContent' => '#add-reminder-content-modal',
            'options' => [
                'class' => 'btn btn-success btn-block',
            ]
        ]);
    ?>

    <a href="/site/reminders" class="btn btn-success btn-block">Календарь</a>
    
</div>
