<?php
/* @var $this MachineTypeController */
/* @var $model machineType */

$this->breadcrumbs=array(
	'Machine Types'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List machineType', 'url'=>array('index')),
	array('label'=>'Create machineType', 'url'=>array('create')),
	array('label'=>'Update machineType', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete machineType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage machineType', 'url'=>array('admin')),
);
?>

<h1>View machineType #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
	),
)); ?>
