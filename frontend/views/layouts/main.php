<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */

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
  
    <div id="wrapper">
    <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><i class="fa fa-eur fa-fw"></i> MyMoney</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="/user/profile"><i class="fa fa-user fa-fw"></i> Профиль</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <?php if (Yii::$app->user->isGuest): ?> 
                                <a href="/user/default/login" data-method="post"><i class="fa fa-sign-out fa-fw"></i> Login</a>
                            <?php else: ?>
                                <a href="/user/default/logout" data-method="post"><i class="fa fa-sign-out fa-fw"></i> Выход</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">

                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       
                        <li>
                            <a href="/site/dashboard"><i class="fa fa-dashboard fa-fw"></i> Инфо<span class="pull-right"><i class="fa fa-angle-right"></i></span></a>
                        </li>
                        <li>
                            <a href="/site/reports"><i class="fa fa-bar-chart-o fa-fw"></i> Отчеты<span class="pull-right"><i class="fa fa-angle-right"></i></span></a>
                        </li>
                        <li>
                            <div id="cards" class='sidebar-element-linked container-fluid' data-url="/accounts"> 
                                <i class="fa fa-edit fa-fw"></i> Счета<span class="pull-right"><i class="fa fa-angle-right"></i></span>
                            </div>
                        </li>
                        <li>
                            <div id="reminders" class='sidebar-element-linked container-fluid' data-url="/reminders"> 
                                <i class="fa fa-calendar fa-fw"></i> Напоминания<span class="pull-right"><i class="fa fa-angle-right"></i></span>
                            </div>
                        </li>
                        <li>
                            <div id="tags" class='sidebar-element-linked container-fluid' data-url="/tags"> 
                                <i class="fa fa-tags fa-fw"></i> Теги<span class="pull-right"><i class="fa fa-angle-right"></i></span>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
                <div id="sidebar-content-panel"> </div>   
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        
        <div id="page-wrapper" style="padding-top: 50px">
            <div id="sidebar-content-panel"> </div>   
            <?= $content ?>
        </div>
        <!-- /#page-wrapper -->
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; Костин Ярослав <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>