<?php

use yii\db\Migration;

/**
 * Class m180503_024214_tahun_ajaran
 */
class m180503_024214_tahun_ajaran extends Migration
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
        
        $this->createTable('{{%tahun_ajaran}}', [
           'id' => $this->primaryKey(),
           'periode_awal'   => $this->date()->notNull(),
           'periode_akhir'   => $this->date()->notNull(), 
           'periode'   => $this->string(50)->unique(), 
           'status'   => $this->smallInteger(1)->defaultValue(0), 
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
        echo "m180503_024214_tahun_ajaran cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180503_024214_tahun_ajaran cannot be reverted.\n";

        return false;
    }
    */
}
