<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carted_product".
 *
 * @property integer $id
 * @property integer $track_id
 * @property integer $product_id
 * @property integer $quantity
 * @property string $date
 */
class CartedProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carted_product';
    }

    public static function getCartedWith($id)
    {
        $sql = "select
        distinct(o1.product_id) as `product_id`,
        p1.`name` as `name`,
        p1.`desc` as `desc`,
        p1.`img` as `img`,
        p1.`price`
        from carted_product as o1
        left join carted_product as o2
            on o2.track_id = o1.track_id
        inner join product as p1 on p1.id = o1.product_id

        where
        o2.product_id= $id
        and o1.product_id != $id";
        return self::findBySql($sql)->asArray(true)->all();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['track_id', 'product_id'], 'required'],
            [['track_id', 'product_id', 'quantity'], 'integer'],
            [['date'], 'safe']
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
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'date' => 'Date',
        ];
    }
}
