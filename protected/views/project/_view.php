<?php
/* @var $this ProjectController */
/* @var $data project */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('projectNo')); ?>:</b>
	<?php echo CHtml::encode($data->projectNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('machineType')); ?>:</b>
	<?php echo CHtml::encode($data->machineType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('goodsFinishedDate')); ?>:</b>
	<?php echo CHtml::encode($data->goodsFinishedDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('deliveryDate')); ?>:</b>
	<?php echo CHtml::encode($data->deliveryDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendorQuoDate')); ?>:</b>
	<?php echo CHtml::encode($data->vendorQuoDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('existInStock')); ?>:</b>
	<?php echo CHtml::encode($data->existInStock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_on')); ?>:</b>
	<?php echo CHtml::encode($data->create_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_by')); ?>:</b>
	<?php echo CHtml::encode($data->create_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_on')); ?>:</b>
	<?php echo CHtml::encode($data->update_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_by')); ?>:</b>
	<?php echo CHtml::encode($data->update_by); ?>
	<br />

	*/ ?>

</div>