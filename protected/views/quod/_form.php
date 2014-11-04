<?php
/* @var $this QuodController */
/* @var $model quod */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'quod-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'quoteNo'); ?>
		<?php echo $form->textField($model,'quoteNo',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'quoteNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enquiryDate'); ?>
		<?php echo $form->textField($model,'enquiryDate'); ?>
		<?php echo $form->error($model,'enquiryDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lineNo'); ?>
		<?php echo $form->textField($model,'lineNo',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'lineNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quoH_id'); ?>
		<?php echo $form->textField($model,'quoH_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'quoH_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qty'); ?>
		<?php echo $form->textField($model,'qty',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'qty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'unitPrice'); ?>
		<?php echo $form->textField($model,'unitPrice'); ?>
		<?php echo $form->error($model,'unitPrice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lineTotal'); ?>
		<?php echo $form->textField($model,'lineTotal',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'lineTotal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->