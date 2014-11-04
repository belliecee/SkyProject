<?php
/* @var $this ProjectController */
/* @var $model project */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'projectNo'); ?>
		<?php echo $form->textField($model,'projectNo',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vendor_id'); ?>
		<?php echo $form->textField($model,'vendor_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'machineType'); ?>
		<?php echo $form->textField($model,'machineType',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'goodsFinishedDate'); ?>
		<?php echo $form->textField($model,'goodsFinishedDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deliveryDate'); ?>
		<?php echo $form->textField($model,'deliveryDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vendorQuoDate'); ?>
		<?php echo $form->textField($model,'vendorQuoDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'existInStock'); ?>
		<?php echo $form->textField($model,'existInStock',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_on'); ?>
		<?php echo $form->textField($model,'create_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_by'); ?>
		<?php echo $form->textField($model,'create_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_on'); ?>
		<?php echo $form->textField($model,'update_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_by'); ?>
		<?php echo $form->textField($model,'update_by',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->