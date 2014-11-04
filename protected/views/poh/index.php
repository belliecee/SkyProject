
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>

<?php
        if(Yii::app()->user->isGuest){
             $this->redirect(Yii::app()->homeUrl);
         }
         else{
            $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->poh_read == 0){
                  $this->redirect(Yii::app()->homeUrl);
             }
            
         }

?>


<br/><br/>
<?php  
     $project_model = project::model()->findByPk($model->project_id);
?>
<div class="other_header" style="margin-top:-32px;">
<?php
     $this->renderPartial('//project/_form',array('model'=>$project_model)); 
?>    
</div> 
<?php
    if($project_model->status  == 18)
        {
               $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->poh_update == 0){
                  $dis = true;
             }
             else
                  $dis = false;
        }
        else
        {
            $dis = true;
        }
?>         

<div class="index_content" style=" margin: 0 0 20px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 70px 0 0;width:1000px;">
 <div class="title2" style="border-bottom: none;"> Purchase Order </div>
  <div class="bottomline"></div>
<?php
     $this->renderPartial('_form',array('model'=>$model,'project_model'=>$project_model)); 
 ?>
</div>


  