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
use kartik\mpdf\Pdf;
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
    public function actionView($quotation_id)
    {
        $qid = Quotation::find()->where(['quotation_id' => $quotation_id])->one()['QID'];
        
        // Quotation
        $model = Quotation::find()->where(['QID' => $qid])->one();
        
        // Customer
        $customerModel = Customer::find()->where(['CID' => $model->CID])->one();
        
        // Viecle
        $viecleModel = Viecle::find()->where(['VID' => $model->VID])->one();
        
        // Description
        $query = Description::find()->where(['QID' => $model->QID, 'type' => 'MAINTENANCE']);
        $maintenanceDescriptionModel = $query->all();
        $sumMaintenance = $query->sum('price');
        
        $query = Description::find()->where(['QID' => $model->QID, 'type' => 'PART']);
        $partDescriptionModel = $query->all();
        $sumPart = $query->sum('price');
        
        $numRow = 0;
        if(sizeof($maintenanceDescriptionModel) > sizeof($partDescriptionModel))
            $numRow = sizeof($maintenanceDescriptionModel);
        else
            $numRow = sizeof($partDescriptionModel);
            
        // render
        $detailView = $this->renderPartial('view_quotation',[
            'maintenanceDescriptionModel' => $maintenanceDescriptionModel,
            'sumMaintenance' => $sumMaintenance,
            'partDescriptionModel' => $partDescriptionModel,
            'sumPart' => $sumPart,
            'numRow' => $numRow,
        ]);
        
        return $this->render('header_quotation', [
            'model' => $model,          // quotation
            'quotationId' => null,
            'customerModel' => $customerModel,
            'viecleModel' => $viecleModel,
            'detailView'  => $detailView,
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
        
        // customer
        if( Yii::$app->request->get('fullname') )
            $customerModel = Customer::find()->where(['fullname' => Yii::$app->request->get('fullname')])->one();
        else{
            $customerModel = new Customer();
        }
        
        // viecle
        if( Yii::$app->request->get('plate_id') ){
            $viecleModel = Viecle::find()->where(['plate_no' => Yii::$app->request->get('plate_id')])->one();
        }
        else{
            $viecleModel = new Viecle();
        }
        
        // Quotation Id    
        $year = date('Y');
        $count = Quotation::find()->where(["EXTRACT(YEAR FROM quotation_date)" => $year])->count();
        $quotationId = ($count + 1) . "/" . ($year + 543);
       
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->QID]);
        } else {
            $detailView = $this->renderPartial('create_quotation');
            return $this->render('header_quotation', [
                'model' => $model,          // quotation
                'quotationId' => $quotationId,
                'customerModel' => $customerModel,
                'viecleModel' => $viecleModel,
                'detailView'  => $detailView,
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
            $quotation->quotation_id = $data["quotation_info"]["quotationId"];;
           
           
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
            

            if( $ret ){
               return ['status' => 'sucess', 'QID' => $QID];
            }
           else{
               return ['status' => 'failed', 'error' => $ret];
           }
       }
   }
    
    public function actionReport($quotation_id) {
        $qid = Quotation::find()->where(['quotation_id' => $quotation_id])->one()['QID'];
        
        // Quotation
        $model = Quotation::find()->where(['QID' => $qid])->one();
        
        // Customer
        $customerModel = Customer::find()->where(['CID' => $model->CID])->one();
        
        // Viecle
        $viecleModel = Viecle::find()->where(['VID' => $model->VID])->one();
        
        // Description
        $query = Description::find()->where(['QID' => $model->QID, 'type' => 'MAINTENANCE']);
        $maintenanceDescriptionModel = $query->all();
        $sumMaintenance = $query->sum('price');
        
        $query = Description::find()->where(['QID' => $model->QID, 'type' => 'PART']);
        $partDescriptionModel = $query->all();
        $sumPart = $query->sum('price');
        
        $numRow = 0;
        if(sizeof($maintenanceDescriptionModel) > sizeof($partDescriptionModel))
            $numRow = sizeof($maintenanceDescriptionModel);
        else
            $numRow = sizeof($partDescriptionModel);
        
        

        //////////////// REPORT PROCEDURE ////////////////////////////////////////
        $content = $this->renderPartial('report',[
            'model' => $model,
            'customerModel' => $customerModel,
            'viecleModel' => $viecleModel,
            
            'maintenanceDescriptionModel' => $maintenanceDescriptionModel,
            'sumMaintenance' => $sumMaintenance,
            'partDescriptionModel' => $partDescriptionModel,
            'sumPart' => $sumPart,
            'numRow' => $numRow,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_UTF8, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        // format content from your own css file if needed or use the
        // enhanced bootstrap css built by Krajee for mPDF formatting 
        'cssFile' => '@app/web/css/pdf.css',
        // any css to be embedded if required
        //        'cssInline' => '.kv-heading-1{font-size:18px}', 
        // set mPDF properties on the fly
        'options' => ['title' => 'ใบเสนอราคา'],
        // call mPDF methods on the fly
        'methods' => [ 
            //'SetHeader'=>['Krajee Report Header'], 
            'SetFooter'=>['หน้า {PAGENO} / {nb}'],
            ]
        ]);

        $pdf->configure(array(
            'defaultfooterline' => '0', 
            'defaultfooterfontstyle' => 'R',
            'defaultfooterfontsize' => '10',
        ));

        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

   
    public function actionViecleRegistration(){
        $viecleModel = new Viecle();
        
        $customerModel = new Customer();
        
        $isUpdate = false;
        if( $viecleModel->load(Yii::$app->request->post()) ){
            if( $viecleModel->validate() ){
                $isUpdate = $viecleModel->save();
            }
            else{
                return $viecleModel->errors;
            }
        }
        
        if( $customerModel->load(Yii::$app->request->post()) ){
            if( $customerModel->validate() ){
                $isUpdate = $customerModel->save();
            }
            else{
                return $customerModel->errors;
            }
        }
        if($isUpdate){
            return $this->redirect(['quotation/create', 'plate_id' => $viecleModel->plate_no, 'fullname' => $customerModel->fullname]);
        }
        else{
            return $this->render('viecle_registration', [
                // viecle
                'viecleModel' => $viecleModel,

                // customer
                'customerModel' => $customerModel,
            ]);    
        }
    }
    
    public function actionSummary(){
        
        $rows = [];
        if( Yii::$app->request->post() ){
            //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            
            $beginDate = date_create(Yii::$app->request->post('start_date'));
            $endDate = date_create(Yii::$app->request->post('end_date'));
            $interval = date_diff($beginDate, $endDate);
            $nMonth = $interval->format("%y")*12 + $interval->format("%m");
            
            $interval_t = [
                'begin' => [ $beginDate, $endDate ],
                'end' => [ $beginDate, $endDate ],
            ];
            
            
            //return $beginDate->format("Y-m-d");
            
            $lists = Quotation::find()->select(['CID'])->distinct()->all();
        
            foreach($lists as $list){
                // customer list
                $quotations = Quotation::find()->with(['descriptions', 'customer'])->where(['in', 'CID', $list]);
                $quotations->andWhere(['between', 'quotation_date', $beginDate->format("Y-m-d"), $endDate->format("Y-m-d")]);
                
                // sum of value
                $quotations_t = $quotations->all();
                $val = 0;
                foreach($quotations_t as $quotations_tt){
                    $val += $quotations_tt->getDescriptions()->sum('price');
                }
                
                // prepare count & value
                $row = ['customer' => $quotations->one()->customer['fullname'], 'count' => $quotations->count(), 'value' => $val ];
                
                // push into rows
                array_push($rows, $row);
            }
        
            
            //return $rows;
            
        }
//        else{
        return $this->render('summary', [
            'rows' => $rows,
        ]);
//        }
        
    }
    
    public function actionTest(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $userID = Yii::$app->user->identity->getId();

        return $userID;
    }
}