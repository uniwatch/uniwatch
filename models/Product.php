<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $desc
 * @property string $price
 * @property string $img
 * @property integer $orders
 * @property integer $carts
 * @property integer $views
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'desc', 'price'], 'required'],
            [['desc'], 'string'],
            [['price'], 'number'],
            [['orders', 'carts', 'views'], 'integer'],
            [['name', 'img'], 'string', 'max' => 255]
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
            'desc' => 'Desc',
            'price' => 'Price',
            'img' => 'Img',
            'orders' => 'Orders',
            'carts' => 'Carts',
            'views' => 'Views',
        ];
    }
}
