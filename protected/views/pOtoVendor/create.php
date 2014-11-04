<?php
/* @var $this PotovendorController */
/* @var $model potovendor */

$this->breadcrumbs=array(
	'Potovendors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List potovendor', 'url'=>array('index')),
	array('label'=>'Manage potovendor', 'url'=>array('admin')),
);
?>

<h1>Create potovendor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>