<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%member}}`.
 */
class m240724_192310_create_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%member}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'started_on' => $this->date()->defaultValue(date('Y-m-d H:i:s'))
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%member}}');
    }
}
