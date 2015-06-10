<?php

namespace common\modules\transactions\models;

use Yii;
use common\modules\tags\models\Tag;
/**
 * This is the model class for table "transaction_tags".
 *
 * @property integer $id
 * @property integer $id_transaction
 * @property integer $id_tag
 *
 * @property Transaction $idTransaction
 * @property Tag $idTag
 */
class TransactionTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_transaction', 'id_tag'], 'required'],
            [['id', 'id_transaction', 'id_tag'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_transaction' => 'Id Transaction',
            'id_tag' => 'Id Tag',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'id_transaction']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'id_tag']);
    }

    public function getTagName() 
    {
        //return Tag::findOne(['id' => 'id_tag'])->name;
        //return $this->hasOne(Tag::className(), [''])
    }
}
