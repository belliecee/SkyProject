<?php
/* @var $this MachineTypeController */
/* @var $model machineType */

$this->breadcrumbs=array(
	'Machine Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List machineType', 'url'=>array('index')),
	array('label'=>'Manage machineType', 'url'=>array('admin')),
);
?>

<h1>Create machineType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>