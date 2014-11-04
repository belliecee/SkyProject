<?php
/* @var $this UserController */
/* @var $model user */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List user', 'url'=>array('index')),
	array('label'=>'Create user', 'url'=>array('create')),
	array('label'=>'Update user', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete user', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage user', 'url'=>array('admin')),
);
?>

<h1>View user #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'givenname',
		'lastname',
		'email',
		'username',
		'password',
		'registereddate',
		'updatedate',
		'last_time_login',
		'officephone',
		'cellphone',
		'homephone',
		'profile',
		'address1',
		'address2',
		'city',
		'country',
		'postcode',
		'capacity',
		'available_monday',
		'available_tuesday',
		'available_wednesday',
		'available_thursday',
		'available_friday',
		'available_saturday',
		'available_sunday',
	),
)); ?>
