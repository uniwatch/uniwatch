<?php

namespace app\controllers;

use app\models\Order;
use app\models\OrderedProduct;
use app\models\Product;
use yii\web\Controller;

class CheckoutController extends Controller
{
    public $layout = false;
    public $defaultAction = 'index';
    public $enableCsrfValidation = false;
    public function actionProceed()
    {
        $data = \Yii::$app->request->post();
        \Yii::$app->response->format = 'json';
        $products = json_decode($data['products'], true);

        if(empty($products) or !is_array($products))
            return false;

        $order = new Order();
        $order->track_id = \Yii::$app->request->cookies['track_id']->value;
        $order->bill_fname = $data['bill_fname'];
        $order->bill_lname = $data['bill_lname'];
        $order->bill_email = $data['bill_email'];
        $order->amount = $data['amount'];
        $order->save();
        $model = new OrderedProduct();
        foreach($products as $product) {
            $productAR = Product::findOne(['id' => $product['id']]);
            $productAR->orders += 1;
            $productAR->save();

            $model->isNewRecord = true;
            $model->id=null;
            $model->order_id = $order->id;
            $model->track_id = \Yii::$app->request->cookies['track_id']->value;
            $model->product_id = $product['id'];
            $model->quantity = $product['count'];
            $model->save();
        }
        return true;
    }
}
