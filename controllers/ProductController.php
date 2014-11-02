<?php

namespace app\controllers;

use app\models\CartedProduct;
use app\models\OrderedProduct;
use app\models\ViewedProduct;
use yii\web\Controller;
use app\models\Product;
class ProductController extends Controller
{
    public $layout = false;

    public function actionView($id)
    {
        \Yii::$app->response->format='json';
        $model = new ViewedProduct();
        $model->product_id = $id;
        $model->track_id = \Yii::$app->request->cookies['track_id'];
        $model->save();

        $product = Product::findOne(['id' => $id]);
        $product->views+=1;
        $product->save();

        $product = $product->toArray();
        $product['ordered'] = OrderedProduct::getViewedWith($id);
        $product['carted'] = CartedProduct::getCartedWith($id);
        $product['viewed'] = ViewedProduct::getViewedWith($id);
        return $product;
    }

    public function actionGetlist($name=null, $page =1, $pageSize=20)
    {
        \Yii::$app->response->format='json';
        return Product::getAll($page,$pageSize, $name);
    }


}
