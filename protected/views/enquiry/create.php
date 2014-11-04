<?php
/* @var $this EnquiryController */
/* @var $model enquiry */

$this->breadcrumbs=array(
	'Enquiries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List enquiry', 'url'=>array('index')),
	array('label'=>'Manage enquiry', 'url'=>array('admin')),
);
?>

<h1>Create enquiry</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>