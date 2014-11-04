<?php

class PaymentController extends Controller
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
				'actions'=>array('create','update','req','admin','delete','deletePayment','delete2'),
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
	public function actionCreate($paymentDate,$amount,$project_id,$payment_id)
	{
		$model=new payment;
                //$anypayment = payment::model()->findAll("project_id=:project_id",array(":project_id"=>$project_id)); 
                $deposit_model = deposit::model()->findAll("project_id=:project_id",array(":project_id"=>$project_id)); 
                $project_model = project::model()->findByPk($project_id);
                $project_model->status = 15;
                $project_model->save();
                
                $model->paymentDate = $paymentDate;
                $model->amount = $amount;
		$model->project_id = $project_id;
                $model->save();
                $payment_model = payment::model()->findAll("project_id=:project_id",array(":project_id"=>$project_id)); 
                
                //$this->render('index',array('model'=>$payment_model,'deposit_model'=>$deposit_model,'project_id'=>$project_id));
                     //$payment_model = payment::model()->findAll("project_id=:project_id",  array(":project_id"=>$project_id));
                //$this->renderPartial('_newform',array('project_id'=>$project_id));
                    /*
                        echo CJSON::encode(array(
                             'paymentID' => $model->id,
                      ));
                     * 
                     */
                
		  
        //      Yii::app()->end();
            
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($paymentDate,$amount,$project_id,$payment_id)
	{
		$model=$this->loadModel($payment_id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$model->paymentDate = $paymentDate;
                $model->amount = $amount;
		$model->project_id = $project_id;
                $model->save();
                     //$payment_model = payment::model()->findAll("project_id=:project_id",  array(":project_id"=>$project_id));
                $this->renderPartial('_newform',array('project_id'=>$project_id));
	}
        
        public function actionDeletePayment($id)
	{
		$model = payment::model()->findByPk($id);
                $model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		
	}
        
         public function actionDelete2($id,$project_id)
	{
		$model = payment::model()->findByPk($id);
                $model->delete();
                //$payment_model = payment::model()->findAll("project_id=:project_id",  array(":project_id"=>$project_id));
               // $deposit_model = deposit::model()->findAll("project_id=:project_id",  array(":project_id"=>$project_id));
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		 $this->renderPartial('_newform',array('project_id'=>$project_id));
                Yii::app()->end();
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
		$model = payment::model()->find($criteria);
                $deposit_model = deposit::model()->find($criteria);
                $this->render('index',array('model'=>$model,'deposit_model'=>$deposit_model,'project_id'=>$project_id));
                
  /*              
                if($model == null){
                     $newmodel = new deposit;
                     //$newmodel->project_id = $project_id;
                     $newmodel->project_id = $project_id;
                     $newmodel->save();
                     $this->render('index',array('model'=>$newmodel,'deposit_model'=>$deposit_model,'project_id'=>$project_id));
                     
                }
                else{
                  
                   if(isset($_POST['deposit']))
                   {
                       
                       $deposit_model->attributes=$_POST['deposit'];
                       $deposit_model->save();
				
                  } 
                  $this->render('index',array('model'=>$model,'deposit_model'=>$deposit_model,'project_id'=>$project_id));
                
                } 
   * 
   */ 
	}
        
          public function actionReq()
	{
                $model=new payment;
		if(isset($_POST['payment']))
		{
			$model->attributes=$_POST['payment'];
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
		$model=new payment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['payment']))
			$model->attributes=$_GET['payment'];

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
		$model=payment::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='payment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
