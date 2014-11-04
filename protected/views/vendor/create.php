<?php
/* @var $this VendorController */
/* @var $model vendor */

$this->breadcrumbs=array(
	'Vendors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List vendor', 'url'=>array('index')),
	array('label'=>'Manage vendor', 'url'=>array('admin')),
);
?>

<h1>Create vendor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>