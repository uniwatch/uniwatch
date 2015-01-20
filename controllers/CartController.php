<?php

namespace app\controllers;

use app\models\CartedProduct;
use app\models\Product;
use yii\web\Controller;

class CartController extends Controller
{
    public $layout = false;

    public function actionAdditem($id)
    {
        $product = Product::findOne(['id' => $id]);
        $product->carts+=1;
        $product->save();

        $model = new CartedProduct();
        $model->product_id = $id;
        $model->quantity = 1;
        $model->track_id = \Yii::$app->request->cookies['track_id']->value;
        \Yii::$app->response->format = 'json';
        return $model->save();
    }

    public function actionDeleteitem()
    {
        \Yii::$app->response->format = 'json';
        return true;
    }

}
