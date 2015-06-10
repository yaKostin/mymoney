<?php

namespace common\modules\transactions\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\modules\transactions\models\Transaction;
use common\modules\tags\models\Tag;
use common\modules\user\models\User;


class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new Transaction();
        $user_id = Yii::$app->user->identity->id;
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
            $tagArray = Tag::getUsersTags($user_id)->orderBy(['name' => SORT_ASC])->All();
            return $this->renderAjax('create', [
                    'model' => $model,
                    'transactiontypeArray' => $transactiontypeArray,
                    'cardArray' => $cardArray,
                    'tagArray' => $tagArray,
                ]); 
        }
    }

    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/site/dashboard']);        
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
