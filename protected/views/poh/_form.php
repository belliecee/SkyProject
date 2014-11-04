<?php
/* @var $this PohController */
/* @var $model poh */
/* @var $form CActiveForm */
?>
<?php
    if($project_model->status  == 18)
        {
             $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->poh_update == 0){
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
 <?php if($dis == false){ ?>   
 <div id="addPod" class="simple_button" style="float: right;"> Add an Item</div>
<?php } ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'poh-form',
	'enableAjaxValidation'=>false,
)); ?>

	<br/><br/>
 <div class="row">
         <b>Ref. Quotaiton No.&nbsp;&nbsp;</b>
	
		<?php 
                        $criteria = new CDbCriteria;
                        $criteria->condition = "project_id=:project_id";
                        $criteria->params = array(":project_id"=>$model->project_id);
                        $criteria->order = 'id ASC';
                ?>
	        <?php echo $form->dropDownList($model, 'quoh_id', CHtml::listData(quoh::model()->findAll($criteria), 'id', 'quoteNo'),array('id'=>'quoh_id','maxlength'=>10,'disabled'=>$dis));?>
                <?php echo $form->error($model,'quoh_id'); ?>

         </div>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
		<b> PO No.&nbsp; </b>
		<?php echo $form->textField($model,'PONo',array('id'=>'pono','size'=>20,'maxlength'=>64,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'PONo'); ?>
	
            &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;      
                
                <?php 
                    
                        if($model->customerPOdate != null){
                            $model->customerPOdate = date("d/m/Y", strtotime($model->customerPOdate));
                        }else{
                            $model->customerPOdate = "";
                        }
                  
                ?>   
		<b> Order Date &nbsp;</b>
		<?php echo $form->textField($model,'customerPOdate',array('id'=>'customerPOdate','size'=>20,'maxlength'=>64,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'customerPOdate'); ?>
                
                
          
	
	
	</div>
      
	
        
        
        <!--------------------- TABLE POD ---------------------------------->
        <!--------------------- TABLE POD ---------------------------------->
        <!--------------------- TABLE POD ---------------------------------->
        
      <?php $pod_model = pod::model()->findAll("poh_id=:poh_id",  array(":poh_id"=>$model->id));   ?>
        
      <div id="pod_contain" class="ui-widget" style="margin:40px 0 0 0px;">

        
  
   
       
          
                <table id='pod_table_view' class="table_view1">
                  <thead>
                    <tr  class="table_view1_header">
                      <th class="table_ind" style="max-width:50px;">No.</th>
                      <th class="table_paymentDate" style="min-width:100px;">Vendor</th>
                      <th class="table_paymentDate" style="min-width:100px;">Product</th>
                      <?php if($project_model->machineType == 2){ ?>
                            <th class="table_paymentDate" style="min-width:100px;">Type</th>
                       <?php } ?>      
                      <th class="table_amount" style="max-width:70px;">Qty</th>
                      <th class="table_operation" style="max-width:70px; ">Unit Price</th>
                       <th class="table_operation" style="max-width:70px; ">Price</th>
                        <th class="table_operation" style="width:70px; "></th>
                    </tr>
                  </thead>
                  <tbody>
                    
                   <div id="showPod">     
<?php
                    $ind = 0;
                    foreach($pod_model as $_model)
                    {
                        ++$ind;
                        $pod_row = "pod_$_model->id";

?>




                                <tr id='<?php echo $pod_row; ?>' class="table_tr_quod" >
                               <!--<input type="hidden" id='<?//php echo "hidden_$quod_row"; ?>' value='<?//php echo $detail->id;?>'> -->
                                <td><center><?php echo CHtml::encode($ind); ?>.</center></td>
                                <td><center><?php 
                                                    if(vendor::model()->findByPk($_model->vendor_id) != null && vendor::model()->findByPk($_model->vendor_id) != ""){
                                                            echo CHtml::encode(vendor::model()->findByPk($_model->vendor_id)->name); 
                                                    }
                                            ?>
                                </center></td>
                                <td><center><?php 
                                                    if(product::model()->findByPk($_model->product_id) != null && product::model()->findByPk($_model->product_id) != ""){
                                                        echo CHtml::encode(product::model()->findByPk($_model->product_id)->name); 
                                                    }
                                           ?>
                                </center></td>
                                 <?php if($project_model->machineType == 2){ ?>
                                        <td><center><?php if(type::model()->findByPk($_model->type_id)){echo CHtml::encode(type::model()->findByPk($_model->type_id)->name); } ?></center></td>
                                 <?php } ?>       
                                <td><center><?php echo CHtml::encode($_model->qty); ?> </center></td>
                                <td><center><?php echo CHtml::encode($_model->unitPrice); ?> </center></td>
                                <td><center><?php echo ($_model->qty * $_model->unitPrice) ?> </center></td>
                               
                               <td><center>
                                   <?php if($dis == false){ ?>
                                
                                  

                                   &nbsp;<span id='<?php echo "update_$pod_row" ?>' class="update" data-id='<?php echo $_model->id; ?>' data-poh='<?php echo $_model->poh_id; ?>'> &nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php  if($auth->poh_delete == 1){ ?><span id='<?php echo "delete_$pod_row" ?>' class="del" data-id='<?php echo $_model->id;?>' data-poh='<?php echo $_model->poh_id; ?>' >&nbsp;&nbsp;&nbsp;&nbsp;</span><?php } ?>
                               <?php } ?>
                               </center>
                               </td>
                         
</tr>  


<?php
                    }
     
?>                    
 </div>
                   
                        
                  </tbody>
                </table>
    </div>   
        
        
        
        
        <!------------- TABLE POD ---------------------------------->
        
        
        <div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>

	<div class="row buttons">
		<?php if($dis == false)echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'simple_button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


 <!---------------- Dialog with Ajax ------------------------------ -->
  
     
<script> 
    
    $(function(){
      
              
              var delurl = '<?php echo $this->createUrl("poh/deletepod"); ?>';
            $(".del").one('click',function(){
                var theID = $(this).data('id');
                var thepoh =  <?php echo $model->id; ?> ; //$(this).data('projectID');
              
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
                            data: {id:theID,poh_id:thepoh},
                            type: 'get',
                            dataType: 'html',
                            success:function(data){
                                $("#pod_contain").html(data);
                            },
                            error: function() { // if error occured
                                  alert("Error  occured.please try again");    
                             }
                     }); 
                                    
            });
          
           
            
    });
    
    
</script> 
    
 <script>
  $(function() {
    function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
    }
 
    $( "#city" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "http://ws.geonames.org/searchJSON",
          dataType: "jsonp",
          data: {
            featureClass: "P",
            style: "full",
            maxRows: 12,
            name_startsWith: request.term
          },
          success: function( data ) {
            response( $.map( data.geonames, function( item ) {
              return {
                label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                value: item.name
              }
            }));
          }
        });
      },
      minLength: 2,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.label :
          "Nothing selected, input was " + this.value);
      },
      open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
      },
      close: function() {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }
    });
  });
  </script>
 
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
        
       
      var dialog_form =  "#dialog_form";
      var vendor = $("#vendor"),
      product = $("#product"),
      type = $("#ttype"),
      qty = $("#qty"),
      unitPrice = $("#unitPrice"),
      allFields = $( [] ).add( vendor ).add( product ).add( type ).add(qty).add(unitPrice),
      tips = $( ".validateTips" );
      var update_id = 0;
  
 
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
      height: 390,
      width: 370,
      modal: true,
      buttons: {
        "Add new pod": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          //bValid = bValid && checkLength( podDate, "podDate", 3, 16 );
          //bValid = bValid && checkLength( contact, "contact", 6, 80 );
          //bValid = bValid && checkLength( detail, "detail", 5, 16 );
 
          //bValid = bValid && checkRegexp( podDate, /^([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
          // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
          //bValid = bValid && checkRegexp( contact, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
          //bValid = bValid && checkRegexp( detail, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 
            if (vendor.val()!= "" && product.val()!= "" && qty.val()!= "" && unitPrice.val()!= "") {
              
                    var createurl = '<?php echo $this->createUrl("poh/createpod"); ?>';
                    var updateurl = '<?php echo $this->createUrl("poh/updatepod"); ?>';
                    var machinetype = '<?php echo  $project_model->machineType;  ?>';
                    var tourl;
                    
                    if($("#opt").val() == 0){ tourl = createurl; $("opt").val();}
                    else{ tourl = updateurl; $("opt").val();}
                    
                    var vendorValue = vendor.val();
                    var productValue = product.val();
                    if(machinetype == 2){
                        var typeValue = type.val();
                    }else{
                        var typeValue = null;
                    }
                        
                    
                    var qtyValue= qty.val();
                    var unitPriceValue = unitPrice.val();
                    var poh_id = <?php echo $model->id?>;
                  
                    $.ajax({
                    url:  tourl,
                    data: {vendor:vendorValue, product:productValue, type:typeValue, qty:qtyValue, unitPrice:unitPriceValue, poh_id:poh_id,id:update_id },
                    type: 'get',
                    dataType: 'html',
                    success:function(data){
                              $("#pod_contain").html(data);
                               $( this ).dialog( "close" );
                    },
                 
                 error: function() { // if error occured
                                          alert("Error");    
                }
                });

               $( this ).dialog( "close" );
          }else
          {
                  var msg = "โปรดใส่ข้อมูลดังรายการข้างล่าง อย่าเว้นว่างไว้ \n\n";
                     vendor.val() == ''? msg = msg  + "● Vendor\n": msg = msg ;
                     product.val() == ''? msg = msg  + "● Product\n" : msg = msg;
                     qty.val() == ''? msg = msg  + "● Qty\n" : msg = msg;
                     unitPrice.val() == ''? msg = msg  + "● Unit Price\n" : msg = msg;
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
 

 
    
    $('#addPod').click(function() { 
        $('#opt').val('0');
        $(dialog_form).dialog( "open" );
        
               
      });
      
    $(".update").click(function(){
                var machinetype = '<?php echo  $project_model->machineType;  ?>';
                
               $('#opt').val('1');
               update_id = $(this).data("id");
               var row_id = "#pod_"+$(this).data("id");
               $("#vendor").val($(row_id+" td:nth-child(2)").text());
               $("#product").val($(row_id+" td:nth-child(3)").text());
               if(machinetype == 2){
                    $("#ttype").val($(row_id+" td:nth-child(4)").text());
                    $("#qty").val($(row_id+" td:nth-child(5)").text());
                    $("#unitPrice").val($(row_id+" td:nth-child(6)").text());
               }else{
                    $("#qty").val($(row_id+" td:nth-child(4)").text());
                    $("#unitPrice").val($(row_id+" td:nth-child(5)").text());
               }
               $(dialog_form).dialog( "open" );

    });           
                 
   
          
  });
  </script>
  
  

  
<?php    
        $pod_form = "pod_".$model->id;
?>  
  
 <div id='dialog_form'  title="Add New Item">
  <p class="validateTips"></p>
 
  <?php $form=$this->beginWidget('CActiveForm', 
        array(
            'id'=>$pod_form,
            'enableAjaxValidation'=>false,
            'htmlOptions' => array("class"=>"dialog_form"),
      )); 
   ?>
  
<?php $pod_model = new pod; ?> 
  <fieldset style="margin-left: -30px;">
      <?php echo $form->errorSummary($pod_model); ?>
      
                &nbsp;&nbsp;<span>Vendor</span>&nbsp;&nbsp;
                
                 <select name="vendor" id="vendor"   class="text ui-widget-content ui-corner-all" style="width:200px">
                          <?php
                                
                            
                                $vendorlist = array();
                                $checklist = array();
                                $quohlist = quoh::model()->findAll("project_id=:project_id",array(":project_id"=>$project_model->id));
                                foreach($quohlist as $qhl){
                                       $quodlist = quod::model()->findAll("quoH_id=:quoH_id",array(":quoH_id"=>$qhl->id));
                                       foreach($quodlist as $qdl){
                                                 if(vendor::model()->findByPk($qdl->vendor_id) != null){
                                                    $vendorname = vendor::model()->findByPk($qdl->vendor_id)->name; 
                                                   
                                                    if(!(in_array($vendorname,$checklist))){
                                                        $checklist = array($checklist,$vendorname);
                                                       
                                                        echo "<option value='$vendorname'>".$vendorname."</option>";
                                                    }
                                                 }
                                            
                                       }
                                }
              
                         ?>              
                </select>
               <!-- 
                <input type="text" name='vendor' id='vendor' class="text ui-widget-content ui-corner-all " />
               -->
                <br/><br/>
               
               &nbsp;&nbsp;<span>Product</span>&nbsp;&nbsp;
                         
                       <select name="product" id="product"   class="text ui-widget-content ui-corner-all" style="width:200px">
                          <?php
                                
                              
                                $productlist = array();
                                $checkproduct = array();
                                $quohlist = quoh::model()->findAll("project_id=:project_id",array(":project_id"=>$project_model->id));
                                foreach($quohlist as $qhl){
                                       $quodlist = quod::model()->findAll("quoH_id=:quoH_id",array(":quoH_id"=>$qhl->id));
                                       foreach($quodlist as $qdl){
                                                 if(product::model()->findByPk($qdl->product_id) != null){
                                                    $productname = product::model()->findByPk($qdl->product_id)->name;  
                                                    if(!(in_array($productname,$checkproduct))){
                                                        $checkproduct = array($checkproduct,$productname);
                                                       
                                                        echo "<option value='$productname'>".$productname."</option>";
                                                    }
                                                 }
                                            
                                       }
                                }
              
                         ?>              
                </select>

        <?php if($project_model->machineType == 2){ ?> <br/><br/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Type</span>&nbsp;&nbsp;
                         
                       <select name="ttype" id="ttype"   class="text ui-widget-content ui-corner-all" style="width:200px">
                          <?php
                                
                              
                                $typelist = array();
                                $checktype = array();
                                $quohlist = quoh::model()->findAll("project_id=:project_id",array(":project_id"=>$project_model->id));
                                foreach($quohlist as $qhl){
                                       $quodlist = quod::model()->findAll("quoH_id=:quoH_id",array(":quoH_id"=>$qhl->id));
                                       foreach($quodlist as $qdl){
                                                 if(type::model()->findByPk($qdl->type_id) != null){
                                                    $typename = type::model()->findByPk($qdl->type_id)->name;  
                                                    if(!(in_array($typename,$checktype))){
                                                        $checktype = array($checktype,$typename);
                                                       
                                                        echo "<option value='$typename'>".$typename."</option>";
                                                    }
                                                 }
                                            
                                       }
                                }
              
                         ?>              
                </select>
       <?php } ?>

                <br/><br/>
               
             
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Qty</span>&nbsp;&nbsp;
                <input type="text" name='' id='qty' class="text ui-widget-content ui-corner-all numberFilter" />
                <br/><br/> 
                 <span>Unit Price</span>&nbsp;&nbsp;
                <input type="text" name='' id='unitPrice' class="text ui-widget-content ui-corner-all numberFilter" />
                <br/><br/>
               <input type="hidden" name='opt' id='opt' class="text ui-widget-content ui-corner-all" />
          
              
    
 
 </fieldset>
 <?php $this->endWidget(); ?>
</div>

  
  

  
  
<div class="operation_footer" style="margin: 20px 0 0 0; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 50px 0 0;width:1020px;height:50px">
     
    <?php
         if($project_model->machineType == 1){
            $move_forward = "deposit"; $next_status = 7;
            $move_backward = "quoh"; $pre_status = 5;
        }
        else if($project_model->machineType == 2){
            $move_forward = "deposit"; $next_status = 7;
            $move_backward = "quoh"; $pre_status = 5;
        }else
            
        {
            $move_forward = "pOtoVendor"; $next_status = 8;
            $move_backward = "vendorprocess"; $pre_status = 3;
        }    
      // ---------------------------------------------------------------
      
         $forward_direction =  $move_forward; $forward_status = $next_status;
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
/*    
    $("#submit").click(function() {
          var input1 = $("<input>").attr("type", "hidden").attr("name", "project_id").val("<?php echo $project_model->id; ?>");
          var input2 = $("<input>").attr("type", "hidden").attr("name", "redirect").val("<?php echo $forward_direction; ?>");
          var input3 = $("<input>").attr("type", "hidden").attr("name", "project_status").val("<?php echo $forward_status; ?>");
           
          var goforward = $("#poh-form").append($(input1)).append($(input2)).append($(input3));
          goforward.submit();

    });
*/
</script>

<script> 
    
    $("#submit").click(function() {
         
          
          
          if($("#pono").val() == '' || $("#customerPOdate").val() == '')
          {
              
               var msg = "โปรดใส่ข้อมูลดังรายการข้างล่าง อย่าเว้นว่างไว้ \n\n";
               $("#pono").val() == ''? msg = msg  + "● PO No.\n": msg = msg ;
               $("#customerPOdate").val() == ''? msg = msg  + "● Order Date\n" : msg = msg;
             
               alert(msg);
          }
          else{
                var input1 = $("<input>").attr("type", "hidden").attr("name", "project_id").val("<?php echo $project_model->id; ?>");
                var input2 = $("<input>").attr("type", "hidden").attr("name", "redirect").val("<?php echo $forward_direction; ?>");
                var input3 = $("<input>").attr("type", "hidden").attr("name", "project_status").val("<?php echo $forward_status; ?>");

                var goforward = $("#poh-form").append($(input1)).append($(input2)).append($(input3));
                goforward.submit();
          }

    });
    
    

</script>