<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Class m191203_132759_user
 */
class m191203_132759_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'user_name' => $this->string(64)->unique(),
            'email' => $this->string(64)->unique(),
            'password' => $this->char(64),
            'create_at' => $this->dateTime(),
            'update_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m191203_132759_user cannot be reverted.\n";
       // $this->dropTable('user');
       // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191203_132759_user cannot be reverted.\n";

        return false;
    }
    */
}
