<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viecle".
 *
 * @property integer $VID
 * @property string $viecle_type
 * @property string $plate_no
 * @property string $viecle_name
 * @property string $brand
 * @property string $model
 * @property string $body_code
 * @property string $engin_code
 * @property integer $viecle_year
 * @property string $body_type
 * @property integer $cc
 * @property integer $seat
 * @property integer $weight
 *
 * @property Quotation[] $quotations
 */
class Viecle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'viecle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['viecle_type', 'plate_no', 'viecle_name', 'brand', 'model', 'body_code', 'engin_code', 'body_type'], 'string'],
            [['viecle_year', 'cc', 'seat', 'weight'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'VID' => 'Vid',
            'viecle_type' => 'ชนิดรถยนต์',
            'plate_no' => 'เลขทะเบียน',
            'viecle_name' => 'ชื่อรถยนต์',
            'brand' => 'ยี่ห้อ',
            'model' => 'รุ่น',
            'body_code' => 'เลขตัวถัง',
            'engin_code' => 'เลขเครื่องยนต์',
            'viecle_year' => 'ปี',
            'body_type' => 'แบบตัวถัง',
            'cc' => 'ซีซี',
            'seat' => 'ที่นั่ง',
            'weight' => 'น้ำหนักรวม',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotations()
    {
        return $this->hasMany(Quotation::className(), ['VID' => 'VID']);
    }
}
