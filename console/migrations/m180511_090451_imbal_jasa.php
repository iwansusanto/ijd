<?php

use yii\db\Migration;

/**
 * Class m180511_090451_imbal_jasa
 */
class m180511_090451_imbal_jasa extends Migration
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
        
        $this->createTable('{{%imbal_jasa}}', [
           'id' => $this->primaryKey(),
           'tgl_kegiatan'   => $this->dateTime()->notNull(),
           'dosen_fakultas_id'   => $this->integer()->notNull(),
           'transaksi_id'   => $this->integer()->notNull(),
           'nip'   => $this->string(30)->notNull(),
           'nama_dosen'   => $this->string(200), 
           'nama_fakultas'   => $this->string(100), 
           'dosen_fakultas_id_digantikan'   => $this->integer(), 
           'nip_digantikan'   => $this->string(30), 
           'nama_dosen_digantikan'   => $this->string(200), 
           'nama_fakultas_digantikan'   => $this->string(100), 
           'module_tahun_ajaran_id'   => $this->integer()->notNull(), 
//           'module_id'   => $this->integer()->notNull(), 
//           'nama_module'   => $this->string(200), 
           'kelas_id'   => $this->integer()->notNull(), 
           'nama_kelas'   => $this->string(100), 
           'ruangan_id'   => $this->integer()->notNull(), 
           'nama_ruangan'   => $this->string(100), 
           'jam_mulai'   => $this->time()->notNull(), 
           'jam_selesai'   => $this->time()->notNull(), 
           'peran_hitung_id'   => $this->integer()->notNull(), 
           'peran_id'   => $this->integer()->notNull(), 
           'nama_peran'   => $this->string(100), 
           'jumlah_jam_rumus'   => $this->integer()->notNull(), 
           'transport'   => $this->float(), 
           'honor'   => $this->float(), 
           'keterangan'   => $this->text(), 
           'user_created'   => $this->integer()->notNull(), 
           'user_updated'   => $this->integer(), 
           'update_time'   => $this->dateTime()->notNull(), 
        ]);
        
//        $this->addForeignKey(
//            'fk-imbal_jasa-module_id',
//            'imbal_jasa',
//            'module_id',
//            'module',
//            'id',
//            'CASCADE'
//        );
        
        $this->addForeignKey(
            'fk-imbal_jasa-kelas_id',
            'imbal_jasa',
            'kelas_id',
            'kelas',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-imbal_jasa-ruangan_id',
            'imbal_jasa',
            'ruangan_id',
            'ruangan',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-imbal_jasa-peran_hitung_id',
            'imbal_jasa',
            'peran_hitung_id',
            'peran_hitung',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-imbal_jasa-peran_id',
            'imbal_jasa',
            'peran_id',
            'peran',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-imbal_jasa-transaksi_id',
            'imbal_jasa',
            'transaksi_id',
            'transaksi',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-imbal_jasa-module_tahun_ajaran_id',
            'imbal_jasa',
            'module_tahun_ajaran_id',
            'module_tahun_ajaran',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180511_090451_imbal_jasa cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180511_090451_imbal_jasa cannot be reverted.\n";

        return false;
    }
    */
}
