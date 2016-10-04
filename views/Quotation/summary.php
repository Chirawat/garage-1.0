<?php
use yii\jui\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = "รายงานสรุป";
?>
    <div class="row">
        <div class="container">
            <?= Html::beginForm( Url::to(['quotation/summary']), 'post', ['class' => 'form-inline'] ); ?>
                <div class="form-group">
                    <?= DatePicker::widget([
                        'name'  => 'start_date',
                        'value'  => "01-01-" . date("Y"),
                        'language' => 'th',
                        'dateFormat' => 'dd-MM-yyyy',
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ]);?>
                </div>
                <div class="form-group">
                    <?= DatePicker::widget([
                        'name'  => 'end_date',
                        'value'  => date("d-m-Y"),
                        'language' => 'th',
                        'dateFormat' => 'dd-MM-yyyy',
                        'options' => [
                            'class' => 'form-control col-sm-4'
                        ],
                    ]);?>
                </div>
                <?= Html::submitButton("แสดง", ['class' => 'btn btn-primary'] ) ?>
                    <?= Html::endForm(); ?>
        </div>
        <br class="transparent">
    </div>
    <div class="row">
        <div class="container">
            <table class="table table-condensed">
                <thead>
                    <tr bgcolor="#000000">
                        <th colspan="1" style="color: white;">เดือน</th>
                        <th colspan="3" style="color: white;">ลูกค้า</th>
                        <th colspan="1" style="color: white;">จำนวน</th>
                        <th colspan="1" style="color: white;">มูลค่า</th>
                    </tr>
                    <tr bgcolor="#ddd">
                        <td colspan="1">มกราคม</td>
                        <td colspan="3"></td>
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php $num = 1; foreach($rows as $row): ?>
                        <tr>
                            <th colspan="1" scope="row">
                            </th>
                            <td colspan="3">
                                <?= $num++ . ".  " . $row['customer'] ?>
                            </td>
                            <td colspan="1">
                                <?= $row['count'] ?>
                            </td>
                            <td colspan="1">
                                <?= number_format($row['value'], 2) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                
                    <tr bgcolor="#ddd">
                        <td colspan="1"></td>
                        <td colspan="3"><b>รวม</b></td>
                        <td colspan="1"><b>100.00</b></td>
                        <td colspan="1"><b>100.00</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>