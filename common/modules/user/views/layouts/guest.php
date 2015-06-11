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
		<div class="news-feed">
			<div class="news-image">
				<img src="http://seantheme.com/color-admin-v1.7/admin/html/assets/img/login-bg/bg-8.jpg" class="faded">
			</div>
		</div>
	    <div id="page-wrapper" style="float:right; width:500px; height:100%; ">
	    	<?= $content ?>
	    </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
