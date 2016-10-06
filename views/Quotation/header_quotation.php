<?php
// http://www.bsourcecode.com/2013/04/yii-ajax-request-and-json-response-array/
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\jui\AutoComplete;

$this->title = 'ใบเสนอราคา';

$url = Url::to(['customer-list']);

Modal::begin([
    'id' => 'modal-save',
    'header' => '<h5>การบันทึก</h5>',
]);

echo 'บันทึกข้อมูลเรียบร้อย';

Modal::end();
?>
    <div class="row">
        <div class="container col-sm-6">
            <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-2 pull-left">
                            <label class="control-label">เลขที่</label>
                        </div>
                        <div class="col-sm-6">
                            <?php if( Yii::$app->request->get('quotation_id') != null ): ?>
                                <input id="quotationId" type="text" class="form-control col-sm-6" value=<?=Yii::$app->request->get('quotation_id')?>>
                            <?php else: ?>
                                <input id="quotationId" type="text" class="form-control col-sm-6" value=<?=$quotationId?>>
                            <?php endif; ?>
                        </div>
                        <a id="viewQuotation" class="btn btn-primary disabled"><span class="glyphicon glyphicon-search"></span></a>
                        <a href=<?=Url::to(['quotation/create'])?> class="btn btn-primary"><span class="glyphicon glyphicon-file"></span></a>
                    </div>
            </form>
        </div>
        <div class="container col-sm-6">
            <div class="pull-right"> 
                <a id="btn-register" href="<?= Url::to(['quotation/viecle-registration']) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-save-file"></span> ลงทะเบียนรถยนต์</a>
                <a id="btn-save" class="btn btn-primary disabled"><span class="glyphicon glyphicon-save-file"></span> บันทึก</a>
<!--                <a id="btn-print" target="_blank" href="<?= Url::to(['quotation/report', 'quotation_id' => Yii::$app->request->get('quotation_id')]) ?>"class="btn btn-success disabled"><span class="glyphicon glyphicon-print"></span> พิมพ์ใบเสนอราคา</a> </div>-->
                <a id="btn-print" target="_blank" class="btn btn-success disabled"><span class="glyphicon glyphicon-print"></span> พิมพ์ใบเสนอราคา</a> </div>
        </div>
    </div>
    
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']);?>
    <div class="row">
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ข้อมูลการซ่อม</h3> </div>
                <div class="panel-body">
                        
                        <?= $form->field($model, 'claim_no') ?>
                    
                        <?= $form->field($viecleModel, 'plate_no')->widget(AutoComplete::classname(), [
                            'options' =>[
                                'class' => 'form-control'
                            ],
                            'clientOptions' => [
                                'source' => Url::to(['viecle/plate-no-list']),
                            ],
                        ]) ?>
                    
                        <?= $form->field($customerModel, 'fullname')->widget(AutoComplete::classname(), [
                            'options' =>[
                                'class' => 'form-control'
                            ],
                            'clientOptions' => [
                                'source' => Url::to(['customer/customer-list']),
                            ],
                        ]) ?>

                    
                </div>
            </div>
        </div>
        <div class="container col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">รายละเอียดใบเสนอราคา</h3> </div>
                <div class="panel-body">
                    <h5><b>ข้อมูลรถ</b></h5>
                    <div class="row">
                        <div class="col-sm-6">เลขทะเบียน <?= $viecleModel->plate_no ?></div>
                        <div class="col-sm-6">ชื่อรถยนต์ <?= $viecleModel->viecle_name ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">เลขที่ตัวถัง <?= $viecleModel->body_code ?></div>
                        <div class="col-sm-6">เลขที่เครื่องยนต์ <?= $viecleModel->engin_code ?></div>
                    </div>
                    
                    <h5><b>ข้อมูลลูกค้า</b></h5>
                    <div class="row">
                        <div class="col-sm-6">ชื่อลูกค้า <?= $customerModel->fullname ?></div>
                        <div class="col-sm-6">ประเภทลูกค้า <?= $customerModel->type ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">โทรศัพท์ <?= $customerModel->phone ?></div>
                        <div class="col-sm-6">แฟ็กส์ <?= $customerModel->fax ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>

<?= $detailView ?>
    
