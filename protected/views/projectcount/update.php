<?php
/* @var $this ProjectcountController */
/* @var $model projectcount */

$this->breadcrumbs=array(
	'Projectcounts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List projectcount', 'url'=>array('index')),
	array('label'=>'Create projectcount', 'url'=>array('create')),
	array('label'=>'View projectcount', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage projectcount', 'url'=>array('admin')),
);
?>

<h1>Update projectcount <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>