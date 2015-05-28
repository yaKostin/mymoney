<?php

namespace common\modules\accounts\controllers;
use Yii;
use yii\web\Controller;
use common\modules\accounts\models\Card;

class DefaultController extends Controller
{

    public function actionIndex()
    {
    	$user_id = Yii::$app->user->identity->id;
    	$cards = Card::find()->where(['user_id' => $user_id])->all();
    	if (Yii::$app->request->isAjax) {
        	return $this->renderAjax('index', [
        		'cards' => $cards
        		]);
        }
        else {
        	return $this->render('index', [
        		'cards' => $cards
        		]);
        }
    }

    public function actionCreate()
    {
        $card = new Card();

        if ($card->load(Yii::$app->request->post())) {
            if ($card->save()) {
                echo 1;
            }
            else {	
                echo 0;
            }
        } else {
            return $this->renderAjax('create', [
                    'card' => $card
                ]); 
        }
    }
}
