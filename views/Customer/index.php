<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(['id' => 'pjax-01']); ?>    <?= GridView::widget([
        'id' => 'gridViewCustomer',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CID',
            'fullname:ntext',
            'type:ntext',
            'address:ntext',
            'phone',
            // 'fax',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<?php
//$this->registerJs('$("body").on("keyup.yiiGridView", "#gridViewCustomer .filters input", function(){
//    $("#gridViewCustomer").yiiGridView("applyFilter");
//})', \yii\web\View::POS_READY);

?>