<?php
/* @var $this VendorprocessController */
/* @var $model vendorprocess */

$this->breadcrumbs=array(
	'Vendorprocesses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List vendorprocess', 'url'=>array('index')),
	array('label'=>'Create vendorprocess', 'url'=>array('create')),
	array('label'=>'View vendorprocess', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage vendorprocess', 'url'=>array('admin')),
);
?>

<h1>Update vendorprocess <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>