<?php

use app\models\Pengembalian;
use yii\db\Migration;

/**
 * Class m220312_034440_pengembalian
 */
class m220312_034440_pengembalian extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%pengembalian}}', [
            'id' => $this->primaryKey(),
            'buku_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'admin_id' => $this->integer()->notNull(),
            'qty' => $this->integer(11)->defaultValue(1),
            'at' => $this->dateTime()->defaultValue(date("Y-m-d H:i:s"))
        ]);
        $this->createIndex(
            'idx-pengembalian-buku_id',
            'pengembalian',
            'buku_id'
        );
        $this->createIndex(
            'idx-pengembalian-user_id',
            'pengembalian',
            'user_id'
        );

        $this->createIndex(
            'idx-pengembalian-admin_id',
            'pengembalian',
            'admin_id'
        );

        $this->addForeignKey(
            'fk-pengembalian-buku_id',
            'pengembalian',
            'buku_id',
            'buku',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-pengembalian-user_id',
            'pengembalian',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-pengembalian-admin_id',
            'pengembalian',
            'admin_id',
            'user',
            'id',
            'CASCADE'
        );

        $pengembalian = new Pengembalian();
        $pengembalian->buku_id = 1;
        $pengembalian->user_id = 2;
        $pengembalian->admin_id = 1;
        $pengembalian->qty = 3;
        $pengembalian->save();

        $pengembalian = new Pengembalian();
        $pengembalian->buku_id = 2;
        $pengembalian->user_id = 2;
        $pengembalian->admin_id = 1;
        $pengembalian->qty = 1;
        $pengembalian->save();
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pengembalian}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220312_034440_pengembalian cannot be reverted.\n";

        return false;
    }
    */
}
