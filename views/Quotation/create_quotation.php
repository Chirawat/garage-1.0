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


//use keygenqt\autocompleteAjax\AutocompleteAjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\QuotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบเสนอราคา';

$url = Url::to(['customer-list']);

Modal::begin([
    'id' => 'modal-save',
    'header' => '<h2>Hello world</h2>',
    //'toggleButton' => ['label' => 'click me'],
]);

echo 'Say hello...';

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
                            <input type="text" class="form-control col-sm-6" disabled >
                        </div>
                        <a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></a>
                        <a href=<?=Url::to(['quotation/create'])?> class="btn btn-primary"><span class="glyphicon glyphicon-file"></span></a>
                    </div>
            </form>
        </div>
        <div class="container col-sm-6">
            <div class="pull-right"> 
                <a href="<?= Url::to(['viecle/create']) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-save-file"></span> ลงทะเบียนรถยนต์</a>
                <a id="btn-save" class="btn btn-primary"><span class="glyphicon glyphicon-save-file"></span> บันทึก</a>
                <a target="_blank" href="<?= Url::to(['site/report']) ?>"class="btn btn-success"><span class="glyphicon glyphicon-print"></span> พิมพ์ใบเสนอราคา</a> </div>
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
                    <h3 class="panel-title">ข้อมูลรถ</h3> </div>
                <div class="panel-body">
                        
                        
                    
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>
    <div class="quotation-content">
        <p id="demo"></p>
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
                <tr id="input-row">
                    <td></td>
                    <td>
                        <input class="form-control" type="text" id="maintenance-list" /> </td>
                    <td>
                        <input class="form-control" type="number" id="maintenance-price" /> </td>
                    <td>
                        <input class="form-control" type="text" id="part-list" /> </td>
                    <td>
                        <input class="form-control" type="number" id="part-price" /> </td>
                    <td>
                        <button class="btn btn-primary btn-xs" id="add-button"><span class="glyphicon glyphicon-plus"></span></button>
                    </td>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td>รวมรายการซ่อม</td>
                    <td><div id="maintenance-total"></div></td>
                    <td>รวมรายการอะไหล่</td>
                    <td><div id="part-total"></div></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>รวมสุทธิ</td>
                    <td><div id="total"></div></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>