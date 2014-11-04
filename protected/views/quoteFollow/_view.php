<?php
/* @var $this QuoteFollowController */
/* @var $data quoteFollow */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quoteNo')); ?>:</b>
	<?php echo CHtml::encode($data->quoteNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quoH_id')); ?>:</b>
	<?php echo CHtml::encode($data->quoH_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('followedDate')); ?>:</b>
	<?php echo CHtml::encode($data->followedDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('followedBy')); ?>:</b>
	<?php echo CHtml::encode($data->followedBy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact')); ?>:</b>
	<?php echo CHtml::encode($data->contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detail')); ?>:</b>
	<?php echo CHtml::encode($data->detail); ?>
	<br />


</div>