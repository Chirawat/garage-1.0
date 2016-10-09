<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

class InvoiceController extends Controller
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
    
    
    public function actionInvoice(){
        return $this->render('invoice',[
            
        ]);
    }
    
    
    public function actionInvoiceReport(){
        //////////////// REPORT PROCEDURE ////////////////////////////////////////
        $thbStr = $this->num2thai(1200);
        $content = $this->renderPartial('invoice_report',[
            'thbStr' => $thbStr,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_UTF8, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        // format content from your own css file if needed or use the
        // enhanced bootstrap css built by Krajee for mPDF formatting 
        'cssFile' => '@app/web/css/pdf.css',
        // any css to be embedded if required
        //        'cssInline' => '.kv-heading-1{font-size:18px}', 
        // set mPDF properties on the fly
        'options' => ['title' => 'ใบเสนอราคา'],
        // call mPDF methods on the fly
        'methods' => [ 
            //'SetHeader'=>['Krajee Report Header'], 
            'SetFooter'=>['หน้า {PAGENO} / {nb}'],
            ]
        ]);

        $pdf->configure(array(
            'defaultfooterline' => '0', 
            'defaultfooterfontstyle' => 'R',
            'defaultfooterfontsize' => '10',
        ));

        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }
    
    function num2thai($number){
        $t1 = array("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
        $t2 = array("เอ็ด", "ยี่", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน");
        $zerobahtshow = 0; // ในกรณีที่มีแต่จำนวนสตางค์ เช่น 0.25 หรือ .75 จะให้แสดงคำว่า ศูนย์บาท หรือไม่ 0 = ไม่แสดง, 1 = แสดง
        (string) $number;
        $number = explode(".", $number);
        if(!empty($number[1])){
            if(strlen($number[1]) == 1){
                $number[1] .= "0";
            }else if(strlen($number[1]) > 2){
                if($number[1]{2} < 5){
                    $number[1] = substr($number[1], 0, 2);
                }else{
                    $number[1] = $number[1]{0}.($number[1]{1}+1);
                }
            }
        }

        for($i=0; $i<count($number); $i++){
            $countnum[$i] = strlen($number[$i]);
            if($countnum[$i] <= 7){
                $var[$i][] = $number[$i];
            }else{
                $loopround = ceil($countnum[$i]/6);
                for($j=1; $j<=$loopround; $j++){
                    if($j == 1){
                            $slen = 0;
                        $elen = $countnum[$i]-(($loopround-1)*6);
                    }else{
                        $slen = $countnum[$i]-((($loopround+1)-$j)*6);
                        $elen = 6;
                    }
                    $var[$i][] = substr($number[$i], $slen, $elen);
                }
            }	

            $nstring[$i] = "";
            for($k=0; $k<count($var[$i]); $k++){
                if($k > 0) $nstring[$i] .= $t2[7];
                    $val = $var[$i][$k];
                    $tnstring = "";
                    $countval = strlen($val);
                for($l=7; $l>=2; $l--){
                    if($countval >= $l){
                        $v = substr($val, -$l, 1);
                        if($v > 0){
                            if($l == 2 && $v == 1){
                                $tnstring .= $t2[($l)];
                            }elseif($l == 2 && $v == 2){
                                $tnstring .= $t2[1].$t2[($l)];
                            }else{
                                $tnstring .= $t1[$v].$t2[($l)];
                            }
                        }
                    }
                }

                if($countval >= 1){
                    $v = substr($val, -1, 1);
                    if($v > 0){
                        if($v == 1 && $countval > 1 && substr($val, -2, 1) > 0){
                            $tnstring .= $t2[0];
                        }else{
                            $tnstring .= $t1[$v];
                        }
                    }
                }

                $nstring[$i] .= $tnstring;
            }
        }
        $rstring = "";
        if(!empty($nstring[0]) || $zerobahtshow == 1 || empty($nstring[1])){
            if($nstring[0] == "") $nstring[0] = $t1[0];
                $rstring .= $nstring[0]."บาท";
        }
        if(count($number) == 1 || empty($nstring[1])){
            $rstring .= "ถ้วน";
        }else{
            $rstring .= $nstring[1]."สตางค์";
        }
        return $rstring;
    }
}
?>