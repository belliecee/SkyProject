<?php
/* @var $this PodController */
/* @var $model pod */

$this->breadcrumbs=array(
	'Pods'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List pod', 'url'=>array('index')),
	array('label'=>'Create pod', 'url'=>array('create')),
	array('label'=>'View pod', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage pod', 'url'=>array('admin')),
);
?>

<h1>Update pod <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>