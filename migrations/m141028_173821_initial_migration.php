<?php

use yii\db\Schema;
use yii\db\Migration;

class m141028_173821_initial_migration extends Migration
{
    public function up()
    {
        $this->createTable('order',[
            'id' => 'pk',
            'track_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'bill_fname' => Schema::TYPE_STRING . ' NOT NULL',
            'bill_lname' => Schema::TYPE_STRING . ' NOT NULL',
            'bill_email' => Schema::TYPE_STRING . ' NOT NULL',
            'amount' => Schema::TYPE_DECIMAL . ' NOT NULL DEFAULT 0.0',
            'date' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT DATETIME(NOW())',

        ]);

        $this->createTable('product',[
            'id' => 'pk',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'desc' => Schema::TYPE_TEXT . ' NOT NULL',
            'price' => Schema::TYPE_DECIMAL . ' NOT NULL',
            'img' => Schema::TYPE_STRING . ' NOT NULL DEFAULT ""',
            'orders' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'carts' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'views' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ]);

        $this->createTable('ordered_product', [
            'id' => 'pk',
            'track_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'order_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'product_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'quantity' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
            'date' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT DATETIME(NOW())',
        ]);

        $this->createTable('carted_product', [
            'id' => 'pk',
            'track_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'product_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'quantity' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',
            'date' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT DATETIME(NOW())',

        ]);
        $this->createTable('viewed_product', [
            'id' => 'pk',
            'track_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'product_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'date' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT DATETIME(NOW())',
        ]);
    }

    public function down()
    {
        echo "m141028_173821_initial_migration cannot be reverted.\n";

        return false;
    }
}
