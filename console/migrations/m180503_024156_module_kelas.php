<?php

use yii\db\Migration;

/**
 * Class m180503_024156_module_kelas
 */
class m180503_024156_module_kelas extends Migration
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
        
        $this->createTable('{{%module_kelas}}', [
           'id' => $this->primaryKey(),
           'module_id'   => $this->integer()->notNull(),
           'kelas_id'   => $this->integer()->notNull(), 
           'tahun_ajaran_id'   => $this->integer()->notNull(), 
           'semester_id'   => $this->integer()->notNull(),
           'user_created'   => $this->integer()->notNull(), 
           'user_updated'   => $this->integer(), 
           'update_time'   => $this->dateTime()->notNull(), 
        ]);
        
        // add foreign key for table `semester`
        $this->addForeignKey(
            'fk-module_kelas-semester_id',
            'module_kelas',
            'semester_id',
            'semester',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-module_kelas-module_id',
            'module_kelas',
            'module_id',
            'module',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-module_kelas-kelas_id',
            'module_kelas',
            'kelas_id',
            'kelas',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-module_kelas-tahun_ajaran_id',
            'module_kelas',
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
        echo "m180503_024156_module_kelas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180503_024156_module_kelas cannot be reverted.\n";

        return false;
    }
    */
}
