<?php

namespace common\models;

/**
 * Class SubIndustry
 *
 * @property integer $id
 * @property string $name
 * @property integer $main_industry
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
            'name' => 'Industry Name',
            'main_industry' => 'Main Industry Name',
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
}