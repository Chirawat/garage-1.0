<?php

namespace app\controllers;

use Yii;
use app\models\Quotation;
use app\models\QuotationSearch;
use app\models\Customer;
use app\models\Viecle;
use app\models\Description;
use app\models\InsuranceCompany;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;
/**
 * QuotationController implements the CRUD actions for Quotation model.
 */
class QuotationController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Quotation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuotationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Quotation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // get quatation id
    public function GetQuotationId(){
        //if( Yii::$app->request->isAjax){ 
            //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $query = Quotation::find()->select('quotation_id')->orderBy(['QID' => SORT_DESC])->one();
            return $query;
         //}
    }

    /**
     * Creates a new Quotation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Quotation();
        
        $customerModel = new Customer();
        
        $viecleModel = new Viecle();
        
        $insuranceCompanyModel = new InsuranceCompany();

        // Query last record of 'Quotation'
        // ex. 2/2559
        $lastQID = Quotation::find()->select('quotation_id')->orderBy(['QID' => SORT_DESC])->one()["quotation_id"];
        $quotationId = (int)$lastQID + 1;
        $quotationId = (string)$quotationId . "/2559";

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->QID]);
        } else {
            return $this->render('create', [
                'model' => $model,          // quotation
                'customerModel' => $customerModel,
                'viecleModel' => $viecleModel,
                //'quotationId' => $quotationId,
            ]);
        }
    }

    /**
     * Updates an existing Quotation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->QID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Quotation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Quotation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quotation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Quotation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

   public function actionQuotationSave(){
       if( Yii::$app->request->isAjax){    
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $request = Yii::$app->request;
            $data = $request->bodyParams;

            // Quation data
            ///////////////////////////////////////////////////////////////////////////////
            $quotation = new Quotation();

            //$quotation->quotation_id = 

            // Fill up CID
            $customer = Customer::find()->where(['fullname' => $data["quotation_info"]["customerFullName"]])->one();
            $quotation->CID = $customer->CID;

            // Fill up VID
            $viecle = Viecle::find()->where(['plate_no' => $data["quotation_info"]["vieclePlateNo"]])->one();
            $quotation->VID = $viecle->VID;

            $quotation->claim_no = $data["quotation_info"]["claimNo"];

            // Fill up EID
            $quotation->Employee = Yii::$app->user->identity->getId();

            $quotation->quotation_date = date("Y-m-d");
           
           // Save Model
            if( $quotation->validate() ){
                $ret = $quotation->save();
            }
           else{
               return $quotation->errors;
           }

           
           $QID = Quotation::find()->select(['QID'])->orderBy(['QID' => SORT_DESC])->one()["QID"];
           
            // Description data
            ///////////////////////////////////////////////////////////////////////////////

            // Maintenance
            if(!empty($data["maintenance_list"])){
                for($i = 0; $i < sizeOf($data["maintenance_list"]); $i++){
                    $description = new Description();

                    $description->QID = $QID;
                    $description->row = 1;
                    $description->description = $data["maintenance_list"][$i]["list"];
                    $description->type = "MAINTENANCE";
                    $description->price = $data["maintenance_list"][$i]["price"];

                    if( $description->validate() )
                        $ret = $description->save();
                    else
                        return $description->errors;
                }
            }

            // Part
            if(!empty($data["part_list"])){
                for($i = 0; $i < sizeOf($data["part_list"]); $i++){
                    $description = new Description();

                    $description->QID = $QID;
                    $description->row = 1;
                    $description->description = $data["part_list"][$i]["list"];
                    $description->type = "PART";
                    $description->price = $data["part_list"][$i]["price"];

                    if( $description->validate() )
                        $ret = $description->save();
                    else
                        return $description->errors;
                }
            }
            

            return $ret;
       }
   }

   
    public function actionTest(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $userID = Yii::$app->user->identity->getId();

        return $userID;
    }
   
}
