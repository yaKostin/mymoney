<?php

namespace common\modules\accounts\models;

use Yii;

/**
 * This is the model class for table "card".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $cardtype_id
 * @property string $amount
 * @property integer $currency_id
 * @property integer $bank_id
 * @property string $name
 *
 * @property Bank $bank
 * @property Cardtype $cardtype
 * @property Currency $currency
 * @property User $user
 * @property CardStats[] $cardStats 
 * @property Transaction[] $transactions
 */
class Card extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'cardtype_id', 'amount', 'bank_id'], 'required'],
            [['user_id', 'cardtype_id', 'currency_id', 'bank_id'], 'integer'],
            [['amount'], 'number'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'cardtype_id' => 'Тип',
            'amount' => 'Баланс',
            'currency_id' => 'Валюта',
            'bank_id' => 'Банк',
            'name' => 'Название',
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
    public function getCardtype()
    {
        return $this->hasOne(Cardtype::className(), ['id' => 'cardtype_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getCardStats() 
    { 
        return $this->hasOne(CardStats::className(), ['card_id' => 'id']); 
    } 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['card_id' => 'id']);
    }
}
