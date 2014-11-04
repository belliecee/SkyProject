<?php
/* @var $this ProjectStatusController */
/* @var $model projectStatus */

$this->breadcrumbs=array(
	'Project Statuses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List projectStatus', 'url'=>array('index')),
	array('label'=>'Create projectStatus', 'url'=>array('create')),
	array('label'=>'View projectStatus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage projectStatus', 'url'=>array('admin')),
);
?>

<h1>Update projectStatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>