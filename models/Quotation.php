<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotation".
 *
 * @property integer $QID
 * @property integer $CID
 * @property integer $VID
 * @property string $Employee
 * @property integer $TID
 * @property string $quotation_id
 * @property string $quotation_date
 * @property string $claim_no
 *
 * @property Description[] $descriptions
 * @property Customer $c
 * @property Viecle $v
 */
class Quotation extends \yii\db\ActiveRecord
{
    //public $cnt;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quotation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CID', 'VID', 'TID'], 'integer'],
            [['Employee', 'quotation_id', 'claim_no'], 'string'],
            [['quotation_date'], 'safe'],
            [['CID'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CID' => 'CID']],
            [['VID'], 'exist', 'skipOnError' => true, 'targetClass' => Viecle::className(), 'targetAttribute' => ['VID' => 'VID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'QID' => 'รหัสใบเสนอราคา',
            'CID' => 'รหัสลูกค้า',
            'VID' => 'รหัสรถ',
            'Employee' => 'พนักงาน',
            'TID' => 'Tid',
            'quotation_id' => 'รหัสใบเสนอราคาอ้างอิง',
            'quotation_date' => 'วันทีทำรายการ',
            'claim_no' => 'เลขที่เคลม',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescriptions()
    {
        return $this->hasMany(Description::className(), ['QID' => 'QID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['CID' => 'CID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViecle()
    {
        return $this->hasOne(Viecle::className(), ['VID' => 'VID']);
    }
}
