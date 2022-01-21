<?php

namespace common\models;

use Yii;

/**
 * Class Enterprise
 *
 * @property integer $id
 * @property integer $industry
 * @property string $inn
 * @property string $address
 * @property string $phone
 * @property string $email
 */
class Enterprise extends \yii\db\ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%enterprises}}';
    }

    public function rules(): array
    {
        return [
            [['owner', 'industry'], 'required'],
            [['id', 'industry'], 'integer'],
            ['inn', 'string', 'max' => 12],
            ['address', 'string', 'max' => 255],
            ['phone', 'string', 'max' => 10],
            ['email', 'email'],
            [
                'industry', 'exist', 'skipOnError' => true,
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
            'owner' =>'Owner',
            'industry' => 'Industry',
            'inn' => 'Inn',
            'address' => 'Address',
            'phone' => 'Phone number',
            'email' => 'Email address',
        ];
    }

    public function getId(): int
    {
        return $this->getPrimaryKey();
    }

    /**
     * @return int
     */
    public function getIndustry(): int
    {
        return $this->industry;
    }

    /**
     * @param int $industry
     */
    public function setIndustry(int $industry)
    {
        $this->industry = $industry;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

    /**
     * @param string $inn
     */
    public function setInn(string $inn)
    {
        $this->inn = $inn;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
}