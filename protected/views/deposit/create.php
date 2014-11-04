<?php
/* @var $this DepositController */
/* @var $model deposit */

$this->breadcrumbs=array(
	'Deposits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List deposit', 'url'=>array('index')),
	array('label'=>'Manage deposit', 'url'=>array('admin')),
);
?>

<h1>Create deposit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>