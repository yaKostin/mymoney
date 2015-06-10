<?php

namespace common\modules\transactions\models;

use Yii;
use yii\db\QueryBuilder;

use common\modules\transactions\models\Transactiontype;
use common\modules\transactions\models\TransactionTags;
use common\modules\transactions\models\Card;
use common\modules\tags\models\TagStats;
use common\modules\tags\models\Tag;
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

            $firstTag = Tag::find()->where(['id' => $this->tags[0] ])->one();
            $firstTagStats = $firstTag->getTagStats()->one();
            $firstTagStats->changeStats($this);
            
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

    public static function getUsersTransactions($user_id) 
    {
        return Transaction::find()
            ->select('transaction.*')
            ->innerJoin('`card`', '`transaction`.`card_id` = `card`.`id`')
            ->where(['card.user_id' => $user_id])
            ->orderBy(['transaction.id' => SORT_DESC]);
    }

    public static function getUsersTransactionsByTag($user_id, $tag_id) 
    {
        return Transaction::find()
            ->select('transaction.*')
            ->innerJoin('`card`', '`transaction`.`card_id` = `card`.`id`')
            ->innerJoin('`transaction_tags`', '`transaction`.`id` = `transaction_tags`.`id_transaction`')
            ->where(['card.user_id' => $user_id, 'transaction_tags.id_tag' => $tag_id])
            ->orderBy(['transaction.id' => SORT_DESC]);
    }

    public static function getUsersTransactionsAmountByTags($user_id, $tags) 
    {
        $transactionsByTags = [];
        for ($i = 0; $i < count($tags); $i++) {
            $transactionsByTags[$i] = Transaction::getUsersTransactionsByTag($user_id, $tags[$i]->id)->All();
        }
        $amountsByTags = [];
        for ($i = 0; $i < count($transactionsByTags); $i++) {
            $amountsByTags[$i] = 0;
            for ($j = 0; $j < count($transactionsByTags[$i]); $j++) { 
                $amountsByTags[$i] += $transactionsByTags[$i][$j]->amount;
            }
        }
        return $amountsByTags;
    }
}
