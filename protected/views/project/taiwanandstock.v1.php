<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>




<script>
    
    $(function(){
        $('.inputtext').keypress(function(e){
            if(e.which == 13)
                $("#taiwanandstock").submit();
        });
        
         $('#search').click(function(){
                $("#taiwanandstock").submit();
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

 

<div class="title2" style="border-bottom: none;">Taiwan-Order & Stock</div>
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

<?php 

          
        $quod = quod::model()->findAll();



?>
  
   
       
          
                <table id='payment_table_view' class="table_view1">
                  <thead>
                    <tr  class="table_view1_header">
                      <th style="min-width:50px;">Project No.</th>
                      <th style="min-width:100px;">Customer</th>
                      <th style="min-width:100px;">Vendor</th>
                      <th style="min-width:100px;">Model</th>
                       <th style="min-width:100px;">Qty</th>
                      <th style="min-width:100px;">Po to <br/>Vendor Date</th>
                      <th style="min-width:100px;">Due Vendor<br/> Date</th>
                      <th style="min-width:100px;">Due Customer<br/> Date</th>
                      
                    </tr>
                    <tr  class="table_view1_header" style="height:20px;">
                      <div class="form" > 
                      <form id="taiwanandstock" method="POST">
                       <th style="min-width:50px; background-color:white; "><input type="text" name="projectNo" style="width:100%; height:20px;" class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" id="customer" name="customer"  style="width:100%;height:20px; "class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" id="vendor" name="vendor" style="width:100%;height:20px; "class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" id="product" name="product" style="width:100%; height:20px;" class="inputtext"/></th>  
                      <th style="min-width:50px; background-color:white; "></th> 
                       <th style="min-width:50px; background-color:white; "><input type="text" name="potovendordate" style="width:100%; height:20px;" class="inputtext"/></th>  
                      <th style="min-width:50px; background-color:white; "><input type="text" name="duevendordate" style="width:100%;height:20px; " class="inputtext"/></th>    
                         <th style="min-width:50px; background-color:white; "><input type="text" name="duecustomerdate" style="width:100%; height:20px;" class="inputtext"/></th>  
                      
                          
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
              $con = "";

                 $con = "  WHERE ((sky1_project.mcstatus LIKE '%PO to Vendor%' AND sky1_project.machineType = 1) OR (sky1_project.mcstatus LIKE '%PO to Vendor%' AND sky1_project.machineType = 3))";
                //$con =  "WHERE $con  sky1_project.mcstatus LIKE '%PO to Vendor%'";
                $con =  "$con and sky1_project.projectNo LIKE '%$projectNo%' ";
                
                   if($vendor != "")
                    $con =    "$con and sky1_vendor.name LIKE '%$vendor%' ";
                   if($customer != "")
                    $con =    "$con and sky1_customer.name LIKE '%$customer%' ";
                   if($product != "")
                    $con =    "$con and sky1_product.name LIKE '%$product%' ";
                   
                   
                     if($potovendordate != "")
                {
                            if($potovendordate != null){
                                $explodeStr = explode("/",$potovendordate);
                                $newDate = ""; 
                                $count = 0;
                                foreach($explodeStr as $eachStr){
                                    if($count == 0)
                                        $newDate = $newDate.$eachStr;
                                    else
                                        $newDate = $eachStr."-".$newDate;
                                    $count++;
                                }
                                $potovendordate = date("Y-m-d", strtotime($newDate));
                                 $con =    "$con and sky1_potovendor.orderDate = '$potovendordate'  "; 
                            }else{
                                $potovendordate = null;
                        }
                }
                if($duevendordate != "")
                {
                            if($duevendordate != null){
                                $explodeStr = explode("/",$duevendordate);
                                $newDate = ""; 
                                $count = 0;
                                foreach($explodeStr as $eachStr){
                                    if($count == 0)
                                        $newDate = $newDate.$eachStr;
                                    else
                                        $newDate = $eachStr."-".$newDate;
                                    $count++;
                                }
                                $duevendordate = date("Y-m-d", strtotime($newDate));
                                 $con =    "$con and sky1_potovendor.vendorDeliveryDate = '$duevendordate'  "; 
                            }else{
                                $duevendordate = null;
                        }
                }
                if($duecustomerdate != "")
                {
                            if($duecustomerdate != null){
                                $explodeStr = explode("/",$duecustomerdate);
                                $newDate = ""; 
                                $count = 0;
                                foreach($explodeStr as $eachStr){
                                    if($count == 0)
                                        $newDate = $newDate.$eachStr;
                                    else
                                        $newDate = $eachStr."-".$newDate;
                                    $count++;
                                }
                                $duecustomerdate = date("Y-m-d", strtotime($newDate));
                                 $con =    "$con and sky1_deposit.customerDeliveryDate = '$duecustomerdate'  "; 
                            }else{
                                $duecustomerdate = null;
                        }
                }
            
                 

                $sql   =   "
                            SELECT 
                            sky1_project.id, 
                            sky1_project.projectNo, 
                            sky1_enquiry.customer,
                            sky1_customer.id customer_id,
                            sky1_customer.name,
                            sky1_pod.product_id,
                            sky1_pod.vendor_id,
                            sky1_vendor.name,
                            sky1_pod.qty podqty,
                            sky1_product.name productname,
                            sky1_potovendor.orderDate,
                            sky1_potovendor.vendorDeliveryDate,
                            sky1_deposit.customerDeliveryDate
                            
                            from sky1_project
                            
                            JOIN sky1_enquiry
                            ON sky1_project.id = sky1_enquiry.project_id
                            
                           LEFT JOIN sky1_customer
                           ON  sky1_enquiry.customer = sky1_customer.id
                           
                            
                            LEFT JOIN sky1_potovendor
                            ON sky1_project.id = sky1_potovendor.project_id
                            
                            LEFT JOIN sky1_deposit
                            ON sky1_project.id = sky1_deposit.project_id
    
                           
                            
                            JOIN sky1_poh
                            ON sky1_project.id = sky1_poh.project_id


                            JOIN sky1_pod
                            ON sky1_pod.poh_id = sky1_poh.id
                            LEFT JOIN sky1_vendor
                            ON sky1_vendor.id = sky1_pod.vendor_id
                            
                             LEFT JOIN sky1_product
                            ON sky1_product.id = sky1_pod.product_id
                            
                          
                            
                            $con
                           
                          ORDER BY sky1_project.id ASC, sky1_pod.id ASC
                            ;
                              ";
               
                
                $rows = Yii::app()->db->createCommand($sql)->queryAll();
                foreach($rows as $row)
                {
                        
                    

 ?>
             <?php 
                    
                     if($row['orderDate'] != null){
                            $row['orderDate'] = date("d/m/Y", strtotime($row['orderDate']));
                        }else{
                            $row['orderDate'] = "";
                        }
                   
              ?>
             <?php 
                     if($row['vendorDeliveryDate'] != null){
                            $row['vendorDeliveryDate'] = date("d/m/Y", strtotime($row['vendorDeliveryDate']));
                        }else{
                            $row['vendorDeliveryDate'] = "";
                        }
                   
              ?>
              <?php 
              
                    if($row['customerDeliveryDate'] != null){
                            $row['customerDeliveryDate'] = date("d/m/Y", strtotime($row['customerDeliveryDate']));
                        }else{
                            $row['customerDeliveryDate'] = "";
                        }
                   
              ?>
       


                               <tr class="table_tr_quod" >
                
                                <td><center><?php echo CHtml::link($row['projectNo'],array('poh/index','project_id'=>$row['id']));  ?></center></td>
                                <td><center><?php if(customer::model()->findByPk($row['customer_id']) != null) echo customer::model()->findByPk($row['customer_id'])->name; ?></center></td>
                                <td><center><?php if(vendor::model()->findByPk($row['vendor_id']) != null) echo vendor::model()->findByPk($row['vendor_id'])->name; ?></center></td>
                                <td><center><?php if(product::model()->findByPk($row['product_id']) != null) echo product::model()->findByPk($row['product_id'])->name; ?></center></td>                
                                <td><center><?php echo $row['podqty']; ?></center></td>
                                <td><center><?php echo $row['orderDate']; ?></center></td>
                                <td><center><?php echo $row['vendorDeliveryDate']; ?></center></td>
                                <td><center><?php echo $row['customerDeliveryDate']; ?></center></td>
                               </tr>  
               

 <?php
            }
?> 

                        
                  </tbody>
                </table>