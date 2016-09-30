<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Quotation */

//$this->title = 'Create Quotati';
//$this->params['breadcrumbs'][] = ['label' => 'Quotations', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('create_quotation', [
        'model' => $model,                      // quotation table
        'customerModel' => $customerModel,
        'viecleModel' => $viecleModel,
        'insuranceCompanyModel' => $insuranceCompanyModel,
        'quotationId' => $quotationId,
    ]) ?>

</div>
