<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\QuotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบเสนอราคา';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="quotation-index">
        <h1><?= Html::encode($this->title) ?></h1>
        
        
        
        
        
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                <?= Html::a('สร้างใหม่', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?php Pjax::begin(); ?>
                <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'QID',
            'VID',
            'CID',
            'ICID',
            'EID',
            // 'quotation_id:ntext',
            // 'quotation_date',
            // 'claim_no:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
                    <?php Pjax::end(); ?>
    </div>