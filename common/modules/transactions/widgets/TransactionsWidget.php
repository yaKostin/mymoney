<?php 

namespace common\modules\transactions\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class TransactionsWidget extends Widget
{
    public $transactionsDataProvider;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('index', [
                'transactionsDataProvider' => $this->transactionsDataProvider
            ]);
    }
}