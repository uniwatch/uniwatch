<?php

namespace app\controllers;

use yii\web\Controller;

class ContactsController extends Controller
{
    public $layout = 'with_menu';
    public function actionIndex()
    {
        return $this->render('index');
    }

}
