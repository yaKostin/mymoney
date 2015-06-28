<?php
namespace frontend\controllers;

use Yii;

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
        if ( !is_object($tag) ) {
            return $this->redirect('/');
        }
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
        if ( !is_object($card) ) {
            return $this->redirect('/');
        }
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
        $chartWidth = 250;
        $chartHeight = 250;
        $cards = Yii::$app->user->identity->getCardArray();
        $cardsExpense = [];
        $cardsIncome = [];
        $cardsExpenseDataSets = [];
        foreach ($cards as $card) {
            $cardStats = $card->getCardStats()->one();
            $color = $this->rand_color();
            $cardsExpenseDataSets[] = [
                'value' => $cardStats->expense,
                'color' => $color,
                'label' => $card->name,
            ];
        }
        $cardsExpenseChartConfig = [
            'type' => 'Doughnut',
            'options' => [
                'width' => $chartWidth,
                'height' => $chartHeight,
            ], 
            'data' => $cardsExpenseDataSets,
        ];

        return $this->render('account', [
                'transactionsDataProvider' => $transactionsDataProvider,
                //'expenseChartConfig' => $expenseChartConfig,
                //'incomeChartConfig' => $incomeChartConfig,
                'card' => $card,
            ]);
    }

    function rand_color() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

    public function actionReports() 
    {
        $user_id = Yii::$app->user->identity->id;
        $budget = Budget::find()->where(['user_id' => $user_id])->one();

        $tags = Tag::getUsersTags($user_id)->All();

        $expenseDatasets = [];
        $incomeDatasets = [];
        $sumExpenseByTags = 0;
        $sumIncomeByTags = 0;
        for ($i = 0; $i < count($tags); $i++) { 
            $tagStats = $tags[$i]->getTagStats()->one();
            if (is_object($tagStats)) {
                $color = $this->rand_color();
                if ($tagStats->expense > 1) {
                    $expenseDatasets[] = [
                        'value' => $tagStats->expense,
                        'color' => $color,
                        'label' => $tagStats->tag->name
                    ];
                }
                if ($tagStats->income > 1) {
                    $incomeDatasets[] = [
                        'value' => $tagStats->income,  
                        'color' => $color,
                        'label' => $tagStats->tag->name
                    ];
                }
                $sumExpenseByTags += $tagStats->expense;
                $sumIncomeByTags += $tagStats->income;
            }
        }
        if ($budget->expense > $sumExpenseByTags ) {
            $expenseDatasets[] = [
                'value' => $budget->expense - $sumExpenseByTags,
                'color' => 'green',
                'label' => 'без тегов'
            ];
        }
        if ($budget->income > $sumIncomeByTags ) {
            $incomeDatasets[] = [  
                'value' => $budget->income - $sumIncomeByTags,
                'color' => 'green',
                'label' => 'без тегов'
            ];
        }
        $chartWidth = 250;
        $chartHeight = 250;
        $expenseChartConfig = [
            'type' => 'Doughnut',
            'options' => [
                'width' => $chartWidth,
                'height' => $chartHeight,
            ],
            'data' => $expenseDatasets,
        ];
        $incomeChartConfig = [
            'type' => 'Doughnut',
            'options' => [
                'width' => $chartWidth,
                'height' => $chartHeight,
            ],
            'data' => $incomeDatasets,
        ];

        $cards = Yii::$app->user->identity->getCardArray();
        $cardsExpense = [];
        $cardsIncome = [];
        $cardsExpenseDataSets = [];
        $cardsIncomeDataSets = [];
        foreach ($cards as $card) {
            $cardStats = $card->getCardStats()->one();
            $color = $this->rand_color();
            $cardsExpenseDataSets[] = [
                'value' => $cardStats->expense,
                'color' => $color,
                'label' => $card->name,
            ];
            $cardsIncomeDataSets[] = [
                'value' => $cardStats->income,
                'color' => $color,
                'label' => $card->name,
            ];
        }
        $cardsExpenseChartConfig = [
            'type' => 'Doughnut',
            'options' => [
                'width' => $chartWidth,
                'height' => $chartHeight,
            ], 
            'data' => $cardsExpenseDataSets,
        ];
        $cardsIncomeChartConfig = [
            'type' => 'Doughnut',
            'options' => [
                'width' => $chartWidth,
                'height' => $chartHeight,
            ], 
            'data' => $cardsIncomeDataSets,
        ];

        $cardsExpeseCountDataSets = [];
        $cardsIncomeCountDataSets = [];
        foreach ($cards as $card) {
            $cardStats = $card->getCardStats()->one();
            $color = $this->rand_color();
            $cardsExpeseCountDataSets[] = [
                'value' => $cardStats->expense_count,
                'color' => $color,
                'label' => $card->name,
            ];
            $cardsIncomeCountDataSets[] = [
                'value' => $cardStats->income_count,
                'color' => $color,
                'label' => $card->name,
            ];
        }
        $cardsExpenseCountChartConfig = [
            'type' => 'Doughnut',
            'options' => [
                'width' => $chartWidth,
                'height' => $chartHeight,
            ], 
            'data' => $cardsExpeseCountDataSets,
        ];
        $cardsIncomeCountChartConfig = [
            'type' => 'Doughnut',
            'options' => [
                'width' => $chartWidth,
                'height' => $chartHeight,
            ], 
            'data' => $cardsIncomeCountDataSets,
        ];
        return $this->render('reports', [
                'budget' => $budget,
                'data' => $expenseDatasets,
                'expenseChartConfig' => $expenseChartConfig,
                'incomeChartConfig' => $incomeChartConfig,
                'cardsExpenseChartConfig' => $cardsExpenseChartConfig,
                'cardsIncomeChartConfig' => $cardsIncomeChartConfig,
                'cardsExpenseCountChartConfig' => $cardsExpenseCountChartConfig,
                'cardsIncomeCountChartConfig' => $cardsIncomeCountChartConfig,
            ]);
    }

    public function actionDashboard()
    {
        $user_id = Yii::$app->user->identity->id;
        $budget = Budget::find()->where(['user_id' => $user_id])->one();
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
        $incomeDatasets = [];
        $sumExpenseByTags = 0;
        $sumIncomeByTags = 0;
        for ($i = 0; $i < count($tags); $i++) { 
            $tagStats = $tags[$i]->getTagStats()->one();
            if (is_object($tagStats)) {
                $color = $this->rand_color();
                if ($tagStats->expense > 1) {
                    $expenseDatasets[] = [
                        'value' => $tagStats->expense,
                        'color' => $color,
                        'label' => $tagStats->tag->name
                    ];
                }
                if ($tagStats->income > 1) {
                    $incomeDatasets[] = [
                        'value' => $tagStats->income,  
                        'color' => $color,
                        'label' => $tagStats->tag->name
                    ];
                }
                $sumExpenseByTags += $tagStats->expense;
                $sumIncomeByTags += $tagStats->income;
            }
        }
        if ($budget->expense > $sumExpenseByTags ) {
            $expenseDatasets[] = [
                'value' => $budget->expense - $sumExpenseByTags,
                'color' => 'green',
                'label' => 'без тегов'
            ];
        }
        if ($budget->income > $sumIncomeByTags ) {
            $incomeDatasets[] = [  
                'value' => $budget->income - $sumIncomeByTags,
                'color' => 'green',
                'label' => 'без тегов'
            ];
        }
        $chartWidth = 250;
        $chartHeight = 250;
        $expenseChartConfig = [
            'type' => 'Doughnut',
            'options' => [
                'width' => $chartWidth,
                'height' => $chartHeight,
            ],
            'data' => $expenseDatasets,
        ];
        $incomeChartConfig = [
            'type' => 'Doughnut',
            'options' => [
                'width' => $chartWidth,
                'height' => $chartHeight,
            ],
            'data' => $incomeDatasets,
        ];

        $cards = Yii::$app->user->identity->getCardArray();
        $cardsExpense = [];
        $cardsIncome = [];
        $cardsExpenseDataSets = [];
        foreach ($cards as $card) {
            $cardStats = $card->getCardStats()->one();
            $color = $this->rand_color();
            $cardsExpenseDataSets[] = [
                'value' => $cardStats->expense,
                'color' => $color,
                'label' => $card->name,
            ];
        }
        $cardsExpenseChartConfig = [
            'type' => 'Doughnut',
            'options' => [
                'width' => $chartWidth,
                'height' => $chartHeight,
            ], 
            'data' => $cardsExpenseDataSets,
        ];

        $cardsExpeseCount = [];
        $cardsIncomeCount = [];
        //$cards
        
        return $this->render('dashboard', [
                'transactionsDataProvider' => $transactionsDataProvider,
                'budget' => $budget,
                'data' => $expenseDatasets,
                'expenseChartConfig' => $expenseChartConfig,
                'incomeChartConfig' => $incomeChartConfig,
                'cardsExpenseChartConfig' => $cardsExpenseChartConfig,
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