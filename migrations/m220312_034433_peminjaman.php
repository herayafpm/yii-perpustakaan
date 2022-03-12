<?php

use app\models\Peminjaman;
use yii\db\Migration;

/**
 * Class m220312_034433_peminjaman
 */
class m220312_034433_peminjaman extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%peminjaman}}', [
            'id' => $this->primaryKey(),
            'buku_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'admin_id' => $this->integer()->notNull(),
            'qty' => $this->integer(11)->defaultValue(1),
            'at' => $this->dateTime()->defaultValue(date("Y-m-d H:i:s"))
        ]);
        $this->createIndex(
            'idx-peminjaman-buku_id',
            'peminjaman',
            'buku_id'
        );
        $this->createIndex(
            'idx-peminjaman-user_id',
            'peminjaman',
            'user_id'
        );

        $this->createIndex(
            'idx-peminjaman-admin_id',
            'peminjaman',
            'admin_id'
        );

        $this->addForeignKey(
            'fk-peminjaman-buku_id',
            'peminjaman',
            'buku_id',
            'buku',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-peminjaman-user_id',
            'peminjaman',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-peminjaman-admin_id',
            'peminjaman',
            'admin_id',
            'user',
            'id',
            'CASCADE'
        );

        $peminjaman = new Peminjaman();
        $peminjaman->buku_id = 1;
        $peminjaman->user_id = 2;
        $peminjaman->admin_id = 1;
        $peminjaman->qty = 3;
        $peminjaman->save();

        $peminjaman = new Peminjaman();
        $peminjaman->buku_id = 2;
        $peminjaman->user_id = 2;
        $peminjaman->admin_id = 1;
        $peminjaman->qty = 1;
        $peminjaman->save();
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%peminjaman}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220312_034433_peminjaman cannot be reverted.\n";

        return false;
    }
    */
}
