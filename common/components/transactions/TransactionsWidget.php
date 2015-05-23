<?php 

namespace common\components\transactions;
use common\components\transactions\models\TransactionsModel;
use yii\base\Widget;
use yii\helpers\Html;

class TransactionsWidget extends Widget
{
    public $model;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('index', [
                'model' => $this->model,
            ]);
    }
}