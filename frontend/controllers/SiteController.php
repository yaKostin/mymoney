<?php
namespace frontend\controllers;

use Yii;

use common\components\transactions\models\TransactionsModel;

use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\DashboardModel;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

use common\models\Bank;
use common\models\Transaction;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDashboard()
    {
        $model = new DashboardModel();
        $banks = Bank::find()->orderBy('name')->all();
        $model->dataProvider = new ActiveDataProvider([
            'query' => Bank::find()->orderBy('name'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $model->transactions = new ActiveDataProvider([
            'query' => Transaction::find()->where(['card_id' => 1]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $transactionsModel = new TransactionsModel();
        $transactionsModel->dataProvider = $model->transactions;
        $transactionsModel->title = "Транзакции";

        $model->gridColumns = [
            'name:text:Название'
        ];
        return $this->render('dashboard', [
                'model' => $model,
                'banks' => $banks,
                'transactionsModel' => $transactionsModel,
            ]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

  
}
