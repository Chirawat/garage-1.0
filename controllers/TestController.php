<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Quotation;
use app\models\Customer;
use app\models\Viecle;
use app\models\Description;

class TestController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actionAddQuotation(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        // add quotation
        $ret = null;
        for($i = 0; $i < 100; $i++){
            $quotation = new Quotation();
            $customer = Customer::findOne( rand(240, 330) );
            $viecle = Viecle::findOne( rand(105, 200) );

            $quotation->CID = $customer->CID;
            $quotation->VID = $viecle->VID;
        
            $day = ($i % 29) + 1;
            $month = ($i % 11) + 1;
            $year = rand(2015, 2016);
            $quotation->quotation_date = $year . "-" . $month . "-" . $day;
            $quotation->save();
            
            // add description
            $QID = Quotation::find()->orderBy(['QID' => SORT_DESC])->one()["QID"];
            
            for($j = 0; $j < 3; $j++){
                $description = new Description();
                $description->QID = $QID;
                $description->description = "test";
                $description->price = 100;
            }
            
            $ret  += "quotation id = " . $QID . "added\n";
        }
        return $ret;
        
    }
    
    public function actionAddDescription(){
        for($i = 58; $i <= 159; $i++ ){
            $description = new Description();
            $description->QID = $i;
            $description->description = "test";
            $description->price = 100;
            
            $description->save();
        }
    }
}
