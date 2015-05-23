<?php

namespace common\modules\transactions\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $card_id
 * @property integer $transactiontype_id
 * @property string $trdate
 * @property string $desciption
 * @property integer $amount
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
            [['card_id', 'transactiontype_id', 'amount'], 'integer'],
            [['trdate'], 'safe'],
            [['desciption'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_id' => 'Card ID',
            'transactiontype_id' => 'Transactiontype ID',
            'trdate' => 'Trdate',
            'desciption' => 'Desciption',
            'amount' => 'Amount',
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
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionTags()
    {
        return $this->hasMany(TransactionTags::className(), ['id_transaction' => 'id']);
    }
}
