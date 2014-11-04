<?php
/* @var $this VendorController */
/* @var $model vendor */

$this->breadcrumbs=array(
	'Vendors'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List vendor', 'url'=>array('index')),
	array('label'=>'Create vendor', 'url'=>array('create')),
	array('label'=>'Update vendor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete vendor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage vendor', 'url'=>array('admin')),
);
?>

<h1>View vendor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'vendor_id',
		'name',
		'address',
		'create_on',
		'create_by',
	),
)); ?>
