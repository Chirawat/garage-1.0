<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $CID
 * @property string $fullname
 * @property string $type
 * @property string $address
 * @property integer $phone
 * @property integer $fax
 *
 * @property Quotation[] $quotations
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname', 'type', 'address'], 'string'],
            [['phone', 'fax', 'taxpayer_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CID' => 'Cid',
            'fullname' => 'ชื่อลูกค้า',
            'type' => 'ประเภทลูกค้า',
            'address' => 'ที่อยู่',
            'phone' => 'โทรศัพท์',
            'fax' => 'แฟกซ์',
            'taxpayer_id' => 'เลขประจำตัวผู้เสียภาษี',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotations()
    {
        return $this->hasMany(Quotation::className(), ['CID' => 'CID']);
    }
}
