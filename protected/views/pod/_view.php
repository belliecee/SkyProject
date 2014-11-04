<?php
/* @var $this PodController */
/* @var $data pod */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PONo')); ?>:</b>
	<?php echo CHtml::encode($data->PONo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lineNo')); ?>:</b>
	<?php echo CHtml::encode($data->lineNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qty')); ?>:</b>
	<?php echo CHtml::encode($data->qty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unitPrice')); ?>:</b>
	<?php echo CHtml::encode($data->unitPrice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lineTotal')); ?>:</b>
	<?php echo CHtml::encode($data->lineTotal); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
	<?php echo CHtml::encode($data->remark); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receivedQty')); ?>:</b>
	<?php echo CHtml::encode($data->receivedQty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deliveredQty')); ?>:</b>
	<?php echo CHtml::encode($data->deliveredQty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('balance')); ?>:</b>
	<?php echo CHtml::encode($data->balance); ?>
	<br />

	*/ ?>

</div>