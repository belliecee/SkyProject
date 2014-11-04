<?php
/* @var $this ProjectController */
/* @var $model project */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List project', 'url'=>array('index')),
	array('label'=>'Create project', 'url'=>array('create')),
	array('label'=>'View project', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage project', 'url'=>array('admin')),
);
?>

<h1>Update project <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>