<?php
/* @var $this MachineTypeController */
/* @var $model machineType */

$this->breadcrumbs=array(
	'Machine Types'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List machineType', 'url'=>array('index')),
	array('label'=>'Create machineType', 'url'=>array('create')),
	array('label'=>'View machineType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage machineType', 'url'=>array('admin')),
);
?>

<h1>Update machineType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>