<?php
namespace frontend\models;

use yii\base\Model;
use Yii;

class DashboardModel extends Model
{
	public $dataProvider;
	public $gridColumns;
	public $transactions;
	public function rules()
    {
        return [
        ];
    }
}