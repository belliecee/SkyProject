 
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
<script> 
    
    $(function(){
        
           
              
              var delurl = '<?php echo $this->createUrl("poh/deletepod"); ?>';
           
           
            $(".del").one('click',function(){
                var theID = $(this).data('id');
                var thepoh =  <?php echo $poh_id; ?> ; //$(this).data('projectID');
              
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
    
 <?php $pod_model = pod::model()->findAll("poh_id=:poh_id",  array(":poh_id"=>$poh_id));   ?>

               
                <table id='pod_table_view' class="table_view1">
                   <thead>
                    <tr  class="table_view1_header">
                      <th class="table_ind" style="max-width:50px;">No.</th>
                      <th class="table_paymentDate" style="min-width:100px;">Vendor</th>
                      <th class="table_paymentDate" style="min-width:100px;">Product</th>
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
                                <td><center><?php echo CHtml::encode(vendor::model()->findByPk($_model->vendor_id)->name); ?></center></td>
                                <td><center><?php echo CHtml::encode(product::model()->findByPk($_model->product_id)->name); ?></center></td>
                                <td><center><?php echo CHtml::encode($_model->qty); ?> </center></td>
                                <td><center><?php echo CHtml::encode($_model->unitPrice); ?> </center></td>
                                <td><center><?php echo ($_model->qty * $_model->unitPrice);?> </center></td>
                               
                               <td><center>
                                    <span id='<?php echo "update_$pod_row" ?>' class="update" data-id='<?php echo $_model->id; ?>' data-poh='<?php echo $_model->poh_id; ?>'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php  if($auth->poh_delete == 1){ ?><span id='<?php echo "delete_$pod_row" ?>' class="del" data-id='<?php echo $_model->id;?>' data-poh='<?php echo $_model->poh_id; ?>' > &nbsp;&nbsp;&nbsp;&nbsp;</span><?php } ?>
                               </center>
                               </td>
                         
</tr>  
<?php
                    }
     
?>                    
 </div>
 

                        
                  </tbody>
                </table>
 
        
        <!------------- TABLE POD ---------------------------------->
        
        
        
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
        
       
      var dialog_form =  "#dialog_form_new";
      var product = $("#product1"),vendor = $("#vendor1"),
      qty = $("#qty1"),
      unitPrice = $("#unitPrice1"),
      allFields = $( [] ).add( vendor ).add( product ).add(qty).add(unitPrice),
      tips = $( ".validateTips" );
      var update_id = 0;
      var opt = $("#opt1");
 
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
      height: 350,
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
                    var tourl;
                   
                    if($("#opt1").val() == 0){ tourl = createurl; }
                    else{ tourl = updateurl; update_id = $("#update_id1").val();  }
                    
                    var vendorValue = vendor.val();
                    var productValue = product.val();
                    var qtyValue= qty.val();
                    var unitPriceValue = unitPrice.val();
                    var poh_id = <?php echo $poh_id?>;
                  
                    $.ajax({
                    url:  tourl,
                    data: {vendor:vendorValue ,product:productValue, qty:qtyValue, unitPrice:unitPriceValue, poh_id:poh_id,id:update_id },
                    type: 'get',
                    dataType: 'html',
                    success:function(data){
                              //alert(data);
                              $("#pod_contain").html(data);
                               $( dialog_form ).dialog( "close" );
                    },
                 
                 error: function() { // if error occured
                                          alert("Error");    
               }
            });

            
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
 

 
    
  
      
    $(".update").click(function(){
                $('#opt1').val('1');
               $("#update_id1").val($(this).data("id"));
               var row_id = "#pod_"+$(this).data("id");
               $("#vendor1").val($(row_id+" td:nth-child(2)").text());
               $("#product1").val($(row_id+" td:nth-child(3)").text());
               $("#qty1").val($(row_id+" td:nth-child(4)").text());
               $("#unitPrice1").val($(row_id+" td:nth-child(5)").text());
               $(dialog_form).dialog( "open" );

    });           
                 
   
          
  });
  </script>
  
  

  
<?php    
        $pod_form = "pod_".$poh_id;
?>  
  
 <div id='dialog_form_new'  title="Add New Item">
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
                <!--
                <input type="text" name='vendor' id='vendor1' class="text ui-widget-content ui-corner-all" />
                -->
                  <select name="vendor" id="vendor1"   class="text ui-widget-content ui-corner-all" style="width:200px">
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
                <br/><br/>
               &nbsp;&nbsp;<span>Product</span>&nbsp;&nbsp;
                
               
                 <select name="product" id="product1"   class="text ui-widget-content ui-corner-all" style="width:200px">
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
                <br/><br/>
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Qty</span>&nbsp;&nbsp;
                <input type="text" name='' id='qty1' class="text ui-widget-content ui-corner-all numberFilter" />
                <br/><br/> 
                 <span>Unit Price</span>&nbsp;&nbsp;
                <input type="text" name='' id='unitPrice1' class="text ui-widget-content ui-corner-all numberFilter" />
                <br/><br/>
               <input type="hidden" name='opt1' id='opt1' class="text ui-widget-content ui-corner-all" />
               
               <input type="hidden" name='update_id' id='update_id1' class="text ui-widget-content ui-corner-all" />
          
              
    
 
 </fieldset>
 <?php $this->endWidget(); ?>
</div>
