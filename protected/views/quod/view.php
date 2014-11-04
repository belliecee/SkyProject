<?php
/* @var $this QuodController */
/* @var $model quod */

$this->breadcrumbs=array(
	'Quods'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List quod', 'url'=>array('index')),
	array('label'=>'Create quod', 'url'=>array('create')),
	array('label'=>'Update quod', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete quod', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage quod', 'url'=>array('admin')),
);
?>

<h1>View quod #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'quoteNo',
		'enquiryDate',
		'lineNo',
		'quoH_id',
		'product_id',
		'qty',
		'unitPrice',
		'lineTotal',
		'remark',
	),
)); ?>
