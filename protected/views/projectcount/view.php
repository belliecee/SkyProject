<?php
/* @var $this ProjectcountController */
/* @var $model projectcount */

$this->breadcrumbs=array(
	'Projectcounts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List projectcount', 'url'=>array('index')),
	array('label'=>'Create projectcount', 'url'=>array('create')),
	array('label'=>'Update projectcount', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete projectcount', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage projectcount', 'url'=>array('admin')),
);
?>

<h1>View projectcount #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'year',
		'type',
		'counter',
	),
)); ?>
