<?php

namespace app\models;

use Yii;
use \app\models\Category;
/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $url
 * @property string $img
 * @property string $desc
 * @property string $price
 * @property string $currency
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
            [['category_id'], 'integer'],
            [['name'], 'required'],
            [['desc'], 'string'],
            [['price'], 'number'],
            [['name', 'url', 'img'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'url' => 'Url',
            'img' => 'Img',
            'desc' => 'Desc',
            'price' => 'Price',
            'currency' => 'Currency',
        ];
    }

    /**
     * @param int $page
     * @param int $pageSize
     * @param null $category
     * @param null $name
     * @param null $priceFrom
     * @param null $priceTo
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getProducts($page = 1, $pageSize = 20, $category = null, $name = null, $priceFrom = null, $priceTo = null) {
        $query = self::find();
        $query->limit=$pageSize;
        $query->offset(($page-1)*$pageSize);
        if(null!=$category) {
            $model = new Category();
            $cats = $model->getAllCategoriesByParent($category,true);
            $cats = array_keys($cats);
            $cats[] = $category;
            $query->andWhere(['category_id'=>$cats]);
        }
        if($name) {
            $query->andWhere('name like :name',[':name' => '%'.$name.'%']);
        }
        if($priceFrom) {
            $query->andWhere('price > :priceFrom', [':priceFrom' => $priceFrom]);
        }
        if($priceTo) {
            $query->andWhere('price < :priceTo', [':priceTo' => $priceTo]);
        }
        return $query->all();
    }
}
