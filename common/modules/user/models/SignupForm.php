<?php
namespace common\modules\user\models;
          
use Yii;
//use common\modules\user\models\User;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Адрес почты',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\modules\user\models\User', 'message' => 'Это имя уже занято, попробуйте другое.'],
            ['username', 'string', 'min' => 2, 'max' => 32],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\modules\user\models\User', 'message' => 'Этот адрес уже зарегистрирован, попробуйте другой.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 32],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
