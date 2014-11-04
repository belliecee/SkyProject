<?php

class PohController extends Controller
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
				'actions'=>array('create','update','req','createpod','deletepod','updatepod'),
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
        
          public function actionDeletepod($id,$poh_id)
	{
		$model=pod::model()->findByPk($id);
                $model->delete();
                
                 $poh_model = poh::model()->findByPk($poh_id);
                 $project_model = project::model()->findByPk($poh_model->project_id);;
		 $this->renderPartial('_newform',array('poh_id'=>$poh_id,'project_model'=>$project_model));
                
		
              
                Yii::app()->end();
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new poh;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['poh']))
		{
			$model->attributes=$_POST['poh'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        public function actionCreatepod($vendor,$product,$type,$qty,$unitPrice,$poh_id)
	{
                $poh = poh::model()->findByPk($poh_id);
                $proj= project::model()->findByPk($poh->project_id);
                
		$model=new pod;
                $getVendor = vendor::model()->findByAttributes(array('name'=>$vendor));
                if($getVendor == null)
                {
                     $vendor_model = new vendor;
                     $vendor_model->name = $vendor;
                     if($vendor_model->save())
                        $model->vendor_id = $vendor_model->id;
                }else{
                     $model->vendor_id = $getVendor->id;
                
                     
                }
                $getProduct = product::model()->findByAttributes(array('name'=>$product));
                if($getProduct == null)
                {
                     $product_model = new product;
                     $product_model->name = $product;
                     if($product_model->save())
                        $model->product_id = $product_model->id;
                }else{
                     $model->product_id = $getProduct->id;
                
                     
                }
               
                if($proj->machineType == 2){ 
                        $getType = type::model()->findByAttributes(array('name'=>$type));
                        if($getType == null)
                        {
                             $type_model = new type;
                             $type_model->name = $type;
                             if($type_model->save())
                                $model->type_id = $type_model->id;
                        }else{
                             $model->type_id = $getType->id;
                        }
                          
                 }
             
                $model->qty = $qty;
                $model->unitPrice =$unitPrice;
                $model->poh_id = $poh_id;
                $model->save();
                
                 $poh_model = poh::model()->findByPk($poh_id);
                 $project_model = project::model()->findByPk($poh_model->project_id);;
		 $this->renderPartial('_newform',array('poh_id'=>$poh_id,'project_model'=>$project_model));
        /*
                if($model->save())
                {
                    //$pod_model = pod::model()->findAll("poh_id=:poh_id",  array(":poh_id"=>$poh_id));
                   
                }
          */      
                Yii::app()->end();
	}
        
         public function actionUpdatepod($vendor,$product,$type,$qty,$unitPrice,$poh_id,$id)
	{
                $poh = poh::model()->findByPk($poh_id);
                $proj= project::model()->findByPk($poh->project_id);
                
		$model = pod::model()->findByPk($id);
                
                $getVendor = vendor::model()->findByAttributes(array('name'=>$vendor));
                if($getVendor == null)
                {
                     $vendor_model = new vendor;
                     $vendor_model->name = $vendor;
                     if($vendor_model->save())
                        $model->vendor_id = $vendor_model->id;
                }else{
                     $model->vendor_id = $getVendor->id;
                
                     
                }
                
                $getProduct = product::model()->findByAttributes(array('name'=>$product));
                if($getProduct == null)
                {
                     $product_model = new product;
                     $product_model->name = $product;
                     if($product_model->save())
                        $model->product_id = $product_model->id;
                }else{
                     $model->product_id = $getProduct->id;
                }
               
                 if($proj->machineType == 2){ 
                        $getType = type::model()->findByAttributes(array('name'=>$type));
                        if($getType == null)
                        {
                             $type_model = new type;
                             $type_model->name = $type;
                             if($type_model->save())
                                $model->type_id = $type_model->id;
                        }else{
                             $model->type_id = $getType->id;
                        }
                          
                 }
                
                $model->qty = $qty;
                $model->unitPrice =$unitPrice;
                $model->poh_id = $poh_id;
                $model->save();
                
                
               $poh_model = poh::model()->findByPk($poh_id);
                 $project_model = project::model()->findByPk($poh_model->project_id);;
		 $this->renderPartial('_newform',array('poh_id'=>$poh_id,'project_model'=>$project_model));
        /*
                if($model->save())
                {
                    //$pod_model = pod::model()->findAll("poh_id=:poh_id",  array(":poh_id"=>$poh_id));
                   
                }
          */      
                Yii::app()->end();
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

		if(isset($_POST['poh']))
		{
			$model->attributes=$_POST['poh'];
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($project_id)
	{
		$criteria = new CDbCriteria();
                $criteria->condition = "project_id=:project_id";
                $criteria->params = array(":project_id"=>$project_id);
		$model = poh::model()->find($criteria);
             
                if($model !== null){
                    if(isset($_POST['poh']))
                    {
                            $model->attributes=$_POST['poh'];
                    /****************** Calculate Customer Delivery Due ******************/
                            
                            if($model->customerPOdate != null){
                               //  Conver customerPOdate Y-m-d
                                  $model->beforeSaveDate("customerPOdate");
                                  $customerPOdate = $model->customerPOdate;
                           
                            // Add Date
                                    $model->customerDeliveryDate  = date('Y-m-d', strtotime($customerPOdate.' +'.$model->customerDeliveryWithin.'days'));
                             //  Conver customerDeliveryDate to d/m/Y  
                                    //$newDate = DateTime::createFromFormat('Y-m-d',$model->customerDeliveryDate);
                                    //$model->customerDeliveryDate = $newDate->format('d/m/Y');
                              }else{
                                  $model->customerDeliveryDate = null;
                              }
                          
                     /****************** Calculate Customer Delivery Due ******************/           
                            $model->save();
                        if(isset($_POST['project_id']) && isset($_POST['redirect']) && isset($_POST['project_status']))
                        {
                             $this->plusstatus($_POST['project_id'],$_POST['redirect'],$_POST['project_status']);
                        }
                    }
                    $this->render('index',array('model'=>$model));
                }       
                else{
                    $newmodel = new poh;
                     $newmodel->project_id = $project_id;
                     if($newmodel->save()){
                          //$year = (date('Y')+543)%100;
                          //$newmodel->PONo = "POC$year/$newmodel->id"; 
                          $newmodel->PONo = ""; 
                          $newmodel->save();
                          $this->render('index',array('model'=>$newmodel));
                     
                         
                     }
                }
	}
        
        public function plusstatus($project_id,$redirect,$project_status)
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

        
        public function actionReq()
	{
                $model=new poh;
		if(isset($_POST['poh']))
		{
			$model->attributes=$_POST['poh'];
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
		$model=new poh('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['poh']))
			$model->attributes=$_GET['poh'];

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
		$model=poh::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='poh-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
