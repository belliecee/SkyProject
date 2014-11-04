<?php
/* @var $this QuohController */
/* @var $model quoh */

$this->breadcrumbs=array(
	'Quohs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List quoh', 'url'=>array('index')),
	array('label'=>'Manage quoh', 'url'=>array('admin')),
);
?>

<h1>Create quoh</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>