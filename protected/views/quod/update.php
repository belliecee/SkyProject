<?php
/* @var $this QuodController */
/* @var $model quod */

$this->breadcrumbs=array(
	'Quods'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List quod', 'url'=>array('index')),
	array('label'=>'Create quod', 'url'=>array('create')),
	array('label'=>'View quod', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage quod', 'url'=>array('admin')),
);
?>

<h1>Update quod <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>