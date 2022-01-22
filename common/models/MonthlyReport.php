<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Class MonthlyReport
 *
 * @property integer $id
 * @property integer $industry
 * @property integer $workers
 * @property string $average_salary
 * @property string $taxes_paid_amount
 * @property string $energy_charges
 */
class MonthlyReport extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%monthly_report}}';
    }

    public function rules(): array
    {
        return [
            [['id', 'industry', 'workers'], 'integer'],
            [['average_salary', 'taxes_paid_amount', 'energy_charges'], 'number'],
            ['provider', 'string', 'max' => 255],
            [
                'provider',
                'required',
                'when' => static function (self $model) {
                    return $model->energy_charges !== null;
                }
            ],
            /**
             * Формат взял как год-месяц, так как отчет вноситься раз в месяц за текущий месяц, в днях нет смысла
             */
            ['date', 'date', 'format' => 'php:Y-m'],

            /**
             * Делаем проверку на существование в базе отрасли,
             * чтобы нельзя было загружать два отчета за одну отрасль и один месяц (если нужно будет корректировать, можно сделать на отдельной вьюхе)
             */
            [
                'date',
                'unique',
                'when' => static function (self $model) {
                    return $model::find()->where(['industry' => $model->industry])->exists();
                }
            ],
            /**
             * Привязываемся к подотраслям, так как отчет не может быть сформирован за всю отрасль разом,
             * иначе невозможно будет сформировать отчет по подотраслям
             */
            [
                'industry',
                'exist',
                'skipOnError' => true,
                'targetClass' => SubIndustry::class,
                'targetAttribute' => ['industry' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Industry Name',
        ];
    }

    public function getId(): int
    {
        return $this->getPrimaryKey();
    }

    /**
     * @return int
     */
    public function getWorkers(): int
    {
        return $this->workers;
    }

    /**
     * @param int $workers
     */
    public function setWorkers(int $workers)
    {
        $this->workers = $workers;
    }

    /**
     * @return string
     */
    public function getAverageSalary(): string
    {
        return $this->average_salary;
    }

    /**
     * @param string $average_salary
     */
    public function setAverageSalary(string $average_salary)
    {
        $this->average_salary = $average_salary;
    }

    /**
     * @return string
     */
    public function getTaxesPaidAmount(): string
    {
        return $this->taxes_paid_amount;
    }

    /**
     * @param string $taxes_paid_amount
     */
    public function setTaxesPaidAmount(string $taxes_paid_amount)
    {
        $this->taxes_paid_amount = $taxes_paid_amount;
    }

    /**
     * @return string
     */
    public function getEnergyCharges(): string
    {
        return $this->energy_charges;
    }

    /**
     * @param string $energy_charges
     */
    public function setEnergyCharges(string $energy_charges)
    {
        $this->energy_charges = $energy_charges;
    }
}