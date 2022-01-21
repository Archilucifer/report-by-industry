<?php

namespace common\models;

use common\models\SubIndustry;
use Yii;
use yii\db\ActiveQuery;

/**
 * Class Industry
 *
 * @property integer $id
 * @property string $name
 */
class Industry extends \yii\db\ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%industries}}';
    }

    public function rules(): array
    {
        return [
            ['id', 'integer'],
            ['name', 'string', 'max' => 255],
            ['name', 'unique'],
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

    public function getSubIndustries(): ActiveQuery
    {
        return $this->hasMany(SubIndustry::class, ['main_industry' => 'id']);
    }
}