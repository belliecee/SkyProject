<?php
/* @var $this VendorprocessController */
/* @var $model vendorprocess */
/* @var $form CActiveForm */
?>

<?php
        if($project_model->status  == 2 || $project_model->status  == 3)
        {
            $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->vendorprocess_update == 0){
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
          
           
     
          function ajaxautocomplete(idname,table){
              var availableTags =   [""];
              $.ajax({
                    url: '<?php echo $this->createUrl('vendorprocess/autocomplete'); ?>',
                    dataType: "json",
                    data: { inputtext:idname.val(),table:table
                    },
                    success: function (response) {
                        availableTags = response.res;
                        idname.autocomplete({
                                source: availableTags
                        }); 
  
                    }
              });
              
          }
           ajaxautocomplete($("#vendor"),"vendor");
           
    });
</script>

<div class="title2" style="border-bottom: none;">Vendor Process </div>
<div class="bottomline"></div>
<br/><br/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vendorprocess-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	
<?php if($project_model->machineType != 3){ ?>
        <div class="row">
             <?php
                         if($model->vendor_id != null){
                             if(vendor::model()->findByPk($model->vendor_id) != null && vendor::model()->findByPk($model->vendor_id) != ""){
                                  $model->vendorstr = vendor::model()->findByPk($model->vendor_id)->name;
                             }
                         }
                ?>
		<b>Vendor</b><br/>
                
		<?php 
                        if($project_model->status  == 2){
                            echo $form->textField($model,'vendorstr',array('id'=>'vendor','size'=>20,'maxlength'=>64,'disabled'=>$dis));
                        }else{
                              echo $form->textField($model,'vendorstr',array('id'=>'vendor','size'=>20,'maxlength'=>64,'disabled'=>true));
                        }
                 ?>
		<?php echo $form->error($model,'vendorstr'); ?>
	</div>
 <?php }  ?>       

	<div class="row">
          
            
             <?php 
                    
                        if($model->enquiryToVendorDate != null){
                            $model->enquiryToVendorDate = date("d/m/Y", strtotime($model->enquiryToVendorDate));
                        }else{
                            $model->enquiryToVendorDate = "";
                        }
                  
            ?> 
                
		<?php echo $form->labelEx($model,'enquiryToVendorDate'); ?>
            
		<?php
                       if($project_model->status  == 2){
                           echo $form->textField($model,'enquiryToVendorDate',array('id'=>'enquiryToVendorDate','disabled'=>$dis)); 
                       }else{
                            echo $form->textField($model,'enquiryToVendorDate',array('id'=>'enquiryToVendorDate','disabled'=>true)); 
                       }
                ?>
		<?php echo $form->error($model,'enquiryToVendorDate'); ?>
	</div>

	<div class="row">
             <?php 
                    
                        if($model->vendorQuotationDate != null){
                            $model->vendorQuotationDate = date("d/m/Y", strtotime($model->vendorQuotationDate));
                        }else{
                            $model->vendorQuotationDate = "";
                        }
                  
                ?>   
		<?php echo $form->labelEx($model,'vendorQuotationDate'); ?>
		<?php 
                        if($project_model->status  == 3){
                           echo $form->textField($model,'vendorQuotationDate',array('id'=>'vendorQuotationDate','disabled'=>$dis));
                        }
                        else{
                           echo $form->textField($model,'vendorQuotationDate',array('id'=>'vendorQuotationDate','disabled'=>true)); 
                        }
               ?>
		<?php echo $form->error($model,'vendorQuotationDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php 
                         if($project_model->status  == 3){
                             echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50, 'disabled'=>$dis)); 
                         }
                        else{
                            echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50, 'disabled'=>true)); 
                        }
                ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>
<?php
/*
	<div class="row">
		<?php echo $form->labelEx($model,'update_on'); ?>
		<?php echo $form->textField($model,'update_on'); ?>
		<?php echo $form->error($model,'update_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'update_by'); ?>
		<?php echo $form->textField($model,'update_by',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'update_by'); ?>
	</div>
*/
?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'simple_button','disabled'=>$dis)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->



<div class="operation_footer" style="margin: 10px 0 0 0; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 50px 0 0;width:1020px;height:50px">
    
<?php




    if($project_model->machineType == 1){
            $move_forward = "quoh"; $next_status = 4;
            $move_backward = "enquiry"; $pre_status = 1;
        }
        else if($project_model->machineType == 2){
            $move_forward = "quoh"; $next_status = 4;
            $move_backward = "enquiry"; $pre_status = 1;
        }else
            
        {
            $move_forward = "pOtovendor"; $next_status = 8;
            $move_backward = "enquiry"; $pre_status = 1;
        }    




       
 
        if($project_model->status == 2){
         $forward_direction = "vendorprocess"; $forward_status = 3;
         $backward_direction = $move_backward; $backward_status = $pre_status;
       }else if($project_model->status == 3){
         $forward_direction = $move_forward; $forward_status = $next_status;
         $backward_direction = "vendorprocess"; $backward_status = 2;
         
       }else{ 
            $forward_direction = "quoh"; $forward_status = 5;
         $backward_direction = "enquiry"; $backward_status = 1;
       }
       
   /* ******************************************************  */    
       if($dis == false){
             echo CHtml::link("<div id='cancel' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Cancel</div>",array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=>"enquiry",'project_status'=>17));
             echo CHtml::link("<div id='delete' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Delete</div>",array("project/remove",'id'=>$project_model->id),array('confirm'=>'Are you sure to delete project?'));
            echo CHtml::link('<div id="back" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;"> Back</div>',array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=> $backward_direction,'project_status'=>$backward_status));
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
         
          
          
          var status = <?php echo $project_model->status ?>;
          
          if(status == 2){
          
                if($("#vendor").val() == '' || $("#enquiryToVendorDate").val() == '')
                {

                     var msg = "โปรดใส่ข้อมูลดังรายการข้างล่าง อย่าเว้นว่างไว้ \n\n";
                     $("#vendor").val() == ''? msg = msg  + "● Vendor\n": msg = msg ;
                     $("#enquiryToVendorDate").val() == ''? msg = msg  + "● enquiryToVendorDate\n" : msg = msg;
                   
                     alert(msg);
                }
                else{
                     var input1 = $("<input>").attr("type", "hidden").attr("name", "project_id").val("<?php echo $project_model->id; ?>");
                    var input2 = $("<input>").attr("type", "hidden").attr("name", "redirect").val("<?php echo $forward_direction; ?>");
                    var input3 = $("<input>").attr("type", "hidden").attr("name", "project_status").val("<?php echo $forward_status; ?>");

                    var goforward = $("#vendorprocess-form").append($(input1)).append($(input2)).append($(input3));
                     goforward.submit();
                }
          }else if(status == 3){
              
                if( $("#vendorQuotationDate").val() == '' )
                {

                     var msg = "โปรดใส่ข้อมูลดังรายการข้างล่าง อย่าเว้นว่างไว้ \n\n";
                      $("#vendor").val() == ''? msg = msg  + "● Vendor": msg = msg ;
                     $("#enquiryToVendorDate").val() == ''? msg = msg  + "● enquiryToVendorDate\n" : msg = msg;
                     $("#vendorQuotationDate").val() == ''? msg = msg  + "● vendorQuotationDate\n" : msg = msg;
                     alert(msg);
                }
                else{
                     var input1 = $("<input>").attr("type", "hidden").attr("name", "project_id").val("<?php echo $project_model->id; ?>");
                    var input2 = $("<input>").attr("type", "hidden").attr("name", "redirect").val("<?php echo $forward_direction; ?>");
                    var input3 = $("<input>").attr("type", "hidden").attr("name", "project_status").val("<?php echo $forward_status; ?>");

                    var goforward = $("#vendorprocess-form").append($(input1)).append($(input2)).append($(input3));
                     goforward.submit();
                }
              
              
          }
           
         
    });

</script>
