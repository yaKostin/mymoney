<?php
use common\modules\transactions\widgets\TransactionsWidget;

$this->title = $card->name;
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> <p class="text-capitalize"> <?= $card->name ?> </p> </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<?= TransactionsWidget::widget(['transactionsDataProvider' => $transactionsDataProvider]) ?>