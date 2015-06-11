<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="login-cover-image">
        <img src="http://seantheme.com/color-admin-v1.7/admin/html/assets/img/login-bg/bg-5.jpg" class="faded">
    </div>
    <div class="wrapper">
        <div class="contaner" style="z-index: 100">
            <?= $content ?>
        </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
