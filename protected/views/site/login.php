<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>
<div class="index_content" style=" margin: 20px 0 20px -50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 70px 0 0;width:1000px; min-height: 500px;">

    
<div class="title2" style="border-bottom: none;">LOG IN</div>
<div class="bottomline"></div>


<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<br/><br/><br/>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		&nbsp;&nbsp;&nbsp;&nbsp;
		<b style="font-size:14px;">Username</b>&nbsp;&nbsp;<?php echo $form->textField($model,'username',array('style'=>'width:300px;')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		&nbsp;&nbsp;&nbsp;&nbsp;
		<b style="font-size:14px;">Password</b>&nbsp;&nbsp;&nbsp;<?php echo $form->passwordField($model,'password',array('style'=>'width:300px;')); ?>
		<?php echo $form->error($model,'password'); ?>
		
	</div>

	<div class="row rememberMe">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
        
	<div class="row buttons">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;
		<?php echo CHtml::submitButton('Login',array('class'=>'simple_button')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>