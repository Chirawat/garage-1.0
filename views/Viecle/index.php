<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ViecleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ลงทะเบียนรถยนต์';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viecle-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Viecle', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
