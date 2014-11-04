<?php
/* @var $this DepositController */
/* @var $model deposit */
/* @var $form CActiveForm */
?>
<?php
    if($project_model->status  == 7)
        {
            $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->deposit_update == 0){
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
<script> 
    
    $(function(){
         
          $('#checkdeposit').change(function(){
              if($(this).is(':checked'))
                 $(".deposit_input").attr("disabled", true);
             else
                 $(".deposit_input").attr("disabled", false);
          });
             
     
          var current_deposit = <?php echo $model->isdeposit ?>;
          
          if(!current_deposit){
              current_deposit = 1;
          }
          
     });
  
</script>

<div class="title2" style="border-bottom: none;">Deposit </div>
<div class="bottomline"></div>
<br/><br/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deposit-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
                <b><?php echo "No Deposit  "; ?></b>&nbsp;
		<?php echo $form->checkBox($model,'isdeposit', array('id'=>'checkdeposit', 'value'=>2,'disabled'=>$dis, 'uncheckValue'=>1, 'style'=>'margin:0;padding:0;width:10px;')); ?>
		<?php echo $form->error($model,'isdeposit'); ?>
                
		
	</div>
         <?php 
                    
                        if($model->depositDate != null){
                            $model->depositDate = date("d/m/Y", strtotime($model->depositDate));
                        }else{
                            $model->depositDate = "";
                        }
                  
                ?>   
	<div class="row">
            
             <b>Deposit Amount</b> &nbsp;&nbsp;
                  <?php 
                    if($model->isdeposit == 2)
                         echo $form->textField($model,'depositAmount', array('class'=>'deposit_input numberFilter','disabled'=>true)); 
                    else
                        echo $form->textField($model,'depositAmount', array('class'=>'deposit_input numberFilter','disabled'=>$dis)); 
                     echo $form->error($model,'depositAmount'); 
                ?>
	        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Deposit Date</b> &nbsp;&nbsp;
                <?php 
                    if($model->isdeposit == 2)
                         echo $form->textField($model,'depositDate', array('class'=>'deposit_input','disabled'=>true)); 
                    else
                         echo $form->textField($model,'depositDate', array('class'=>'deposit_input','disabled'=>$dis)); 
                     echo $form->error($model,'depositDate'); 
                ?>
                
                
		
	</div>

 <!------------------------------------- Delivery within ------------------------------->
     
	<div class="row">
		
                <b>Customer delivery within &nbsp; </b>
		<?php echo $form->textField($model,'customerDeliveryWithin',array('class'=>' numberFilter fourlength', 'size'=>10,'maxlength'=>10,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'customerDeliveryWithin'); ?>
                <b>days</b>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    
		 <?php 
                    
                        if($model->customerDeliveryDate != null){
                            $model->customerDeliveryDate = date("d/m/Y", strtotime($model->customerDeliveryDate));
                        }else{
                            $model->customerDeliveryDate = "";
                        }
                  
                ?>   
                 <b>Due Delivery</b>
		<?php echo $form->textField($model,'customerDeliveryDate',array('size'=>20,'maxlength'=>10,'disabled'=>true)); ?>
		<?php echo $form->error($model,'customerDeliveryDate'); ?>
	</div>
 <!------------------------------------- Delivery within ------------------------------->    

	<div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>


	
         <div class="row buttons">
		<?php if($dis == false) echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'simple_button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="operation_footer" style="margin: 20px 0 0 0; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 50px 0 0;width:1020px;height:50px">
    
     
<?php

       if($project_model->machineType == 1){
            if($project_model->existInStock == 2){
                $move_forward = "delivery"; $next_status = 13;
                $move_backward = "poh"; $pre_status = 18;
            }
            else{
               $move_forward = "pOtoVendor"; $next_status = 8;
               $move_backward = "poh"; $pre_status = 18;
            }
           
        }
        else if($project_model->machineType == 2){
            $move_forward = "delivery"; $next_status = 12;
            $move_backward = "poh"; $pre_status = 18;
        }else
            
        {
            $move_forward = "pOtoVendor"; $next_status = 8;
            $move_backward = "vendorprocess"; $pre_status = 3;
        }    
      // ---------------------------------------------------------------
      
       
       $forward_direction = $move_forward; $forward_status = $next_status;
       $backward_direction = $move_backward; $backward_status = $pre_status;
 
 if($dis == false){
    echo CHtml::link("<div id='cancel' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Cancel</div>",array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=>"enquiry",'project_status'=>17));
     echo CHtml::link("<div id='delete' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Delete</div>",array("project/remove",'id'=>$project_model->id),array('confirm'=>'Are you sure to delete project?'));

      echo CHtml::link('<div id="reject" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;">Back</div>',array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=> $backward_direction,'project_status'=>$backward_status));
  
 
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
          var input1 = $("<input>").attr("type", "hidden").attr("name", "project_id").val("<?php echo $project_model->id; ?>");
          var input2 = $("<input>").attr("type", "hidden").attr("name", "redirect").val("<?php echo $forward_direction; ?>");
          var input3 = $("<input>").attr("type", "hidden").attr("name", "project_status").val("<?php echo $forward_status; ?>");
           
          var goforward = $("#deposit-form").append($(input1)).append($(input2)).append($(input3));
          goforward.submit();

    });

</script>