<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%loan}}`.
 */
class m240724_192352_create_loan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%loan}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'borrower_id' => $this->integer(),
            'borrowed_on' => $this->dateTime(),
            'to_be_returned_on' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-loan-book_id',
            'loan',
            'book_id'
        );

        $this->addForeignKey(
            'fk-loan-book_id',
            'loan',
            'book_id',
            'book',
            'id',
            'CASCADE',
        );

         $this->createIndex(
            'idx-loan-borrower_id',
            'loan',
            'borrower_id'
        );


        $this->addForeignKey(
            'fk-loan-borrower_id',
            'loan',
            'borrower_id',
            'member',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeingKey('fk-loan-borrower_id', 'loan');
        $this->dropIndex('idx-loan-borrower_id', 'loan');
        $this->dropForeingKey('fk-loan-book_id', 'loan');
        $this->dropIndex('idx-loan-book_id', 'loan');

        $this->dropTable('{{%loan}}');
    }
}
