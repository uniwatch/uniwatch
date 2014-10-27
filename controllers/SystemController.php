<?php

namespace app\controllers;

class SystemController extends \yii\web\Controller
{
    public function actionError()
    {
        echo '<pre>';
        var_dump(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS,4));
        echo '</pre>';
        //$this->render('');
    }

}
