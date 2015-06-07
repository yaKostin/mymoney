<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [ 
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'main' => [
            'class' => 'common\modules\main\Module',
        ],
        'transactions' => [
            'class' => 'common\modules\transactions\Module',
        ],
        'tags' => [
            'class' => 'common\modules\tags\Module',
        ],
        'reminders' => [
            'class' => 'common\modules\reminders\Module',
        ],
    ],
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
