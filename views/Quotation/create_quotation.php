<?php
// http://www.bsourcecode.com/2013/04/yii-ajax-request-and-json-response-array/
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\jui\AutoComplete;
use yii\bootstrap\Modal;
//use keygenqt\autocompleteAjax\AutocompleteAjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\QuotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$data = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");

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
                            <input type="text" class="form-control col-sm-6" disabled value=<?=$quotationId?>>
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
    <?php $form = ActiveForm::begin([
                        'layout' => 'horizontal',
                            'fieldConfig' => [
                                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                'horizontalCssClasses' => [
                                    'label' => 'col-sm-3',
                                    'offset' => 'col-sm-offset-8',
                                    'wrapper' => 'col-sm-8',
                                    'error' => '',
                                    'hint' => '',
                                ],
                            ],
                        ]); 
                    ?>
    <div class="row">
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ข้อมูลการซ่อม</h3> </div>
                <div class="panel-body">
                    
                    
<?php
$jsCustomer = <<< 'JS'
function( request, response ) {
    $.ajax( {
        url: "index.php?r=customer/customer-list",
        dataType: "json",
        data: {
            term: request.term
        },
        success: function( data ) {
            response( data );
        }
    } );
}
JS;
?>
                    <div class="row">
                        <?= $form->field($customerModel, 'type')->inline()->radioList(['INSURANCE' => 'บริษัทประกัน', 'GENERAL' => 'ลูกค้าทั่วไป', 'PARTIES' => 'รถคู่กรณี']) ?>
                    </div>
                    <div class="row">
                        <?= $form->field($model, 'claim_no')->textInput() ?>
                    </div>
                    <div class="row">
                        <?= $form->field($customerModel, 'fullname')->widget(AutoComplete::classname(), [
                              'clientOptions' => [
                                  'source' => new JsExpression($jsCustomer),
                              ],
                               'options' => ['class' => 'form-control'],
                          ]) ?>
                    </div>
                        <?= $form->field($customerModel, 'phone')->textInput() ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="container col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ข้อมูลรถ</h3> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                         <?= $form->field($viecleModel, 'viecle_name')->widget(AutoComplete::classname(), [
                              'clientOptions' => [
                                  'source' => new JsExpression($jsCustomer),
                              ],
                               'options' => ['class' => 'form-control'],
                          ]) ?>
                    </div>
                    
                    <div class="row">
                         <?= $form->field($viecleModel, 'brand')->widget(AutoComplete::classname(), [
                              'clientOptions' => [
                                  'source' => new JsExpression($jsCustomer),
                              ],
                               'options' => ['class' => 'form-control'],
                          ]) ?>
                    </div>
                    
                    <div class="row">
                        <?= $form->field($viecleModel, 'model')->widget(AutoComplete::classname(), [
                              'clientOptions' => [
                                  'source' => new JsExpression($jsCustomer),
                              ],
                               'options' => ['class' => 'form-control'],
                          ]) ?>
                    </div>
                    
                    <div class="row">
                        <?= $form->field($viecleModel, 'viecle_year')->widget(AutoComplete::classname(), [
                              'clientOptions' => [
                                  'source' => new JsExpression($jsCustomer),
                              ],
                               'options' => ['class' => 'form-control'],
                          ]) ?>
                    </div>
                    
                    <div class="row">
                         <?= $form->field($viecleModel, 'engin_code')->widget(AutoComplete::classname(), [
                              'clientOptions' => [
                                  'source' => new JsExpression($jsCustomer),
                              ],
                               'options' => ['class' => 'form-control'],
                          ]) ?>
                    </div>
                    
                    <div class="row">
                         <?= $form->field($viecleModel, 'body_code')->widget(AutoComplete::classname(), [
                              'clientOptions' => [
                                  'source' => new JsExpression($jsCustomer),
                              ],
                               'options' => ['class' => 'form-control'],
                          ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
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