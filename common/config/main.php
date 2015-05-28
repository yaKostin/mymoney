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
        'language'=>'ru',
        'sourceLanguage'=>'ru',
    ],
    'language'=>'ru',
    'sourceLanguage'=>'ru',
];
