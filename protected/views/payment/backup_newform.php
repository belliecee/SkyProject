<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>

<?php
    
             $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->poh_update == 0){
                  $dis = true;
             }
             else
                  $dis = false;
      
?>

<div id="payment_view">
<?php $payment_model = payment::model()->findAll("project_id=:project_id",  array(":project_id"=>$project_id));   ?>
<?php //$deposit_model = deposit::model()->findAll("project_id=:project_id",  array(":project_id"=>$project_id));   ?>
    <?php 
                $criteria = new CDbCriteria();
                $criteria->condition = "project_id=:project_id";
                $criteria->params = array(":project_id"=>$project_id);
		$deposit_model = deposit::model()->find($criteria);
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
                                <td><center><?php echo CHtml::encode($_model->amount); ?></center></td>
                                <?php $total += $_model->amount ?>
                               
                               <td>
                                
                               <center>
                                   &nbsp;<span id='<?php echo "update_$payment_row" ?>' class="update" data-id='<?php echo $_model->id; ?>'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php  if($auth->payment_delete == 1){ ?><span id='<?php echo "delete_$payment_row" ?>' class="del" data-id='<?php echo $_model->id;?>'  >&nbsp;&nbsp;&nbsp;&nbsp;</span><?php } ?>
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
                            <td><center><b><?php echo $total; ?></b></center></td>
                            <td></td>
     
 </tr>
                   
                        
                  </tbody>
                </table>

</div>

 <script>
  $(function() {
        
      var plusind=0;     
      var dialog_form =  "#new_dialog_form";
      var paymentDate = $("#new_paymentDate"),
      amount = $("#new_amount"),
      //detail = $("#detail"),
      //paymentedBy = $("#paymentedBy"),
     // projectID = $("#quohID"),
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
   
    $("#new_dialog_form").dialog({
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
 
          if (paymentDate.val()!= "" && amount.val()!= "") {
                    
                    
                    if($("#opt1").val() == 0){ 
                        var tourl = '<?php echo $this->createUrl("payment/create"); ?>';
                        payment_id = 0;
                    }
                    else{
                        var tourl = '<?php echo $this->createUrl("payment/update"); ?>';
                        payment_id = $("#new_update_id").val();
                    }
                   
                   
                  

                    var projectID = <?php echo $project_id; ?>;
                    var paymentDateValue = paymentDate.val();
                    var amountValue= amount.val();
                  
                    $.ajax({
                    url:  tourl,
                    data: {paymentDate:paymentDateValue,amount:amountValue,project_id:projectID,payment_id:payment_id},
                    type: 'get',
                    dataType: 'html',
                    success:function(data){
                             
                              $("#payment_view").html(data);
     
                  },
                 
                 error: function() { // if error occured
                                          alert("Error occured ");    
               }
            });

            $( this ).dialog( "close" );
          } else
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
 

/*
    $('#addPayment').click(function() { 
         $("#opt1").val('0');
        $("#new_dialog_form").dialog( "open" );
       
               
      });
*/      
    $('.update').click(function(){
      
         update_id = $(this).data("id");
         var row_id = "#payment_"+update_id;

       
         $("#new_paymentDate").val($(row_id+" td:nth-child(2)").text());
         $("#new_amount").val($(row_id+" td:nth-child(3)").text());
         $("#opt1").val('1');
         $('#new_update_id').val(update_id);
      
          $("#new_dialog_form").dialog("open");
        
         
    });
   
          
  });
</script>
  
  


<script> 
    
    $(function(){
        
           
              
              var delurl = '<?php echo $this->createUrl("payment/delete2"); ?>';
           
           
            $(".del").one('click',function(){
                var click_row = $(this).parent().parent().attr('id');
                var theID = $(this).data('id');
                var theproject =  <?php echo $project_id; ?> ; //$(this).data('projectID');
                 



               $.ajax({
                            url: delurl,
                            data: {id:theID,project_id:theproject},
                            type: 'get',
                            dataType: 'html',
                            success:function(data){
                                $("#payment_view").html(data);
                            },
                            error: function() { // if error occured
                                  alert("Error  occured.please try again");    
                             }
                     }); 
                                    
            });
          
           
            
    });
    
    
</script> 


  
<?php    
        $new_payment_form = "new_payment_form";
?>  
  
 <div id='new_dialog_form'  title="Add New Item">
  <p class="validateTips"></p>
 
  <?php $form=$this->beginWidget('CActiveForm', 
        array(
            'id'=>$new_payment_form,
            'enableAjaxValidation'=>false,
            'htmlOptions' => array("class"=>"dialog_form"),
      )); 
   ?>
  

  <fieldset style="margin-left: -20px;">
      <?php echo $form->errorSummary($payment_model); ?>
                <?php 
                    /*
                        if($model->paymentDate != null){
                            $model->paymentDate = date("d/m/Y", strtotime($model->paymentDate));
                        }else{
                            $model->paymentDate = "";
                        }
                     * 
                     */
                  
                ?>   
               <input type="hidden" id="opt1"/>
               <input type="hidden" id='new_update_id' />
              
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Date</span>&nbsp;&nbsp;
                
                <input type="text" name='paymentDate' id='new_paymentDate' class="text ui-widget-content ui-corner-all" />
                <br/><br/>
                
                &nbsp;&nbsp;&nbsp;<span>Amount</span>&nbsp;
                <input type="text" name='amount' id='new_amount' class="text ui-widget-content ui-corner-all numberFilter" />
                <br/><br/>  
          
              
    
 
 </fieldset>
 <?php $this->endWidget(); ?>
</div>