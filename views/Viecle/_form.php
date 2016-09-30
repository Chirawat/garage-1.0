<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Viecle */
/* @var $form yii\widgets\ActiveForm */
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
                            <?= $form->field($model, 'viecle_type')->inline()->radioList(['CAR' => 'รถยนต์', 'MOTORCYCLE' => 'รถมอเตอร์ไซค์']) ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'>    
                            <?= $form->field($model, 'plate_no')->textInput() ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'>    
                            <?= $form->field($model, 'viecle_name')->textInput() ?>
                        </div>
                        <div class='col-sm-6'>    
                            <?= $form->field($model, 'model')->textInput() ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'>    
                            <?= $form->field($model, 'body_code')->textInput() ?>
                        </div>
                        <div class='col-sm-6'>    
                            <?= $form->field($model, 'engin_code')->textInput() ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'>    
                            <?= $form->field($model, 'viecle_year')->textInput() ?>
                        </div>
                        <div class='col-sm-6'>    
                            <?= $form->field($model, 'body_type')->textInput() ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'>    
                            <?= $form->field($model, 'cc')->textInput() ?>
                        </div>
                        <div class='col-sm-6'>    
                            <?= $form->field($model, 'seat')->textInput() ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'>    
                            <?= $form->field($model, 'weight')->textInput() ?>
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
                </div>
            </div>
        
            <div class="container">
                <div class="form-group">
                    <?= Html::submitButton('บันทึก' ,['class' => 'btn btn-success']) ?>
                </div>
            </div>
        
            <?php ActiveForm::end(); ?>
    </div>