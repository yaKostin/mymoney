<?php

namespace common\modules\transactions\models;

use Yii;
use common\modules\transactions\models\Transactiontype;
/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $card_id
 * @property integer $transactiontype_id
 * @property string $trdate
 * @property string $description
 * @property string $amount
 *
 * @property Card $card
 * @property Transactiontype $transactiontype
 * @property TransactionTags[] $transactionTags
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_id', 'transactiontype_id', 'amount'], 'required'],
            [['card_id', 'transactiontype_id'], 'integer'],
            [['trdate'], 'safe'],
            [['amount'], 'number'],
            [['description'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_id' => 'Карта',
            'transactiontype_id' => 'Тип',
            'trdate' => 'Дата',
            'description' => 'Описание',
            'amount' => 'Сумма',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCard()
    {
        return $this->hasOne(Card::className(), ['id' => 'card_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactiontype()
    {
        return $this->hasOne(Transactiontype::className(), ['id' => 'transactiontype_id']);
    }

    /**
     * @return array Transactiontype array.
     */
    public static function getTransactiontypeArray()
    {
       return Transactiontype::find()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionTags()
    {
        return $this->hasMany(TransactionTags::className(), ['id_transaction' => 'id']);
    }
}
