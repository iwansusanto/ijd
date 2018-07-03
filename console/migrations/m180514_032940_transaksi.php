<?php

use yii\db\Migration;

/**
 * Class m180514_032940_transaksi
 */
class m180514_032940_transaksi extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%transaksi}}', [
           'id' => $this->primaryKey(),
           'no_transaksi'   => $this->string(15)->notNull()->unique()->comment('Ym/IJD/xxx'),
           'tgl_transaksi'   => $this->dateTime()->notNull(), 
           'bulan_tahun'   => $this->date()->notNull(), 
           'keterangan'   => $this->text(), 
           'user_created'   => $this->integer()->notNull(), 
           'user_updated'   => $this->integer(), 
           'update_time'   => $this->dateTime()->notNull(), 
        ]);
        
        $this->createIndex(
            'no_transaksi-index-transaksi',
            'transaksi',
            'no_transaksi',
            true
        );
        
        $this->createIndex(
            'bulan_tahun-index-transaksi',
            'transaksi',
            'bulan_tahun',
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180514_032940_transaksi cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180514_032940_transaksi cannot be reverted.\n";

        return false;
    }
    */
}
