<?php
/* @var $this ProjectcountController */
/* @var $model projectcount */

$this->breadcrumbs=array(
	'Projectcounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List projectcount', 'url'=>array('index')),
	array('label'=>'Manage projectcount', 'url'=>array('admin')),
);
?>

<h1>Create projectcount</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>