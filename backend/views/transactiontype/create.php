<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Transactiontype */

$this->title = 'Create Transactiontype';
$this->params['breadcrumbs'][] = ['label' => 'Transactiontypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactiontype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
