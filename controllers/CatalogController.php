<?php

namespace app\controllers;

use app\models\Product;

class CatalogController extends \yii\web\Controller
{
    public $layout = false;

    public $defaultAction = 'list';
    public function actionHome()
    {
        $this->layout = false;
        $data = Product::getAll(0, 20);
        return $this->render('list',['items'=>$data]);
    }
    public function actionList($page = 1, $name = '', $category = null, $priceFrom = null, $priceTo = null)
    {
        $data = Product::getProducts(
            $page,
            20,
            $category,
            $name,
            $priceFrom,
            $priceTo
        );
        return $this->render('list',['items'=>$data]);
    }

}
