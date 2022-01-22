<?php

namespace common\models;

use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * Class SubIndustry
 *
 * @property integer $id
 * @property string $name
 * @property integer $main_industry
 * @property Industry $industries
 */
class SubIndustry extends \yii\db\ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%sub_industries}}';
    }

    public function rules(): array
    {
        return [
            [['id', 'main_industry'], 'integer'],
            ['name', 'string', 'max' => 255],
            ['name', 'unique'],

            [
                'main_industry', 'exist', 'skipOnError' => true,
                'targetClass' => Industry::class,
                'targetAttribute' => ['main_industry' => 'id']
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
            'name' => 'Sub industry name',
            'main_industry' => 'Main industry name',
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getMainIndustry(): int
    {
        return $this->main_industry;
    }

    /**
     * @param int $main_industry
     */
    public function setMainIndustry(int $main_industry)
    {
        $this->main_industry = $main_industry;
    }

    public function getIndustries(): ActiveQuery
    {
        return $this->hasOne(Industry::class, ['id' => 'main_industry']);
    }

    public static function getIndustriesList(): array
    {
        return self::find()->select(
            [
                new Expression('CONCAT(`name`, \' (\', id, \')\')'),
                'id'
            ]
        )->asArray()->indexBy('id')->orderBy(['id' => SORT_ASC])->column();
    }

    public static function getListSubIndustriesWithIndustryId(): array
    {
        return self::find()
            ->select(
                [
                    new Expression(
                        'CONCAT('
                        . Industry::tableName() . ' . name, \' (\', '
                        . Industry::tableName() . '.id,\')\') as industry'
                    ),
                    new Expression(
                        'GROUP_CONCAT(
                    CONCAT(' . self::tableName() . '.id) ORDER BY '
                        . self::tableName() . '.id ASC) as id'
                    )
                ]
            )
            ->joinWith('industries')
            ->asArray()
            ->indexBy(self::tableName() . '.id')
            ->groupBy('industry')
            ->orderBy(['industry' => SORT_ASC])
            ->column();
    }
}