<?php
// http://www.bsourcecode.com/2013/04/yii-ajax-request-and-json-response-array/
//use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\jui\AutoComplete;
use yii\jui\JuiAsset;

$this->title = 'ใบเสร็จ';

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
                            <!--View-->
                            <input id="invoiceId" type="text" class="form-control col-sm-6" >
                        <?php else: ?>
                            <!--New-->
                            <input id="invoiceId" type="text" value="<?= $iid ?>" class="form-control col-sm-6" >
                        <?php endif; ?>
                    </div>
                    <a id="viewInovoice" class="btn btn-primary disabled"><span class="glyphicon glyphicon-search"></span></a>
                    <a href="<?=Url::to(['invoice/create'])?>" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span></a>
                </div>
        </form>
    </div>
    <div class="container col-sm-6">
        <div class="pull-right"> 
            <a id="btn-save-invoice" class="btn btn-primary disabled"><span class="glyphicon glyphicon-save-file"></span> บันทึก</a>
            <a href="<?= Url::to(['invoice/invoice-report', 'invoice_id'=> Yii::$app->request->get('invoice_id'), 'iid'=> Yii::$app->request->get('iid')]) ?>" id="btn-print-invoice" target="_blank" class="btn btn-success disabled"><span class="glyphicon glyphicon-print"></span> พิมพ์ใบเสร็จ</a> </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">ข้อมูลลูกค้า</h3> </div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <?php if( $customer == null ): ?>
                            <lable class="col-sm-2" for="customer">ลูกค้า</lable>
                            <div class="col-sm-10">
                                <?= AutoComplete::widget([
                                    'id' => 'customer',
                                    'options' =>[
                                        'class' => 'form-control'
                                    ],
                                    'clientOptions' => [
                                        'source' => Url::to(['customer/customer-list']),
                                    ],
                                    'clientEvents' => [
                                        'select' => 'function(){ }',
                                    ],
                                ]) ?>
                            </div>
                        <?php else: ?>
                            <lable class="col-sm-4" for="customer">ลูกค้า</lable>
                            <div class="col-sm-8">
                                <b><?= $customer->fullname ?></b>
                            </div>
                            <lable class="col-sm-4" for="customer">ที่อยู่</lable>
                            <div class="col-sm-8">
                                <?= $customer->address ?> 
                            </div>
                            <lable class="col-sm-4" for="customer">เลขประจำตัวผู้เสียภาษี</lable>
                            <div class="col-sm-8">
                                 <?= $customer->phone ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $detail ?>