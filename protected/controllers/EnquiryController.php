<?php

class EnquiryController extends Controller
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
				'actions'=>array('patchinsert','create','update','req','teset','autocomplete','savefield','deleteproduct'),
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
        
         public function actionDeleteproduct($id){
           $productenquiry = productenquiry::model()->findByPk($id);
           if($productenquiry != null)
               $productenquiry->delete();
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionPatchinsert(){
		$model = enquiry::model()->findAll();
		foreach($model as $mo){
			$projectmodel = project::model()->findByPk($mo->project_id);
			//echo $projectmodel->id."<br/>";
			if($projectmodel != null){
				if($projectmodel->machineType != 3){
					$projectmodel->customer_id = $mo->customer;
				}else{
					$projectmodel->vendor_id = $mo->customer;
				}
				$projectmodel->save();
			}
		}
		
	}
	public function actionCreate()
	{
		$model=new enquiry;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['enquiry']))
		{
			$model->attributes=$_POST['enquiry'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['enquiry']))
		{
			$model->attributes=$_POST['enquiry'];
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
        
          public function actionSavefield($id,$fieldname,$fieldvalue){
  
        // Query with 
           
          $model=$this->loadModel($id);
          $project_model = project::model()->findByPk($model->project_id);
         // Append the query result to array
          $model->saveAttributes(array($fieldname=>$fieldvalue));
          $project_model->saveAttributes(array('existInStock'=>$fieldvalue));
          Yii::app()->end();
 
 }
	public function actionIndex($project_id)
	{
  
                $criteria = new CDbCriteria();
                $criteria->condition = "project_id=:project_id";
                $criteria->params = array(":project_id"=>$project_id);
				$model = enquiry::model()->find($criteria);
                $project_model = project::model()->findByPk($project_id);
                
                if($model == null){
                     $newmodel = new enquiry;
                     $newmodel->project_id = $project_id;
                     $newmodel->isstock = 1;
                     $project_model->existInStock = 1;
                     $project_model->save();
                     if($newmodel->save())
                         $this->render('index',array('model'=>$newmodel));
                }
                 if(isset($_POST['enquiry']))
				 {

					$model->attributes=$_POST['enquiry'];
                        
                               
                         if($project_model->machineType != 3){
                                $str = $_POST['enquiry']['customerstr'];
                                $getCustomer = customer::model()->findByAttributes(array('name'=>$str));
							
                                 if($getCustomer == null)
                                {
                                     $customer_model = new customer;
                                     $customer_model->name = $str;
                                     if($customer_model->save())
                                        $model->customer = $customer_model->id;
										$project_model->customer_id = $customer_model->id;
										
                                }else{
                                        $model->customer = $getCustomer->id;
										$project_model->customer_id = $getCustomer->id;
                                }
                         }else{
                             
                             
                             
                                
                                
                                if(isset($_POST['product'])){
                                    $productenquiery_model = new productenquiry;
                                    if($_POST['product']!= "" && $_POST['qty']!=""){
                                        $productenquiery_model->name = $_POST['product'];
                                        $productenquiery_model->qty = $_POST['qty'];
                                        $productenquiery_model->project_id = $project_model->id;
                                        $productenquiery_model->save();
                                    }

                                }
                              
                                 // VENDOR
                            
                             
                                if(isset($_POST['enquiry']['vendorstr'])){
                                    $str = $_POST['enquiry']['vendorstr'];
                                      $getVendor = vendor::model()->findByAttributes(array('name'=>$str));
                                       if($getVendor == null)
                                      {
                                           $vendor_model = new vendor;
                                           $vendor_model->name = $str;
                                           if($vendor_model->save())
                                              $model->customer = $vendor_model->id;
											  $project_model->vendor_id = $vendor_model->id;
                                      }else{
                                              $model->customer = $getVendor->id;
											  $project_model->vendor_id = $vendor_model->id;
                                      }
                                }
                                
                             
                               //VENDOR
                         }
                       
						$model->save();
                        $project_model->save();
                        
                        if(isset($_POST['project_id']) && isset($_POST['redirect']) && isset($_POST['project_status']))
                        {
                             $this->plusstatus($_POST['project_id'],$_POST['redirect'],$_POST['project_status']);
                        }
				
		}
               
                 $this->render('index',array('model'=>$model));
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
        public function actionTest()
	{
            /*
               if(isset($_POST['longtest']))
               {
                   $model = $this->loadModel($_POST['id']);
                   $model->contact = $_POST['longtest'];
                   $model->save(); 
                     
               }
             * 
             */
               Yii::app()->end();
        }
        public function actionReq()
	{
           
               $model=new enquiry;
               
                //$project_id = $_GET['current'];
                //$project_id = $this->loadModel($current);
		//$dataProvider=new CActiveDataProvider('enquiry');
		$this->renderPartial('_form',array('model'=>$model));
                Yii::app()->end();
           

	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new enquiry('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['enquiry']))
			$model->attributes=$_GET['enquiry'];

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
		$model=enquiry::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='enquiry-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
