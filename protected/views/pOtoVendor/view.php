<?php
/* @var $this PotovendorController */
/* @var $model potovendor */

$this->breadcrumbs=array(
	'Potovendors'=>array('index'),
	$model->potovendor_id,
);

$this->menu=array(
	array('label'=>'List potovendor', 'url'=>array('index')),
	array('label'=>'Create potovendor', 'url'=>array('create')),
	array('label'=>'Update potovendor', 'url'=>array('update', 'id'=>$model->potovendor_id)),
	array('label'=>'Delete potovendor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->potovendor_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage potovendor', 'url'=>array('admin')),
);
?>

<h1>View potovendor #<?php echo $model->potovendor_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'potovendor_id',
		'POtoVendotNo',
		'project_id',
		'orderDate',
		'vendorPOdate',
		'vendorDeliveryWithin',
		'vendorDeliveryDate',
		'remark',
	),
)); ?>
