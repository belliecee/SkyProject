<?php
/* @var $this EnquiryController */
/* @var $model enquiry */

$this->breadcrumbs=array(
	'Enquiries'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List enquiry', 'url'=>array('index')),
	array('label'=>'Create enquiry', 'url'=>array('create')),
	array('label'=>'Update enquiry', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete enquiry', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage enquiry', 'url'=>array('admin')),
);
?>

<h1>View enquiry #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'customer',
		'date',
		'contact',
		'remark',
		'mobile',
		'create_on',
		'create_by',
		'update_on',
		'update_by',
	),
)); ?>
