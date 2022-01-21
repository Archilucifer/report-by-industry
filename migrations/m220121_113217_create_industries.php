<?php

use yii\db\Migration;

/**
 * Class m220121_113217_create_industries
 */
class m220121_113217_create_industries extends Migration
{
    const TABLE_NAME = '{{%industries}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
