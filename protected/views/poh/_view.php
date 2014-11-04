<?php
/* @var $this PohController */
/* @var $data poh */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PONo')); ?>:</b>
	<?php echo CHtml::encode($data->PONo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerPOdate')); ?>:</b>
	<?php echo CHtml::encode($data->customerPOdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendorPOdate')); ?>:</b>
	<?php echo CHtml::encode($data->vendorPOdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerDeliveryWithin')); ?>:</b>
	<?php echo CHtml::encode($data->customerDeliveryWithin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerDeliveryDate')); ?>:</b>
	<?php echo CHtml::encode($data->customerDeliveryDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_id); ?>
	<br />

	*/ ?>

</div>