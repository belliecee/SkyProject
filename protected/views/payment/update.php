<?php
/* @var $this PaymentController */
/* @var $model payment */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List payment', 'url'=>array('index')),
	array('label'=>'Create payment', 'url'=>array('create')),
	array('label'=>'View payment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage payment', 'url'=>array('admin')),
);
?>

<h1>Update payment <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>