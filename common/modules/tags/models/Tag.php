<?php

namespace common\modules\tags\models;

use Yii;
use common\modules\transactions\models\Transaction;
/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 *
 * @property TransactionTags[] $transactionTags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionTags()
    {
        return $this->hasMany(TransactionTags::className(), ['id_tag' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions() 
    {
        return $this
            ->hasMany(Transaction::className(), ['id' => 'id_transaction'])
            ->viaTable(TransactionTags::tableName(), ['id_tag' => 'id']);       
    }
}
