<?php
/* @var $this QuohController */
/* @var $model quoh */

$this->breadcrumbs=array(
	'Quohs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List quoh', 'url'=>array('index')),
	array('label'=>'Create quoh', 'url'=>array('create')),
	array('label'=>'Update quoh', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete quoh', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage quoh', 'url'=>array('admin')),
);
?>

<h1>View quoh #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'quoteNo',
		'vendorQuoteDate',
		'enquiryDate',
		'vendor_id',
		'　status',
		'project_id',
		'deleted',
		'vendorRemark',
		'customerQuoteDate',
		'customer_id',
		'remark',
	),
)); ?>
