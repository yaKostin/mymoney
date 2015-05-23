<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "merchant".
 *
 * @property integer $id
 * @property string $num
 * @property string $hashpass
 * @property integer $user_id
 * @property integer $bank_id
 *
 * @property Bank $bank
 * @property User $user
 */
class Merchant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'merchant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num', 'hashpass', 'user_id', 'bank_id'], 'required'],
            [['user_id', 'bank_id'], 'integer'],
            [['num'], 'string', 'max' => 32],
            [['hashpass'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num' => 'Num',
            'hashpass' => 'Hashpass',
            'user_id' => 'User ID',
            'bank_id' => 'Bank ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::className(), ['id' => 'bank_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
