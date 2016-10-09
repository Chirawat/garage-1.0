<?php
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="form-group">
    <?php Modal::begin(['id' => 'add-description', 'header' => 'เพิ่มรายการ']) ?>
    <?php $form = ActiveForm::begin([
                'action' => ['quotation/add-description'],
                'layout' => 'horizontal',
            ]);?>
    <div class="row">
        <div class="container col-sm-12">
            <div class="form-group">

                <?= $form->field($newDescription, 'description')->textInput() ?>

                <?= $form->field($newDescription, 'price')->textInput() ?>

                <?= $form->field($newDescription, 'type')->dropdownList(['MAINTENANCE' => 'รายการซ่อม', 'PART' => 'รายการอะไหล่']) ?>
                <input type="hidden" name="qid" value="<?= $qid ?>"/>
                
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <?= Html::submitButton('เพิ่มรายการ', ['class' => 'btn btn-primary'] ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php Modal::end() ?>
    <a href="#add-description" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> เพิ่มรายการ</a>
    <a href="<?= Url::to(['quotation/view', 'quotation_id' => $quotation_id]) ?>" data-toggle="modal" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> เสร็จสิ้น</a>
</div>
<table class="table table-bordered">
    <thead>
        <tr bgcolor="#000000">
            <th class="col-sm-1" class="text-white" style="color:white;">ลำดับ</th>
            <th style="color:white;">รายการ</th>
            <th class="col-sm-2" style="color:white;">ราคา</th>
            <th class="col-sm-2" style="color:white;">ประเภท</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; foreach($descriptionModel as $description): ?>
            <?php
                // Modal
                $modalEditId = "edit-". $i;
                Modal::begin([
                    'id' => $modalEditId,
                    'header' => 'แก้ไขรายการ',
                ]); ?>
                <div class="row">
                    <div class="container col-sm-12">
                        <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
                        <?php $did = $description->DID; ?>
                        <div class="row">
                            <input type="hidden" name="did" value="<?= $description->DID ?>"/>
                            <?= $form->field($description, 'description')->textInput() ?>
                        </div>
                        <div class="row">
                            <?= $form->field($description, 'price')->textInput() ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <?= Html::submitButton("แก้ไขรายการ", ['class' => 'btn btn-primary']) ?>
                             </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <?php Modal::end(); ?>
        
                <?php $modalDelId = "del-" . $i;
                Modal::begin([
                    'id' => $modalDelId,
                    'header' => "ยืนยันการลบ",
                ]);?>
                <div class="row">
                    <div class="container">
                        <?php $form = ActiveForm::begin(['action' => ['quotation/delete-description']]) ?>
                            คุณต้องการที่จะลบรายการที่ <?= $i ?> ใช่หรือไม่
                            <input type="hidden" name="did" value="<?= $description->DID ?>" />
                            <input type="hidden" name="qid" value="<?= $description->quotation->QID ?>" />
                            <div class="row"><br></div>
                                <div>
                                    <?=Html:: submitButton('ตกลง', ['class' => 'btn btn-primary']); ?>
                                </div>
                            
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
                <?php Modal::end() ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $description->description ?></td>
                <td class="text-right"><?= number_format( $description->price, 2 ) ?></td>
                <td><?= $description->type ?></td>
                <td>
                    <div class="btn-group">
                        <a href="#<?= $modalEditId ?>" data-toggle="modal" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="#<?= $modalDelId ?>" data-toggle="modal" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>        
</table>
