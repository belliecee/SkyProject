<?php
/* @var $this PaymentController */
/* @var $model payment */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List payment', 'url'=>array('index')),
	array('label'=>'Create payment', 'url'=>array('create')),
	array('label'=>'Update payment', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete payment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage payment', 'url'=>array('admin')),
);
?>

<h1>View payment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'quotation_id',
		'paymentDate',
		'amount',
		'update_on',
		'update_by',
	),
)); ?>
