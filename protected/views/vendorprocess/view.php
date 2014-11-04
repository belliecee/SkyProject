<?php
/* @var $this VendorprocessController */
/* @var $model vendorprocess */

$this->breadcrumbs=array(
	'Vendorprocesses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List vendorprocess', 'url'=>array('index')),
	array('label'=>'Create vendorprocess', 'url'=>array('create')),
	array('label'=>'Update vendorprocess', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete vendorprocess', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage vendorprocess', 'url'=>array('admin')),
);
?>

<h1>View vendorprocess #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'vendor_id',
		'project_id',
		'enquiryToVendorDate',
		'vendorQuotationDate',
		'remark',
		'create_on',
		'create_by',
	),
)); ?>
