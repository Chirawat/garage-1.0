<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'AJAX';?>


<?php Pjax::begin(); ?>
<?= Html::a("Refresh", ['ajax/index'], ['class' => 'btn btn-lg btn-primary', 'id' => 'refreshButton']) ?>
<h1>Current time: <?= $time ?></h1>
<?php Pjax::end(); 

$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 3000);
});
JS;
$this->registerJs($script);
?>