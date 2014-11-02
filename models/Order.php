<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $track_id
 * @property string $bill_fname
 * @property string $bill_lname
 * @property string $bill_email
 * @property string $amount
 * @property string $date
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['track_id', 'bill_fname', 'bill_lname', 'bill_email'], 'required'],
            [['track_id'], 'integer'],
            [['amount'], 'number'],
            [['date'], 'safe'],
            [['bill_fname', 'bill_lname', 'bill_email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'track_id' => 'Track ID',
            'bill_fname' => 'Bill Fname',
            'bill_lname' => 'Bill Lname',
            'bill_email' => 'Bill Email',
            'amount' => 'Amount',
            'date' => 'Date',
        ];
    }
}
