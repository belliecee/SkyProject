<?php
/* @var $this PaymentController */
/* @var $model payment */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List payment', 'url'=>array('index')),
	array('label'=>'Manage payment', 'url'=>array('admin')),
);
?>

<h1>Create payment</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>