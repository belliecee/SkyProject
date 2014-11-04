<?php
/* @var $this ProjectStatusController */
/* @var $model projectStatus */

$this->breadcrumbs=array(
	'Project Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List projectStatus', 'url'=>array('index')),
	array('label'=>'Manage projectStatus', 'url'=>array('admin')),
);
?>

<h1>Create projectStatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>