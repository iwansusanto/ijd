<?php

use yii\db\Migration;

/**
 * Class m180507_020615_dosen_fakultas
 */
class m180507_020615_dosen_fakultas extends Migration
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
        
        $this->createTable('{{%dosen_fakultas}}', [
           'id' => $this->primaryKey(),
           'dosen_id'   => $this->integer()->notNull(),
           'fakultas_id'   => $this->integer()->notNull(),
           'semester_id'   => $this->integer()->notNull(),
           'tahun_ajaran_id'   => $this->integer()->notNull(), 
           'user_created'   => $this->integer()->notNull(), 
           'user_updated'   => $this->integer(), 
           'update_time'   => $this->dateTime()->notNull(), 
        ]);
        
        // add foreign key for table `semester`
        $this->addForeignKey(
            'fk-dosen_fakultas-semester_id',
            'dosen_fakultas',
            'semester_id',
            'semester',
            'id',
            'CASCADE'
        );
        
        // add foreign key for table `dosen`
        $this->addForeignKey(
            'fk-dosen_fakultas-dosen_id',
            'dosen_fakultas',
            'dosen_id',
            'dosen',
            'id',
            'CASCADE'
        );
         
        // add foreign key for table `fakultas`
        $this->addForeignKey(
            'fk-dosen_fakultas-fakultas_id',
            'dosen_fakultas',
            'fakultas_id',
            'fakultas',
            'id',
            'CASCADE'
        );
        
        // add foreign key for table `tahun ajaran`
        $this->addForeignKey(
            'fk-dosen_fakultas-tahun_ajaran_id',
            'dosen_fakultas',
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
        echo "m180507_020615_dosen_fakultas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180507_020615_dosen_fakultas cannot be reverted.\n";

        return false;
    }
    */
}
