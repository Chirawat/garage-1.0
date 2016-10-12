<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>
    <div class="viecle-form">
        
        <?php $form = ActiveForm::begin([
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-4',
                        'offset' => 'col-sm-offset-4',
                        'wrapper' => 'col-sm-8',
                        'error' => '',
                        'hint' => '',
                    ],
                ],
            ]); 
        ?>
        
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ข้อมูลรถยนต์</h3> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class='col-sm-6'>    
                            <?= $form->field($viecleModel, 'plate_no')->textInput() ?>
                        </div>
                        <div class='col-sm-6'>    
                            <?= $form->field($viecleModel, 'viecle_name')->textInput() ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'>    
                            <?= $form->field($viecleModel, 'model')->textInput() ?>
                        </div>
                        <div class='col-sm-6'>    
                            <?= $form->field($viecleModel, 'body_code')->textInput() ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'>    
                            <?= $form->field($viecleModel, 'engin_code')->textInput() ?>
                        </div>
                        <div class='col-sm-6'>    
                            <?= $form->field($viecleModel, 'viecle_year')->textInput() ?>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'>    
                            <?= $form->field($viecleModel, 'body_type')->textInput() ?>
                        </div>
                        <div class='col-sm-6'>    
                            <?= $form->field($viecleModel, 'cc')->textInput() ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'>    
                            <?= $form->field($viecleModel, 'seat')->textInput() ?>
                        </div>
                        <div class='col-sm-6'>    
                            <?= $form->field($viecleModel, 'weight')->textInput() ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ข้อมูลลูกค้า</h3> </div>
                <div class="panel-body">
                    
                    <div class="row">
                        <div class='col-sm-6'>    
                            <?= $form->field($customerModel, 'type')->inline()->radioList(['INSURANCE' => 'บริษัทประกัน', 'GENERAL' => 'ลูกค้าทั่วไป']) ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'> 
                            <?= $form->field($customerModel, 'fullname')->textInput() ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($customerModel, 'address')->textArea(['rows' => '3']) ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'> 
                            <?= $form->field($customerModel, 'phone')->textInput() ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'> 
                            <?= $form->field($customerModel, 'fax')->textInput() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-sm-6'> 
                            <?= $form->field($customerModel, 'taxpayer_id')->textInput() ?>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="container">
                <div class="form-group">
                    <a href=<?= Url::to(['quotation/create']) ?> class="btn btn-primary">กลับ</a>
                    <?= Html::submitButton('บันทึก' ,['class' => 'btn btn-success']) ?>
                </div>
            </div>
        
            <?php ActiveForm::end(); ?>
    </div>