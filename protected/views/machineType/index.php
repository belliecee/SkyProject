<?php
/* @var $this MachineTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Machine Types',
);

$this->menu=array(
	array('label'=>'Create machineType', 'url'=>array('create')),
	array('label'=>'Manage machineType', 'url'=>array('admin')),
);
?>

<h1>Machine Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
