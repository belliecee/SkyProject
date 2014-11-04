<?php
/* @var $this DepositController */
/* @var $model deposit */

$this->breadcrumbs=array(
	'Deposits'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List deposit', 'url'=>array('index')),
	array('label'=>'Create deposit', 'url'=>array('create')),
	array('label'=>'Update deposit', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete deposit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage deposit', 'url'=>array('admin')),
);
?>

<h1>View deposit #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'poh_id',
		'date',
		'amount',
		'remark',
	),
)); ?>
