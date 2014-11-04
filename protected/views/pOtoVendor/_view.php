<?php
/* @var $this PotovendorController */
/* @var $data potovendor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('potovendor_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->potovendor_id), array('view', 'id'=>$data->potovendor_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('POtoVendotNo')); ?>:</b>
	<?php echo CHtml::encode($data->POtoVendotNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderDate')); ?>:</b>
	<?php echo CHtml::encode($data->orderDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendorPOdate')); ?>:</b>
	<?php echo CHtml::encode($data->vendorPOdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendorDeliveryWithin')); ?>:</b>
	<?php echo CHtml::encode($data->vendorDeliveryWithin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendorDeliveryDate')); ?>:</b>
	<?php echo CHtml::encode($data->vendorDeliveryDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
	<?php echo CHtml::encode($data->remark); ?>
	<br />

	*/ ?>

</div>