<?php

namespace common\modules\account\models;

use Yii;

/**
 * This is the model class for table "card_stats".
 *
 * @property integer $id
 * @property integer $card_id
 * @property string $income
 * @property string $expense
 * @property string $limit
 *
 * @property Card $card
 */
class CardStats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'card_stats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['card_id'], 'required'],
            [['card_id'], 'integer'],
            [['income', 'expense', 'limit'], 'number']
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
            'income' => 'Income',
            'expense' => 'Expense',
            'limit' => 'Limit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCard()
    {
        return $this->hasOne(Card::className(), ['id' => 'card_id']);
    }
}
