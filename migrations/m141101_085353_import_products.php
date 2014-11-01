<?php

use yii\db\Schema;

class m141101_085353_import_products extends \yii\db\Migration
{
    public function up()
    {
        try{
            Yii::$app->runAction('parse-xml-feed/import-products');
        }
        catch(\yii\base\Exception $e) {
            echo 'Exception: ' . $e->getCode() . ' ' . $e->getMessage();
            return false;
        }
        return true;
    }

    public function down()
    {
        echo "m141101_085353_import_products cannot be reverted.\n";

        return false;
    }
}
