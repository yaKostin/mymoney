<?php

namespace common\modules\transactions\controllers;

use Yii;
use yii\web\Controller;
use common\modules\transactions\models\Transaction;
use common\modules\user\models\User;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new Transaction();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                echo 1;
            }
            else {	
                echo 0;
            }
        } else {
            $transactiontypeArray = Transaction::getTransactiontypeArray();
            $cardArray = Yii::$app->user->identity->getCardArray();
            return $this->renderAjax('create', [
                    'model' => $model,
                    'transactiontypeArray' => $transactiontypeArray,
                    'cardArray' => $cardArray,
                ]); 
        }
    }
}
