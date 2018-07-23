<?php

use yii\db\Migration;

/**
 * Class m180722_085756_module_tahun_ajaran
 */
class m180722_085756_module_tahun_ajaran extends Migration
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
        
        $this->createTable('{{%module_tahun_ajaran}}', [
           'id' => $this->primaryKey(),
           'module_id'   => $this->integer()->notNull(),
           'nama'   => $this->string(200),
           'tahun_ajaran_id'   => $this->integer()->notNull(), 
           'periode'   => $this->string(50), 
           'jumlah_sks'   => $this->smallInteger(3)->notNull(),
           'jumlah_menit_per_sks'   => $this->smallInteger(3)->notNull()->defaultValue(50)->notNull(),
           'user_created'   => $this->integer(), 
           'user_updated'   => $this->integer(), 
           'update_time'   => $this->dateTime(), 
        ]);
        
        $this->addForeignKey(
            'fk-module_tahun_ajaran-module_id',
            'module_tahun_ajaran',
            'module_id',
            'module',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-module_tahun_ajaran-tahun_ajaran_id',
            'module_tahun_ajaran',
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
        echo "m180722_085756_module_tahun_ajaran cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180722_085756_module_tahun_ajaran cannot be reverted.\n";

        return false;
    }
    */
}
