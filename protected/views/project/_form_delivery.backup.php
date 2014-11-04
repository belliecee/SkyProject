
<div class="title2" style="border-bottom: none;">Finished Date </div>
<div class="bottomline"></div>
<br/><br/>

  
<?php
        if(Yii::app()->user->isGuest){
             $this->redirect(Yii::app()->homeUrl);
         }
          else{
            $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->delivery_read == 0){
                  $this->redirect(Yii::app()->homeUrl);
             }
            
         }

?>
  
    <?php
        if(($model->status  >= 12 && $model->status  <= 13) || ($model->status  == 16 && $model->machineType == 3))
        {
            $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->delivery_update == 0){
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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'project-form',
        'action'=>Yii::app()->createUrl("project/delivery",array('project_id'=>$model->id,)),
	'enableAjaxValidation'=>false,
)); ?>

<!--	<p class="note">Fields with <span class="required">*</span> are required.</p> -->

	<?php echo $form->errorSummary($model); ?>
<br/>
        <div class="row">
             <?php 
                    
                        if($model->goodsFinishedDate != null){
                            $model->goodsFinishedDate = date("d/m/Y", strtotime($model->goodsFinishedDate));
                        }else{
                            $model->goodsFinishedDate = "";
                        }
                  
                ?>  
           
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php 
                  if($model->machineType == 2){
                      echo "<b>Goods finished date &nbsp;&nbsp;</b>";
                  }else{
                      echo "<b>Goods arrive office &nbsp;&nbsp;</b>";
                  }
                
                
            ?>
		
                <?php 
                      if(($model->status  == 16 && $model->machineType == 3) || ($model->status  > 12)) 
                         echo $form->textField($model,'goodsFinishedDate',array('id'=>'goodsFinishedDate','size'=>10,'maxlength'=>10,'disabled'=>true));
                      else 
                          echo $form->textField($model,'goodsFinishedDate',array('id'=>'goodsFinishedDate','size'=>10,'maxlength'=>10,'disabled'=>$dis));
                ?>
		<?php echo $form->error($model,'goodsFinishedDate'); ?>
        </div>   
       <br/><br/>
       
    <?php if($model->machineType != 3){ ?>
    
<div class="title2" style="border-bottom: none;margin-left:0;">Delivery to Customer </div>
<div class="bottomline" style="margin-left:0;"></div>
<br/><br/>
<br/><br/>
        <div class="row">
             <?php 
                    
                        if($model->deliveryDate != null){
                            $model->deliveryDate = date("d/m/Y", strtotime($model->deliveryDate));
                        }else{
                            $model->deliveryDate = "";
                        }
                  
                ?>  
            
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>Delivery to Customer on &nbsp;&nbsp;</b>
                    <?php 
                              if($model->status  == 13) 
                                   echo $form->textField($model,'deliveryDate',array('id'=>'deliveryDate','size'=>10,'maxlength'=>10,'disabled'=>$dis)); 
                               else
                                   echo $form->textField($model,'deliveryDate',array('id'=>'deliveryDate','size'=>10,'maxlength'=>10,'disabled'=>true)); 
                              ?>
                   
                    <?php echo $form->error($model,'deliveryDate'); ?>
                
	 </div>   
             
   <?php } ?>  
	      <br/><br/>  
        <div class="row buttons">
		<?php if($dis == false) echo CHtml::submitButton('Save',array('class'=>'simple_button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
   


<div class="operation_footer" style="margin: 20px 0 0 0; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 50px 0 0;width:1020px;height:50px">
    
     <?php
       
     
       if($model->machineType == 1){
            if($model->existInStock == 2){
               
                $move_forward = "payment"; $next_status = 14;
                $move_backward = "deposit"; $pre_status = 7;
            }
            else{
                $move_forward = "payment"; $next_status = 14;
                $move_backward = "pOtoVendor"; $pre_status = 8;
            }
          
        }
        else if($model->machineType == 2){
            $move_forward = "payment"; $next_status = 14;
           $move_backward = "deposit"; $pre_status = 7;
        }else
        {
         
            
                 $move_forward = "delivery"; $next_status = 16;
                 $move_backward = "pOtoVendor"; $pre_status = 8;
            
        }    
      
           
   /* ******************************************************  */    
     
     /*
       if($model->status == 11){
         $forward_direction = "delivery"; $forward_status = 12;
         $backward_direction = $move_backward; $backward_status = $pre_status;
       }else
      * 
      */ 
       if($model->status == 12){
         if($model->machineType == 3){
            $forward_direction = $move_forward; $forward_status = $next_status;
         }
         else{
            $forward_direction = "delivery"; $forward_status = 13;
         }
         $backward_direction = $move_backward; $backward_status = $pre_status;
       }else if($model->status == 13){
         $forward_direction = $move_forward; $forward_status = $next_status;
         $backward_direction = "delivery"; $backward_status = 12;
    
        }else if($model->status == 16){
         $forward_direction = "delivery"; $forward_status = 16;
         $backward_direction = "delivery"; $backward_status = 12;
       }
       
       else{
         $forward_direction = "payment"; $forward_status = 13;
         $backward_direction = "delivery"; $backward_status = 12;
       }
 
if($dis == false){
      echo CHtml::link("<div id='cancel' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Cancel</div>",array("project/plusstatus",'project_id'=>$model->id,'redirect'=>"enquiry",'project_status'=>17));
      echo CHtml::link("<div id='delete' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Delete</div>",array("project/remove",'id'=>$model->id),array('confirm'=>'Are you sure to delete project?'));

      echo CHtml::link('<div id="reject" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;"> Back</div>',array("project/plusstatus",'project_id'=>$model->id,'redirect'=> $backward_direction,'project_status'=>$backward_status));
  
      if($model->status !=16 || $model->machineType!=3)
        echo /*CHtml::link(*/'<div id="submit" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;">Submit</div>';//,array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=> $forward_direction,'project_status'=>$forward_status));
  }
?>    
      
</div>
<form id="goforward" name="gogo">
        <input type="hidden" id="project_id" name="project_id" value="<?php echo $model->id; ?>" >
        <input type="hidden" id="redirect"  name="redirect" value="<?php echo $forward_direction; ?>">
        <input type="hidden" id="project_status"  name="project_status" value="<?php echo $forward_status; ?>">
</form>    



<script> 
    
    $("#submit").click(function() {
         
          
          
          var status = <?php echo $model->status ?>;
          
          if(status == 12){
          
                if($("#goodsFinishedDate").val() == '' )
                {

                     var msg = "โปรดใส่ข้อมูลดังรายการข้างล่าง อย่าเว้นว่างไว้ \n\n";
                     $("#goodsFinishedDate").val() == ''? msg = msg  + "● Goods Finished Date\n": msg = msg ;
                   
                   
                     alert(msg);
                }
                else{
                    var input1 = $("<input>").attr("type", "hidden").attr("name", "project_id").val("<?php echo $model->id; ?>");
                    var input2 = $("<input>").attr("type", "hidden").attr("name", "redirect").val("<?php echo $forward_direction; ?>");
                    var input3 = $("<input>").attr("type", "hidden").attr("name", "project_status").val("<?php echo $forward_status; ?>");
                    var input4 = $("<input>").attr("type", "hidden").attr("name", "goodsFinishedDate").val($('#goodsFinishedDate').val()); 
                    var input5 = $("<input>").attr("type", "hidden").attr("name", "deliveryDate").val($('#deliveryDate').val()); 
                    var goforward = $("#project-form").append($(input1)).append($(input2)).append($(input3)).append($(input4)).append($(input5));
                    goforward.submit();
                }
          }else if(status == 13){
              
                if( $("#deliveryDate").val() == '' )
                {

                     var msg = "โปรดใส่ข้อมูลดังรายการข้างล่าง อย่าเว้นว่างไว้ \n\n";
                      $("#deliveryDate").val() == ''? msg = msg  + "● Delivery Date": msg = msg ;
                   
                     alert(msg);
                }
                else{
                      var input1 = $("<input>").attr("type", "hidden").attr("name", "project_id").val("<?php echo $model->id; ?>");
                    var input2 = $("<input>").attr("type", "hidden").attr("name", "redirect").val("<?php echo $forward_direction; ?>");
                    var input3 = $("<input>").attr("type", "hidden").attr("name", "project_status").val("<?php echo $forward_status; ?>");
                    var input4 = $("<input>").attr("type", "hidden").attr("name", "goodsFinishedDate").val($('#goodsFinishedDate').val()); 
                    var input5 = $("<input>").attr("type", "hidden").attr("name", "deliveryDate").val($('#deliveryDate').val()); 
                    var goforward = $("#project-form").append($(input1)).append($(input2)).append($(input3)).append($(input4)).append($(input5));
                    goforward.submit();
                }
              
              
          }
           
         
    });

</script>
