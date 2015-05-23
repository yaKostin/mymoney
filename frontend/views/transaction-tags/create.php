<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TransactionTags */

$this->title = 'Create Transaction Tags';
$this->params['breadcrumbs'][] = ['label' => 'Transaction Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-tags-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
