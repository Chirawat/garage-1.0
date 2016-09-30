<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "insurance_company".
 *
 * @property integer $ICID
 * @property string $name
 * @property string $address
 * @property integer $phone
 * @property integer $fax
 *
 * @property Quotation[] $quotations
 */
class InsuranceCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insurance_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address'], 'string'],
            [['phone', 'fax'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ICID' => 'Icid',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'fax' => 'Fax',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotations()
    {
        return $this->hasMany(Quotation::className(), ['ICID' => 'ICID']);
    }
}
