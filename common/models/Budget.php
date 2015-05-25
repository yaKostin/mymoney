<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "budget".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $balance
 * @property integer $limit
 * @property integer $income
 * @property integer $expense
 */
class Budget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'budget';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'balance', 'limit', 'income', 'expense'], 'integer']
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
            'balance' => 'Баланс',
            'limit' => 'Лимит',
            'income' => 'Доходы',
            'expense' => 'Расходы',
        ];
    }
}
