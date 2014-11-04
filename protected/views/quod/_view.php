<?php
/* @var $this QuodController */
/* @var $data quod */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quoteNo')); ?>:</b>
	<?php echo CHtml::encode($data->quoteNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enquiryDate')); ?>:</b>
	<?php echo CHtml::encode($data->enquiryDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lineNo')); ?>:</b>
	<?php echo CHtml::encode($data->lineNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quoH_id')); ?>:</b>
	<?php echo CHtml::encode($data->quoH_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qty')); ?>:</b>
	<?php echo CHtml::encode($data->qty); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('unitPrice')); ?>:</b>
	<?php echo CHtml::encode($data->unitPrice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lineTotal')); ?>:</b>
	<?php echo CHtml::encode($data->lineTotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
	<?php echo CHtml::encode($data->remark); ?>
	<br />

	*/ ?>

</div>