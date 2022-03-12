<?php

use app\models\Buku;
use yii\db\Migration;

/**
 * Class m220312_034416_buku
 */
class m220312_034416_buku extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%buku}}', [
            'id' => $this->primaryKey(),
            'judul' => $this->string(255),
            'pengarang' => $this->string(255),
            'tahun_terbit' => $this->integer(11),
            'stok' => $this->integer(11)->defaultValue(0),
        ]);
        $buku = new Buku();
        $buku->judul = 'Buku 1';
        $buku->pengarang = 'Pengarang 1';
        $buku->tahun_terbit = 2005;
        $buku->stok = 5;
        $buku->save();

        $buku = new Buku();
        $buku->judul = 'Buku 2';
        $buku->pengarang = 'Pengarang 2';
        $buku->tahun_terbit = 2005;
        $buku->stok = 5;
        $buku->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%buku}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220312_034416_buku cannot be reverted.\n";

        return false;
    }
    */
}
