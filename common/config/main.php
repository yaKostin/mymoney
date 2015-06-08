<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [ 
        'main' => [
            'class' => 'common\modules\main\Module',
        ],
        'user' => [
            'class' => 'common\modules\user\Module',
        ],
        'accounts' => [
            'class' => 'common\modules\accounts\Module',
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'common\modules\user\models\User',
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // стандартное правило для обработки '/' как 'site/index'
                
                
            ],
        ],
        'language'=>'ru',
        'sourceLanguage'=>'ru',
    ],
    'language'=>'ru',
    'sourceLanguage'=>'ru',
];
