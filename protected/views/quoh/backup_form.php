

<?php
/* @var $this QuohController */
/* @var $model quoh */
/* @var $form CActiveForm */
$quoh_parent_form = "quoh_parent_form_$model->id";
$quoh_form = "quoh_form_$model->id";
$quod_form = "quod_form_$model->id";
$quod_table_view = "quod_table_view_$model->id";
$showquod = "showquod_$model->id";
$quoh_id = $model->id;
$vendor_id = "vendor_quoh_$model->id";
$product_id = "product_quoh_$model->id";
$type_id = "type_quoh_$model->id";
$qty = "qty_quoh_$model->id";
$unitPrice = "unitPrice_quoh_$model->id";
$dialog_form = "dialog_form";
$deleteQuoh = "deleteQuoh_$model->id";




?>

<?php
        if($project_model->status  == 4 || $project_model->status  == 19)
        {
            $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->quoh_update == 0){
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
<form id="fake" method="POST"></form>
<div id='<?php echo $quoh_parent_form; ?>' class="form">
<!------------------ Separate the Buttons adding QUOD   ------------------->
<?php  $addItem_quoh_id  = "quoh_$model->id"; ?>
<!------------------ The Button for add an ITEM  ------------------->
<?php
     if($dis == false){
?>
        <div id = '<?php echo $addItem_quoh_id; ?>' data-quohid = '<?php echo $model->id ;?>' class="add_an_item" style="float:right;margin-top: 45px;"  >Add an Item</div>

<?php } ?>
<!------------------ The Button for add an ITEM  ------------------->
 
<?php //echo CHtml::link('View Detail',array('quoteFollow/index','quoh_id'=>$model->id,'project_id'=>$model->project_id),array('style'=>"color:rgb(78,103,200);font-weight:bold;font-size:18px ; float:right;margin: 50px 40px 0 0;")); ?>
<?php
/*
$arraysource = array('ac1','ac2','ac3',"aapne","javascript");
$this->widget('zii.widgets.jui.CJuiAutoComplete',array(
    'name'=>'city',
    'source'=> $arraysource,
    // additional javascript options for the autocomplete plugin
    'options'=>array(
        'minLength'=>'2',
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
    ),
));
 * */
 
?>

<script> 
    
    $(function(){
          
          $('.save')
     
          function ajaxautocomplete(idname,table){
              //var machinetype = '<?php //echo $project_model->machineType; ?>';
              var availableTags =   [""];
              $.ajax({
                    url: '<?php echo $this->createUrl('quoh/autocomplete'); ?>',
                    dataType: "json",
                    data: { inputtext:idname.val(),table:table}, //,machinetype:machinetype},
                    success: function (response) {
                        availableTags = response.res;
                        idname.autocomplete({
                                source: availableTags
                        }); 
  
                    }/*,
                    error: function() { // if error occured
                                  alert("GET FROM AUTOCOMPLETE Error  occured.please try again");    
                   }
    */
              });
              
          }
          ajaxautocomplete($("#vendor_id"),"vendor");
          ajaxautocomplete($("#product_id"),"product");
          ajaxautocomplete($("#type_id"),"type");
          
          
           
    });
</script>

<?php echo CHtml::hiddenField('user_id'); ?>
<!------------------ Quotation HEADER  ------------------->

      <div class="bottomline"></div>
      <br/><br/>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>$quoh_form,
	'enableAjaxValidation'=>false,
        
)); ?>

       
<script>
    $(function(){
          var waiting = '<?php echo $model->status; ?>';
          var model_id = '<?php echo $model->id; ?>';
          var waiting_id = "#waiting_"+model_id;
          if(waiting == 2){
              $(waiting_id).attr('checked',true);
          }else{
               $(waiting_id).attr('checked',false);
          }
          
        
        
        
        function saveajax(quoh_id,fieldname,fieldvalue){
             var savefieldurl = '<?php echo $this->createUrl("quoh/savefield"); ?>';
              $.ajax({
                                    url: savefieldurl,
                                    data: {id:quoh_id,fieldname:fieldname,fieldvalue:fieldvalue},
                                    type: 'get'
                }); 
            
        }
        
         function saveajax_refresh(quoh_id,fieldname,fieldvalue){
             var savefieldurl = '<?php echo $this->createUrl("quoh/savefield"); ?>';
              $.ajax({
                                    url: savefieldurl,
                                    data: {id:quoh_id,fieldname:fieldname,fieldvalue:fieldvalue},
                                    type: 'get',
                                    success:function(data){
                                         $("#fake").submit();
   
                                    }
                                    
                }); 
            
        }
        $(".savequoteno").blur(function(){      
            saveajax($(this).data("id"),"quoteNo",$(this).val());                      
       });
        $(".savedate").blur(function(){  
            
            var datestr = $(this).val();
            var datearr = datestr.split("/");
            var dateforsave;
            if(datearr[0]!=null && datearr[1]!=null && datearr[2]!=null)
                dateforsave =  datearr[2] +"-"+ datearr[1]+"-"+ datearr[0];
            else
                dateforsave = null;
            saveajax($(this).data("id"),"vendorQuoteDate",dateforsave);                      
       });
        $(".saveremark").blur(function(){      
            saveajax($(this).data("id"),"remark",$(this).val());                      
       });
        $(".savewaiting").change(function(){  
            if($(this).prop('checked') == true){
                 saveajax_refresh($(this).data("id"),"status",'2'); 
               
            }else{
                 saveajax_refresh($(this).data("id"),"status",'1');
                 
            }
         
            
       });
       
       
       $.ajaxSetup ({
            cache: false
        });
     });
 </script>

	<?php echo $form->errorSummary($model); ?>
        
        <div class="row">
		<?php echo $form->hiddenField($model,'id',array('id'=>'save_id' ,'size'=>10,'maxlength'=>10,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'id'); ?>
		<?php //echo $form->hiddenField($model,'id',array('size'=>60,'maxlength'=>64)); ?>
	</div>
	<div class="row">
               
                <b>Quotation No.</b>&nbsp;
		<?php echo $form->textField($model,'quoteNo',array('id'=>"quoteNo_$model->id",'data-id'=>$model->id,'class'=>'savequoteno','size'=>20,'maxlength'=>64,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'quoteNo'); ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
                
                <?php 
                   
                     if($model->vendorQuoteDate != null){
                            $model->vendorQuoteDate = date("d/m/Y", strtotime($model->vendorQuoteDate));
                        }else{
                            $model->vendorQuoteDate = "";
                   }
            ?>
               <b>Quotation Date</b>&nbsp;
		<?php echo $form->textField($model,'vendorQuoteDate',array('id'=>"vendorQuoteDate_$model->id",'data-id'=>$model->id,'class'=>'savedate','disabled'=>$dis)); ?>
		<?php echo $form->error($model,'vendorQuoteDate'); ?>
        
        </div>
      
                
       
        
<!------------------ Quotation HEADER  ------------------->



<!------------------ Quotation DETAIL  ------------------->
        
        <?php   $quod_detail = quod::model()->findAll("quoH_id=:quoH_id",array(":quoH_id"=>$model->id)); ?>
        
   
               <div id='<?php echo $quod_table_view; ?>' class="ui-widget">
                <table  class="table_view1">
                  <thead>
                    <tr class="table_view1_header">
                      <th class="table_vendor" style="width:150px;">Vendor</th>
                      <th class="table_model" style="width:150px;">Model</th>
                       <?php if($project_model->machineType == 2){  ?>  
                            <th class="table_type" style="width:150px;">Type</th>
                      <?php } ?>
                      <th class="table_qty" style="width:100px;">Quantity</th>
                      <th class="table_unitprice" style="width:100px;">Unit Price</th>
                      <th class="table_total" style="width:100px;">Total</th>
                      <th class="table_operation" style="width:70px;"> </th>
                    </tr>
                  </thead>
              <!--    <div id='<?php //echo $showquod; ?>' > -->
                  <tbody>
               
                  <?php $i = 1; ?>    
                   <?php  foreach($quod_detail as $detail){ ?>
                    <?php $quod_row = "quod_$detail->id"; ?>
                             <tr id="<?php echo $quod_row;?>" class="table_tr_quod" >
                                <input type="hidden" id='<?php echo "hidden_$quod_row"; ?>' value='<?php echo $detail->id;?>'>
                                <td><center><?php if(vendor::model()->findByPk($detail->vendor_id) != null) echo CHtml::encode(vendor::model()->findByPk($detail->vendor_id)->name); ?></center></td>
                                <td><center><?php if(product::model()->findByPk($detail->product_id) != null) echo CHtml::encode(product::model()->findByPk($detail->product_id)->name); ?></center></td>
                                <?php if($project_model->machineType == 2){  ?>    
                                    <td><center><?php  if($detail->type_id != null && type::model()->findByPk($detail->type_id)!= null ) echo CHtml::encode(type::model()->findByPk($detail->type_id)->name); ?></center></td>
                                <?php } ?>
                                <td><center><?php echo CHtml::encode($detail->qty); ?></center></td>
                                <td><center><?php echo CHtml::encode($detail->unitPrice); ?></center></td>
                               <td><center><?php echo CHtml::encode($detail->qty * $detail->unitPrice); ?></center></td>
                <td><?php if($dis == false){?>&nbsp;<span id='<?php echo "update_$quod_row" ?>' class="update_quod" data-hidden="true" data-quohid='<?php echo $model->id; ?>' data-id='<?php echo $detail->id; ?>'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp  <?php  if($auth->quoh_delete == 1){ ?> <span id='<?php echo "delete_$quod_row" ?>' data-quohid='<?php echo $model->id; ?>' class="delete_quod" data-id='<?php echo $detail->id;?>'  >&nbsp;&nbsp;&nbsp;&nbsp;</span><?php }} ?></td>
                            </tr>
                   <?php } ?>
                 
                  </tbody>
               <!--    </div> -->
                </table>
              </div>
           <?php $i++; ?>    


        <div class="row">
                <b>Remark  &nbsp;&nbsp;</b><br/>
		<?php echo $form->textArea($model,'remark',array('id'=>"remark_$model->id",'data-id'=>$model->id,'class'=>'saveremark','rows'=>6, 'cols'=>50,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>
         
         
        
           <div class="row" style="margin-bottom:20px;">
             <?php echo "Waiting  "; ?>&nbsp;
            <?php if($dis == false){ ?>
                    <input type="checkbox" id='<?php echo "waiting_$model->id"; ?>' class='savewaiting' data-id='<?php echo $model->id; ?>' style='margin:0;padding:0;width:10px;'  />
                <?php }else{ ?>
                    <input type="checkbox" id='<?php echo "waiting_$model->id"; ?>' class='savewaiting' data-id='<?php echo $model->id; ?>' style='margin:0;padding:0;width:10px;' disabled="disabled"/>    
           <?php  } ?>
             
           </div>
         
         
         
         
         
         
     <!------------------    END OF QUOTATION HEADER FORM        -------------------------->
         
         
         
         
         

	<script>
        $(function() {
                var deleteQuohButt  = $("#".concat('<?php echo $deleteQuoh ; ?>'));
                var delQuoh = '<?php echo $this->createUrl('quoh/deleteQuoh'); ?>';
                var quohID = <?php echo $model->id; ?>;
                var projectID = <?php echo $model->project_id; ?>;

                $("#".concat('<?php echo $deleteQuoh ; ?>')).click(function(){ 
                   
                  
                    $.ajax({
                            url: delQuoh,
                            data: {id:quohID,project_id:projectID},
                            type: 'get',
                            success: function(){
                                var click_delete_quoh = deleteQuohButt.parent().parent().parent().attr('id');
                               
                                // click_delete_quoh is quoh_parent_form_[# of QUOH]
                                $("#".concat(click_delete_quoh)).hide('fast');
                                $("#fake").submit();
                               
                            },
                            error: function() { // if error occured
                                  alert("Delete Quoh Error  occured.please try again");    
                             }
                     }); 
                                    
            });
               
        });
        </script>
	<div class="row buttons">
		<?php 
                         //if($dis == false)
                            echo CHtml::submitButton('',array('disabled'=>'true','style'=>'background-color:white;border:none')); 
                             
                 ?>
                <?php 
                       if($dis == false){
                          if($auth->quoh_delete == 1){
                              echo '<div id="'.$deleteQuoh.'" class="simple_button" style="margin: 4px 0 0 0; float: right;background-color:rgb(255,162,161)">Delete</div>';
                       
                          }
                       }     
                          
          /*
                echo CHtml::ajaxLink('<div id="'.$deleteQuoh.'" class="simple_button" style="margin: 4px 0 0 0; float: left;">Delete</div>',
                                    array('quoh/deleteQuoh','id'=>$model->id,'project_id'=>$model->project_id),
                                    array('update'=>'#show_quoh'),
                                    array('confirm'=>'Are you sure to delete ?')
                                 );
               */
               
               ?> 
               
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->


<script> 
    
    $(function(){
        
             $("").keyup(function(){});
             
             var delurl = '<?php echo $this->createUrl("quoh/deleteQuod"); ?>';
            // var quod_row = "#".concat('<?//php echo $quod_row; ?>');
            
             //var quod_row_id = "#".concat('<?php// echo  "hidden_$quod_row"; ?>');
             //var quod_row_val = $(quod_row_id).val();
             //var delete_quod_row = "#".concat('<?php //echo "delete_$quod_row" ; ?>');
           
            $(".delete_quod").one('click',function(){
                var click_row = $(this).parent().parent().attr('id');
                var quod_ID = $(this).data('id');
                $("#".concat(click_row)).hide('fast');
                    
                
                 
           
 

               $.ajax({
                            url: delurl,
                            data: {id:quod_ID},
                            type: 'get',
                           
                            error: function() { // if error occured
                                  alert(" DELETE QUOD Error  occured.please try again");    
                             }
                     }); 
                                    
            });
          
           
            
    });
</script>                     



<!------------------ Quotation DETAIL  ------------------->




<!---------------- DIALOG TO DELETE FILE  ---------------->
<!--
    <div id="dialog-confirm" title="Empty the recycle bin?">
       <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>These items will be permanently deleted and cannot be recovered. Are you sure?
</div>
-->
<!---------------- DIALOG TO DELETE FILE  ---------------->

<!---------------------   DIALOG  ---------------------------->
 <style>
  /*  
    body { font-size: 62.5%; }

    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0;margin:0;}
 */
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
    var 
      vendor = $("#vendor_id"),
      product = $("#product_id"),
      type = $("#type_id"),
      qty = $("#qty"),
      unitPrice = $("#unitPrice"),
      allFields = $( [] ).add( vendor ).add( product ).add( type ).add( qty ).add( unitPrice ),
      tips = $( ".validateTips" );
      
      var dialog_form = "#"+'<?php echo $dialog_form;?>';
      var update_id;
      var quoh_id;
 
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
      height: 370,
      width: 390,
      modal: true,
      buttons: {
        "Add an Item": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
          
          //bValid = bValid && checkLength( product, "product", 3, 16 );
          //bValid = bValid && checkLength( qty, "qty", 6, 80 );
          //bValid = bValid && checkLength( unitPrice, "unitPrice", 5, 16 );
 
          //bValid = bValid && checkRegexp( product, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
          // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
          //bValid = bValid && checkRegexp( qty, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
          //bValid = bValid && checkRegexp( qty, /^([0-9])+$/, "Quantity must be a number" );
          //bValid = bValid && checkRegexp( unitPrice, /^\d*(?:\.\d*)?$/, "Password field only allow : 0-9" );
 
         // if ( bValid ) {
         if ( vendor.val()!= "" && product.val()!= ""&& type.val()!= "" && qty.val()!= "" && unitPrice.val()!= "") {
  /*            
            $( "#users tbody" ).append( "<tr>" +
              "<td>" + name.val() + "</td>" +
              "<td>" + email.val() + "</td>" +
              "<td>" + password.val() + "</td>" +
            "</tr>" ); 
*/


           
            var tourl='<?php echo $this->createUrl("quoh/saveQuod"); ?>'; 
            if($("#opt").val() == 0){
                 update_id = 0;
                 quoh_id = $('#quoh_id').val();
            }else{
                update_id = $("#update_id").val();
                quoh_id = $('#quoh_id').val();
            }
               
                             
           
           
            
            var  js_product =  "#product_id";
            var  js_vendor =  "#vendor_id";
            var  js_type =  "#type_id";
            var  js_qty =  "#qty";
            var  js_unitPrice =  "#unitPrice";
            
            
            var productValue = $(js_product).val();
            var vendorValue = $(js_vendor).val();
            var typeValue = $(js_type).val();
            var qtyValue=$(js_qty).val();
            var unitPriceValue=$(js_unitPrice).val();
           // 
    /********    Separate Table by QUOH ID   ********/        
    var quod_table_view = "#".concat('<?php echo $quod_table_view; ?>');
 
       
            var quod_table_view = "#".concat('quod_table_view_'+quoh_id)
            var showquod = "#".concat('showquod_'+quoh_id);
             
            $.ajax({
                    url:  tourl,
                    data: {vendor:vendorValue,product:productValue,type:typeValue,qty:qtyValue,unitprice:unitPriceValue,quoh_id:quoh_id,update_id:update_id},
                    type: 'get',
                    dataType: 'html',
                    success:function(data){
                        
                        $(quod_table_view).html(data);   
                   
                   
                              $( this ).dialog( "close" );
                                 allFields.val( "" ).removeClass( "ui-state-error" );
                                  
                            },
                 error: function() { // if error occured
                                          alert("add QUOD Error: "+tourl);    
               }
            });

            $( this ).dialog( "close" );
              
            
          }else
          {
                  var msg = "โปรดใส่ข้อมูลดังรายการข้างล่าง อย่าเว้นว่างไว้ \n\n";
                     vendor.val() == ''? msg = msg  + "● Vendor\n": msg = msg ;
                     product.val() == ''? msg = msg  + "● Product\n" : msg = msg;
                     type.val() == ''? msg = msg  + "● Type\n" : msg = msg;
                     qty.val() == ''? msg = msg  + "● Qty\n" : msg = msg;
                     unitPrice.val() == ''? msg = msg  + "● Unit Price\n" : msg = msg;
                     alert(msg);
          }
        },

       
        Cancel: function() {
          $( this ).dialog( "close" );
          allFields.val( "" ).removeClass( "ui-state-error" );
        }
      },
      close: function() {
      
          allFields.val( "" ).removeClass( "ui-state-error" );
                $("#product_id").val("");
                $("#vendor_id").val("");
                $("#type_id").val("");
                $("#qty").val("");
                $("#unitPrice").val("");
      }
    });
    
    
     
   
    /*****************       OTHER ADD   ***************/
    var     add_an_item = '<?php echo "#$addItem_quoh_id"; ?>';
    
    $('.update_quod').click(function(){
         //alert($(this).data('id'));
            update_id = $(this).data("id");
            quoh_id = $(this).data('quohid');
            
          
            var row_id = "#quod_"+$(this).data("id");
            var vendor_update = "#vendor_id"; 
            var product_update = "#product_id"; 
            var type_update = "#type_id"; 
            var qty_update = "#qty"; 
            var unitPrice_update = "#unitPrice"; 
            var machinetype = '<?php  echo $project_model->machineType ?>';
             //alert(update_id+"  "+quoh_id );
             //alert($(row_id+" td:nth-child(3)").text());
            
            $(vendor_update).val($(row_id+" td:nth-child(2)").text());
            $(product_update).val($(row_id+" td:nth-child(3)").text());
            if(machinetype == 2){
                $(type_update).val($(row_id+" td:nth-child(4)").text());
                $(qty_update).val($(row_id+" td:nth-child(5)").text());
                $(unitPrice_update).val($(row_id+" td:nth-child(6)").text());
            }else{
                $(type_update).val('0');
                $(qty_update).val($(row_id+" td:nth-child(4)").text());
                $(unitPrice_update).val($(row_id+" td:nth-child(5)").text());
            }
            
            $('#quoh_id').val(quoh_id);
            $('#update_id').val(update_id);
            $("#opt").val('1');
            
            $("#dialog_form").dialog( "open" );
        
         
    });
    
    $(add_an_item)
      .button()
      .click(function() { 
        quoh_id = $(this).data('quohid');
        update_id = 0;
       
        //alert(quoh_id);
         var machinetype = '<?php  echo $project_model->machineType ?>';
         
         
        if(machinetype == 2){
            $("#vendor_id").val('Sky');
             $("#type_id").val(''); 
        }
        else{
            $("#vendor_id").val('');
             $("#type_id").val('0'); 
        }

         $("#product_id").val(''); 
         $("#qty").val(''); 
        
         $("#unitPrice").val('');; 
        $('#quoh_id').val(quoh_id);
        $('#update_id').val(update_id);
        $("#opt").val('0');
       
        $("#dialog_form").dialog("open");
        
        
        
        
      });
      
       var $autocomplete = $('<ul class="autocomplete"></ul>').hide().insertAfter('#search-text');
       var autourl = '<?php echo $this->createUrl("quoh/autocomplete"); ?>';
     
                    $('#search-text').keyup(function() {
                    $.ajax({
                        'url': autourl,
                        'data': {'search-text': $('#search-text').val()},
                        'dataType': 'html',
                        'type': 'POST',
                        'success': function(data) {
                        if (data.length) {
                        $autocomplete.empty();
                        $.each(data, function(index, term) {
                        $('<li></li>').text(term).appendTo($autocomplete);
                        });
                        $autocomplete.show();
                        }
                        }
                    });
            });
      
    
        
  });
  </script>
  
  
  <!---------------------   DIALOG  ---------------------------->
  
  <div id='dialog_form'  title="Add New Item">
  <p class="validateTips"></p>
 
  <?php $form=$this->beginWidget('CActiveForm', 
        array(
            'id'=>$quod_form,
            'enableAjaxValidation'=>false,
            'htmlOptions' => array("class"=>"dialog_form"),
      )); 
   ?>
<?php $quod_model = new quod; ?> 
  <fieldset style="margin-left: -20px;">
      <?php echo $form->errorSummary($quod_model); ?>
               <input type="hidden" id="opt"/> 
                <input type="hidden" id="quoh_id" />
                <input type="hidden" id='update_id' />
                
               
                
               &nbsp;<span>Vendor </span>&nbsp;&nbsp;
                <input type="text" name='<?php echo $vendor_id;?>' id='vendor_id' class="text ui-widget-content ui-corner-all" />
                <br/><br/>
                
                &nbsp; &nbsp;<span>Model </span>&nbsp;&nbsp;
                <input type="text" name='<?php echo $product_id;?>' id='product_id' class="text ui-widget-content ui-corner-all"   />
                
            <?php if($project_model->machineType == 2){  ?>     
                <br/><br/> 
           
                &nbsp; &nbsp;<span>Type </span>&nbsp;&nbsp;&nbsp;
          
                <input type="text" name='<?php echo $type_id;?>' id='type_id' class="text ui-widget-content ui-corner-all"   />
           <?php }else{  ?>  
                 <input type="hidden" name='type_id' id='type_id' value='0'  />
            <?php }  ?>
                <br/><br/>
                
                <span>Quantity</span>&nbsp;&nbsp;
                <input type="text" name='<?php echo $qty;?>' id='qty' class="text ui-widget-content ui-corner-all numberFilter" maxlength="10"/>
                <br/><br/>  
                
                <span>Unit Price</span>&nbsp;
                <input type="text" name='<?php echo $unitPrice;?>' id='unitPrice' class="text ui-widget-content ui-corner-all numberFilter" />
		
                <br/><br/> 
                <?php //echo $form->hiddenField($quod_model,'quoh_id',array('id'=>'quoh_id','class'=>"text ui-widget-content ui-corner-all",'value'=>$model->id,)); ?>
		<?php //echo $form->error($quod_model,'quoh_id'); ?>
                
    
 
 </fieldset>
 <?php $this->endWidget(); ?>
</div>
  
  
 

 <?php  

    

         if($project_model->machineType == 1){
             if($project_model->existInStock == 2){
                 $move_forward = "poh"; $next_status = 18;
                 $move_backward = "enquiry"; $pre_status = 1;
            }
            else{
                $move_forward = "poh"; $next_status = 18;
                $move_backward = "vendorprocess"; $pre_status = 3;
            }
           
        }
        else if($project_model->machineType == 2){
            $move_forward = "poh"; $next_status = 18;
            $move_backward = "enquiry"; $pre_status = 1;
        }else
            
        {
            $move_forward = "pOtoVendor"; $next_status = 7;
            $move_backward = "vendorprocess"; $pre_status = 3;
        }    
      
     //  $backward_direction = "enquiry"; $backward_status = 1;
       
       
   /* ******************************************************  */    
       
       if($project_model->status == 4){
         $forward_direction = "quoh"; $forward_status = 5;
         $backward_direction = $move_backward; $backward_status = $pre_status;
       }else if($project_model->status == 5){
        $forward_direction = $move_forward; $forward_status = $next_status;
         $backward_direction = "quoh"; $backward_status = 4;
         
       }
       else{
         $forward_direction = "poh"; $forward_status = 5;
         $backward_direction = "quoh"; $backward_status = 3;
       }
 
   
     ?>   
    
      


  
 