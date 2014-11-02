<?php

namespace app\controllers;

use app\models\Order;
use app\models\OrderedProduct;
use app\models\Product;
use \yii\web\Controller;

class CheckoutController extends Controller
{
    public $layout = false;

    public function actionProceed()
    {
        $post = \Yii::$app->request->post();
        \Yii::$app->response->format = 'json';
        if(empty($post['products']) or !is_array($post['products']))
            return false;
        $order = new Order();
        $order->track_id = $_COOKIE['track_id'];
        $order->bill_fname = $post['bill_lname'];
        $order->bill_lname = $post['bill_fname'];
        $order->bill_email = $post['bill_email'];
        $order->amount = $post['amount'];
        $order->save();
        $model = new OrderedProduct();
        foreach($post['products'] as $product) {
            $productAR = Product::findOne(['product_id' => $product['id']]);
            $productAR->orders += 1;
            $productAR->save();

            $model->isNewRecord = true;
            $model->id=null;
            $model->order_id = $order->id;
            $model->track_id = \Yii::$app->request->cookies['track_id'];
            $model->product_id = $product['id'];
            $model->quantity = $product['quantity'];
            $model->save();
        }
        return true;
    }
}
