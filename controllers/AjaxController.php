<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


class AjaxController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', ['time' => date('H:i:s')]);
    }
}
?>