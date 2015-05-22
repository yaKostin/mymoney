<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TransactionTags */

$this->title = 'Update Transaction Tags: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transaction Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaction-tags-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
