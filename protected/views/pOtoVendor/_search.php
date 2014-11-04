<?php
/* @var $this PotovendorController */
/* @var $model potovendor */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'potovendor_id'); ?>
		<?php echo $form->textField($model,'potovendor_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'POtoVendotNo'); ?>
		<?php echo $form->textField($model,'POtoVendotNo',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_id'); ?>
		<?php echo $form->textField($model,'project_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'orderDate'); ?>
		<?php echo $form->textField($model,'orderDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vendorPOdate'); ?>
		<?php echo $form->textField($model,'vendorPOdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vendorDeliveryWithin'); ?>
		<?php echo $form->textField($model,'vendorDeliveryWithin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vendorDeliveryDate'); ?>
		<?php echo $form->textField($model,'vendorDeliveryDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remark'); ?>
		<?php echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->