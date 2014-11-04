

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
     
<?php 


    //$new_dialog_form = "new_dialog_form_$quoh_id"; 
    $new_dialog_form = "new_dialog_form";
    
    
    
?>

<?php
    
             $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->poh_update == 0){
                  $dis = true;
             }
             else
                  $dis = false;
      
?>

<?php 
        $addItem_quoh_id  = "quoh_$quoh_id";
        $quod_table_view = "quod_table_view_$quoh_id";
        $quod_form = "quod_form_$quoh_id";
        
        $quoh_model = quoh::model()->findByPk($quoh_id);
        $project_model = project::model()->findByPk($quoh_model->project_id);
?>

<?php   $quod_detail = quod::model()->findAll("quoH_id=:quoH_id",array(":quoH_id"=>$quoh_id)); ?>
              
            
                <table  class="table_view1">
                  <thead>
                    <tr class="table_view1_header">
                      <th class="table_vendor" style="min-width:150px;">Vendor</th>
                      <th class="table_vendor" style="min-width:150px;">Model</th>
                       <?php if($project_model->machineType == 2){  ?>  
                            <th class="table_type" style="width:150px;">Type</th>
                      <?php } ?>
                      <th class="table_qty" style="min-width:100px;">Quantity</th>
                      <th class="table_unitprice" style="min-width:100px;">Unit Price</th>
                      <th class="table_total" style="min-width:100px;">Total</th>
                      <th class="table_operation" style="width:70px;"> </th>
                    </tr>
                  </thead>
                
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
                                 <?php }  ?>
                                <td><center><?php echo CHtml::encode($detail->qty); ?></center></td>
                                <td><center><?php echo CHtml::encode($detail->unitPrice); ?></center></td>
                               <td><center><?php echo CHtml::encode($detail->qty * $detail->unitPrice); ?></center></td>
                               <td>&nbsp;<span id='<?php echo "new_update_$quod_row" ?>' class="new_update_quod" data-hidden="true" data-quohid='<?php echo $quoh_id; ?>' data-id='<?php echo $detail->id; ?>'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php  if($auth->quoh_delete == 1){ ?><span id='<?php echo "delete_$quod_row" ?>' data-quohid='<?php echo $quoh_id; ?>' class="delete_quod" data-id='<?php echo $detail->id;?>'  >&nbsp;&nbsp;&nbsp;&nbsp;</span><?php } ?></td>
                            </tr>
                   <?php } ?>
                 
                  </tbody>
                  
                </table>
             
           <?php $i++; ?>    
<?php 

/************************ AJAX PART ***************************************/
?>

<script> 
    
    $(function(){
          
           
     /*    
          $("#new_vendor_id").keyup(function(){
               ajaxautocomplete($("#new_vendor_id"),"vendor");
                
          });
          $("#new_product_id").keyup(function(){
               ajaxautocomplete($("#new_product_id"),"product");
                
          });
    */      
          function ajaxautocomplete(idname,table){
              var availableTags =   [""];
              $.ajax({
                    url: '<?php echo $this->createUrl('quoh/autocomplete'); ?>',
                    dataType: "json",
                    data: { inputtext:idname.val(),table:table},
                    success: function (response) {
                        availableTags = response.res;
                        idname.autocomplete({
                                source: availableTags
                        }); 
  
                    },
                    error: function() { // if error occured
                                  alert("GET FROM AUTOCOMPLETE Error  occured.please try again");    
                   }
              });
              
          }
          ajaxautocomplete($("#new_vendor_id"),"vendor");
          ajaxautocomplete($("#new_product_id"),"product");
          ajaxautocomplete($("#new_type_id"),"type");
           
    });
</script>

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
      vendor = $("#new_vendor_id"),
      product = $("#new_product_id"),
      type = $("#new_type_id"),
      qty = $("#new_qty"),
      unitPrice = $("#new_unitPrice"),
      allFields = $( [] ).add( vendor ).add( product ).add( type ).add( qty ).add( unitPrice ),
      tips = $( ".validateTips" );
      
      var new_dialog_form = "#new_dialog_form"; //+'<?php // echo $new_dialog_form;?>';
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

   
    $(new_dialog_form).dialog({
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
 
          if (vendor.val()!= "" && product.val()!= "" && type.val()!= "" && qty.val()!= "" && unitPrice.val()!= "") {
  /*            
            $( "#users tbody" ).append( "<tr>" +
              "<td>" + name.val() + "</td>" +
              "<td>" + email.val() + "</td>" +
              "<td>" + password.val() + "</td>" +
            "</tr>" ); 
*/


           
            var tourl='<?php echo $this->createUrl("quoh/saveQuod"); ?>'; 
            if($("#opt1").val() == 0){
                 update_id = 0;
                 quoh_id = $('#new_quoh_id').val();
            }else{
                update_id = $("#new_update_id").val();
                quoh_id = $('#new_quoh_id').val();
            }
               
                             
           
           
           
            var  js_product =  '#new_product_id';
            var  js_vendor =  "#new_vendor_id";
            var  js_type =  "#new_type_id";
            var  js_qty =  "#new_qty";
            var  js_unitPrice =  "#new_unitPrice";
            
            
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
             //alert(showquod);  
            $.ajax({
                    url:  tourl,
                    data: {vendor:vendorValue,product:productValue,type:typeValue,qty:qtyValue,unitprice:unitPriceValue,quoh_id:quoh_id,update_id:update_id},
                    type: 'get',
                    dataType: 'html',
                    success:function(data){
                        //alert(update_id);
                        $(quod_table_view).html(data);   
                   
                   
                              $( this ).dialog( "close" );
                                 allFields.val( "" ).removeClass( "ui-state-error" );
                                  
                            },
                 error: function() { // if error occured
                                          alert("Add Quod Error: "+tourl);    
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
      }
    });
    /*****************       OTHER ADD   ***************/
    var     add_an_item = '<?php echo "#$addItem_quoh_id"; ?>';
    
    $('.new_update_quod').click(function(){
          
            update_id = $(this).data("id");
            quoh_id = $(this).data('quohid');
            //alert(update_id+"  "+quoh_id );
         
            var row_id = "#quod_"+update_id;
           // alert($(row_id+" td:nth-child(3)").text());
            var vendor_update = '#new_vendor_id'; 
            var product_update = "#new_product_id"; 
             var type_update = "#new_type_id"; 
            var qty_update = "#new_qty"; 
            var unitPrice_update = "#new_unitPrice"; 
            var machinetype = '<?php  echo $project_model->machineType ?>';
            $("#new_update_id").val(update_id);
            $("#new_quoh_id").val(quoh_id);
            
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
            
            $("#opt1").val('1');
           
            $("#new_dialog_form").dialog( "open" );
            
        
         
    });
/*    
    $(add_an_item)
      .button()
      .click(function() { 
        quoh_id = $(this).data('quohid');
        //alert(quoh_id);
        $('#quoh_id').val(quoh_id);
        $("#opt").val('0');
        
        allFields.val( "" ).removeClass( "ui-state-error" );
        $("#new_dialog_form").dialog( "open" );
        
        
        
        
      });
   
*/      
    
        
  });
  </script>
  
  
  <!---------------------   DIALOG  ---------------------------->
  
  <div id='new_dialog_form'  title="Add New Item">
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
      
               <input type="hidden" id="opt1"/>
               <input type="hidden" id="new_quoh_id" />
               <input type="hidden" id='new_update_id' />
               &nbsp;<span>Vendor </span>&nbsp;&nbsp;
                <input type="text" name='vendor_id' id='new_vendor_id' class="text ui-widget-content ui-corner-all " />
                <br/><br/>
                
                &nbsp; &nbsp;<span>Model </span>&nbsp;&nbsp;
              
                    <input type="text" name='product_id' id='new_product_id' class="text ui-widget-content ui-corner-all "  />
              
               <?php if($project_model->machineType == 2){  ?>       
               <br/><br/>
            
                &nbsp; &nbsp;<span>Type </span>&nbsp;&nbsp;
             
                    <input type="text" name='type_id' id='new_type_id' class="text ui-widget-content ui-corner-all "  />
             <?php }else{  ?>
                     <input type="hidden" name='type_id' id='new_type_id' value='0'  />
              <?php }  ?>
               <br/><br/>
                
                <span>Quantity</span>&nbsp;&nbsp;
                <input type="text" name='qty' id='new_qty' class="text ui-widget-content ui-corner-all numberFilter" />
                <br/><br/>  
                
                <span>Unit Price</span>&nbsp;
                <input type="text" name='unitPrice' id='new_unitPrice' class="text ui-widget-content ui-corner-all numberFilter" />
		
                <br/><br/> 
                <?php //echo $form->hiddenField($quod_model,'quoh_id',array('id'=>'quoh_id','class'=>"text ui-widget-content ui-corner-all",'value'=>$model->id,)); ?>
		<?php //echo $form->error($quod_model,'quoh_id'); ?>
                
    
 
 </fieldset>
 <?php $this->endWidget(); ?>
</div>
  
  
  
  <script> 
    
    $(function(){
             var delurl = '<?php echo $this->createUrl("quoh/deleteQuod"); ?>';
            
            $(".delete_quod").one('click',function(){
                var click_row = $(this).parent().parent().attr('id');
                var quod_ID = $(this).data('id');
                $("#".concat(click_row)).hide('fast');
                    
                
                   $.ajax({
                            url: delurl,
                            data: {id:quod_ID},
                            type: 'get',
                           
                            error: function() { // if error occured
                                  alert("Delete Quod Error  occured.please try again");    
                             }
                     }); 
                                    
            });
          
           
            
    });
</script>                     

  
<!---------------------   DIALOG  ---------------------------->

  
  
  
  