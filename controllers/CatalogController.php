<?php

namespace app\controllers;

use app\models\Product;
use yii\web\Controller;

class CatalogController extends Controller
{
    public $layout = 'main';

    public $defaultAction = 'home';
    public function actionHome()
    {
        if (!isset(\Yii::$app->request->cookies['track_id'])) {
            \Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'track_id',
                'value' => time()
            ]));
        }
        return $this->render('home');
    }

}
