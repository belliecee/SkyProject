<?php
/* @var $this VendorprocessController */
/* @var $model vendorprocess */

$this->breadcrumbs=array(
	'Vendorprocesses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List vendorprocess', 'url'=>array('index')),
	array('label'=>'Manage vendorprocess', 'url'=>array('admin')),
);
?>

<h1>Create vendorprocess</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>