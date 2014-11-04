<?php
/* @var $this EnquiryController */
/* @var $model enquiry */
/* @var $form CActiveForm */
?>
<script type="text/javascript">
    
    $(function(){
              
         $('#qty1').attr('disabled',true);
         $('#product1').attr('disabled',true);
         $("#addnewbutton").click(function(){
                 
                    $(this).hide();
                    $("#additem").slideDown('slow');
                    $('#qty1').attr('disabled',false);
                    $('#product1').attr('disabled',false);

                
         });
         $("#addbutton").click(function(){
                   if($("#product1").val() == '' || $("#qty1").val() == '')
                    {

                         var msg = "โปรดใส่ข้อมูลดังรายการข้างล่าง อย่าเว้นว่างไว้ \n\n";
                        
                         $("#qty1").val() == ''? msg = msg  + "● Qty\n" : msg = msg;
                         $("#product1").val() == ''? msg = msg  + "● Product\n" : msg = msg;
                         alert(msg);
                    }
                    else{
                         
                          
                         $("#enquiry-form").submit();
                    }
         });
         $("#canceladd").click(function(){
                $("#additem").hide();
                $('#qty1').val('');
                $('#product1').val('');
                $('#qty1').attr('disabled',true);
                $('#product1').attr('disabled',true);
                $("#addnewbutton").show();
         });
         
         $('.del').one('click',function(){
               
                var productid = $(this).data("id");
                 $.ajax({
                    url: '<?php echo $this->createUrl('enquiry/deleteproduct'); ?>',
                    
                    data: { id:productid
                    },
                    success: function () {
                       var productrow = $("#row_"+productid);
                       
                       $("#enquiry-form").submit();
                       
                         
  
                    }
              });
                 alert(productform);
                $(productform).submit();
        });
           
    });
</script>



<?php

       
        
        if($project_model->status  <= 1 )
        {
            $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->enquiry_update == 0){
                  $dis = true;
             }
             else
                  $dis = false;
        }
        else
        {
            $dis = true;
        }
        $project_id = $project_model->id;
        
        $load_customer = customer::model()->findAll();
        $cu = count($load_customer);
        
?>

<?php

         if($model->isstock == null){
             $model->isstock = 1;
         }

?>

<script> 
    
    $(function(){
          
       $(".overlay").hide();   
       $( ".overlay" ).progressbar({
                value: false
         });
       var isstock = '<?php echo $model->isstock; ?>'
       //alert('isstock = '+isstock);
       if(isstock == 1)
       {
          $("#changetype").attr('checked', false);
           $("#changetype").val('1');
         
       }else{
            $("#changetype").attr('checked', true);
             $("#changetype").val('2');
            
       }
      
          
          function ajaxautocomplete(idname,table){
   /*           
              var i;
              var n ;
              
              n = '<?php // echo $cu; ?>';
              var availableTags =   [""];
              for(i=0;i<n;i++)
              {
                    <?php // $i=0; ?>;
                    availableTags = [availableTags,'<?php // echo $load_customer[$i++]->name; ?>'];
                    
              }
     */         
               idname.autocomplete({
                                source: availableTags
                     });
        
              $.ajax({
                    url: '<?php echo $this->createUrl('enquiry/autocomplete'); ?>',
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
          ajaxautocomplete($("#customer"),"customer");
          ajaxautocomplete($("#product1"),"productenquiry");
          
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



<script>
    $(function(){
        function saveajax(quoh_id,fieldname,fieldvalue){
             var savefieldurl = '<?php echo $this->createUrl("enquiry/savefield"); ?>';
              $.ajax({
                                    url: savefieldurl,
                                    data: {id:quoh_id,fieldname:fieldname,fieldvalue:fieldvalue},
                                    type: 'get',
                                    beforeSend: function(){
                                                  $(".overlay").show();$("#changetype").attr("disabled",true);$(".simple_button").attr("disabled",true);
                                                   
                                          },
                                    success: function(){
                                                   $(".overlay").hide();$("#changetype").attr("disabled",false);$(".simple_button").attr("disabled",false);
                                                
                                       }
                                    /*,                                  
                                    error: function() { // if error occured
                                          alert("Error: Add Quotation  occured.please try again");    
                                     }
        */
                }); 
            
        }
        $("#changetype").change(function(){
              if($(this).is(':checked')){
                  $(this).val('2');
                  
            
                            
              }else
              {
                   $(this).val('1');
                   
                                  
              }
             
             saveajax($(this).data('id'),"isstock",$(this).val())
                  
                         
       });
        
  
     });
 </script>

<div class="title2" style="border-bottom: none;">Enquiry </div>
<div class="bottomline"></div>
<br/><br/>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'enquiry-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

      
        
	<div class="row">
            
            <?php if($project_model->machineType != 3){ ?>
		<b>Customer : </b>&nbsp;
                <?php
                         if($model->customer != null)
                            $model->customerstr = customer::model()->findByPk($model->customer)->name;
                ?>
		<?php echo $form->textField($model,'customerstr',array('id'=>"customer",'size'=>20,'maxlength'=>64,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'customerstr'); ?>
             
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php }
       
        else{  
        ?>
             <div class="row">
             <?php
                       if(vendor::model()->findByPk($model->customer) != null)
                          $model->vendorstr = vendor::model()->findByPk($model->customer)->name; 
                          
                ?>
                 <b>Vendor :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
		<?php 
                       
                     echo $form->textField($model,'vendorstr',array('id'=>'vendor','size'=>20,'maxlength'=>64,'disabled'=>$dis));
                       
                 ?>
		<?php echo $form->error($model,'vendorstr'); ?>
	</div>
        
        <?php }  ?>
 
        
         <?php 
                    
                        if($model->date != null){
                            $model->date = date("d/m/Y", strtotime($model->date));
                        }else{
                            $model->date = "";
                        }
                  
        ?>   
		<b><?php echo "Enquiry Date  : "; ?></b>&nbsp;
		<?php echo $form->textField($model,'date',array('id'=>'enquirydate', 'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'date'); ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
        <?php if($project_model->machineType != 3){  ?>
                <div class="row">
                        <b><?php echo "Contact person/tel : "; ?></b><br/>
                        <?php echo $form->textField($model,'contact',array('id'=>'contact','size'=>64,'maxlength'=>256,'disabled'=>$dis)); ?>
                        <?php echo $form->error($model,'contact'); ?>
                </div>
        <?php  }  ?>
	<div class="row">
		<b><?php echo "Remark"; ?></b><br/>
		<?php echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50,'disabled'=>$dis)); ?>
		<?php echo $form->error($model,'remark'); ?>
	</div>

	<div class="row">
		<b><?php echo "Product : "; ?></b><br/>
                
		<?php
                         $i = 0;
                         if($project_model->machineType == 3){
                             
                ?>                     
                                <div id='table' class="ui-widget">
                                        <table  class="table_view1" style="width:800px">
                                          <thead>
                                            <tr class="table_view1_header">
                                              <th class="table_vendor" style="width:200px;">No.</th>
                                              <th class="table_vendor" style="width:400px;">Product</th>
                                              <th class="table_vendor" style="width:100px;">Qty</th>
                                              <th class="table_operation" style="width:100px;"> </th>
                                            </tr>
                                          </thead> 
                                          <tbody>
                                          
                                                   <?php// $i = 1; ?>  
                                                   <?php $allproduct = productenquiry::model()->findAll("project_id=:project_id",array(":project_id"=>$project_model->id)); ?> 
                                                   <?php  if($allproduct != null){ ?>
                                                            <?php  foreach($allproduct as $detail){ ?>
                                                             <?php //$quod_row = "quod_$detail->id"; ?>
                                                                  <tr id='<?php echo "row_".$detail->id; ?>'>

                                                                         <td><center><?php echo ++$i."."; ?></center></td>
                                                                         <td><center><?php echo $detail->name; ?></center></td>
                                                                         <td><center><?php echo $detail->qty; ?></center></td>


                                                                        <td><center><?php if($dis == false){?>  &nbsp;&nbsp;&nbsp;<span id='<?php echo "delete_$detail->id" ?>' data-id='<?php echo $detail->id; ?>' class="del" data-id='<?php echo $detail->id;?>'  >&nbsp;&nbsp;&nbsp;&nbsp;</span> <?php } ?></center></td>
                                                                 
                                        <form id='<?php echo 'deleteproduct_'.$detail->id; ?>'>
                                                                             <input  type="hidden" name='deleteproduct' value='<?php echo $detail->id; ?>' />
                                        </form>                            
                                                                 </tr>
                                           <?php          }             
                                                   }
                                           ?>
                                                                 
                                                <tr id="additem" style="display:none">

                                                       <td><center><?php echo ++$i."."; ?></center></td>
                                                       <?php  if($dis == false){  ?>
                                                            <td><center><input id="product1" name='product' class="inputtext"  style="width: 270px" /></center></td>
                                                            <td><center><input id="qty1" name='qty' class="inputtext"   style="width: 100px" /></center></td>
                                                       <?php }else{ ?>
                                                                <td><center><input id="product1" name='product' class="inputtext"  style="width: 270px" disabled="disabled"/></center></td>
                                                            <td><center><input id="qty1" name='qty' class="inputtext"   style="width: 100px" disabled="disabled" /></center></td>
                                                      <?php } ?>

                                                      <td><?php if($dis == false){?> <span id="addbutton" style="color:blue;font-size:12px; cursor:pointer;">Save</span>/<span id="canceladd" style="color:blue;font-size:12px; cursor:pointer;">Cancel</span>   <?php } ?></td>
                                                </tr>
                                            </form>
                                          </tbody>
                                         </table>
                                   </div>
                <?php
                           
                         }
                         else{
                                echo $form->textField($model,'product',array('id'=>'product','size'=>60,'maxlength'=>64,'disabled'=>$dis));
                                echo $form->error($model,'product');
                         }
                ?>
                <?php if($dis == false && $project_model->machineType == 3) { ?>
                    <div id="addnewbutton" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;">Add a product</div>
                <?php } ?>
        </div>
        <?php if ($project_model->machineType  != 2){ ?>
         <div class="row" style="margin-bottom:20px;">
         
                <?php if ($project_model->machineType  == 1) echo "<b style='font-size:14px;'>Exist in stock  : </b>"; 
                      else echo "<b style='font-size:14px;'>ไม่ต้องขอราคาไต้หวัน  : </b>";
                ?>&nbsp;
                <?php if($project_model->status == 1){ ?>
                    <input type="checkbox" id="changetype" data-id='<?php echo $model->id; ?>' style='margin:0;padding:0;width:10px;'  />
                <?php }else{ ?>
                    <input type="checkbox" id="changetype" data-id='<?php echo $model->id; ?>' style='margin:0;padding:0;width:10px;' disabled="disabled"/>    
               <?php  } ?>
             
		<?php echo $form->error($model,'isstock'); ?>
         </div>
    
    <?php } ?>


<?php 
/*        
	<div class="row">
		<?php echo $form->labelEx($model,'create_on'); ?>
		<?php echo $form->textField($model,'create_on'); ?>
		<?php echo $form->error($model,'create_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_by'); ?>
		<?php echo $form->textField($model,'create_by',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'create_by'); ?>
	</div>

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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('id'=>'saveenquiry','class'=>'simple_button','disabled'=>$dis)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<div class="operation_footer" style=" position:relative ;margin: 10px 0 0 0; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 50px 0 0;width:1020px;height:50px">
 <div class="overlay"> </div> <!--  END OF OVERLAY  -->
<?php
     
        if($project_model->machineType == 1){
            if($model->isstock == 2){
                $forward_direction = "quoh"; $forward_status = 4;
            }
            else{
                $forward_direction = "vendorprocess"; $forward_status = 2;
            }
        }
        else if($project_model->machineType == 2){
            $forward_direction = "quoh"; $forward_status = 5;
        }else
        {
 
             if($project_model->existInStock == 2){
                $forward_direction = "delivery"; $forward_status = 12;
            }
            else{
                $forward_direction = "vendorprocess"; $forward_status = 2;
            }
        }    
  
       $backward_direction = "enquiry"; $backward_status = 1;
       
     
       
   /* ******************************************************  */    
 
  if($dis == false){
      if($project_model->status == 17)
            echo CHtml::link("<div id='activate' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'>Activate</div>",array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=>"enquiry",'project_status'=>1));
      else
          echo CHtml::link("<div id='cancel' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Cancel</div>",array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=>"enquiry",'project_status'=>17));
      
     
       echo CHtml::link("<div id='cancel' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Delete</div>",array("project/remove",'id'=>$project_model->id),array('confirm'=>'Are you sure to delete project?'));
       
      echo CHtml::link('<div id="reject" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;"> Back</div>',array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=> $backward_direction,'project_status'=>$backward_status));
  
      echo /*CHtml::link(*/'<div id="submit" class="simple_button savebutton" style="float: right;margin-top:10px; margin-right: 10px;">Submit</div>';//,array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=> $forward_direction,'project_status'=>$forward_status));
  }else{
       if($project_model->status == 17)
           echo CHtml::link("<div id='activate' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'>Activate</div>",array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=>"enquiry",'project_status'=>1));
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
         
         var machineType; machineType = '<?php echo $project_model->machineType ; ?>';
       
          if(machineType == '1'){
                        if($('#changetype').val() == '2')
                        {  
                             $('#redirect').val('quoh'); $('#project_status').val('4');
                             
                        }else{
                             $('#redirect').val('vendorprocess'); $('#project_status').val('2');
                            
                        }
                }
                else if(machineType == '2'){
                    
                        $('#redirect').val('quoh'); $('#project_status').val('4');
                      
                }
                else {
                     if($('#changetype').val() == '2')
                        {
                                $('#redirect').val('pOtovendor'); $('#project_status').val('8');
                                
                        }else{
                               $('#redirect').val('vendorprocess'); $('#project_status').val('2');
                               
                        }
                }
          if($("#customer").val() == '' || $("#enquirydate").val() == '' || $("#contact").val() == '' || $("#product").val() == '' || $("#vendor").val() == '' )
          {
              
               var msg = "โปรดใส่ข้อมูลดังรายการข้างล่าง อย่าเว้นว่างไว้ \n\n";
               $("#customer").val() == ''? msg = msg  + "● Customer\n": msg = msg ;
               $("#vendor").val() == ''? msg = msg  + "● Vendor\n": msg = msg ;
               $("#enquirydate").val() == ''? msg = msg  + "● Enquiry Date\n" : msg = msg;
               $("#contact").val() == ''? msg = msg  + "● Contact\n": msg = msg ;
               $("#product").val() == ''? msg = msg  + "● Product\n" : msg = msg;
              
               alert(msg);
          }
          else{
                var input1 = $("<input>").attr("type", "hidden").attr("name", "project_id").attr("id", "project_id").val('<?php echo $project_model->id; ?>');
                var input2 = $("<input>").attr("type", "hidden").attr("name", "redirect").attr("id", "project_id").val($('#redirect').val());
                var input3 = $("<input>").attr("type", "hidden").attr("name", "project_status").attr("id", "project_id").val($('#project_status').val());
                
                

                var goforward = $("#enquiry-form").append($(input1)).append($(input2)).append($(input3));
               goforward.submit();
          }

    });
    
    

</script>
  