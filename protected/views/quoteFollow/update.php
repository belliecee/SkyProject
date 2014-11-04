<?php
/* @var $this QuoteFollowController */
/* @var $model quoteFollow */

$this->breadcrumbs=array(
	'Quote Follows'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List quoteFollow', 'url'=>array('index')),
	array('label'=>'Create quoteFollow', 'url'=>array('create')),
	array('label'=>'View quoteFollow', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage quoteFollow', 'url'=>array('admin')),
);
?>

<h1>Update quoteFollow <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>