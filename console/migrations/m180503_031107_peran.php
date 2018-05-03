<?php

use yii\db\Migration;

/**
 * Class m180503_031107_peran
 */
class m180503_031107_peran extends Migration
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
        
        $this->createTable('{{%peran}}', [
           'id' => $this->primaryKey(),
           'nama'   => $this->string(100)->notNull(),
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
        echo "m180503_031107_peran cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180503_031107_peran cannot be reverted.\n";

        return false;
    }
    */
}
