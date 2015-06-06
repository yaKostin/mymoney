<?php
use kartik\grid\GridView;
use prawee\widgets\ButtonAjax;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
?>
<div class="tags-default-index container-fluid">
    <?php
        Modal::begin([
                'id' => 'add-tag-modal',
                'size' => 'modal-md',
            ]);

        echo '<div id="add-tag-content-modal"></div>';
        
        Modal::end();
    ?>
    <div class="row">
        <div class="col-md-1"> <h3> Теги </h3></div>
        <a href="/tags/default/change"> 
            <div class="col-md-1 pull-right"> <h3> Изменить </h3> </div>
        </a>
    </div>

    <?php Pjax::begin(['id' => 'tags-grid']); ?>

        <?= GridView::widget([
            'dataProvider' => $tagsDataProvider,
            'export' => false,
            'rowOptions' => function ($model, $key, $index, $grid) {
                return ['id' => $model['id'], 'onclick' => ' location.href = "index.php?r=site/tag&id=" + this.id', 'style' => 'cursor: pointer;' ];
            },  
            'columns' => [
                'name:raw',
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
            'route'=>['/tags/default/create'],
            'modalId'=>'#add-tag-modal',
            'modalContent'=>'#add-tag-content-modal',
            'options'=>[
                'class'=>'btn btn-success btn-block',
            ]
        ]);
    ?>
</div>
