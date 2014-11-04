<?php
/* @var $this UserController */
/* @var $model user */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'givenname'); ?>
		<?php echo $form->textField($model,'givenname',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'givenname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
        
	<div class="row">
              <?php $model->password = null;  ?>
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
         <div class="row">
        <?php $model->password = null;  ?>
        <?php echo $form->label($model,'password_repeat'); ?>
        <?php echo $form->passwordField($model,'password_repeat',array('size'=>60,'maxlength'=>256,)); ?>
        <?php echo $form->error($model,'password_repeat'); ?>
    </div>
        
      

	
        <div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
        <div class="row">
            <?php //echo $form->dropDownList($model,'auth', CHtml::listData(authitem::model()->findAll(), 'name', 'name'),array('empty'=>'   ','name'=>'auth' ,'id'=>'auth','maxlength'=>10));?>
        </div>  
        
  <?php if(user::model()->findByPk(Yii::app()->user->getId())->auth === "admin" ){  ?> 
         <div class="row">
            <select name="myDropDown" id="myDropDown"> 
                <?php 
                     $usergroup = usergroup::model()->findAll();
                     foreach($usergroup as $group){
                         
                         echo  "<option value='".$group->name."' >".$group->name."</option>" 
                ?>
             <?php } ?>
            </select>
           
        </div>  
     <?php }  ?>
        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'simple_button')); ?>
              <?php
                    $visi = false;
                      if(Yii::app()->user->isGuest)
                          $visi = false;
                        else
                           $visi = user::model()->findByPk(Yii::app()->user->getId())->islevel("admin");
                        
                    if($visi == true)
                         echo CHtml::link('<div id="Back" class="simple_button" style="display:inline-block;margin-top:10px; margin-left: 20px;">Back</div>',array("user/index"));
                    else
                         echo CHtml::link('<div id="Back" class="simple_button" style="display:inline-block;margin-top:10px; margin-left: 20px;">Back</div>',array("site"));
                ?>
	</div>

<?php $this->endWidget(); ?>
      
      </div><!-- form -->