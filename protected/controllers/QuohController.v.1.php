<?php

class QuohController extends Controller
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
				'actions'=>array('checkwait','autocomplete','create','update','req','admin','saveQuod','delete','deleteQuod','deleteQuoh','savefield','plusstatus'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
 
 
 
   public function actionSavefield($id,$fieldname,$fieldvalue){
  
        // Query with 
           
          $model=$this->loadModel($id);
         // Append the query result to array
          $model->saveAttributes(array($fieldname=>$fieldvalue));
          if($fieldname == "status"){
              $proj = project::model()->findByPk($model->project_id);
              if($fieldvalue == 2){
                  $proj->status = 19;
              }else{
                   $proj->status = 4;
              }
              $proj->save();
              
          }

          Yii::app()->end();
 
 }
      
        
        
        public function actionSaveQuod($vendor,$product,$type,$qty,$unitprice,$quoh_id,$update_id)
	{
                
		if($update_id == 0)
                    $model = new quod;
                else
                    $model = quod::model()->findByPk($update_id);
                
                $quoh = quoh::model()->findByPk($quoh_id);
                $proj= project::model()->findByPk($quoh->project_id);
                
                $vendor_id = vendor::model()->findByAttributes(array('name'=>$vendor));
                if($vendor_id == null)
                {
                    $vendor_model = new vendor;
                    $vendor_model->name = $vendor;
                    if($vendor_model->save())
                        $model->vendor_id = $vendor_model->id;
                }else{
                    $model->vendor_id = $vendor_id->id;
                }
                
                $product_id = product::model()->findByAttributes(array('name'=>$product));
                if($product_id == null)
                {
                    $product_model = new product;
                    $product_model->name = $product;
                    if($product_model->save())
                        $model->product_id = $product_model->id;
                }else{
                    $model->product_id = $product_id->id;
                }
               if($proj->machineType == 2){ 
                        $type_id = type::model()->findByAttributes(array('name'=>$type));
                       if($type_id == null)
                       {
                           $type_model = new type;
                           $type_model->name = $type;
                           if($type_model->save())
                               $model->type_id = $type_model->id;
                       }else{
                           $model->type_id = $type_id->id;
                       }
               }
   
                $model->qty = $qty;
                $model->unitPrice=$unitprice;
                $model->quoH_id = $quoh_id;
 
                $model->save();
                
                $this->renderPartial('_newform',array('quoh_id'=>$quoh_id));
                
                Yii::app()->end();
              
             

            //$this->renderPartial('_test', array('model_id' => $id,));
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($project_id)
	{
                $project_model = project::model()->findByPk($project_id);
		$model=new quoh;
                $model->project_id = $project_id;
                $model->status = 1;
                if($model->save()){
                     //$year = (date('Y')+543)%100;
                    
                     //$model->quoteNo = "Q$year/$model->id"; 
                    $model->quoteNo = ""; 
                     $model->save();
                }
                $this->renderPartial('_form',array('model'=>$model,'project_model'=>$project_model));
                  
                    //echo CJSON::encode(array('newID'=>$model->id));

                
              
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
 /*
		if(isset($_POST['quoh']))
		{
			$model->attributes=$_POST['quoh'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
  * 
  */        Yii::app()->end();
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

		if(isset($_POST['quoh']))
		{
			$model->attributes=$_POST['quoh'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

        public function actionDeleteQuod($id)
	{
                $model = quod::model()->findByPk($id);
		$model->delete();
             
               
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		
	}
        
        public function actionDeleteQuoh($id,$project_id)
	{
               
                $model = quoh::model()->findByPk($id);
                
                if($model != null)
                    quod::model()->deleteAll("quoH_id=:id",array(":id"=>$id));
                    $model->delete();
                //$_model = quoh::model()->findAll('project_id=:project_id',array(':project_id'=>$project_id));
                //$this->render('index',array('model'=>$_model,'project_id'=>$project_id));
                //$this->renderPartial('_newform',array('project_id'=>$project_id));
                Yii::app()->end();
             
               
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
                //$model = quod::model()->findByPk($id);
		//$model->delete();
             
                Yii::app()->end();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($project_id)
	{
              /*
                if(user::model()->findByPk(Yii::app()->user->getId())->auth !== "admin"){
                   $this->redirect(array('enquiry/index','project_id'=>$project_id)); 
                }
               * 
               */
                
		$criteria = new CDbCriteria();
                $criteria->condition = "project_id=:project_id";
                $criteria->params = array(":project_id"=>$project_id);
		$model = quoh::model()->find($criteria);
                 
                if($model == null){
                     $newmodel = new quoh;
                     $newmodel->project_id = $project_id;
                     $newmodel->status = 1;
                     if($newmodel->save()){
                        //$year = (date('Y')+543)%100;
                        //$newmodel->quoteNo = "Q$year/$newmodel->id";
                         $newmodel->quoteNo = "";
                        $newmodel->save();
                        $this->render('index',array('model'=>$newmodel,'project_id'=>$project_id));
                     }
                }
                else{
                  /*
                   if(isset($_POST['quoh']))
                   {
                           $model = $this->loadModel($_POST['quoh']['id']);
                           $model->attributes=$_POST['quoh'];
                           $model->save();   
                   }
                   * 
                   */
                  if(isset($_POST['project_id']) && isset($_POST['redirect']) && isset($_POST['project_status']))
    
                    {
                      // $this->redirect($this->createUrl("project/theproject"));
                         $this->plusstatus($_POST['project_id'],$_POST['redirect'],$_POST['project_status']);
                    }
                    
                  $this->render('index',array('model'=>$model,'project_id'=>$project_id));
                
                }  
	}
        
          public function plusstatus($project_id,$redirect,$project_status)
	{
                $criteria = new CDbCriteria();
                $criteria->condition = "project_id=:project_id";
                $criteria->params = array(":project_id"=>$project_id);
		$quohmodel = quoh::model()->find($criteria);
                
                $model = project::model()->findByPk($project_id);
                $model->status = $project_status; 
                $model->save();
                $direction = $redirect."/index";
                if(($project_status == 11) || ($project_status == 12) || ($project_status == 13))
                     $direction = "project/".$redirect;
                else
                   $direction = $redirect."/index";
                $this->redirect($this->createUrl($direction,array("project_id"=>$project_id)));
                //$this->redirect($this->createUrl($direction,array('model'=>$quohmodel,"project_id"=>$project_id)));
                //echo $this->renderPartial('//project/_form',array('model'=>$model));  
        } 

        public function actionReq()
	{
                $model=new quoh;
		if(isset($_POST['quoh']))
		{
			$model->attributes=$_POST['quoh'];
			$model->save();
				
		}
		$this->renderPartial('_form',array('model'=>$model));
                
                
                Yii::app()->end();

	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new quoh('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['quoh']))
			$model->attributes=$_GET['quoh'];

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
		$model=quoh::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='quoh-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
