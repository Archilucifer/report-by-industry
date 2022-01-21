<?php


/**
 * Class MonthlyReport
 *
 * @property integer $id
 * @property integer $workers
 * @property string $average_salary
 * @property string $taxes_paid_amount
 * @property string $energy_charges
 */
class MonthlyReport extends \yii\db\ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%monthly_report}}';
    }

    public function rules(): array
    {
        return [
            [['id','workers'], 'integer'],
            [['average_salary', 'taxes_paid_amount','energy_charges','number']],
            ['provider', 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'name' => Yii::t('common', 'Industry Name'),
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