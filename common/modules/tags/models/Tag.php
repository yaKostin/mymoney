<?php

namespace common\modules\tags\models;

use Yii;
use common\modules\transactions\models\Transaction;
use common\modules\tags\models\TagStats;
/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id 
 *
 * @property User $user
 * @property TagStats[] $tagStats
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
            [['name', 'user_id'], 'required'],
            [['user_id'], 'integer'],
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
            'user_id' => 'User ID', 
        ];
    }

    /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public static function getUsersTags($user_id)
    {
        return Tag::find()->where(['user_id' => $user_id]);
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

    public function getUserTransactions($user_id) 
    {
        return $this
            ->hasMany(Transaction::className(), ['id' => 'id_transaction'])
            ->viaTable(TransactionTags::tableName(), ['id_tag' => 'id'])
            ->with([    // this is for the related models
                'posts' => function($query) use ($searchword) {
                    $query->where(['like', 'post.title', $searchword]);
                },
            ]);       
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTagStats()
    {
        return $this->hasOne(TagStats::className(), ['tag_id' => 'id']);
        //return TagStats::find()->where(['tag_id' => 'id'])->one();
    }

    public static function getAllUsersTransactionsByTags($user_id) 
    {
        $tags = Tag::find()->All();
        $transactionsByTags = [];
        for ($i = 0; $i < count($tags); $i++ ) {
            $transactionsByTags[$i] = Transaction:: $tags[$i]->getUserTransactions($user_id)->All();
        } 
        $transactionDataByTags = [];
        for ($i = 0; $i < count($transactionsByTags); $i++) {
            $transactionDataByTags[$i] = 0;
            for ($j = 0; $j < count($transactionsByTags[$i]); $j++) {
                $transactionDataByTags[$i] += $transactionsByTags[$i][$j]->amount;
            }
        
        }
        return $transactionDataByTags;
    }
}
