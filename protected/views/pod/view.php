<?php
/* @var $this PodController */
/* @var $model pod */

$this->breadcrumbs=array(
	'Pods'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List pod', 'url'=>array('index')),
	array('label'=>'Create pod', 'url'=>array('create')),
	array('label'=>'Update pod', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete pod', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage pod', 'url'=>array('admin')),
);
?>

<h1>View pod #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'PONo',
		'lineNo',
		'product_id',
		'qty',
		'unitPrice',
		'lineTotal',
		'remark',
		'receivedQty',
		'deliveredQty',
		'balance',
	),
)); ?>
