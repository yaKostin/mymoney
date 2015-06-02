<?php

namespace common\modules\accounts;

use yii\web\AssetBundle;

/**
 * Module asset bundle.
 */
class AccountsAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@common/modules/accounts/assets';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/accounts.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        //'yii\web\JqueryAsset',
        //'yii\web\YiiAsset'
    ];
}
