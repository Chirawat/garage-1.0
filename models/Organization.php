<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property integer $OID
 * @property string $name
 * @property string $address
 * @property integer $phone
 * @property integer $fax
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization';
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
            'OID' => 'Oid',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'fax' => 'Fax',
        ];
    }
}
