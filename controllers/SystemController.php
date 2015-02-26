<?php

namespace app\controllers;

class SystemController extends \yii\web\Controller
{
    public function actionError()
    {

        if($error=\Yii::$app->errorHandler->error)
        {
            $error=array(
                'code'=>$error['code'],
                'message'=>$error['message'],
            );
            echo CJSON::encode($error);
        }
    }

}
