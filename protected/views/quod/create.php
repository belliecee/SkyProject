<?php
/* @var $this QuodController */
/* @var $model quod */

$this->breadcrumbs=array(
	'Quods'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List quod', 'url'=>array('index')),
	array('label'=>'Manage quod', 'url'=>array('admin')),
);
?>

<h1>Create quod</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>