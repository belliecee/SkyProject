<?php
/* @var $this PohController */
/* @var $model poh */

$this->breadcrumbs=array(
	'Pohs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List poh', 'url'=>array('index')),
	array('label'=>'Manage poh', 'url'=>array('admin')),
);
?>

<h1>Create poh</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>