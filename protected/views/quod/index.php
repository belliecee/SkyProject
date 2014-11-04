<?php
/* @var $this QuodController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Quods',
);

$this->menu=array(
	array('label'=>'Create quod', 'url'=>array('create')),
	array('label'=>'Manage quod', 'url'=>array('admin')),
);
?>

<h1>Quods</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
