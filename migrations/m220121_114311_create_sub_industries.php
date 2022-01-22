<?php

use yii\db\Migration;

/**
 * Class m220121_114311_create_sub_industries
 */
class m220121_114311_create_sub_industries extends Migration
{
    public const TABLE_NAME = '{{%sub_industries}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            self::TABLE_NAME,
            [
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull()->unique(),
                'main_industry' => $this->integer()->notNull(),
            ]
        );

        $this->addForeignKey(
            'FK-sub-industries-main-industry-id',
            self::TABLE_NAME,
            'main_industry',
            '{{%industries}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
