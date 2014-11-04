
<!------------------ The Button for add an ITEM  ------------------->



<div class="title2" style="border-bottom: none;">Model</div>
<div class="bottomline"></div>
<!--------------------------- Start Table ----------------------------------------->

<br/><br/>
<div style="margin: 0 auto; display: block; width: 600px;">
<?php
/* @var $this ProductController */
/* @var $model product */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div style="float:rigth">
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
</div>    
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		
		array(
			'class'=>'CButtonColumn',
                        'deleteConfirmation'=>"js:'Do you really want to delete record with ID '+$(this).parent().parent().children(':nth-child(2)').text()+'?'",
                        'template'=>'{edit} {delete}',
                        'buttons'=>array(
                                    'edit' => array
                                    (
                                       // 'label'=>'Send an e-mail to this user',
                                        'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
                                        'url'=>'Yii::app()->createUrl("product/update", array("id"=>$data->id))',
                                    ),
                                    'delete' => array
                                    (
                                       
                                    
                                        'url'=>'Yii::app()->createUrl("product/remove", array("id"=>$data->id))',
                                        'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                                        
                                    ),
                            ),

		),
	),
)); ?>

</div>