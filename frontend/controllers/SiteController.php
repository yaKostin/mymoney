<?php
namespace frontend\controllers;

use Yii;

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
//use common\models\Transaction;
use common\modules\transactions\models\Transaction;
use common\modules\transactions\models\Card;
use common\modules\tags\models\Tag;
use common\models\Budget;

use common\modules\reminders\models\Reminder;
/**
 * Site controller
 */
class SiteController extends Controller
{
    //public $defaultAction = 'dashboard';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'dashboard', 'tag', 'reminders', 'account'],
                'rules' => [
                    [
                        'actions' => ['signup', 'index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'dashboard', 'tag', 'reminders', 'account'],
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

    public function actionLogin() 
    {
        return $this->redirect('/user/default/login');
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'guest.php';
            return $this->render('index');    
        } else {
            return $this->redirect('/site/dashboard');
        }
    }

    public function actionReminders()
    {
        $user_id = Yii::$app->user->identity->id;
        $reminders = Reminder::getUsersReminders($user_id)->all();
        $events = [];
        foreach($reminders as $reminder) {
            $Event = new \yii2fullcalendar\models\Event();
            $Event->id = $reminder->id;
            $Event->title = $reminder->text;
            $Event->start = date( $reminder->duedate );//date('Y-m-d\TH:m:s\Z');
            $events[] = $Event;
        }
        
        return $this->render('reminders', [
            'events' => $events,
            ]);
    }

    public function actionTag() 
    {
        $user_id = Yii::$app->user->identity->id;
        $tag_id = $_GET['id'];
        $tag = Tag::find()->where(['id' => $tag_id])->one();
        $tagStats = $tag->getTagStats()->one();
        $transactionsDataProvider = new ActiveDataProvider([
            'query' => Transaction::getUsersTransactionsByTag($user_id, $tag_id),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'amount',
                    'trdate'
                    ]
                ]
        ]);

        return $this->render('tag', [
                'transactionsDataProvider' => $transactionsDataProvider,
                'tag' => $tag,
                'tagStats' => $tagStats,
            ]);
    }


    public function actionAccount() 
    {
        $user_id = Yii::$app->user->identity->id;
        $card_id = $_GET['id'];
        $card = Card::find()->where(['id' => $card_id])->one();
        $transactionsDataProvider = new ActiveDataProvider([
            'query' => Transaction::find()->where(['card_id' => $card_id])->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'amount',
                    'trdate'
                    ]
                ]
        ]);

        return $this->render('account', [
                'transactionsDataProvider' => $transactionsDataProvider,
                'card' => $card,
            ]);
    }

    public function actionDashboard()
    {
        $color = [
            '#F7464A',
            '#46BFBD',
            '#FDB45C',
            '#F7464A',
            '#46BFBD',
            '#FDB45C',
            '#F7464A',
            '#46BFBD',
            '#FDB45C',
            '#46BFBD',
            '#FDB45C',
            '#F7464A',
        ];
        $user_id = Yii::$app->user->identity->id;
        $transactionsDataProvider = new ActiveDataProvider([
            'query' => Transaction::getUsersTransactions($user_id),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'amount',
                    'trdate'
                    ]
                ]
        ]);

        $tags = Tag::getUsersTags($user_id)->All();

        $expenseDatasets = [];
        for ($i = 0; $i < count($tags); $i++) { 
            $tagStats = $tags[$i]->getTagStats()->one();
            if (is_object($tagStats)) {
                $expenseDatasets[] = [
                    'value' => $tagStats->expense,
                    'color' => $color[$i],
                    'label' => $tagStats->tag->name
                ];
            }
        }

        $expenseChartConfig = [
            'type' => 'Doughnut',
            'options' => [
                'height' => 300,
                'width' => 300,
            ],
            'data' => $expenseDatasets,
        ];

        $budget = Budget::find()->where(['user_id' => $user_id])->one();
        return $this->render('dashboard', [
                'transactionsDataProvider' => $transactionsDataProvider,
                'budget' => $budget,
                'data' => $expenseDatasets,
                'expenseChartConfig' => $expenseChartConfig,
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
  
}
