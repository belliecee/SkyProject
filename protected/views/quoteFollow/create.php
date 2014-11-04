<?php
/* @var $this QuoteFollowController */
/* @var $model quoteFollow */

$this->breadcrumbs=array(
	'Quote Follows'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List quoteFollow', 'url'=>array('index')),
	array('label'=>'Manage quoteFollow', 'url'=>array('admin')),
);
?>

<h1>Create quoteFollow</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>