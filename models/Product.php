<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

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
class Product extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    public static function setViewed($id)
    {
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

    public static function getAll($page=1, $pageSize=20, $name = null)
    {
        $query = self::find();
        if($name) {
            $query->andWhere(['name'=>['like','%'.$name.'%']]);
        }
        $query->orderBy([
            'orders' => 'desc',
            'views' => 'desc',
            'carts' => 'desc',
        ]);
        $page-=1;
        $offset = $page*$pageSize;
        $query->offset = $offset;
        $query->limit = $pageSize;
        return $query->all();
    }
}
