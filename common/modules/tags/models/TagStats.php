<?php

namespace common\modules\tags\models;

use Yii;

/**
 * This is the model class for table "tag_stats".
 *
 * @property integer $id
 * @property integer $tag_id
 * @property string $expense
 * @property string $income
 * @property string $limit
 *
 * @property Tag $tag
 */
class TagStats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_stats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id'], 'required'],
            [['tag_id'], 'integer'],
            [['expense', 'income', 'limit'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_id' => 'Тег',
            'expense' => 'Расходы',
            'income' => 'Поступления',
            'limit' => 'Лимит'
        ];
    }

    public function changeStats($transaction)
    {
        if ($transaction->transactiontype->id == 1) {
            $this->expense += $transaction->amount;
        } else {
            $this->income += $transaction->amount;
        }
        $this->update();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }
}
