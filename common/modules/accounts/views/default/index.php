<?php
use prawee\widgets\ButtonAjax;
use yii\bootstrap\Modal;
?>
<div class="accounts-default-index">
    <?php
        Modal::begin([
                'id' => 'add-account-modal',
                'size' => 'modal-lg',
            ]);

        echo '<div id="add-account-modal-content"></div>';
        
        Modal::end();
    ?>
    <div class="row">
        <div class="col-sm-1"> Счета </div>
        <div class="pull-right"> Изменить </div>
    </div>
    <?php foreach ($cards as $card): ?>
        <div class="row">
            <div class="col-sm-1"> <?= $card->bank->name ?> </div>
            <div class="col-sm-1 pull-right"> <?= $card->amount ?> </div>
        </div>
    <?php endforeach; ?>
    <?= ButtonAjax::widget([
            'name'=>'Создать',
            'route'=>['/accounts/default/create'],
            'modalId'=>'#add-account-modal',
            'modalContent'=>'#add-account-modal-content',
            'options'=>[
                'class'=>'btn btn-success',
                'title'=>'Button for create application',
            ]
        ]);
    ?>
</div>
