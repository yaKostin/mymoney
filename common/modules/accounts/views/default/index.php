<?php
use kartik\grid\GridView;
use prawee\widgets\ButtonAjax;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
?>
<div class="accounts-default-index container-fluid">
    <?php
        Modal::begin([
                'id' => 'add-account-modal',
                'size' => 'modal-md',
            ]);

        echo '<div id="add-account-content-modal"></div>';
        
        Modal::end();
    ?>
    <div class="row">
        <div class="col-md-1"> <h3> Счета </h3></div>
        <a href="/accounts/default/change"> 
            <div class="col-md-1 pull-right"> <h3> Изменить </h3> </div>
        </a>
    </div>

    <?php Pjax::begin(['id' => 'accounts-grid']); ?>

        <?= GridView::widget([
            'dataProvider' => $cardsDataProvider,
            'export' => false,
            'rowOptions' => function ($model, $key, $index, $grid) {
                return ['id' => $model['id'], 'onclick' => ' location.href = "/site/account?id=" + this.id', 'style' => 'cursor: pointer;' ];
            },  
            'columns' => [
                'name:raw',
                'amount:raw'
            ],
            'pjax' => true,
            'pjaxSettings'=>[
                'neverTimeout'=>true,
            ],
            'condensed' => false,
            'responsive' => true,   
            'hover' => true,
            ]);
        ?>

    <?php Pjax::end(); ?>

    <?= ButtonAjax::widget([
            'name'=>'Добавить',
            'route'=>['/accounts/default/create'],
            'modalId'=>'#add-account-modal',
            'modalContent'=>'#add-account-content-modal',
            'options'=>[
                'class'=>'btn btn-success btn-block',
            ]
        ]);
    ?>
</div>
