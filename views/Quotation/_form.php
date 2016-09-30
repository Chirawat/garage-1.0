<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Quotation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quotation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'VID')->textInput() ?>

    <?= $form->field($model, 'CID')->textInput() ?>

    <?= $form->field($model, 'ICID')->textInput() ?>

    <?= $form->field($model, 'EID')->textInput() ?>

    <?= $form->field($model, 'quotation_id')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'quotation_date')->textInput() ?>

    <?= $form->field($model, 'claim_no')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
