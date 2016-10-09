<?php
use yii\helpers\Html;
?>

<div class="form-group">
    <?= Html::a('แก้ไขรายการ',['quotation/edit', 'qid' => $qid], ['class' => 'btn btn-primary']) ?>
</div>
<table class="table table-bordered" id="myTable">
    <thead>
        <tr bgcolor="#000000">
            <th class="text-white" style="color:white;">ลำดับ</th>
            <th class="col-sm-4" style="color:white;">รายการซ่อม</th>
            <th class="col-sm-2" style="color:white;">ราคา</th>
            <th class="col-sm-4" style="color:white;">รายการอะไหล่</th>
            <th class="col-sm-2" style="color:white;">ราคา</th>
            <th></th>
        </tr>
        <tbody>
            <?php for($i = 0; $i < $numRow; $i++):?>
                <tr>
                    <td><?= ($i + 1) ?></td>
                    <td><?= isset($maintenanceDescriptionModel[$i]) ? $maintenanceDescriptionModel[$i]->description:null ?></td>
                    <td class="text-right"><?= isset($maintenanceDescriptionModel[$i]) ? number_format( $maintenanceDescriptionModel[$i]->price, 2 ):null ?></td>
                    <td><?= isset($partDescriptionModel[$i]) ? $partDescriptionModel[$i]->description:null ?></td>
                    <td class="text-right"><?= isset($partDescriptionModel[$i]) ? number_format( $partDescriptionModel[$i]->price, 2 ):null ?></td>
                    <td>
<!--                        <a href="#" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>-->
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td>รวมรายการซ่อม</td>               
                <td><?= number_format( $sumMaintenance, 2 ) ?></td>
                <td>รวมรายการอะไหล่</td>
                <td><?= number_format( $sumPart, 2 ) ?></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>รวมสุทธิ</td>
                <td><?= number_format( $sumMaintenance + $sumPart, 2 ) ?></td>
                <td></td>
            </tr>
        </tfoot>
</table>