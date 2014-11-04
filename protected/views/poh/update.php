<?php
/* @var $this PohController */
/* @var $model poh */

$this->breadcrumbs=array(
	'Pohs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List poh', 'url'=>array('index')),
	array('label'=>'Create poh', 'url'=>array('create')),
	array('label'=>'View poh', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage poh', 'url'=>array('admin')),
);
?>

<h1>Update poh <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>