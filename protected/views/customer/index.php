<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>


<!------------------ The Button for add an ITEM  ------------------->



<div class="title2" style="border-bottom: none;">Customer</div>
<div class="bottomline"></div>
<!--------------------------- Start Table ----------------------------------------->

<br/><br/>

<div id="viewdetail">    
<?php
    $this->renderPartial('admin',array('model'=>$model)); 
?>
</div> 
