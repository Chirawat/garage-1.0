<?php use yii\helpers\Html; 
function DateThai($strDate){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม.","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    
//    return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
    return "$strDay $strMonthThai $strYear";
}
?>
    <table width="100%">
        <tr>
            <td>
                <?=Html::img(Yii::getAlias('@app').'/web/img/intel_logo.png', ['width' => 100])?>
            </td>
            <td>
                <h3>เจริญการช่าง</h3> <small>345 ม.3 บ้านดอนมะยาง ต.ตาดทอง อ.เมืองยโสธร จ.ยโสธร 35000<br/>
                เบอร์โทรศัพท์ 045-712911, 082-7565361 เบอร์แฟกซ์ 045-712911</small> 
            </td>
            <td class="text-right" valign="top">
                เลขที่ <?= $model->quotation_id ?>
            </td>
        </tr>
    </table>
    <br/>
    <h3 class="header">ใบเสนอราคา</h3>
    <table width="100%">
        <tr>
            <td class="text-right">วันที่ <?= DateThai($model->quotation_date) ?></td>
        </tr>
        <tr>
            <td><?= $customerModel->fullname ?> เลขที่เคลม <?= $model->claim_no ?></td>
        </tr>
    </table>
<br/>
    <table class="table_bordered" width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
            <td class="column-header" colspan="2">ชื่อรถยนต์ / รุ่น</td>
            <td class="column-header">เลขทะเบียน</td>
            <td class="column-header" colspan="2">เลขตัวถัง</td>
            <td class="column-header" colspan="2">เลขเครื่องยนต์</td>
            <td class="column-header">ปีรุ่น</td>
        </tr>
        <tr>
            <td class="text-centered" colspan="2"><?= $viecleModel->brand . " " . $viecleModel->model ?></td>
            <td class="text-centered"><?= $viecleModel->plate_no ?></td>
            <td class="text-centered" colspan="2"><?= $viecleModel->body_code ?></td>
            <td class="text-centered" colspan="2"><?= $viecleModel->engin_code ?></td>
            <td class="text-centered"><?= $viecleModel->viecle_year ?></td>
        </tr>
    </table>
    <!--<pagebreak />-->
    <table class="table_bordered" width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
            <td class="column-header">ลำดับ</td>
            <td class="column-header" colspan="2">รายการซ่อม</td>
            <td class="column-header">ราคา</td>
            <td class="column-header" colspan="2">รายการอะไหล่</td>
            <td class="column-header">ราคา</td>
        </tr>
        <?php for($i = 0; $i < $numRow; $i++):?>
        <tr>
            <td class="text-centered"><?= ($i + 1) ?></td>
            <td colspan="2" class="description"><?= isset($maintenanceDescriptionModel[$i]) ? $maintenanceDescriptionModel[$i]->description:null ?></td>
            <td class="text-right"><?= isset($maintenanceDescriptionModel[$i]) ? number_format( $maintenanceDescriptionModel[$i]->price, 2):null ?></td>
            <td colspan="2" class="description"><?= isset($partDescriptionModel[$i]) ? $partDescriptionModel[$i]->description:null ?></td>
            <td class="text-right"><?= isset($partDescriptionModel[$i]) ? number_format( $partDescriptionModel[$i]->price, 2 ):null ?></td>
        </tr>
       <?php endfor; ?>
        <tr>
            <td class="total-cell"></td>
            <td class="text-right" colspan="2"><b>รวมรายการซ่อม</b></td>
            <td class="text-right"><b><?= number_format( $sumMaintenance, 2) ?></b></td>
            <td class="text-right" colspan="2"><b>รวมรายการอะไหล่</b></td>
            <td class="text-right"><b><?= number_format( $sumPart, 2 ) ?></b></td>
        </tr>
        <tr>
            <td class="total-cell" colspan="4"></td>
            <td class="text-right" colspan="2"><b>รวมสุทธิ</b></td>
            <td class="text-right"><b><?= number_format( $sumMaintenance + $sumPart, 2) ?></b></td>
        </tr>
    </table>
    <br/>
    <br/>
    <br/>
    <table align="right">
        <tr>
            <td>ลงชื่อ&emsp;............................................ ผู้เสนอราคา
                <br/> &emsp;&emsp;&emsp;(&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;)</td>
        </tr>
    </table>