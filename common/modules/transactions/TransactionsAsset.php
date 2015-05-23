<?php

namespace common\modules\transactions;

use yii\web\AssetBundle;

/**
 * Module asset bundle.
 */
class TransactionsAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@common/modules/transactions/assets';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/transactions.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        //'yii\web\JqueryAsset',
        //'yii\web\YiiAsset'
    ];
}
