<?php
/* @var $this ProjectController */
/* @var $model project */


$this->menu=array(
	array('label'=>'List project', 'url'=>array('index')),
	array('label'=>'Manage project', 'url'=>array('admin')),
);
?>

<h1>Create project</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>