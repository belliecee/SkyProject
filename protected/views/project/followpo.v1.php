<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>


<script>
    
    $(function(){
        $('.inputtext').keypress(function(e){
            if(e.which == 13)
                $("#followpo").submit();
        });
        
         $('#search').click(function(){
                $("#followpo").submit();
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

 

<div class="title2" style="border-bottom: none;">Follow PO</div>
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
  <?php
          if($machineType == null)
              $machineType = 4;
            
          if($status == null)
              $status = "";

         

?>  
    
<div id="show-contain" class="ui-widget" style="margin:40px 0 0 50px;">


  
   
       
          
                <table id='payment_table_view' class="table_view1">
                  <thead>
                    <tr  class="table_view1_header">
                     <th style="min-width:50px;">No.</th>
                      <th style="min-width:50px;">Project No.</th>
                      <th style="min-width:70px;">Machine Type</th>
                      <th style="min-width:70px;">Status</th>
                      <th style="min-width:70px;">Customer</th>
                       <th style="min-width:70px;">Vendor</th>
                      <th style="min-width:70px;">Model</th>
                      <th style="min-width:70px;">Due Vendor</th>
                      <th style="min-width:70px;">Due Customer<br/> Date</th>
                      
                    </tr>
                    <tr  class="table_view1_header" style="height:20px;">
                      <div class="form"> 
                       <form id="followpo" method="POST">
                      <th style="min-width:50px; background-color:white; "></th>
                     <th style="min-width:50px; background-color:white; "><input type="text" name="projectNo" style="width:100%; height:20px;" class="inputtext"/></th>
                     <th style="min-width:50px; background-color:white; ">
                     
                              <select name="machineType"  style="width:100%; height:30px;" class="inputtext" id="machinetype"> 
                             <option value="">  All  </option>      
                            <option value="1" >Taiwan</option> 
                             <option value="2" >Made </option> 
                          
                            </select>
                        <!--  <input type="text" name="machineType" style="width:100%; height:20px;" class="inputtext"/> -->
                     </th>
                      <th style="min-width:50px; background-color:white; ">
                           
             <select name="status"  style="width:100%; height:30px;" class="inputtext" id="status">
                          <?php
                      /*          
                                $taiwan = array(1,2,3,4,5,18,7,8,12,13,15,16,17);
                                $made = array(1,4,5,18,7,8,12,13,15,16,17);
                                $stock = array(1,2,3,4,8,12,16,17);
                                
                               
                                if($machineType == 2){
                                        $mctype = $made ;
                                }else if($machineType == 3){
                                     $mctype = $stock;
                                }else {
                                    $mctype = $taiwan ;
                                } 
                      */
                               $mctype = array("Customer PO","Customer Deposit","PO to Vendor");
                          
                                $projectlist = array();    
                                $projstatus = projectStatus::model()->findAll();
                                $all = 0;
                                echo "<option value=''>All</option>";
                                echo "<option value='Customer PO'>Customer PO</option>";
                                echo "<option value='Customer Deposit'>Customer Deposit</option>";
                                echo "<option value='PO to Vendor'>PO to Vendor</option>";
                                        
                         ?>              
                        </select>
                      </th>
                        <th style="min-width:50px; background-color:white; "><input type="text" id="customer" name="customer" style="width:100%; height:20px;" class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" id="vendor" name="vendor" style="width:100%; height:20px;" class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" id="product" name="product" style="width:100%; height:20px;" class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" name="duevendordate" style="width:100%; height:20px;" class="inputtext"/></th>
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
/*
                        if(($machineType == 2) && ($status == 13)){
                              $statusstr = "Goods finished date"; 
                         }
                         else if(($machineType == 2) && ($status == 8)){
                             $status = 12; 
                         }
 * 
 */                        
          

              $con = "";
              $con =    " WHERE ((sky1_project.mcstatus LIKE '%Customer Deposit%' AND sky1_project.machineType = 2) OR ((sky1_project.mcstatus LIKE '%PO to Vendor%' OR sky1_project.mcstatus LIKE '%Customer Deposit%' OR sky1_project.mcstatus LIKE '%Customer PO%') AND sky1_project.machineType = 1 )) ";
                if($projectNo != "")
                  $con =  "$con and  sky1_project.projectNo LIKE '%$projectNo%' ";
                 if($vendor != "")
                        $con =    "$con and sky1_vendor.name LIKE '%$vendor%' ";
                   if($customer != "")
                        $con =    "$con and sky1_customer.name LIKE '%$customer%' ";
                   if($product != "")
                        $con =    "$con and sky1_product.name LIKE '%$product%' ";
                   if($machineType != "" && $machineType != 4)
                         $con =    "$con and sky1_project.machineType = '$machineType' ";
                /* 
                  if($status == "Customer Deposit")
                     $con =    "$con and sky1_project.mcstatus LIKE '%Customer Deposit%'";
                  if($status == "Customer PO")
                     $con =    "$con and sky1_project.mcstatus LIKE '%Customer PO%'";
                  if($status == "PO to Vendor")
                 * 
                 */
                     $con =    "$con and sky1_project.mcstatus LIKE '%$status%'";
             // echo $con."<br/><br/>".$status;
              
                   
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
               //echo $con;
               
               $revisesql =  "SELECT sky1_project.id project_id, sky1_project.projectNo, sky1_enquiry.customer customer_id, 
                                sky1_project.mcstatus,sky1_customer.name,sky1_project.machinetype,sky1_project.status,
                                sky1_poh.id,
                                sky1_pod.product_id,
  				sky1_pod.vendor_id,
				sky1_customer.name customer_name,				
                                sky1_vendor.name,
                            
                                sky1_product.name productname,
                                sky1_pod.product_id,
                                sky1_pod.qty,
                           
                                sky1_potovendor.vendorDeliverydate,
                                sky1_deposit.customerDeliveryDate 

                                from sky1_project  

                                LEFT JOIN sky1_enquiry
                                ON sky1_project.id = sky1_enquiry.project_id

 				LEFT JOIN sky1_potovendor
                                ON sky1_project.id = sky1_potovendor.project_id
                            
                                LEFT JOIN sky1_customer
                                ON sky1_customer.id = sky1_enquiry.customer
                                
                                LEFT JOIN sky1_deposit
                                ON sky1_project.id = sky1_deposit.project_id

                                LEFT JOIN sky1_poh
                                ON sky1_project.id = sky1_poh.project_id

                                RIGHT JOIN sky1_pod
                                ON sky1_pod.poh_id = sky1_poh.id

 				LEFT JOIN sky1_vendor
                                ON sky1_pod.vendor_id = sky1_vendor.id
								

				LEFT JOIN sky1_product
                                ON sky1_pod.product_id = sky1_product.id

                                 $con
                               
                                ORDER BY sky1_project.id DESC" ;
               
                $sql   =   "
                            SELECT 
                            sky1_project.id project_id,
                            sky1_project.projectNo, 
                            sky1_enquiry.customer customer_id,
                            sky1_customer.name customer_name,
                            sky1_project.machinetype,
                            sky1_project.status,
                            sky1_project.mcstatus
                           
                            
                            sky1_vendor.name,
                            
                            sky1_product.name productname,
                            sky1_pod.product_id,
                            sky1_pod.qty,
                            sky1_potovendor.vendorDeliverydate,
                            sky1_poh.customerDeliveryDate 


                            from sky1_project

                            LEFT JOIN sky1_enquiry
                            ON sky1_project.id = sky1_enquiry.project_id
                            
                            LEFT JOIN sky1_customer
                            ON sky1_customer.id = sky1_enquiry.customer
                            

                        

                            LEFT JOIN sky1_potovendor
                            ON sky1_project.id = sky1_potovendor.project_id
                            
                            LEFT JOIN sky1_poh
                            ON sky1_project.id = sky1_poh.project_id

                            JOIN sky1_pod
                            ON sky1_pod.poh_id = sky1_poh.id
                            
                            LEFT JOIN sky1_vendor
                            ON sky1_vendor.id = sky1_pod.vendor_id
                            
                            LEFT JOIN sky1_product
                            ON sky1_product.id = sky1_pod.product_id
                             
                              $con
                           ORDER BY sky1_project.id DESC
                            ;

                              

                             
                              ";
               // echo $sql;
                $rowNo = 0;
                
                $rows = Yii::app()->db->createCommand($revisesql)->queryAll();
                foreach($rows as $row)
                {
                        
                    

 ?>
                      
                      
             <?php 
                    
                        if($row['vendorDeliverydate'] != null){
                            $row['vendorDeliverydate'] = date("d/m/Y", strtotime($row['vendorDeliverydate']));
                        }else{
                            $row['vendorDeliverydate'] = "";
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
                                <td><center><?php echo ++$rowNo; ?>.</center></td>
                                <td><center><?php echo CHtml::link($row['projectNo'],array('poh/index','project_id'=>$row['project_id']));  ?></center></td>
                               
                                 <td><center><?php echo machineType::model()->findByPk($row['machinetype'])->type; ?></center></td>
                                 <td><center><?php echo $row['mcstatus'];
                                 /*
                                               if(($machineType == 2) && ($status == 13)){
                                                                    echo "Goods finished date"; 
                                                               }
                                                               else if(($machineType == 2) && ($status == 12)){
                                                                   echo "Customer Deposit";  
                                                               }
                                                               else{
                        
                                                                            if (projectstatus::model()->findByPk($row['status']) != null){
                                                                                  if((projectstatus::model()->findByPk($row['status'])->id >= 1 && projectstatus::model()->findByPk($row['status'])->id <=16) || projectstatus::model()->findByPk($row['status'])->id == 18)
                                                                                        echo projectstatus::model()->findByPk($row['status'])->status;  
                                                                                  else
                                                                                         echo "-";  

                                                                             }
                                                                             else{
                                                                                  echo "-";  
                                                                             }
                                                               }
                                  * 
                                  */
                                   ?>
                                 </center></td>
                                   <td><center><?php echo $row['customer_name'];/*if(customer::model()->findByPk($row['customer_id']) != null) echo customer::model()->findByPk($row['customer_id'])->name;*/ ?></center></td>
                                  <td><center><?php if(vendor::model()->findByPk($row['vendor_id']) != null) echo vendor::model()->findByPk($row['vendor_id'])->name; ?></center></td>
                                 <td><center><?php if(product::model()->findByPk($row['product_id']) != null) echo product::model()->findByPk($row['product_id'])->name; ?></center></td>
                                 <td><center><?php echo $row['vendorDeliverydate']; ?></center></td>
                                <td><center><?php echo $row['customerDeliveryDate']; ?></center></td>
                               
                              
                               
                  

                               </tr>  
               

 <?php
            }
?> 

                        
                  </tbody>
                </table>