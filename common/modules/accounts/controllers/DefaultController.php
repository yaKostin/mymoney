<?php

namespace common\modules\accounts\controllers;
use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\modules\accounts\models\Card;
use common\modules\accounts\models\Bank;
use common\models\Currency;
use common\models\Cardtype;

class DefaultController extends Controller
{

    public function actionIndex()
    {
    	$user_id = Yii::$app->user->identity->id;
    	$cards = Card::find()->where(['user_id' => $user_id])->all();
    	$cardsDataProvider = new ActiveDataProvider([
            'query' => Card::find()->where(['user_id' => $user_id])->orderBy(['name' => SORT_ASC]),
            'sort' => [
                'attributes' => [
                    'amount',
                    'name'
                    ]
                ]
        ]);
    	if (Yii::$app->request->isAjax) {
        	return $this->renderAjax('index', [
        		'cards' => $cards,
        		'cardsDataProvider' => $cardsDataProvider
        		]);
        }
        else {
        	return $this->render('index', [
        		'cards' => $cards,
        		'cardsDataProvider' => $cardsDataProvider
        		]);
        }
    }

    public function actionCreate()
    {
        $card = new Card();
        $banks = Bank::find()->orderBy(['name' => SORT_ASC])->All();
        $currencies = Currency::find()->orderBy(['name' => SORT_ASC])->All();
        $cardtypes = Cardtype::find()->orderBy(['name' => SORT_ASC])->All();

        if ($card->load(Yii::$app->request->post())) {
            $card->user_id =  Yii::$app->user->identity->id;
            if ($card->save()) {
                echo 1;
            }
            else {	
                echo 0;
            }
        }
        else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('create', [
                        'card' => $card,
                        'banks' => $banks,
                        'currencies' => $currencies,
                        'cardtypes' => $cardtypes
                    ]); 
            }
            else {
                return $this->render('create', [
                        'card' => $card,
                        'banks' => $banks,
                        'currencies' => $currencies,
                        'cardtypes' => $cardtypes
                    ]);    
            }
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
        //$this->findModel($id)->delete();

          echo 'ok';
            exit;
    }
}
