<?php
/* @var $this QuohController */
/* @var $data quoh */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quoteNo')); ?>:</b>
	<?php echo CHtml::encode($data->quoteNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendorQuoteDate')); ?>:</b>
	<?php echo CHtml::encode($data->vendorQuoteDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enquiryDate')); ?>:</b>
	<?php echo CHtml::encode($data->enquiryDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('　status')); ?>:</b>
	<?php echo CHtml::encode($data->　status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendorRemark')); ?>:</b>
	<?php echo CHtml::encode($data->vendorRemark); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customerQuoteDate')); ?>:</b>
	<?php echo CHtml::encode($data->customerQuoteDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
	<?php echo CHtml::encode($data->remark); ?>
	<br />

	*/ ?>

</div>