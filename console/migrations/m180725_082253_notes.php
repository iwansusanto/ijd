<?php

use yii\db\Migration;

/**
 * Class m180725_082253_notes
 */
class m180725_082253_notes extends Migration
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
        
        $this->createTable('{{%notes}}', [
           'id' => $this->primaryKey(),
           'title'   => $this->string(100)->notNull(),
           'tahun_ajaran_id'   => $this->smallInteger(3)->null(), 
           'user_created'   => $this->integer()->notNull(), 
           'user_updated'   => $this->integer(), 
           'update_time'   => $this->dateTime()->notNull(), 
        ]);
        
        $this->addForeignKey(
            'fk-notes-tahun_ajaran_id',
            'notes',
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
        echo "m180725_082253_notes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180725_082253_notes cannot be reverted.\n";

        return false;
    }
    */
}
