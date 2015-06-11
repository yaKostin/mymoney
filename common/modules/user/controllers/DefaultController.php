<?php

namespace common\modules\user\controllers;

use Yii;

use common\modules\user\models\LoginForm;
use common\modules\user\models\PasswordResetRequestForm;
use common\modules\user\models\ResetPasswordForm;
use common\modules\user\models\SignupForm;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login', 'signup', 'reset-password', 'request-password-reset'],
                'rules' => [
                    [
                        'actions' => ['signup', 'login', 'request-password-reset', 'reset-password',],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'request-password-reset', 'reset-password', ],
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

    public function actionSignup()
    {
        $this->layout = 'guest.php';
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

    public function actionLogin()
    {   
        $this->layout = 'guest.php';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/');// $this->goHome();
    }

    public function actionRequestPasswordReset()
    {
        $this->layout = "guest.php";
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Проверьте почтовый ящик для дальнейших инструкций.');
                //return $this->goHome();
                return $this->redirect('/');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Извините, мы не можем отправить письмо.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'Новый пароль был сохранен.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
