<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QuotationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quotation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'QID') ?>

    <?= $form->field($model, 'VID') ?>

    <?= $form->field($model, 'CID') ?>

    <?= $form->field($model, 'ICID') ?>

    <?= $form->field($model, 'EID') ?>

    <?php // echo $form->field($model, 'quotation_id') ?>

    <?php // echo $form->field($model, 'quotation_date') ?>

    <?php // echo $form->field($model, 'claim_no') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
