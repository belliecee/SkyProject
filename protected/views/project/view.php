<?php
/* @var $this ProjectController */
/* @var $model project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List project', 'url'=>array('index')),
	array('label'=>'Create project', 'url'=>array('create')),
	array('label'=>'Update project', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete project', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage project', 'url'=>array('admin')),
);
?>

<h1>View project #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'projectNo',
		'customer_id',
		'vendor_id',
		'status',
		'machineType',
		'goodsFinishedDate',
		'deliveryDate',
		'vendorQuoDate',
		'existInStock',
		'create_on',
		'create_by',
		'update_on',
		'update_by',
	),
)); ?>
