<?php

use yii\db\Migration;

/**
 * Class m180726_010548_noteijd
 */
class m180726_010548_noteijd extends Migration
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
        
        $this->createTable('{{%noteijd}}', [
           'id' => $this->primaryKey(),
           'title'   => $this->string(100)->notNull(),
           'tahun_ajaran_id'   => $this->integer()->notNull(), 
           'no_urut'   => $this->tinyInteger()->notNull(), 
           'user_created'   => $this->integer()->notNull(), 
           'user_updated'   => $this->integer(), 
           'update_time'   => $this->dateTime()->notNull(), 
        ]);
        
        $this->addForeignKey(
            'fk-noteijd-tahun_ajaran_id',
            'noteijd',
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
        echo "m180726_010548_noteijd cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180726_010548_noteijd cannot be reverted.\n";

        return false;
    }
    */
}
