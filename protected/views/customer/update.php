
<?php
/* @var $this CustomerController */
/* @var $model customer */


?>
<!------------------ The Button for add an ITEM  ------------------->



<div class="title2" style="border-bottom: none;">Update Customer</div>
<div class="bottomline"></div>
<!--------------------------- Start Table ----------------------------------------->
<br/><br/>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>