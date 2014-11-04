<?php
/* @var $this PotovendorController */
/* @var $model potovendor */

$this->breadcrumbs=array(
	'Potovendors'=>array('index'),
	$model->potovendor_id=>array('view','id'=>$model->potovendor_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List potovendor', 'url'=>array('index')),
	array('label'=>'Create potovendor', 'url'=>array('create')),
	array('label'=>'View potovendor', 'url'=>array('view', 'id'=>$model->potovendor_id)),
	array('label'=>'Manage potovendor', 'url'=>array('admin')),
);
?>

<h1>Update potovendor <?php echo $model->potovendor_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>