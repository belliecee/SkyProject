<?php
/* @var $this QuohController */
/* @var $model quoh */

$this->breadcrumbs=array(
	'Quohs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List quoh', 'url'=>array('index')),
	array('label'=>'Create quoh', 'url'=>array('create')),
	array('label'=>'View quoh', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage quoh', 'url'=>array('admin')),
);
?>

<h1>Update quoh <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>