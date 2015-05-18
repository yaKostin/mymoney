<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Repeattype */

$this->title = 'Create Repeattype';
$this->params['breadcrumbs'][] = ['label' => 'Repeattypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repeattype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
