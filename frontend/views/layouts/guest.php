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
    
    <div class="wrapper">
        <div class="contaner" style="z-index: 100">
            <?= $content ?>
        </div>
    </div>

    <footer class="footer" style="position: absolute; bottom: 0; width: 100%">
        <div class="container">
        <p class="pull-left">&copy; Костин Ярослав <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
