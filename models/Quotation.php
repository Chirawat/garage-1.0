<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "quotation".
 *
 * @property integer $QID
 * @property integer $VID
 * @property integer $CID
 * @property integer $ICID
 * @property integer $EID
 * @property string $quotation_id
 * @property string $quotation_date
 * @property string $claim_no
 *
 * @property Customer $c
 * @property Employee $e
 * @property InsuranceCompany $iC
 * @property Viecle $v
 * @property QuotationDescription[] $quotationDescriptions
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
            [['VID', 'CID', 'EID'], 'required'],
            [['VID', 'CID', 'ICID', 'EID'], 'integer'],
            [['quotation_id', 'claim_no'], 'string'],
            [['quotation_date'], 'safe'],
            [['CID'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CID' => 'CID']],
            [['EID'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['EID' => 'EID']],
            [['ICID'], 'exist', 'skipOnError' => true, 'targetClass' => InsuranceCompany::className(), 'targetAttribute' => ['ICID' => 'ICID']],
            [['VID'], 'exist', 'skipOnError' => true, 'targetClass' => Viecle::className(), 'targetAttribute' => ['VID' => 'VID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'QID' => 'Qid',
            'VID' => 'Vid',
            'CID' => 'Cid',
            'ICID' => 'Icid',
            'EID' => 'Eid',
            'quotation_id' => 'Quotation ID',
            'quotation_date' => 'Quotation Date',
            'claim_no' => 'เลขที่เคลม',
        ];
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
    public function getIC()
    {
        return $this->hasOne(InsuranceCompany::className(), ['ICID' => 'ICID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getV()
    {
        return $this->hasOne(Viecle::className(), ['VID' => 'VID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotationDescriptions()
    {
        return $this->hasMany(QuotationDescription::className(), ['QID' => 'QID']);
    }
}
