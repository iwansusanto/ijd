<?php

use yii\db\Migration;

/**
 * Class m180726_030551_personijd
 */
class m180726_030900_personijd extends Migration
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
        
        $this->createTable('{{%personijd}}', [
           'id' => $this->primaryKey(),
           'dosen_id'   => $this->integer()->notNull(),
           'jabatan_id'   => $this->integer()->notNull(), 
           'tahun_ajaran_id'   => $this->integer()->notNull(),   
           'nip'   => $this->string(50)->notNull(),
           'nama'   => $this->string(200)->notNull(),
           'status'   => $this->tinyInteger()->notNull()->comment('1: aktif, 0: not aktif'), 
           'user_created'   => $this->integer()->notNull(), 
           'user_updated'   => $this->integer(), 
           'update_time'   => $this->dateTime()->notNull(), 
        ]);
        
        $this->addForeignKey(
            'fk-personijd-jabatan_id',
            'personijd',
            'jabatan_id',
            'jabatan',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-personijd-dosen_id',
            'personijd',
            'dosen_id',
            'dosen',
            'id',
            'CASCADE'
        );
        
        // add foreign key for table `tahun ajaran`
        $this->addForeignKey(
            'fk-personijd-tahun_ajaran_id',
            'personijd',
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
        echo "m180726_030551_personijd cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180726_030551_personijd cannot be reverted.\n";

        return false;
    }
    */
}
