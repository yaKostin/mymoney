<?php

namespace common\modules\transactions\models;

use Yii;
use yii\db\QueryBuilder;

use common\modules\transactions\models\Transactiontype;
use common\modules\transactions\models\TransactionTags;
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
    public $tags = [];
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
            //['transactiontype_id', 'default', 'value' => 3],
            [['trdate', 'tags'], 'safe'],
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
            'transactionTags' => 'Теги',
        ];
    }

    /**
    * @inheritdoc
    */
    public function afterSave($insert, $changedAttributes)
    {
        if ( !empty($this->tags) ) {
            TransactionTags::deleteAll(['id_transaction' => $this->id]);
            $values = [];            
            for($i = 0; $i < count($this->tags); $i++) {
                $values[$i] = [$this->id, $this->tags[$i]];
            }
            
            self::getDb()->createCommand()
                ->batchInsert(TransactionTags::tableName(), ['id_transaction', 'id_tag'], $values)->execute();
         
            parent::afterSave($insert, $changedAttributes);
        }
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
       return Transactiontype::find()->orderBy(['id' => SORT_ASC])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionTags()
    {
        return $this->hasMany(TransactionTags::className(), ['id_transaction' => 'id']);
    }
}
