<?php

class ProjectController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('autocomplete','create','update','start','saveajax','delivery','projheader','admin','delete','taiwanandstock','checkprice','followquotation','waitingquotation','followpo','followtaiwanquotation','complete','plusstatus','minusstatus','rejectstatus','theproject','remove'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

        
          public function actionAutocomplete($inputtext,$table){
  
                // Query with 
                   $qtxt ="SELECT sky1_$table.name FROM sky1_$table WHERE sky1_$table.name LIKE '$inputtext%';";
                   $rows =Yii::app()->db->createCommand($qtxt)->queryAll();

                 // Append the query result to array
                    $res = array();
                    foreach($rows as $row)
                    {
                        $res[] = $row['name'];
                    }


                    echo CJSON::encode(array('res'=>$res));

                    Yii::app()->end();

        }
        
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionStart($projecttype)
	{    
     
               $model=new project;
              
               $model->machineType = $projecttype;
               $model->status = 1;
               $model->existInStock  = 1; 
                
               
                if($model->save())
                { 
                    $year = (date('Y')+543)%100;      
                    if($model->machineType == 3){
                        
   // Current year counter    
                         $_projectcount = projectcount::model()->findAll("type=:type and year=:year",array(":type"=>"ST",":year"=>$year));
                        
                          
                          if($_projectcount == null){
                              $newprojectcounter = new projectcount;
                              $newprojectcounter->year = $year;
                              $newprojectcounter->counter = 1;
                              $newprojectcounter->type = "ST";
                              $newprojectcounter->save();
                              $currentid = 1;
                          }else{
                              $projectcount =  $_projectcount[0];
                              $currentid = ++$projectcount->counter;
                              $projectcount->save();
                          }
                     
                        $_projectNo = "ST$year/$currentid";                         
                        
                    }else{
                          $_projectcount = projectcount::model()->findAll("type=:type and year=:year",array(":type"=>"P",":year"=>$year));
                          
                          
                          if($_projectcount == null){
                              
                              $newprojectcounter = new projectcount;
                              $newprojectcounter->year = $year;
                              $newprojectcounter->counter = 1;
                              $newprojectcounter->type = "P";
                              $newprojectcounter->save();
                              $currentid = 1;
                          }else{
                              $projectcount =  $_projectcount[0];
                              $currentid = ++$projectcount->counter;
                              $projectcount->save();
                          }
                     
                        $_projectNo = "P$year/$currentid";     
                      
                    }
                   
                    $model->projectNo = $_projectNo; 
                    $model->save();
                  
                    $enquiry_model = new enquiry;
                    $enquiry_model->project_id = $model->id;
                    $enquiry_model->save();
                    
                    //$vendor_model = new vendor;
                    
                  
                    $this->renderPartial('_form',array('model'=>$model));
                    
                    //echo CJSON::encode(array(
/*                     //echo json_encode($project_id);
                   echo CJSON::encode(array(
                            'current'=>$model->id,
                            //'projectHeader'=>$projectHeader
                    ));
  */                  
                    //
            
                    Yii::app()->end();
                  
                }    
 /*           
                if(isset($_POST['project_id']))
		{
                    $project_id = $_POST['project_id'];
                    $this->renderPartial('_form',array('model'=>$this->loadModel($project_id)));
                }
  * 
  */
                Yii::app()->end();

	}
        public function actionPlusstatus($project_id,$redirect,$project_status)
	{
                $model = project::model()->findByPk($project_id);
                $model->status = $project_status; 
                $model->save();
                $direction = $redirect."/index";
                if(($project_status == 11) || ($project_status == 12) || ($project_status == 13))
                     $direction = "project/".$redirect;
                else
                   $direction = $redirect."/index";
                $this->redirect($this->createUrl($direction,array("project_id"=>$project_id)));
                //echo $this->renderPartial('//project/_form',array('model'=>$model));  
        } 
        public function actionMinusstatus($project_id)
	{
                $model = project::model()->findByPk($project_id);
                if($model->status > 1)
                    --$model->status;
                $model->save();
                echo $this->renderPartial('//project/_form',array('model'=>$model));  
        } 
         public function actionRejectstatus($project_id)
	{
                $model = project::model()->findByPk($project_id);
                $model->status = 17;
                $model->save();
                echo $this->renderPartial('//project/_form',array('model'=>$model));  
        } 
        
        public function actionTaiwanandstock()
	{
                 
                 $p1 = ""; $p2 = "";  $p3 = "";
                $p4 = "";  $p5 = "";  $p6 = "";
                $p7 = ""; 
               
                if(isset($_POST['projectNo']))
                {
                    $p1 = $_POST['projectNo'];
                }
                if(isset($_POST['customer']))
                {
                    $p2 = $_POST['customer'];
                }
                 if(isset($_POST['vendor']))
                {
                    $p3 = $_POST['vendor'];
                }
                 if(isset($_POST['product']))
                {
                    $p4 = $_POST['product'];
                }
                 if(isset($_POST['potovendordate']))
                {
                    $p5 = $_POST['potovendordate'];
                }
                 if(isset($_POST['duevendordate']))
                {
                    $p6 = $_POST['duevendordate'];
                }
                 if(isset($_POST['duecustomerdate']))
                {
                    $p7 = $_POST['duecustomerdate'];
                }
              
              
                $this->render('taiwanandstock',array('projectNo'=>$p1,'customer'=>$p2,'vendor'=>$p3,'product'=>$p4,'potovendordate'=>$p5,'duevendordate'=>$p6,'duecustomerdate'=>$p7));
        } 
         public function actionCheckprice()
	{
                $p1 = ""; $p2 = "";  $p3 = "";
                $p4 = "";  $p5 = "";  $p6 = "";
                $p7 = ""; 
               
                if(isset($_POST['projectNo']))
                {
                    $p1 = $_POST['projectNo'];
                }
                if(isset($_POST['quoteDate']))
                {
                    $p2 = $_POST['quoteDate'];
                }
                 if(isset($_POST['quoteNo']))
                {
                    $p3 = $_POST['quoteNo'];
                }
                 if(isset($_POST['customer']))
                {
                    $p4 = $_POST['customer'];
                }
                 if(isset($_POST['vendor']))
                {
                    $p5 = $_POST['vendor'];
                }
                 if(isset($_POST['product']))
                {
                    $p6 = $_POST['product'];
                }
                 if(isset($_POST['customerPOdate']))
                {
                    $p7 = $_POST['customerPOdate'];
                }
              
              
                $this->render('checkprice',array('projectNo'=>$p1,'quoteDate'=>$p2,'quoteNo'=>$p3,'customer'=>$p4,'vendor'=>$p5,'product'=>$p6,'customerPOdate'=>$p7));
        }
         public function actionFollowquotation()
	{
                $p1 = ""; $p2 = "";  $p3 = "";
                $p4 = "";  $p5 = "";  $p6 = "";
                $p7 = ""; $p8 = ""; $p9 = "";
                
               
                if(isset($_POST['projectNo']))
                {
                    $p1 = $_POST['projectNo'];
                }
                if(isset($_POST['customer']))
                {
                    $p2 = $_POST['customer'];
                }
                if(isset($_POST['product']))
                {
                    $p3 = $_POST['product'];
                }
                if(isset($_POST['vendor']))
                {
                    $p4 = $_POST['vendor'];
                }
                 if(isset($_POST['type']))
                {
                    $p5 = $_POST['type'];
                }
               
                 if(isset($_POST['followedDate']))
                {
                    $p6 = $_POST['followedDate'];
                }
                 if(isset($_POST['contact']))
                {
                    $p7 = $_POST['contact'];
                }
                 if(isset($_POST['detail']))
                {
                    $p8 = $_POST['detail'];
                }
                 if(isset($_POST['followedBy']))
                {
                    $p9 = $_POST['followedBy'];
                }
              
                $this->render('followquotation',array('projectNo'=>$p1,'customer'=>$p2,'product'=>$p3,'vendor'=>$p4,'type'=>$p5,'followedDate'=>$p6,'contact'=>$p7,'detail'=>$p8,'followedBy'=>$p9)); 
        } 
        public function actionWaitingquotation()
	{
                $p1 = ""; $p2 = "";  $p3 = "";
                $p4 = "";  $p5 = "";  $p6 = "";
                $p7 = ""; $p8 = ""; $p9 = "";
                
               
                if(isset($_POST['projectNo']))
                {
                    $p1 = $_POST['projectNo'];
                }
                if(isset($_POST['customer']))
                {
                    $p2 = $_POST['customer'];
                }
                if(isset($_POST['product']))
                {
                    $p3 = $_POST['product'];
                }
                if(isset($_POST['vendor']))
                {
                    $p4 = $_POST['vendor'];
                }
                 if(isset($_POST['type']))
                {
                    $p5 = $_POST['type'];
                }
               
                 if(isset($_POST['followedDate']))
                {
                    $p6 = $_POST['followedDate'];
                }
                 if(isset($_POST['contact']))
                {
                    $p7 = $_POST['contact'];
                }
                 if(isset($_POST['detail']))
                {
                    $p8 = $_POST['detail'];
                }
                 if(isset($_POST['followedBy']))
                {
                    $p9 = $_POST['followedBy'];
                }
              
                $this->render('waitingquotation',array('projectNo'=>$p1,'customer'=>$p2,'product'=>$p3,'vendor'=>$p4,'type'=>$p5,'followedDate'=>$p6,'contact'=>$p7,'detail'=>$p8,'followedBy'=>$p9)); 
        } 
        public function actionTheproject()
	{
               // if(Yii::app()->session['testcount'] == null) {Yii::app()->session['testcount']=0;echo Yii::app()->session['testcount']; }
               // else {Yii::app()->session['testcount'] = Yii::app()->session['testcount'] + 1; echo Yii::app()->session['testcount'];}
                
                if(Yii::app()->session['theproject_projectNo'] == null){$p1 = "";}else{$p1 = Yii::app()->session['theproject_projectNo'];} 
                if(Yii::app()->session['theproject_machineType'] == null){$p2 = "";}else{$p2 = Yii::app()->session['theproject_machineType'];} 
                if(Yii::app()->session['theproject_status'] == null){$p3 = "";}else{$p3 = Yii::app()->session['theproject_status'];} 
                if(Yii::app()->session['theproject_customer'] == null){$p4 = "";}else{$p4 = Yii::app()->session['theproject_customer'];} 
                if(Yii::app()->session['theproject_vendor'] == null){$p5 = "";}else{$p5 = Yii::app()->session['theproject_vendor'];} 
                $newsearch = false;
                 
               if(isset($_POST['clearsearch'])){
                   $this->removeSession("theproject");
                   if(isset($_GET['page'])){unset($_GET['page']);}
				   $p1 = "";  $p2 = ""; $p3 = ""; $p4 = ""; $p5 = "";
                   $this->redirect(array('theproject'));
               }
               
               if(isset($_POST['newsearch'])){
//                   Yii::app()->session['testcount'] = Yii::app()->session['testcount'] + 1; 
//                   echo Yii::app()->session['testcount'];
                   $newsearch = true;
               }
               
                if(isset($_POST['projectNo']))
                {
                    $p1 = $_POST['projectNo'];
                    Yii::app()->session['theproject_projectNo'] = $_POST['projectNo'];
                }
                if(isset($_POST['machineType']))
                {
                    $p2 = $_POST['machineType'];
                    Yii::app()->session['theproject_machineType'] = $_POST['machineType'];
                }
                 if(isset($_POST['status']))
                {
                    $p3 = $_POST['status'];
                    Yii::app()->session['theproject_status'] = $_POST['status'];
                }
                 if(isset($_POST['customer']))
                {
                    $p4 = $_POST['customer'];
                     Yii::app()->session['theproject_customer'] = $_POST['customer'];
                }
                 if(isset($_POST['vendor']))
                {
                    $p5 = $_POST['vendor'];
                    Yii::app()->session['theproject_vendor'] = $_POST['vendor'];
                }

                $this->render('theproject',array('newsearch'=>$newsearch,'projectNo'=>$p1,'machineType'=>$p2,'status'=>$p3,'customer'=>$p4,'vendor'=>$p5));
        } 
        public function actionFollowpo()
	{
                
                  $p1 = ""; $p2 = "";  $p3 = "";
                $p4 = "";  $p5 = "";  $p6 = "";
                $p7 = "";  $p8 = "";
               
                if(isset($_POST['projectNo']))
                {
                    $p1 = $_POST['projectNo'];
                }
                if(isset($_POST['machineType']))
                {
                    $p2 = $_POST['machineType'];
                }
                 if(isset($_POST['status']))
                {
                    $p3 = $_POST['status'];
                    
                }
                 if(isset($_POST['customer']))
                {
                    $p4 = $_POST['customer'];
                }
                 if(isset($_POST['vendor']))
                {
                    $p5 = $_POST['vendor'];
                }
                 if(isset($_POST['product']))
                {
                    $p6 = $_POST['product'];
                }
                 if(isset($_POST['duevendordate']))
                {
                    $p7 = $_POST['duevendordate'];
                }
                
                  if(isset($_POST['duecustomerdate']))
                {
                    $p8 = $_POST['duecustomerdate'];
                }
              
              
              
                $this->render('followpo',array('projectNo'=>$p1,'machineType'=>$p2,'status'=>$p3,'customer'=>$p4,'vendor'=>$p5,'product'=>$p6,'duevendordate'=>$p7,'duecustomerdate'=>$p8));
        } 
        public function actionFollowtaiwanquotation()
	{
                $p1 = ""; $p2 = "";  $p3 = "";
                $p5 = "";  $p4 = "";
               
                if(isset($_POST['projectNo']))
                {
                    $p1 = $_POST['projectNo'];
                }
                if(isset($_POST['enquiryDate']))
                {
                    $p2 = $_POST['enquiryDate'];
                }
                 if(isset($_POST['customer']))
                {
                    $p3 = $_POST['customer'];
                }
                 if(isset($_POST['product']))
                {
                    $p4 = $_POST['product'];
                }
                 if(isset($_POST['vendor']))
                {
                    $p5 = $_POST['vendor'];
                }
                $this->render('followtaiwanquotation',array('projectNo'=>$p1,'enquiryDate'=>$p2,'customer'=>$p3,'product'=>$p4,'vendor'=>$p5)); 
        } 
        public function actionComplete()
	{
                if(Yii::app()->session['complete_projectNo'] == null){$p1 = "";}else{$p1 = Yii::app()->session['complete_projectNo'];} 
                if(Yii::app()->session['complete_customer'] == null){$p2 = "";}else{$p2 = Yii::app()->session['complete_customer'];} 
                if(Yii::app()->session['complete_quoteDate'] == null){$p3 = "";}else{$p3 = Yii::app()->session['complete_quoteDate'];} 
                if(Yii::app()->session['complete_quoteNo'] == null){$p4 = "";}else{$p4 = Yii::app()->session['complete_quoteNo'];} 
                if(Yii::app()->session['complete_vendor'] == null){$p5 = "";}else{$p5 = Yii::app()->session['complete_vendor'];} 
                if(Yii::app()->session['complete_product'] == null){$p6 = "";}else{$p6 = Yii::app()->session['complete_product'];} 
                if(Yii::app()->session['complete_customerPOdate'] == null){$p7 = "";}else{$p7 = Yii::app()->session['complete_customerPOdate'];} 
                if(Yii::app()->session['complete_deliveryDate'] == null){$p8 = "";}else{$p8 = Yii::app()->session['complete_deliveryDate'];} 
                if(Yii::app()->session['complete_paymentDate'] == null){$p9 = "";}else{$p9 = Yii::app()->session['complete_paymentDate'];} 
                
                $newsearch = false;
            
//                if(isset($_POST['clearsearch'])){
//                   $this->removeSession("complete");
//                   if(isset($_GET['page'])){unset($_GET['page']);}
//                   $this->redirect(array('complete'));
//               }
               
               if(isset($_POST['newsearch'])){
                   
                   $newsearch = true;
               }
               
                if(isset($_POST['projectNo']))
                {
                    $p1 = $_POST['projectNo'];
                }
                if(isset($_POST['customer']))
                {
                    $p2 = $_POST['customer'];
                }
                 if(isset($_POST['quoteDate']))
                {
                    $p3 = $_POST['quoteDate'];
                }
                 if(isset($_POST['quoteNo']))
                {
                    $p4 = $_POST['quoteNo'];
                }
                 if(isset($_POST['vendor']))
                {
                    $p5 = $_POST['vendor'];
                }
                 if(isset($_POST['product']))
                {
                    $p6 = $_POST['product'];
                }
                 if(isset($_POST['customerPOdate']))
                {
                    $p7 = $_POST['customerPOdate'];
                }
                if(isset($_POST['deliveryDate']))
                {
                    $p8 = $_POST['deliveryDate'];
                }
                if(isset($_POST['paymentDate']))
                {
                    $p9 = $_POST['paymentDate'];
                }
               
              
                $this->render('complete',array('newsearch'=>$newsearch,'projectNo'=>$p1,'customer'=>$p2,'quoteDate'=>$p3,'quoteNo'=>$p4,'vendor'=>$p5,'product'=>$p6,'customerPOdate'=>$p7,'deliveryDate'=>$p8,'paymentDate'=>$p9)); 
             
        } 
        
        
        public function actionDelivery($project_id)
	{
                $model = $this->loadModel($project_id);
                
               
                if(isset($_POST['project']))
		{
			$model->attributes=$_POST['project'];
			$model->save();
				
		}
                if(isset($_POST['goodsFinishedDate']))
		{
			$model->goodsFinishedDate=$_POST['goodsFinishedDate'];
			$model->save();
				
		}
                if(isset($_POST['deliveryDate']))
		{
			$model->deliveryDate=$_POST['deliveryDate'];
			$model->save();
				
		}
                if(isset($_POST['project_id']) && isset($_POST['redirect']) && isset($_POST['project_status']))
                {
                             $this->plusstatus($_POST['project_id'],$_POST['redirect'],$_POST['project_status']);
                }
                
		$this->render('delivery',array('model'=>$model,'project_id'=>$project_id));
                                
            
        } 
         public function plusstatus($project_id,$redirect,$project_status)
	{
                $model = project::model()->findByPk($project_id);
                $model->status = $project_status; 
                $model->save();
                $direction = $redirect."/index";
                if(($project_status == 11) || ($project_status == 12) || ($project_status == 13) || ($project_status == 16 && $model->machineType == 3))
                     $direction = "project/".$redirect;
                else
                   $direction = $redirect."/index";
                $this->redirect($this->createUrl($direction,array("project_id"=>$project_id)));
                //echo $this->renderPartial('//project/_form',array('model'=>$model));  
        }   
        public function actionProjheader($id)
	{      
                //$model = new project;
                $model=$this->loadModel($id);
                $this->renderPartial('_form',array('model'=>$model));
                                
            
        } 
        

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new project;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['project']))
		{
			$model->attributes=$_POST['project'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

        public function actionSaveajax($id,$textbox_id,$textbox_value)
	{
           
		$model=$this->loadModel($id);
                //$_model = new project;
                if(strcmp($textbox_id,"machineType") == 0){
                     $model->machineType = $textbox_value;
                     $model->save();
                }
                else if(strcmp($textbox_id,"status") == 0){
                     $model->status = 5;
                    $model->save();
                }

            //$this->renderPartial('_test', array('model_id' => $id,));
	}
        
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['project']))
		{
			$model->attributes=$_POST['project'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            /*
                $criteria = new CDbCriteria();
                $criteria->condition = "project_id=:project_id";
                $criteria->params = array(":project_id"=>$id);
               
                $enquiry = enquiry::model()->deleteAll($criteria);
		$this->loadModel($id)->delete();
                
             *
             */
                $this->redirect(Yii::app()->homeUrl);
                
                

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		
	}
        public function actionRemove($id)
	{
                $criteria = new CDbCriteria();
                $criteria->condition = "project_id=:project_id";
                $criteria->params = array(":project_id"=>$id);
               
                enquiry::model()->deleteAll($criteria);
                vendorprocess::model()->deleteAll($criteria);
                $quoh = quoh::model()->findAll($criteria);
                if($quoh != null){
                    foreach($quoh as $qhead){
                        quod::model()->deleteAll("quoH_id=:quoH_id",array(":quoH_id"=>$qhead->id));
                        quoteFollow::model()->deleteAll("quoH_id=:quoH_id",array(":quoH_id"=>$qhead->id));
                        $qhead->delete();
                    }
                }
                
                $poh = poh::model()->findAll($criteria);
                if($poh != null){
                    foreach($poh as $phead){
                        pod::model()->deleteAll("poh_id=:poh_id",array(":poh_id"=>$phead->id));
                        $phead->delete();
                    }
                }
                deposit::model()->deleteAll($criteria);
                pOtoVendor::model()->deleteAll($criteria);
                payment::model()->deleteAll($criteria);
                
                
		$this->loadModel($id)->delete();
            
                $this->redirect(Yii::app()->homeUrl);
                
            
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex($projecttype)
	{
		$dataProvider=new CActiveDataProvider('project');
                
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
                        'projecttype'=>$projecttype,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new project('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['project']))
			$model->attributes=$_GET['project'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
         private function removeSession($actionname){
            
            if($actionname == "theproject"){
                if(isset(Yii::app()->session['theproject_projectNo'])){unset(Yii::app()->session['theproject_projectNo']);}
                if(isset(Yii::app()->session['theproject_machineType'])){unset(Yii::app()->session['theproject_machineType']);}
                if(isset(Yii::app()->session['theproject_status'])){unset(Yii::app()->session['theproject_status']);}
                if(isset(Yii::app()->session['theproject_customer'])){unset(Yii::app()->session['theproject_customer']);}
                if(isset(Yii::app()->session['theproject_vendor'])){unset(Yii::app()->session['theproject_vendor']);}
            }
             if($actionname == "complete"){
                if(isset(Yii::app()->session['theproject_projectNo'])){unset(Yii::app()->session['theproject_projectNo']);}
                if(isset(Yii::app()->session['theproject_machineType'])){unset(Yii::app()->session['theproject_machineType']);}
                if(isset(Yii::app()->session['theproject_status'])){unset(Yii::app()->session['theproject_status']);}
                if(isset(Yii::app()->session['theproject_customer'])){unset(Yii::app()->session['theproject_customer']);}
                if(isset(Yii::app()->session['theproject_vendor'])){unset(Yii::app()->session['theproject_vendor']);}
            }
            
        }
       
        
       
        
}
