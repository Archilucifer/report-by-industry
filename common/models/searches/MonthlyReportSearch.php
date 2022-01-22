<?php

namespace common\models\searches;

use common\models\MonthlyReport;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\db\Query;

class MonthlyReportSearch extends Model
{
    /**
     * @var string
     */
    public $date_from;

    /**
     * @var string
     */
    public $date_to;

    /**
     * @var int[]
     */
    public $industries;

    public function rules(): array
    {
        return [
            ['industries', 'formatIndustriesIds'],
            ['industries', 'each', 'rule' => ['integer']],
            [['date_from', 'date_to'], 'required'],
            [['date_from'], 'date', 'format' => 'php:Y-m'],
            ['date_to', 'date', 'format' => 'php:Y-m'],
            ['date_from', 'compare', 'compareAttribute' => 'date_to', 'operator' => '<='],
            ['date_to', 'compare', 'compareAttribute' => 'date_from', 'operator' => '>='],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = (new Query());

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            $query->emulateExecution();
            return $dataProvider;
        }

        $query->select(
            [
                new Expression('SUM(workers) as total_workers'),
                new Expression('SUM(average_salary) as total_average_salary'),
                new Expression('SUM(taxes_paid_amount) as total_taxes_paid_amount'),
                new Expression('COALESCE(SUM(energy_charges), 0) as energy_charges'),
                new Expression('GROUP_CONCAT(provider) as provider'),
                'industry'
            ]
        )->from([MonthlyReport::tableName()]);

        $query->groupBy(['industry']);

        $query->andFilterWhere(
            [
                'in',
                MonthlyReport::tableName() . '.industry',
                $this->industries
            ]
        );
        $query->andWhere(
            [
                'between',
                'date',
                $this->date_from,
                $this->date_to
            ]
        );

        return $dataProvider;
    }

    /**
     * Делаем так для красоты массива, можно и без этого
     */
    public function formatIndustriesIds(): void
    {
        $ids = explode(',', implode(',', $this->industries));
        $this->industries = $ids;
    }
}