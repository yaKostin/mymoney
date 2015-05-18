<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "repeattype".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Reminder[] $reminders
 */
class Repeattype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repeattype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 20],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReminders()
    {
        return $this->hasMany(Reminder::className(), ['repeattype_id' => 'id']);
    }
}
