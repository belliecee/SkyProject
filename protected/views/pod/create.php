<?php
/* @var $this PodController */
/* @var $model pod */

$this->breadcrumbs=array(
	'Pods'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List pod', 'url'=>array('index')),
	array('label'=>'Manage pod', 'url'=>array('admin')),
);
?>

<h1>Create pod</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>