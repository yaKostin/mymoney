<?php

namespace common\modules\reminders\models;

use Yii;

/**
 * This is the model class for table "reminder".
 *
 * @property integer $id
 * @property string $text
 * @property integer $user_id
 * @property string $duedate
 * @property integer $repeattype_id
 * @property integer $repeatcount
 * @property integer $sendemail
 *
 * @property Repeattype $repeattype
 * @property User $user
 */
class Reminder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reminder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'duedate', 'repeattype_id', 'repeatcount'], 'required'],
            [['user_id', 'repeattype_id', 'repeatcount', 'sendemail'], 'integer'],
            [['duedate'], 'safe'],
            [['text'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст',
            'user_id' => 'User ID',
            'duedate' => 'Дата',
            'repeattype_id' => 'Repeattype ID',
            'repeatcount' => 'Repeatcount',
            'sendemail' => 'Sendemail',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepeattype()
    {
        return $this->hasOne(Repeattype::className(), ['id' => 'repeattype_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
