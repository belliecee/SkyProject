<?php
/* @var $this DepositController */
/* @var $model deposit */

$this->breadcrumbs=array(
	'Deposits'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List deposit', 'url'=>array('index')),
	array('label'=>'Create deposit', 'url'=>array('create')),
	array('label'=>'View deposit', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage deposit', 'url'=>array('admin')),
);
?>

<h1>Update deposit <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>