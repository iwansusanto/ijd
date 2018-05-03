<?php

use yii\db\Migration;

/**
 * Class m180502_020627_module
 */
class m180502_020627_module extends Migration
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
        
        $this->createTable('{{%module}}', [
           'id' => $this->primaryKey(),
           'nama'   => $this->string(200)->notNull(),
           'keterangan'   => $this->text(), 
           'user_created'   => $this->integer()->notNull(), 
           'user_updated'   => $this->integer(), 
           'update_time'   => $this->dateTime()->notNull(), 
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180502_020627_module cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180502_020627_module cannot be reverted.\n";

        return false;
    }
    */
}
