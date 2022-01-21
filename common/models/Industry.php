<?php

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
        return '{{%industry}}';
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
            'id' => Yii::t('common', 'ID'),
            'name' => Yii::t('common', 'Industry Name'),
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
}