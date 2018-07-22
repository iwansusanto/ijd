<?php

use yii\db\Migration;

/**
 * Class m180503_033029_peran_hitung
 */
class m180503_033029_peran_hitung extends Migration
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
        
        $this->createTable('{{%peran_hitung}}', [
           'id' => $this->primaryKey(),
           'peran_id'   => $this->integer()->notNull(),
           'module_id'   => $this->integer()->notNull(),
           'tahun_ajaran_id'   => $this->integer()->notNull(),
           'bulan'   => $this->smallInteger(2)->notNull(), 
           'tahun'   => $this->smallInteger(4)->notNull(), 
//           'jumlah_sks'   => $this->smallInteger(3)->notNull(), 
           'jumlah_menit_hitung'   => $this->smallInteger()->notNull()->defaultValue(60)->comment('per jam(dalam satuan menit)'), 
           'honor_menit_hitung'   => $this->integer()->notNull()->comment('nilai imbal jasa'), 
           'transport_hitung'   => $this->integer()->comment('transport imbal jasa'), 
//           'jumlah_menit_per_sks'   => $this->smallInteger(3)->notNull()->defaultValue(50), 
           'volume_menit_pertemuan'   => $this->smallInteger(3)->notNull()->defaultValue(120), 
           'keterangan'   => $this->text(), 
           'user_created'   => $this->integer()->notNull(), 
           'user_updated'   => $this->integer(), 
           'update_time'   => $this->dateTime()->notNull(), 
        ]);
        
        $this->addForeignKey(
            'fk-peran_hitung-peran_id',
            'peran_hitung',
            'peran_id',
            'peran',
            'id',
            'CASCADE'
        );
        
        
        $this->addForeignKey(
            'fk-peran_hitung-module_id',
            'peran_hitung',
            'module_id',
            'module',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-peran_hitung-tahun_ajaran_id',
            'peran_hitung',
            'tahun_ajaran_id',
            'tahun_ajaran',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180503_033029_peran_hitung cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180503_033029_peran_hitung cannot be reverted.\n";

        return false;
    }
    */
}
