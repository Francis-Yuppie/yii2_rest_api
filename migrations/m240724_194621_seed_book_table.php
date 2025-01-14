<?php

use yii\db\Migration;

/**
 * Class m240724_194621_seed_book_table
 */
class m240724_194621_seed_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeBooks();
    }

    private function insertFakeBooks()
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 50; $i++){
            $this->insert(
                'book',
                [
                    'name' => $faker->catchPhrase,
                    'author' => $faker->name,
                    'release_year' => (int)$faker->year,
                ]
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240724_194621_seed_book_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240724_194621_seed_book_table cannot be reverted.\n";

        return false;
    }
    */
}
