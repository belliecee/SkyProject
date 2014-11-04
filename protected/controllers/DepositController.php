<?php

class DepositController extends Controller
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
				'actions'=>array('create','update','delete'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new deposit;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['deposit']))
		{
			$model->attributes=$_POST['deposit'];
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

		if(isset($_POST['deposit']))
		{
			$model->attributes=$_POST['deposit'];
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
		$model = deposit::model()->find($criteria);
                
                
		 if($model == null){
                     $newmodel = new deposit;
                     $newmodel->project_id = $project_id;
                     
                        if($newmodel->save())
                            $this->render('index',array('model'=>$newmodel));
                    
                }
                else{
                  
                    if(isset($_POST['deposit']))
                   {
                          $model->attributes=$_POST['deposit'];
                          if($_POST['deposit']['isdeposit'] == 2){
                                //$model->depositDate = null;
                                $model->depositAmount = 0;
                                $model->depositDate = null;
                          }
                          
                          if($model->depositDate != null){
                               //  Conver customerPOdate Y-m-d
                                  $model->beforeSaveDate("depositDate");
                                  $depositDate = $model->depositDate;
                           
                            // Add Date
                                    $model->customerDeliveryDate  = date('Y-m-d', strtotime($depositDate.' +'.$model->customerDeliveryWithin.'days'));
                             //  Conver customerDeliveryDate to d/m/Y  
                              }else{
                                 
                                  $poh_model = poh::model()->find($criteria);
                                  $model->customerDeliveryDate  = date('Y-m-d', strtotime($poh_model->customerPOdate.' +'.$model->customerDeliveryWithin.'days'));
                            
                                
                              }
                          
                           $model->save();
                        if(isset($_POST['project_id']) && isset($_POST['redirect']) && isset($_POST['project_status']))
                        {
                             $this->plusstatus($_POST['project_id'],$_POST['redirect'],$_POST['project_status']);
                        }
                   }
                   $this->render('index',array('model'=>$model));
                
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

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new deposit('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['deposit']))
			$model->attributes=$_GET['deposit'];

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
		$model=deposit::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='deposit-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
