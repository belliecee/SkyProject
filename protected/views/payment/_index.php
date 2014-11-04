<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>



<?php
        //$form = "payment_form_$model->id";
        $table_view = "payment_table_view";
        //$id = $model->id;
        //$paymentedDate = "paymentedDate_$model->id";
        //$contact = "contact_$model->id";
        //$detail = "detail_$model->id";
        //$paymentedBy = "paymentedBy_$model->id";
        //$quohID = "quoh_$model->id";
        //$payment_row = "payment_$model->id";
        //$dialog_form = "payment_dialog_form_$model->id";


?>

<br/><br/>
<div class="other_header" style="margin-top:-32px;">
<?php  
     $project_model = project::model()->findByPk($project_id);
     $this->renderPartial('//project/_form',array('model'=>$project_model)); 
?>    
</div>
<div class="index_content" style=" margin: 0 0 20px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 70px 0 0;width:1000px; min-height: 500px;">

<!------------------ The Button for add an ITEM  ------------------->

 
 <?php  echo CHtml::ajaxLink('<div id="addPayment" class="simple_button" style="float: right;"> Add Payment</div>',
                                array("payment/create",'project_id'=>$project_id),
                                array(
                                        'update' => '#show_quoh'
                                  
                           ));?>

<div class="title2" style="border-bottom: none;">Payment </div>
<div class="bottomline"></div>
    <!--------------------------- Start Table ----------------------------------------->


        <div id="payment-contain" class="ui-widget" style="margin:40px 0 0 50px;">

<?php $payment_model = payment::model()->findAll("project_id=:project_id",  array(":project_id"=>$project_id));   ?>
  
   
       
          
                <table id='payment_table_view' class="table_view1">
                  <thead>
                    <tr  class="table_view1_header">
                      <th class="table_ind" style="min-width:50px;">No.</th>
                      <th class="table_paymentDate" style="min-width:100px;">Date</th>
                      <th class="table_amount" style="min-width:100px;">Amount</th>
                      <th class="table_operation" style="min-width:50px; "> </th>
                    </tr>
                  </thead>
                  <tbody>
                    
                   <div id="showPayment">     
<?php
                    $ind = 0;
                    foreach($payment_model as $_model)
                    {
                                  

                        ++$ind;
                        $payment_row = "payment_$_model->id";

?>




                                <tr id='<?php echo $payment_row; ?>' class="table_tr_quod" >
                               <!--<input type="hidden" id='<?//php echo "hidden_$quod_row"; ?>' value='<?//php echo $detail->id;?>'> -->
                                <td><center><?php echo CHtml::encode($ind); ?>.</center></td>
                                <td><?php echo CHtml::encode($_model->id); ?></td>
                                <td><?php echo CHtml::encode($_model->amount); ?></td>
                               
                               <td>
                                 <?php
                                 /*
                                   echo CHtml::ajaxLink('<div id="update_'.$payment_row.'"  class="simple_button" style="display: inline-block;">Delete</div>',
                                        array("payment/delete2",'id'=>$_model->id,'project_id'=>$_model->project_id),
                                        array(
                                                'update' => '#payment-contain'
                                          ));
                                 */
                                ?>
                                  

                                   &nbsp;<span id='<?php echo "update_$payment_row" ?>' class="update" data-id='<?php echo $_model->id; ?>' data-projectID='<?php echo $_model->project_id; ?>'>Upd</span>&nbsp;&nbsp;&nbsp;<span id='<?php echo "delete_$payment_row" ?>' class="del" data-id='<?php echo $_model->id;?>' data-projectID='<?php echo $_model->project_id; ?>' >Del</span></td>
                         
</tr>  


<?php
                    }
     
?>                    
 </div>
                   
                        
                  </tbody>
                </table>
    </div>    
    
<?php            
        //}
        
?>    
    
<script> 
    
    $(function(){
        
           
              
              var delurl = '<?php echo $this->createUrl("payment/delete2"); ?>';
           
           
            $(".del").click(function(){
                var click_row = $(this).parent().parent().attr('id');
                var theID = $(this).data('id');
                var theproject =  <?php echo $_model->project_id; ?> ; //$(this).data('projectID');
                 alert(theID+'.....'+theproject);
/*                
                   
                    $( "#dialog-confirm" ).dialog({
                        resizable: false,
                        height:140,
                        modal: true,
                        buttons: {
                          "Delete all items": function() {
                            $( this ).dialog( "close" );
                          },
                          Cancel: function() {
                            $( this ).dialog( "close" );
                          }
                        }
                      });
*/  


               $.ajax({
                            url: delurl,
                            data: {id:theID,project_id:theproject},
                            type: 'get',
                            dataType: 'html',
                            success:function(data){
                                $("#payment-contain").html(data);
                            },
                            error: function() { // if error occured
                                  alert("Error  occured.please try again");    
                             }
                     }); 
                                    
            });
          
           
            
    });
    
    
</script> 
    
    
<?php //$this->renderPartial('_form',array('model'=>$model,'project_id'=>$project_id,'quoh_id'=>$quoh_id)); ?>



</div>  <!--------------------------- End of Content ----------------------------------------->


<!---------------- OPERATION FOOTER --------------------------------------------------->

<div class="operation_footer" style="margin: 10px 0 50px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 50px 0 0;width:1000px;height:50px">
<div id="Back" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;"> Back</div>
   
      
</div>


<!---------------------------------        -------------------------------------------->



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
   
    $(dialog_form).dialog({
      autoOpen: false,
      height: 250,
      width: 350,
      modal: true,
      buttons: {
        "Add new payment": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          //bValid = bValid && checkLength( paymentDate, "paymentDate", 3, 16 );
          //bValid = bValid && checkLength( contact, "contact", 6, 80 );
          //bValid = bValid && checkLength( detail, "detail", 5, 16 );
 
          //bValid = bValid && checkRegexp( paymentDate, /^([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
          // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
          //bValid = bValid && checkRegexp( contact, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
          //bValid = bValid && checkRegexp( detail, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 
          if ( bValid ) {
              
                    var tourl = '<?php echo $this->createUrl("payment/create"); ?>';
                    var payment_id =  '<?php echo $model->id;?>';
                    var ind = '<?php echo $ind;?>' ;
                  

                    var projectID = <?php echo $project_id; ?>;
                    var paymentDateValue = paymentDate.val();
                    var amountValue= amount.val();
                  
                    $.ajax({
                    url:  tourl,
                    data: {paymentDate:paymentDateValue,amount:amountValue,project_id:projectID},
                    type: 'get',
                    dataType: 'json',
                    success:function(response){
                           
                           
                              plusind++;
                              var order = parseInt(ind) + parseInt(plusind);
                              var paymentid =  response.paymentID;
 
                             
                              var table_view = "#payment_table_view";
                          
                             
                        
// CHANGE: BEGIN: addrow                       
                              var addRow = "payment_"+response.paymentID;
                              var updateRow = "update_"+addRow;
                              var deleteRow = "delete_"+addRow;
// END   
                           
// CHANGE: BEGIN: _table_view/attribute  

                              $(table_view).append(
                                "<tr id='"+ addRow +"' class='.quod_table_view'>" +
                                  "<td><center>" + order + ".</center></td>" +
                                  "<td>" + paymentDateValue + "</td>" +
                                  "<td>" + amountValue + "</td>" +                             
                                  "<td>&nbsp;<span id='" + updateRow + "' class='update' data-id='"+response.paymentID+"' >Upd</span>&nbsp;&nbsp;&nbsp;<span id='" + deleteRow + "' class='del' data-id='"+response.paymentID+"' >Del</span></td>"+
                                  
                                "</tr>" 
// END                             
                                );
      
/* CHANGE ACTION NAME*/   

                                var delurl = '<?php echo $this->createUrl("payment/deletePayment"); ?>';
                                var deleteRowID = "#".concat(deleteRow);
                                //$(".delete_quod").click(function(){ alert("SUCCESS"); });
                                $(deleteRowID).click(function(){ 
                                    alert(addRow);
                                    $.ajax({
                                            url: delurl,
/* CHANGE response. ...ID */                               
                                            data: {id:response.paymentID},
                                            type: 'get',
                                            success:function(){
                                                     $("#".concat(addRow)).hide('fast');
                                            },
                                            error: function() { // if error occured
                                                  alert("Error  occured.please try again");    
                                             }
                                     }); 
                                     

                            });
                    

                            $( this ).dialog( "close" );
                                 allFields.val( "" ).removeClass( "ui-state-error" );
                                  
                  },
                 error: function() { // if error occured
                                          alert("Error: "+paymentedDateValue);    
               }
            });

            $( this ).dialog( "close" );
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
        $(dialog_form).dialog( "open" );
        
               
      });
   
          
  });
  </script>
  
  

  
<?php    
        $payment_form = "payment_".$model->id;
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
               
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Date</span>&nbsp;&nbsp;
                
                <input type="date" name='paymentDate' id='paymentDate' class="text ui-widget-content ui-corner-all" />
                <br/><br/>
                
                &nbsp;&nbsp;&nbsp;<span>Amount</span>&nbsp;
                <input type="text" name='amount' id='amount' class="text ui-widget-content ui-corner-all" />
                <br/><br/>  
          
              
                <?php //echo $form->hiddenField($payment_model,'quoH_id',array('id'=>'quohID','class'=>"text ui-widget-content ui-corner-all",'value'=>$quoh_id,)); ?>
		<?php //echo $form->error($payment_model,'quoH_id'); ?>
                <?php //echo $form->hiddenField($payment_model,'paymentedBy',array('id'=>'paymentedBy','class'=>"text ui-widget-content ui-corner-all")); ?>
		<?php //echo $form->error($payment_model,'paymentedBy'); ?>
              
                
    
 
 </fieldset>
 <?php $this->endWidget(); ?>
</div>


  