<?php

use yii\db\Migration;

/**
 * Class m220121_114942_create_enterprises
 */
class m220121_114942_create_enterprises extends Migration
{
    const TABLE_NAME = '{{%enterprises}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'owner' => $this->string()->notNull(),
            'industry' => $this->integer()->notNull(),
            'inn' => $this->string(),
            'address' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
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
