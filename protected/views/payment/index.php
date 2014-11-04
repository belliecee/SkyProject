<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>


<?php
        if(Yii::app()->user->isGuest){
             $this->redirect(Yii::app()->homeUrl);
         }
          else{
            $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->payment_read == 0){
                  $this->redirect(Yii::app()->homeUrl);
             }
            
         }

?>




<br/><br/>
<div class="other_header" style="margin-top:-32px;">
<?php  
     $project_model = project::model()->findByPk($project_id);
     //echo $project_model->status;
     $this->renderPartial('//project/_form',array('model'=>$project_model)); 

        //$form = "payment_form_$model->id";
        $table_view = "payment_table_view";
        $anypay = payment::model()->findAll("project_id=:project_id",array(":project_id"=>$project_model->id));
        $nopay = '0';
        if($anypay == null){$nopay = '1';}

?>
</div>
<?php
        if($project_model->status  >= 14 && $project_model->status  <= 15)
        {
            $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->payment_update == 0){
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

<div class="index_content" style=" margin: 0 0 20px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 70px 0 0;width:1000px; min-height: 500px;">

    
<form method="post" id="fake"></form>    
    
<!------------------ The Button for add an ITEM  ------------------->

<?php if($dis == false) {?> 
    <div id="addPayment" class="simple_button" style="float: right;"> Add Payment</div>
                               
<?php } ?>
<div class="title2" style="border-bottom: none;">Payment </div>
<div class="bottomline"></div>
    <!--------------------------- Start Table ----------------------------------------->

<br/><br/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deposit-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($deposit_model); ?>

	

	<div class="row">
             <?php 
                    
                        if($deposit_model->depositDate != null){
                            $deposit_model->depositDate = date("d/m/Y", strtotime($deposit_model->depositDate));
                        }else{
                            $deposit_model->depositDate = "";
                        }
                  
                ?>   
            
            &nbsp;&nbsp;&nbsp;<b>Deposit Date</b>&nbsp;&nbsp;
		<?php echo $form->textField($deposit_model,'depositDate',array('disabled'=>true)); ?>
		<?php echo $form->error($deposit_model,'depositDate'); ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<b>Deposit Amount</b>&nbsp;&nbsp;
		<span style="font-size:20px;"><?php 
                                $depoitamount = number_format($deposit_model->depositAmount,2);
                                echo "<b>".$depoitamount."  "."</b>"; 
                   ?>
                <span/>    
		
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php //echo CHtml::submitButton('Save',array('class'=>'simple_button','style'=>'float:right;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>    

 
<?php $payment_model = payment::model()->findAll("project_id=:project_id",  array(":project_id"=>$project_id));   ?>
     
    
<div id="payment_contain" class="ui-widget" style="margin:40px 0 0 50px;">

   
       
          <?php 
                   $total = 0;
                  if($deposit_model != null)
                       $total += $deposit_model->depositAmount;
          ?>
                <table id='payment_table_view' class="table_view1">
                  <thead>
                    <tr  class="table_view1_header">
                      <th class="table_ind" style="min-width:50px;">No.</th>
                      <th class="table_paymentDate" style="min-width:100px;">Date</th>
                      <th class="table_amount" style="min-width:100px;">Amount</th>
                      <th class="table_operation" style="max-width:50px; "> </th>
                    </tr>
                  </thead>
                  <tbody>
 <?php   if($payment_model != null){ ?>   
                   <div id="showPayment">     
<?php
                    $ind=0;
                    foreach($payment_model as $_model)
                    {
                                  

                        ++$ind;
                        $payment_row = "payment_$_model->id";

?>




                                <tr id='<?php echo $payment_row; ?>' class="table_tr_quod" >
                               <!--<input type="hidden" id='<?//php echo "hidden_$quod_row"; ?>' value='<?//php echo $detail->id;?>'> -->
                                <td><center><?php echo CHtml::encode($ind); ?>.</center></td>
                            
                            <?php 

                                                   if($_model->paymentDate != null){
                                                       $_model->paymentDate = date("d/m/Y", strtotime($_model->paymentDate));
                                                   }else{
                                                       $_model->paymentDate = "";
                                                   }

                             ?>   
                           
                                <td><center><?php echo CHtml::encode($_model->paymentDate); ?></center></td>
                                <?php 
                                        //$amountstr = number_format($_model->amount);
                                        $amountstr = number_format($_model->amount, 2);
                                         
                                ?>
                                <td data-amount="<?php echo $_model->amount; ?>"><center><?php echo $amountstr; ?></center></td>
                                 <?php $total += $_model->amount ?>
                               <td><center>
                                 <?php
                                 /*
                                   echo CHtml::ajaxLink('<div id="update_'.$payment_row.'"  class="simple_button" style="display: inline-block;">Delete</div>',
                                        array("payment/delete2",'id'=>$_model->id,'project_id'=>$_model->project_id),
                                        array(
                                                'update' => '#payment-contain'
                                          ));
                                 */
                                ?>
                                  <?php if($dis == false){ ?>

                                   &nbsp;<span id='<?php echo "update_$payment_row" ?>' class="update" data-id='<?php echo $_model->id; ?>' data-projectID='<?php echo $_model->project_id; ?>'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php  if($auth->payment_delete == 1){ ?><span id='<?php echo "delete_$payment_row" ?>' class="del" data-id='<?php echo $_model->id;?>' data-projectID='<?php echo $_model->project_id; ?>' >&nbsp;&nbsp;&nbsp;&nbsp;</span> <?php } ?>
                                  <?php } ?>
                                   </center>
                               </td>
                         
</tr>  


<?php
                    }
          }
     
?>                 
<tr>
                            <td><center><b>Total</b></center></td>
                            <td></td>
                            <?php $totalstr = number_format($total,2);   ?>
                            <td><center><b><?php echo $totalstr; ?></b></center></td>
                            <td></td>
     
 </tr>
 </div>
                  
                   
                        
                  </tbody>
                </table>
    </div>    
    
<div id="try"></div>
    
<script> 
    
    $(function(){
        
           
              
              var delurl = '<?php echo $this->createUrl("payment/delete2"); ?>';
           
           
            $(".del").one('click',function(){
                var click_row = $(this).parent().parent().attr('id');
                var theID = $(this).data('id');
                var theproject = <?php echo $project_id; ?> ; //$(this).data('projectID');
                var update_id;



               $.ajax({
                            url: delurl,
                            data: {id:theID,project_id:theproject},
                            type: 'get',
                            dataType: 'html',
                            success:function(data){
                               
                                $("#payment_contain").html(data);
                            },
                            error: function() { // if error occured
                                  alert("Error  occured.please try again ---");    
                             }
                     }); 
                                    
            });
          
           
            
    });
    
    
</script> 
    
    
<?php //$this->renderPartial('_form',array('model'=>$model,'project_id'=>$project_id,'quoh_id'=>$quoh_id)); ?>



</div>  <!--------------------------- End of Content ----------------------------------------->





  <!---------------- Dialog with Ajax ------------------------------ -->
  
   <style>

    fieldset { padding:0; border:0;margin-top:25px;}
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    /*
    .ui-dialog .ui-state-error { padding: .3em; }
    */
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
 
 <script>
  $(function() {
        
      var plusind=0;     
      var dialog_form =  "#dialog_form";
      var paymentDate = $("#paymentDate"),
      amount = $("#amount"),
      //detail = $("#detail"),
      //paymentedBy = $("#paymentedBy"),
      projectID = $("#quohID"),
      allFields = $( [] ).add( paymentDate ).add(amount),
      tips = $( ".validateTips" );
      var update_id; var payment_id;
      
  
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
   
    $("#dialog_form").dialog({
      autoOpen: false,
      height: 250,
      width: 350,
      modal: true,
      buttons: {
        "Save": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          //bValid = bValid && checkLength( paymentDate, "paymentDate", 3, 16 );
          //bValid = bValid && checkLength( contact, "contact", 6, 80 );
          //bValid = bValid && checkLength( detail, "detail", 5, 16 );
 
          //bValid = bValid && checkRegexp( paymentDate, /^([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
          // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
          //bValid = bValid && checkRegexp( contact, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
          //bValid = bValid && checkRegexp( detail, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
           $('#payment-contain').css({'background-color':'red'});
            if (paymentDate.val()!= "" && amount.val()!= "") {
                    if($("#opt0").val() == 0){ 
                        var tourl = '<?php echo $this->createUrl("payment/create"); ?>';
                        payment_id = 0;
                    }
                    else{
                        var tourl = '<?php echo $this->createUrl("payment/update"); ?>';
                        payment_id = $("#update_id").val();
                    }
                   
                   
                  
                   
                    var projectID = <?php echo $project_id; ?>;
                    var paymentDateValue = paymentDate.val();
                    var amountValue= amount.val();
                    var nopay = '<?php echo $nopay; ?>';
                 
                  
                        $.ajax({
                                      url:  tourl,
                                      data: {paymentDate:paymentDateValue,amount:amountValue,project_id:projectID,payment_id:payment_id},
                                      type: 'get',
                                      dataType: 'html',
                                      success:function(data){
                                                //alert(paymentDateValue);
                                                $("#fake").submit();
                                    },

                                      error: function() { // if error occured
                                                               alert("Error: ");    
                                     }
                             });
                            
                   
                        
                  

            $( this ).dialog( "close" );
          }
          else
          {
                  var msg = "โปรดใส่ข้อมูลดังรายการข้างล่าง อย่าเว้นว่างไว้ \n\n";
                     paymentDate.val() == ''? msg = msg  + "● Payment Date\n": msg = msg ;
                     amount.val() == ''? msg = msg  + "● Payment Amount\n" : msg = msg;
                    
                     alert(msg);
          }
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 

 
    
    $('#addPayment').click(function() { 
         $("#opt0").val('0');
        $("#dialog_form").dialog( "open" );
       
               
      });
      
    $('.update').click(function(){
      
         update_id = $(this).data("id");
         var row_id = "#payment_"+update_id;

       
         $("#paymentDate").val($(row_id+" td:nth-child(2)").text());
         $("#amount").val($(row_id+" td:nth-child(3)").data('amount'));
         $("#opt0").val('1');
         $('#update_id').val(update_id);
      
          $("#dialog_form").dialog("open");
        
         
    });
   
          
  });
  </script>
  
  

  
<?php    
        $payment_form = "payment_form";
?>  
  
 <div id='dialog_form'  title="Add New Item">
  <p class="validateTips"></p>
 
  <?php $form=$this->beginWidget('CActiveForm', 
        array(
            'id'=>$payment_form,
            'enableAjaxValidation'=>false,
            'htmlOptions' => array("class"=>"dialog_form"),
      )); 
   ?>
  
<?php $payment_model = new payment; ?> 
  <fieldset style="margin-left: -20px;">
      <?php echo $form->errorSummary($payment_model); ?>
                <?php
                
                /*
                    
                        if($model->paymentDate != null){
                            $model->paymentDate = date("d/m/Y", strtotime($model->paymentDate));
                        }else{
                            $model->paymentDate = "";
                        }
                  */
                ?>   
               <input type="hidden" id="opt0"/>
               <input type="hidden" id='update_id' />
              
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Date</span>&nbsp;&nbsp;
                
                <input type="text" name='paymentDate' id='paymentDate' class="text ui-widget-content ui-corner-all" />
                <br/><br/>
                
                &nbsp;&nbsp;&nbsp;<span>Amount</span>&nbsp;
                <input type="text" name='amount' id='amount' class="text ui-widget-content ui-corner-all numberFilter" />
                <br/><br/>  
          
              
    
 
 </fieldset>
 <?php $this->endWidget(); ?>
</div>


  <!---------------- OPERATION FOOTER --------------------------------------------------->


  


<div class="operation_footer" style="margin: 10px 0 50px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 50px 0 0;width:1000px;height:50px">
     
      <?php
       echo CHtml::link("<div id='cancel' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Cancel</div>",array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=>"enquiry",'project_status'=>17));
     echo CHtml::link("<div id='delete' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Delete</div>",array("project/remove",'id'=>$project_model->id),array('confirm'=>'Are you sure to delete project?'));

      
          if($project_model->machineType == 1){
            $move_forward = "payment"; $next_status = 16;
            $move_backward = "delivery"; $pre_status = 13;
        }
        else if($project_model->machineType == 2){
            $move_forward = "payment"; $next_status = 16;
           $move_backward = "delivery"; $pre_status = 13;
        }else 
        {
            $move_forward = "delivery"; $next_status = 16;
            $move_backward = "delivery"; $pre_status = 12;
        }    
      
           
   /* ******************************************************  */   
     /*  
       if($project_model->status == 14){
         $forward_direction = "payment"; $forward_status = 15;
         $backward_direction = $move_backward; $backward_status = $pre_status;
       }else 
   */        
       if($project_model->status == 15){
         $forward_direction = "payment"; $forward_status = 16;
         $backward_direction = $move_backward; $backward_status = $pre_status;
       }else if($project_model->status == 16){
         $forward_direction = $move_forward; $forward_status = $next_status;
         $backward_direction = "payment"; $backward_status = 15;
       }
       
       else{
         $forward_direction = "payment"; $forward_status = 16;
         $backward_direction = "delivery"; $backward_status = 15;
       }
 

      echo CHtml::link('<div id="reject" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;"> Back</div>',array("project/plusstatus",'project_id'=>$project_id,'redirect'=> $backward_direction,'project_status'=>$backward_status));
  
      echo CHtml::link('<div id="submit" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;">Submit</div>',array("project/plusstatus",'project_id'=>$project_id,'redirect'=> $forward_direction,'project_status'=>$forward_status));
?>    
      
</div>


<!---------------------------------        -------------------------------------------->