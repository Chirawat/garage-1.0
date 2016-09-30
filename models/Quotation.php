<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotation".
 *
 * @property integer $QID
 * @property integer $CID
 * @property integer $VID
 * @property integer $EID
 * @property integer $TID
 * @property string $quotation_id
 * @property string $quotation_date
 * @property string $claim_no
 *
 * @property Description[] $descriptions
 * @property Customer $c
 * @property Employee $e
 * @property Viecle $v
 */
class Quotation extends \yii\db\ActiveRecord
{
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
            [['CID', 'VID', 'EID', 'TID'], 'integer'],
            [['quotation_id', 'claim_no'], 'string'],
            [['quotation_date'], 'safe'],
            [['CID'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CID' => 'CID']],
            [['EID'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['EID' => 'EID']],
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
            'EID' => 'รหัสพนักงาน',
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
    public function getC()
    {
        return $this->hasOne(Customer::className(), ['CID' => 'CID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getE()
    {
        return $this->hasOne(Employee::className(), ['EID' => 'EID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getV()
    {
        return $this->hasOne(Viecle::className(), ['VID' => 'VID']);
    }
}
