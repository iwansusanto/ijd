<?php

use yii\db\Migration;

/**
 * Class m180503_024141_dosen_kelas
 */
class m180503_024141_dosen_kelas extends Migration
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
        
        $this->createTable('{{%dosen_kelas}}', [
           'id' => $this->primaryKey(),
           'dosen_id'   => $this->integer()->notNull(),
           'kelas_id'   => $this->integer()->notNull(), 
           'tahun_ajaran_id'   => $this->integer()->notNull(), 
           'user_created'   => $this->integer()->notNull(), 
           'user_updated'   => $this->integer(), 
           'update_time'   => $this->dateTime()->notNull(), 
        ]);
        
         $this->createIndex(
            'dosen-index-dosen_kelas',
            'dosen_kelas',
            'dosen_id',
            true
        );
         
         $this->createIndex(
            'kelas-index-dosen_kelas',
            'dosen_kelas',
            'kelas_id',
            true
        );
         
         $this->createIndex(
            'tahun_ajaran-index-dosen_kelas',
            'dosen_kelas',
            'tahun_ajaran_id',
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180503_024141_dosen_kelas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180503_024141_dosen_kelas cannot be reverted.\n";

        return false;
    }
    */
}
