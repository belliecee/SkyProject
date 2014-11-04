<?php
/* @var $this ProjectController */
/* @var $model project */
/* @var $form CActiveForm */

  
?>


<script> 
    
    $(function(){
            $("#submenu").show();
            $("#createProject").hide();
           
            
           
             var tourl = '<?php echo $this->createUrl("project/saveajax"); ?>';
             var model_id = <?php echo CHtml::encode($model->id); ?>;
            $(".project").change(function(){
                //alert($(this).val());
                 $.ajax({
                            url:  tourl,
                            data: {id:model_id,textbox_id:$(this).attr('id'),textbox_value:$(this).val()},
                            type: 'get',
                            success:function(){
                                    // alert($(this).val());
                            },
                            error: function() { // if error occured
                                  alert("Error  occured.please try again");    
                             }
                     }); 
            });
            
           
            
    });
</script>

<div class="form" style="margin: 0px 0 0 50px;">
<br/><br/>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>

<!--	<p class="note">Fields with <span class="required">*</span> are required.</p> -->

	<?php echo $form->errorSummary($model); ?>

	<div class="row title2" style="font-size:18px;  color:rgb(206,101,54); border:none;">
		<?php //echo $form->labelEx($model,'projectNo'); ?>
		
                 <b><u>
                 Project No.&nbsp;&nbsp;
               
                <?php echo CHtml::encode($model->projectNo); ?>
		<?php echo $form->error($model,'projectNo'); ?>
                </u></b>
            
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<b>Kind of Machine</b> :
              <span class="row title2" style="font-size:15px;  color:rgb(206,101,54); border:none;">  
		<?php //echo $form->textField($model,'machineType',array('name'=>'machineType' ,'id'=>'machineType','class'=>'project','size'=>10,'maxlength'=>10)); ?>
		<?php //echo $form->dropDownList($model, 'machineType', CHtml::listData(machineType::model()->findAll(), 'id', 'type'),array('empty'=>'-- Select Type --','name'=>'machineType' ,'id'=>'machineType','class'=>'project','maxlength'=>10));?>
                <?php 
                                  
                        echo machineType::model()->findByPk($model->machineType)->type; 
                     
                ?>
              </span>
                      <?php //echo $form->error($model,'machineType'); ?>
	
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<b>Status</b> :
                <?php //$project_model = project::model()->findByPk($model->id);  ?>
		<span id="project_state" class="row title2" style="font-size:15px;  color:rgb(206,101,54); border:none;">
                    <?php 
// RULE EXCEPION                    
                    
                         if(($model->machineType == 3) && ($model->status == 8)){
                             $model->mcstatus = "Vendor sends Quotation back ";
                              echo "Vendor sends Quotation back "; 
                         }
                         // IN CASE, added quotation already
                         else if((($model->machineType == 1) && ($model->status == 5)) || (($model->machineType == 2) && ($model->status == 5))  ){
                              $allfollow = false;   
                               $quoh = quoh::model()->findAll("project_id=:project_id",array(":project_id"=>$model->id));
          
                                foreach($quoh as $_quoh){
                                    $follow = null;
                                     $follow = quoteFollow::model()->findAll("quoH_id=:quoH_id",array(":quoH_id"=>$_quoh->id));
                                     if($follow != null) {$allfollow = true;}
                                }
                                if($allfollow == true){echo "Follow Quotation";$model->mcstatus ="Follow Quotation";}
                                else{echo "Send Quotation to Customer"; $model->mcstatus ="Send Quotation to Customer";}
                         }
                          else if($model->status == 15){
                              
                              $model->mcstatus ="Payment";
                              echo "Payment"; 
                         }
                       
                         else if(($model->machineType == 2) && ($model->status == 13)){
                              $model->mcstatus ="Good finish";
                              echo "Good finish"; 
                         }
                         else if(($model->machineType == 2) && ($model->status == 12)){
                              $model->mcstatus ="Customer Deposit";
                             echo "Customer Deposit"; 
                         }
                         
                         else if( (($model->machineType == 1) && ($model->existInStock == 2) && ($model->status == 4)) || ($model->machineType == 2 &&$model->status == 4) ) {
                             $model->mcstatus ="Customer Enquiry";
                             echo "Customer Enquiry"; 
                         }
                         else if(($model->machineType == 1) && ($model->existInStock == 2) && ($model->status == 12)){
                             $model->mcstatus ="Customer Deposit"; 
                             echo "Customer Deposit"; 
                         }
                        
                        
                         else{    
                            $model->mcstatus = projectStatus::model()->findByPk($model->status)->status; 
                            echo projectStatus::model()->findByPk($model->status)->status; 
                         }
                         
                         $model->saveAttributes(array('mcstatus'));
                    
                    ?>
                <?php //echo $form->dropDownList($model, 'status', CHtml::listData(projectstatus::model()->findAll(), 'id', 'status'),array('empty'=>'-- Select Status --','name'=>'status' ,'id'=>'status','class'=>'project','maxlength'=>10));?>
		<?php //echo $form->error($model,'status'); ?>
        </span>        
	</div> 

<?php $this->endWidget(); ?>


<?php /* ********************* BEGIN OF SUBTITLE  **************************** */ ?> 
  
     <div id="submenu" style="display: none;">
           <ul class="project_menu">
              <?php
                    
                        echo '<li>'; 
                        if(($model->status >= 1 && $model->status <= 16) || $model->status == 18 )
                            echo CHtml::link('Enquiry',array('enquiry/index','project_id'=>$model->id)); 
                        else
                            echo '<span class="greylink">Enquiry</span>';
                        echo '</li>';
             
             ?>
             <?php if($model->machineType != 2 ){
                 
                    echo "<li>";  
                    if((($model->status >= 2 && $model->status <= 16) || $model->status == 18)){
                        if($model->existInStock == 1) {
                            echo CHtml::link('Vendor Process',array('vendorprocess/index','project_id'=>$model->id),array());
                        }else{
                            echo '<span class="greylink">Vendor Process</span>';
                        }
                    }
                    else{
                        echo '<span class="greylink">Vendor Process</span>';
                    }
                    echo "</li>";
                  }
             ?>
             <?php
                if($model->machineType != 3){
                  echo "<li>";
                  if(($model->status >= 4 && $model->status <= 16) || $model->status == 18 || $model->mcstatus == "Waiting")
                        echo CHtml::link('Quotation',array('quoh/index','project_id'=>$model->id));
                  else
                         echo '<span class="greylink">Quotation</span>';
                  echo "</li>";
                }
            ?>    
           
            <?php
            if($model->machineType != 3){
                  echo "<li>";
                  if(($model->status >= 6 && $model->status <= 16) || $model->status == 18)
                        echo CHtml::link('Purchase Order',array('poh/index','project_id'=>$model->id));
                  else
                        echo '<span class="greylink">Purchase Order</span>';
                  echo "</li>";
            }
            ?>
             <?php
             if($model->machineType != 3){
                  echo "<li>";
                  if($model->status >= 7 && $model->status <= 16)
                        echo CHtml::link('Deposit',array('deposit/index','project_id'=>$model->id));
                  else
                        echo '<span class="greylink">Deposit</span>';
                  echo "</li>";
             }
            ?>   
               
             <?php 
                      
                            if($model->machineType != 2){    
                                echo"<li>";
                                if /*(*/($model->status >= 8 && $model->status <= 16) //&&  $model->existInStock == 1)
                                    if($model->existInStock == 1) {
                                         echo CHtml::link('PO to Vendor',array('POtoVendor/index','project_id'=>$model->id));
                                    }else{
                                          if($model->status >= 8 && $model->machineType == 3) 
                                              echo CHtml::link('PO to Vendor',array('POtoVendor/index','project_id'=>$model->id));
                                          else
                                                echo '<span class="greylink">PO to Vendor</span>';
                                    }
                                    // echo CHtml::link('PO to Vendor',array('POtoVendor/index','project_id'=>$model->id));
                                else
                                     echo '<span class="greylink">PO to Vendor</span>';
                                echo "</li>";
                            }
                       
                      
                 ?>
                <?php
                        echo "<li>";
                     
                                if(($model->status >= 12 && $model->status <= 16) )
                                    echo CHtml::link('Shipping & Delivery',array('project/delivery','project_id'=>$model->id)); 
                                else
                                    echo '<span class="greylink">Shipping & Delivery</span>';
                        echo "</li>";
               ?>
               
                <?php
                 if($model->machineType != 3){
                        echo "<li>";
                        if($model->status >= 14 && $model->status <= 16)
                            echo CHtml::link('Payment',array('payment/index','project_id'=>$model->id)); 
                        else
                            echo '<span class="greylink">Payment</span>';
                        echo "</li>";
                 }
                ?>
            
               
              
           </ul>
     </div>

<?php /* *********************  END OF  SUBTITLE  **************************** */ ?> 

<div id="req_res"></div> 


</div><!-- form -->