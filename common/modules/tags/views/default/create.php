<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\tags\models\Tag */

$this->title = 'Добавить тег';
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
