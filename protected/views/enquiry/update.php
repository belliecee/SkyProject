<?php
/* @var $this EnquiryController */
/* @var $model enquiry */

$this->breadcrumbs=array(
	'Enquiries'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List enquiry', 'url'=>array('index')),
	array('label'=>'Create enquiry', 'url'=>array('create')),
	array('label'=>'View enquiry', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage enquiry', 'url'=>array('admin')),
);
?>

<h1>Update enquiry <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>