<?php
use yii\helpers\Html;
?>

<div class="login-cover-image">
    <?= Html::img('@web/img/bg-guest-404.jpg', ['class'=>'faded']); ?>
</div>

<div class="site-index">
    <div class="jumbotron">
        <h1 style="font-weight: bold"> <?= nl2br(Html::encode($message)) ?> </h1>
        
        <p><a class="btn btn-lg btn-success" href="/">На главную</a></p>
    </div>
</div>