<?php
/* @var $this ProductController */
/* @var $model product */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List product', 'url'=>array('index')),
	array('label'=>'Manage product', 'url'=>array('admin')),
);
?>

<h1>Create product</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>