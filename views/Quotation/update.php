<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Quotation */

$this->title = 'Update Quotation: ' . $model->QID;
$this->params['breadcrumbs'][] = ['label' => 'Quotations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->QID, 'url' => ['view', 'id' => $model->QID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="quotation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
