<?php
/* @var $this ProjectcountController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Projectcounts',
);

$this->menu=array(
	array('label'=>'Create projectcount', 'url'=>array('create')),
	array('label'=>'Manage projectcount', 'url'=>array('admin')),
);
?>

<h1>Projectcounts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
