<?php
/* @var $this VendorController */
/* @var $model vendor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vendor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>

	
	<div class="row">
            <b>Vendor Name</b>&nbsp;&nbsp;
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    
        <br/><br/>
	
	
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'simple_button')); ?>
                <?php echo CHtml::link('<div style="margin-left:20px;display:inline-block ;text-decoration:none" class="simple_button">Cancel</div>',$this->createUrl('vendor/admin')); ?>
	

<?php $this->endWidget(); ?>

</div><!-- form -->