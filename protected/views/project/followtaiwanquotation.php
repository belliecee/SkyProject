<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>


<script>
    
    $(function(){
        $('.inputtext').keypress(function(e){
            if(e.which == 13)
                $("#twq").submit();
        });
        
         $('#search').click(function(){
                $("#twq").submit();
        });
        
        function ajaxautocomplete(idname,table){
              var availableTags =   [""];
              $.ajax({
                    url: '<?php echo $this->createUrl('project/autocomplete'); ?>',
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
          ajaxautocomplete($("#vendor"),"vendor"); 
          ajaxautocomplete($("#product"),"product"); 
           
    });
</script>


<br/><br/>
<div class="other_header" style="margin-top:-32px;">
<?php  
     //$project_model = project::model()->findByPk($project_id);
     //$this->renderPartial('//project/_form',array('model'=>$project_model)); 
?>    
</div>
<div class="index_content" style=" margin: 0 0 20px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 70px 0 0;width:1000px; min-height: 500px;">

    
    
    
<!------------------ The Button for add an ITEM  ------------------->

 

<div class="title2" style="border-bottom: none;">Follow Taiwan Quotation</div>
<div class="bottomline"></div>
<!--------------------------- Start Table ----------------------------------------->
 <div id="search" class="simple_button" style="display: inline-block;float: right;" disabled ="">Search</div>
<br/><br/>
<div class="form">
<?php $deposit_model = new deposit; ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deposit-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($deposit_model); ?>

	
<?php
/*

        <div class="row">
            &nbsp;&nbsp;&nbsp;<b>Date</b>&nbsp;&nbsp;
		<?php echo $form->textField($deposit_model,'date'); ?>
		<?php echo $form->error($deposit_model,'date'); ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<b>Amount</b>&nbsp;&nbsp;
		<?php echo $form->textField($deposit_model,'amount'); ?>
		<?php echo $form->error($deposit_model,'amount'); ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php echo CHtml::submitButton('Save',array('class'=>'simple_button','style'=>'float:right;')); ?>
	</div>

*/
 ?>

<?php $this->endWidget(); ?>

</div>    
    
    
<div id="show-contain" class="ui-widget" style="margin:40px 0 0 50px;">


  
   
       
          
                <table id='payment_table_view' class="table_view1">
                  <thead>
                    <tr  class="table_view1_header">
                     
                      <th style="min-width:50px;">Project No.</th>
                      <th style="min-width:70px;">Enquiry Date</th>
                     
                      <th style="min-width:70px;">Customer</th>
                       <th style="min-width:70px;">Product</th>
                      <th style="min-width:70px;">Vendor</th>
                    
                      
                    </tr>
                    <tr  class="table_view1_header" style="height:20px;">
                      <div class="form"> 
                      <form id="twq" method="POST">
                        <th style="min-width:50px; background-color:white; "><input type="text" name="projectNo"  style="width:100%;height:20px; "class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" name="enquiryDate" style="width:100%;height:20px; "class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" id="customer" name="customer" style="width:100%; height:20px;" class="inputtext"/></th>  
                      <th style="min-width:50px; background-color:white; "><input type="text" id="product" name="product" style="width:100%;height:20px; " class="inputtext"/></th> 
                       <th style="min-width:50px; background-color:white; "><input type="text" id="vendor"   name="vendor" style="width:100%; height:20px;" class="inputtext"/></th>  
                     </form>
                     
                      </div>
                    </tr>
                  </thead>
                  <tbody>
<?php 
//  LOAD QUOD
// Find project parameters

/*
                $criteria = new CDbCriteria();
                $criteria->condition = "id=:id";
                $criteria->params = array(":id"=>505);
                
                
                
                $quod_model = quod::model()->findAll();
 * 
 */
            
               $con = "WHERE sky1_project.mcstatus LIKE 'Send Enquiry to Vendor'";
               $con =  "$con and sky1_project.projectNo LIKE '%$projectNo%' ";
               
                if($enquiryDate != "")
                {
                            if($enquiryDate != null){
                                $explodeStr = explode("/",$enquiryDate);
                                $newDate = ""; 
                                $count = 0;
                                foreach($explodeStr as $eachStr){
                                    if($count == 0)
                                        $newDate = $newDate.$eachStr;
                                    else
                                        $newDate = $eachStr."-".$newDate;
                                    $count++;
                                }
                                $enquiryDate = date("Y-m-d", strtotime($newDate));
                                 $con =    "$con and sky1_enquiry.date = '$enquiryDate' and  sky1_enquiry.date != '' ";
                            }else{
                                $enquiryDate = null;
                        }
                }
             
                if($customer != "")
                    $con =    "$con and sky1_customer.name LIKE '$customer' ";
                if($product != "")
                    $con =    "$con and sky1_enquiry.product LIKE '$product' ";
               if($vendor != "")
                    $con =    "$con and sky1_vendor.name LIKE '$vendor' ";
                                   
                              ;

                $sql   =   "
                            SELECT 
                            sky1_project.id project_id,
                            sky1_project.projectNo, 
                            sky1_project.machinetype,
                            sky1_project.status,
                            sky1_enquiry.customer customer_id,
                            sky1_enquiry.date enquiryDate,
                            sky1_vendorprocess.vendor_id,
                            sky1_enquiry.product
                            
                           


                            from sky1_project

                            JOIN sky1_enquiry
                            ON sky1_project.id = sky1_enquiry.project_id
                            JOIN sky1_vendorprocess
                            ON sky1_project.id = sky1_vendorprocess.project_id
                            LEFT JOIN sky1_vendor
                            ON sky1_vendor.id = sky1_vendorprocess.vendor_id
                           
                            LEFT JOIN sky1_customer
                            ON sky1_customer.id = sky1_enquiry.customer
                            
                             $con
                                    
                              ORDER BY sky1_project.id DESC

                            ;

                              ";
                $rowNo = 0;
                
                $rows = Yii::app()->db->createCommand($sql)->queryAll();
                foreach($rows as $row)
                {
                        
                    

 ?>
             
             <?php 
             
                     if($row['enquiryDate'] != null){
                        if($row['enquiryDate'] != null){
                            $row['enquiryDate'] = date("d/m/Y", strtotime($row['enquiryDate']));
                        }else{
                            $row['enquiryDate'] = "";
                        }
                     }
                  
              ?>


                               <tr class="table_tr_quod" >
                               
                                <td><center><?php echo CHtml::link($row['projectNo'],array('enquiry/index','project_id'=>$row['project_id']));  ?></center></td>
                                 <td><center><?php echo $row['enquiryDate']; ?></center></td>
                               
                                   <td><center><?php if(customer::model()->findByPk($row['customer_id'])) echo customer::model()->findByPk($row['customer_id'])->name; ?></center></td>
                                 <td><center><?php echo $row['product']; ?></center></td>
                                  <td><center><?php if(vendor::model()->findByPk($row['vendor_id'])) echo vendor::model()->findByPk($row['vendor_id'])->name; ?></center></td>
                                 
                              
                               
                              
                               
                  

                               </tr>  
               

 <?php
            }
?> 

                        
                  </tbody>
                </table>