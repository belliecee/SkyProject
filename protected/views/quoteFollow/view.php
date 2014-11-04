<?php
/* @var $this QuoteFollowController */
/* @var $model quoteFollow */

$this->breadcrumbs=array(
	'Quote Follows'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List quoteFollow', 'url'=>array('index')),
	array('label'=>'Create quoteFollow', 'url'=>array('create')),
	array('label'=>'Update quoteFollow', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete quoteFollow', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage quoteFollow', 'url'=>array('admin')),
);
?>

<h1>View quoteFollow #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'quoteNo',
		'quoH_id',
		'followedDate',
		'followedBy',
		'contact',
		'detail',
	),
)); ?>
