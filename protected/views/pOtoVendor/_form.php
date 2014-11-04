<?php
/* @var $this PotovendorController */
/* @var $model potovendor */
/* @var $form CActiveForm */
?>
<?php
    if($project_model->status  >= 8 && $project_model->status  <= 10)
        {
             $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->potovendor_update == 0){
                  $dis = true;
             }
             else
                  $dis = false;
        }
        else
        {
            $dis = true;
        }
?>


<div class="title2" style="border-bottom: none;">PO to Vendor </div>
<div class="bottomline"></div>
<br/><br/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'potovendor-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
            
            <b>PO No.</b> &nbsp;
		<?php echo $form->textField($model,'POtoVendotNo',array('id'=>'POtoVendotNo','size'=>10,'maxlength'=>64,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'POtoVendotNo'); ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php 
                    
                        if($model->orderDate != null){
                            $model->orderDate = date("d/m/Y", strtotime($model->orderDate));
                        }else{
                            $model->orderDate = "";
                        }
                  
          ?>
         
		<b>Order Date :</b>&nbsp;
		<?php echo $form->textField($model,'orderDate',array('id'=>'orderDate','disabled'=>$dis)); ?>
		<?php echo $form->error($model,'orderDate'); ?>
	</div>

	

	<div class="row">
           
                <b>Vendor Delivery Within :</b>&nbsp;
		
		<?php echo $form->textField($model,'vendorDeliveryWithin',array('id'=>'vendorDeliveryWithin','class'=>'fourlength numberFilter','size'=>5,'maxlength'=>64,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'vendorDeliveryWithin'); ?>
                 &nbsp;<b>days </b>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <?php 
                    
                        if($model->vendorDeliveryDate != null){
                            $model->vendorDeliveryDate = date("d/m/Y", strtotime($model->vendorDeliveryDate));
                        }else{
                            $model->vendorDeliveryDate = "";
                        }
                  
          ?>
         
		 <b>Vendor Delivery Date :</b>&nbsp;
		<?php echo $form->textField($model,'vendorDeliveryDate',array('disabled'=>true)); ?>
		<?php echo $form->error($model,'vendorDeliveryDate'); ?>
	</div>
<br/>
	<div class="row">
		<b><?php echo $form->labelEx($model,'remark'); ?></b>
		<?php echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>

	<div class="row buttons">
		<?php if($dis == false) echo CHtml::submitButton('Save',array('class'=>'simple_button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<div class="operation_footer" style="margin: 20px 0 0 0; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 50px 0 0;width:1020px;height:50px">
     
     <?php
     
     
       
        
       if($project_model->machineType == 1){
            $move_forward = "delivery"; $next_status = 12;
            $move_backward = "deposit"; $pre_status = 7;
        }
        else if($project_model->machineType == 2){
            $move_forward = "delivery"; $next_status = 12;
           $move_backward = "deposit"; $pre_status = 7;
        }else
        {        if($project_model->existInStock == 2){
                    $move_forward = "delivery"; $next_status = 12;
                    $move_backward = "enquiry"; $pre_status = 1;
                }else{
                    $move_forward = "delivery"; $next_status = 12;
                    $move_backward = "vendorprocess"; $pre_status = 3;
                }
        }    
      
       //$backward_direction = "enquiry"; $backward_status = 1;
        
      
     
       
   /* ******************************************************  */    
     /*  
       if($project_model->status == 7){
         $forward_direction = "pOtoVendor"; $forward_status = 8;
         $backward_direction = $move_backward; $backward_status = $pre_status;
       }else */ 
        if($project_model->status == 8){
         $forward_direction = $move_forward; $forward_status = $next_status;
         $backward_direction =  $move_backward ; $backward_status = $pre_status;
        }
 /*       
        else if($project_model->status == 9){
         $forward_direction = "pOtoVendor"; $forward_status = 10;
         $backward_direction = "pOtoVendor"; $backward_status = 8;
       }else if($project_model->status == 10){
         $forward_direction = $move_forward; $forward_status = $next_status;
         $backward_direction = "pOtoVendor"; $backward_status = 9;
       }
  * 
  */
       else{
         $forward_direction = "delivery"; $forward_status = 12;
         $backward_direction = "pOtoVendor"; $backward_status = 7;
       }
if($dis == false){
      echo CHtml::link("<div id='cancel' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Cancel</div>",array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=>"enquiry",'project_status'=>17));
     echo CHtml::link("<div id='delete' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Delete</div>",array("project/remove",'id'=>$project_model->id),array('confirm'=>'Are you sure to delete project?'));

      echo CHtml::link('<div id="reject" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;"> Back</div>',array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=> $backward_direction,'project_status'=>$backward_status));
  
 
      echo /*CHtml::link(*/'<div id="submit" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;">Submit</div>';//,array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=> $forward_direction,'project_status'=>$forward_status));
  }
?>    
      
</div>
<form id="goforward" name="gogo">
        <input type="hidden" id="project_id" name="project_id" value="<?php echo $project_model->id; ?>" >
        <input type="hidden" id="redirect"  name="redirect" value="<?php echo $forward_direction; ?>">
        <input type="hidden" id="project_status"  name="project_status" value="<?php echo $forward_status; ?>">
</form>    



<script> 
    
    $("#submit").click(function() {
         
          
          
          if($("#POtoVendotNo").val() == '' || $("#orderDate").val() == '' || $("#vendorDeliveryWithin").val() == '' )
          {
              
               var msg = "โปรดใส่ข้อมูลดังรายการข้างล่าง อย่าเว้นว่างไว้ \n\n";
               $("#POtoVendotNo").val() == ''? msg = msg  + "● PO No.\n": msg = msg ;
               $("#orderDate").val() == ''? msg = msg  + "● Order Date\n" : msg = msg;
               $("#vendorDeliveryWithin").val() == ''? msg = msg  + "● Vendor Delivery Within\n": msg = msg ;
             
               alert(msg);
          }
          else{
               var input1 = $("<input>").attr("type", "hidden").attr("name", "project_id").val("<?php echo $project_model->id; ?>");
                var input2 = $("<input>").attr("type", "hidden").attr("name", "redirect").val("<?php echo $forward_direction; ?>");
                var input3 = $("<input>").attr("type", "hidden").attr("name", "project_status").val("<?php echo $forward_status; ?>");

                var goforward = $("#potovendor-form").append($(input1)).append($(input2)).append($(input3));
                goforward.submit();
          }

    });
    
    

</script>
  