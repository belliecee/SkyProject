<?php
/* @var $this ProductController */
/* @var $model product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List product', 'url'=>array('index')),
	array('label'=>'Create product', 'url'=>array('create')),
	array('label'=>'Update product', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete product', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage product', 'url'=>array('admin')),
);
?>

<h1>View product #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'modelNo',
		'name',
		'type',
		'price',
		'deleted',
	),
)); ?>
