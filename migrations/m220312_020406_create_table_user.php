<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m220312_020406_create_table_user
 */
class m220312_020406_create_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->unique(),
            'nama' => $this->string(255),
            'password' => $this->string(255),
            'authKey' => $this->string(255)->null(),
            'accessToken' => $this->string(255)->null(),
        ]);
        $user_model = new User();
        $user_model->username = "admin";
        $user_model->nama = "admin";
        $user_model->password = "admin";
        $user_model->save();

        $user_model = new User();
        $user_model->username = "user";
        $user_model->nama = "user";
        $user_model->password = "user";
        $user_model->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220312_020406_create_table_user cannot be reverted.\n";

        return false;
    }
    */
}
