

<?php   //$model = new project; ?>
<?php //echo $this->renderPartial('_form', array('model'=>$model)); ?>


<?php /* ********************* BEGIN OF SUBTITLE  **************************** */ ?> 
    <?php   $_project = project::model()->findByPk($project_id); ?>
        
   <span class="title1"> <?php   echo CHtml::encode($_project->name);  ?> </span>

    <div id="submenu">
           <ul class="project_menu">
                <li><?php echo CHtml::ajaxLink('Enquiry',array('enquiry/req'),array('update'=>'#req_res')); ?></li>
                <li><?php echo CHtml::ajaxLink('Vendor Process',array('vendor/req'),array('update'=>'#req_res')); ?></li>
                <li><?php echo CHtml::ajaxLink('Quotation',array('quoh/req'),array('update'=>'#req_res')); ?></li>
                <li><?php echo CHtml::ajaxLink('Purchase Order',array('poh/req'),array('update'=>'#req_res')); ?></li>
                <li><?php echo CHtml::ajaxLink('Payment',array('payment/req'),array('update'=>'#req_res')); ?></li>
                <li><?php echo CHtml::ajaxLink('Delivery',array('project/delivery_req'),array('update'=>'#req_res')); ?></li>
                
                <!--<a href="<?php echo $this->createUrl('task/index',array('project_id'=>$project_id));?>"><li>Task</li></a>-->
              
           </ul>
     </div>

<?php /* *********************  END OF  SUBTITLE  **************************** */ ?> 