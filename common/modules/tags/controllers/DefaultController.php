<?php

namespace common\modules\tags\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

use common\modules\tags\models\Tag;

class DefaultController extends Controller
{
    public function actionIndex()
    {
    	$tagsDataProvider = new ActiveDataProvider([
            'query' => Tag::find(),
            'sort' => [
                'attributes' => [
                    'name',
                    ]
                ]
        ]);

    	if (Yii::$app->request->isAjax) {
        	return $this->renderAjax('index', [
        		'tagsDataProvider' => $tagsDataProvider,
        		]);
        }
        else {
        	return $this->render('index', [
        		'tagsDataProvider' => $tagsDataProvider,
        		]);
        }
    }
}
