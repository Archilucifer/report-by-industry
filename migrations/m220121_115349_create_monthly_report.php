<?php

use yii\db\Migration;

/**
 * Class m220121_115349_create_mounthly_report
 */
class m220121_115349_create_monthly_report extends Migration
{
    const TABLE_NAME = '{{%monthly_report}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'industry' => $this->integer()->notNull(),
            'workers' => $this->integer()->notNull(),
            'average_salary' => $this->decimal(20, 4)->notNull(),
            'taxes_paid_amount' => $this->decimal(20, 4)->notNull(),
            'energy_charges' => $this->decimal(20, 4),
            'provider' => $this->string(),
            'date' => $this->string(),
        ]);

        $this->addForeignKey(
            'FK-monthly-report-industry-id',
            self::TABLE_NAME,
            'industry',
            '{{%sub_industries}}',
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
