<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Card */
?>
<div class="card-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'card' => $card,
    ]) ?>

</div>
