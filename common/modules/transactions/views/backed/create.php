<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Transaction */

?>
<div class="transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderPartial('_form', [
        'model' => $model,
    ]) ?>

</div>
