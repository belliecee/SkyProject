<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>
<?php
             $page = (isset($_GET['page']) ? $_GET['page'] : 1); 
             $page_size = 50;
             if($newsearch == true ){
                  $start = 0;
              }else{
                  $start = (($page-1)*$page_size); 
              }
             
            
             $page_limit = $start.", ".$page_size;
?>
<script>
    
    $(function(){
        $('.inputtext').keypress(function(e){
            if(e.which == 13)
                $("#complete").submit();
        });
        
          $('#search').click(function(){
                $("#complete").submit();
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
<div class="index_content" style=" margin: 0 0 20px 0; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 70px 0 0;width:1128px; min-height: 500px;">

    
    
    
<!------------------ The Button for add an ITEM  ------------------->

 

<div class="title2" style="border-bottom: none;">Complete</div>
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

	


<?php $this->endWidget(); ?>

</div>    
    
    
<div id="show-contain" class="ui-widget" style="margin:40px 0 0 20px; width:1100px;">

<?php 



             $con = "";
              $con =  "$con   WHERE ((sky1_project.mcstatus LIKE '%Completed%' AND sky1_project.machineType = 1) OR (sky1_project.mcstatus LIKE '%Completed%' AND sky1_project.machineType = 2))  ";
              
              $con =  "$con and sky1_project.projectNo LIKE '%$projectNo%' ";
                if($quoteDate != "")
                {
                            if($quoteDate != null){
                                $explodeStr = explode("/",$quoteDate);
                                $newDate = ""; 
                                $count = 0;
                                foreach($explodeStr as $eachStr){
                                    if($count == 0)
                                        $newDate = $newDate.$eachStr;
                                    else
                                        $newDate = $eachStr."-".$newDate;
                                    $count++;
                                }
                                $quoteDate = date("Y-m-d", strtotime($newDate));
                                 $con =    "$con and sky1_quoh.vendorQuoteDate >= '$quoteDate' and  sky1_quoh.vendorQuoteDate != '' ";
                            }else{
                                $quoteDate = null;
                        }
                }
                
                
                
                
                if($quoteNo != "")
                    $con =    "$con and sky1_quoh.quoteNo LIKE '%$quoteNo%' ";
                 if($customer != "")
                    $con =    "$con and sky1_customer.name LIKE '$customer' ";
                 if($vendor != "")
                    $con =    "$con and sky1_vendor.name LIKE '$vendor' ";
                 if($product != "")
                    $con =    "$con and sky1_product.name LIKE '$product' ";
               
                 
                if($customerPOdate != "")
                {
                            if($customerPOdate != null){
                                $explodeStr = explode("/",$customerPOdate);
                                $newDate = ""; 
                                $count = 0;
                                foreach($explodeStr as $eachStr){
                                    if($count == 0)
                                        $newDate = $newDate.$eachStr;
                                    else
                                        $newDate = $eachStr."-".$newDate;
                                    $count++;
                                }
                                $customerPOdate = date("Y-m-d", strtotime($newDate));
                                 $con =    "$con and sky1_poh.customerPOdate = '$customerPOdate'  "; 
                            }else{
                                $customerPOdate = null;
                        }
                }
                
                if($deliveryDate != "")
                {
                            if($deliveryDate != null){
                                $explodeStr = explode("/",$deliveryDate);
                                $newDate = ""; 
                                $count = 0;
                                foreach($explodeStr as $eachStr){
                                    if($count == 0)
                                        $newDate = $newDate.$eachStr;
                                    else
                                        $newDate = $eachStr."-".$newDate;
                                    $count++;
                                }
                                $deliveryDate = date("Y-m-d", strtotime($newDate));
                                 $con =    "$con and sky1_project.deliveryDate = '$deliveryDate'  "; 
                            }else{
                                $deliveryDate = null;
                        }
                }
                
               $con2 = "";
                 if($paymentDate != "")
                {
                            if($paymentDate != null){
                                $explodeStr = explode("/",$paymentDate);
                                $newDate = ""; 
                                $count = 0;
                                foreach($explodeStr as $eachStr){
                                    if($count == 0)
                                        $newDate = $newDate.$eachStr;
                                    else
                                        $newDate = $eachStr."-".$newDate;
                                    $count++;
                                }
                                $paymentDate = date("Y-m-d", strtotime($newDate));
                                $con2 =    "$con2 and sky1_project.paymentDate = '$paymentDate'  "; 
                            }else{
                                $paymentDate = null;
                        }
                }




                $sql   =   "
                            SELECT 
                            sky1_project.id project_id, 
                            sky1_project.projectNo, 
                            sky1_project.deliveryDate, 
                            sky1_project.mcstatus, 
                            sky1_project.machineType, 
                            sky1_enquiry.customer customer_id,
                            sky1_customer.name customer_name,
                            sky1_vendorprocess.vendor_id,
                            sky1_pod.product_id,
                            sky1_pod.qty,
                            sky1_deposit.depositAmount,
                            sky1_quoh.vendorQuoteDate,
                            sky1_vendor.name vendor_name,
                            sky1_quoh.quoteNo,
                            sky1_product.name,
                            sky1_poh.customerPOdate,
                            sky1_poh.quoh_id,
                            sky1_pod.id pod_id,
                            sky1_pod.unitPrice pounitPrice
                            
                           from   sky1_project
                            
                            JOIN sky1_enquiry
                            ON sky1_project.id = sky1_enquiry.project_id
                            
                            LEFT JOIN sky1_customer
                            ON sky1_customer.id = sky1_enquiry.customer
                            
                            
                            LEFT JOIN sky1_deposit
                            ON sky1_project.id = sky1_deposit.project_id
                            
                          
                            LEFT JOIN sky1_vendorprocess
                            ON sky1_project.id = sky1_vendorprocess.project_id
                            

                            JOIN sky1_poh
                            ON sky1_project.id = sky1_poh.project_id
                            
                            LEFT JOIN sky1_quoh
                            ON sky1_quoh.id = sky1_poh.quoh_id
                                
                            JOIN sky1_pod
                            ON sky1_pod.poh_id = sky1_poh.id

                           LEFT JOIN sky1_vendor
                           ON sky1_vendor.id = sky1_pod.vendor_id
                            
                            LEFT JOIN sky1_product
                            ON sky1_product.id = sky1_pod.product_id
                            
                            
                       

                          
                          
                            $con
                          
                            
                            ORDER BY sky1_project.id, sky1_poh.id, sky1_pod.id ASC
                            LIMIT $page_limit
                            ;
                              ";
                
                 $sql_count   =   "
                            SELECT 
                            sky1_project.id project_id, 
                            sky1_project.projectNo, 
                            sky1_project.deliveryDate, 
                            sky1_project.mcstatus, 
                            sky1_project.machineType, 
                            sky1_enquiry.customer customer_id,
                            sky1_customer.name customer_name,
                            sky1_vendorprocess.vendor_id,
                            sky1_pod.product_id,
                            sky1_pod.qty,
                            sky1_deposit.depositAmount,
                            sky1_quoh.vendorQuoteDate,
                            sky1_vendor.name vendor_name,
                            sky1_quoh.quoteNo,
                            sky1_product.name,
                            sky1_poh.customerPOdate,
                            sky1_poh.quoh_id,
                            sky1_pod.id pod_id,
                            sky1_pod.unitPrice pounitPrice,
                            COUNT(*) as 'count'
                            
                           from   sky1_project
                            
                            JOIN sky1_enquiry
                            ON sky1_project.id = sky1_enquiry.project_id
                            
                            LEFT JOIN sky1_customer
                            ON sky1_customer.id = sky1_enquiry.customer
                            
                            
                            LEFT JOIN sky1_deposit
                            ON sky1_project.id = sky1_deposit.project_id
                            
                          
                            LEFT JOIN sky1_vendorprocess
                            ON sky1_project.id = sky1_vendorprocess.project_id
                            

                            JOIN sky1_poh
                            ON sky1_project.id = sky1_poh.project_id
                            
                            LEFT JOIN sky1_quoh
                            ON sky1_quoh.id = sky1_poh.quoh_id
                                
                            JOIN sky1_pod
                            ON sky1_pod.poh_id = sky1_poh.id

                           LEFT JOIN sky1_vendor
                           ON sky1_vendor.id = sky1_pod.vendor_id
                            
                            LEFT JOIN sky1_product
                            ON sky1_product.id = sky1_pod.product_id
                            
                            
                       

                          
                          
                            $con
                          
                            GROUP BY  sky1_project.machinetype
                            ORDER BY sky1_project.id, sky1_poh.id, sky1_pod.id ASC
                            
                            ;
                              ";
               
                
                $rows = Yii::app()->db->createCommand($sql)->queryAll();
                $row_count = Yii::app()->db->createCommand($sql_count)->queryAll();
                //$item_count  = $row_count[0]['count'];
                $item_count  = $row_count[0]['count'] + $row_count[1]['count'] + $row_count[2]['count'];
                
                $pages = new CPagination($item_count);
                $pages->setPageSize($page_size);
// PAGINATION error handling                
                if($newsearch == true){
                    $pages->setCurrentPage(0);
                }
                
?>
                
  
 <?php    
               
            	$this->widget('CLinkPager', array(
                'pages'=>$pages,
                 'maxButtonCount'=>30,
                ));
?>          <br/><br/>
       
          
                <table id='payment_table_view' class="table_view1" style="width:900px">
                  <thead>
                    <tr  class="table_view1_header">
                      <th style="max-width:70px;">Project No.</th>
                       <th style="max-width:70px;">Customer</th>
                      <th style="max-width:50px;">Quote<br/> Date</th>
                      <th style="max-width:70px;">Quote No.</th>
                     
                       <th style="max-width:70px;">Vendor</th>
                      <th style="max-width:70px;">Model</th>
                      <th style="max-width:70px;">Qty</th>
                      <th style="max-width:70px;">Price</th>
                       <th style="max-width:70px;">PO <br/>Date</th>
                    
                      <th style="max-width:70px;">Price</th>
                       <th style="max-width:70px;">Actual <br/>Delivery</th>
                       <th style="max-width:70px;">Deposit</th>
                       <th style="max-width:70px;">Payment <br/>Date</th>
                      
                    </tr>
                    <tr  class="table_view1_header" style="height:20px;">
                      <div class="form"> 
                      <form id="complete" method="POST">
                       <th style="min-width:50px; background-color:white; "><input type="text" name="projectNo"  style="width:100%; height:20px;" class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" id="customer" name="customer"  style="width:100%;height:20px; "class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" name="quoteDate"  style="width:100%; height:20px;" class="inputtext"/></th>  
                      <th style="min-width:50px; background-color:white; "><input type="text" name="quoteNo"  style="width:100%;height:20px; " class="inputtext"/></th> 
                       <th style="min-width:50px; background-color:white; "><input type="text" id="vendor"  name="vendor"  style="width:100%; height:20px;" class="inputtext"/></th>  
                      <th style="min-width:50px; background-color:white; "><input type="text" id="product" name="product"  style="width:100%;height:20px; " class="inputtext"/></th>    
                      <th style="min-width:50px; background-color:white; "></th>  
                      <th style="min-width:50px; background-color:white; "></th>
                        <th style="min-width:50px; background-color:white; "><input type="text" name="customerPOdate"  style="width:100%; height:20px;" class="inputtext"/></th>  
                      <th style="min-width:50px; background-color:white; "></th>    
                      <th style="min-width:50px; background-color:white; "><input type="text" name="deliveryDate"  style="width:100%; height:20px;" class="inputtext"/></th>  
                      <th style="min-width:50px; background-color:white; "></th> 
                      <th style="min-width:50px; background-color:white; "><input type="text" name="paymentDate"  style="width:100%; height:20px;" class="inputtext"/></th>
                      <input type="hidden" name="newsearch">
                      
                      </form>
                          
                    
                      </div>
                    </tr>
                  </thead>
                  <tbody>
    
<?php
                $ind = 0; $count = 0; $quohcmp = 0;
                foreach($rows as $row)
                {
                     $quoh = quoh::model()->findByPk($row['quoh_id']);
                    /*
                        if($count == 0){
                            $quohcmp =  $row['quoh_id'];
                        }
                        else{
                     * 
                     */
                            if ($quohcmp != $row['quoh_id']){
                                $ind = 0;
                                $quohcmp =  $row['quoh_id'];
                            }

                       // }
                        $quod = quod::model()->findAll("quoH_id=:quoH_id",array(":quoH_id"=>$row['quoh_id']));
                     
                     $count++;
                    

 ?>
            
              <?php 
                     if($quoh != null){
                        if($quoh->vendorQuoteDate != null){
                            $quoh->vendorQuoteDate = date("d/m/Y", strtotime($quoh->vendorQuoteDate));
                        }else{
                            $quoh->vendorQuoteDate = "";
                        }
                     }
                  
            ?>          
                      
                         
             <?php 
                    
                        if($row['customerPOdate'] != null){
                            $row['customerPOdate'] = date("d/m/Y", strtotime($row['customerPOdate']));
                        }else{
                            $row['customerPOdate'] = "";
                        }
                  
            ?>               
             <?php 
                    
                        if($row['deliveryDate'] != null){
                            $row['deliveryDate'] = date("d/m/Y", strtotime($row['deliveryDate']));
                        }else{
                            $row['deliveryDate'] = "";
                        }
                  
            ?>        
                      
             
               <?php 
               
               
               
                     $sqlmax   =   "
                            SELECT 
                            max(sky1_payment.paymentDate) as lastpayment
                          
 
                            from sky1_payment
                            WHERE sky1_payment.project_id = ".$row['project_id']." 
                            GROUP BY sky1_payment.project_id
                           
                            
                            ;
                              ";
                        $rowpay = Yii::app()->db->createCommand($sqlmax)->queryAll();
                ?>  
                   <?php 
                   
                       $lastPay = 0000-00-00;
                       if($rowpay != null)
                       {
                            $lastPay = $rowpay[0]['lastpayment'];
                            if($rowpay[0]['lastpayment'] != null){
                                $rowpay[0]['lastpayment'] = date("d/m/Y", strtotime($rowpay[0]['lastpayment']));
                            }else{
                                $rowpay[0]['lastpayment'] = "";
                            }
                       }
                  
            ?>         
                  <?php
                  
                    if($paymentDate == null || $paymentDate == "" || $paymentDate <= $lastPay){
                  ?>
                      
                       
                               <tr class="table_tr_quod" >
                
                                <td>
                                    <center>
                                        <?php echo CHtml::link($row['projectNo'],array('enquiry/index','project_id'=>$row['project_id']));  ?>
                                    </center>
                                </td>
                                <td>
                                        <center>
                                              <?php 
                                                        if($row['customer_name'] != null){
                                                            if($row['customer_name'] == "")
                                                                echo " - ";
                                                            else
                                                                echo $row['customer_name'];
                                                        }
                                                        else
                                                            echo " - ";
                                              ?>
                                        </center>
                                </td>
                                <td>
                                        <center>
                                              <?php 
                                                       
                                                        
                                                            if($quoh != null){
                                                                if($quoh->vendorQuoteDate == "")
                                                                    echo " - ";
                                                                else
                                                                    echo $quoh->vendorQuoteDate;
                                                            }
                                                            else
                                                                echo " - ";
                                                       
                                              ?>
                                        </center>
                                </td>
                                <td>
                                        <center>
                                              <?php 
                                                      
                                                         if($quoh != null){
                                                            if($quoh->quoteNo == "")
                                                                echo " - ";
                                                            else
                                                                echo $quoh->quoteNo;
                                                        }
                                                        else
                                                            echo " - ";
                                            
                                              ?>
                                        </center>
                                </td>
                                <td>
                                        <center>
                                              <?php 
                                                        if($row['vendor_name'] != null){
                                                            if($row['vendor_name'] == "")
                                                                echo " - ";
                                                            else
                                                                echo $row['vendor_name'];
                                                        }
                                                        else
                                                            echo " - ";
                                              ?>
                                        </center>
                                </td>
                               
                               
                                <td>
                                    <center>
                                        <?php 
                                                if(product::model()->findByPk($row['product_id']) != null)
                                                {
                                                    if(product::model()->findByPk($row['product_id'])->name == "")
                                                         echo " - "; 
                                                    else 
                                                      echo product::model()->findByPk($row['product_id'])->name;
                                                } 
                                               else
                                                    echo " - ";
                                       ?>
                                    </center>
                                </td>                
                                <td>
                                    <center>
                                        <?php 
                                                    if($row['qty'] != null){
                                                            if($row['qty'] == "")
                                                                echo " - ";
                                                            else
                                                                echo $row['qty'];
                                                        }
                                                        else
                                                            echo " - ";
                                                
                                        ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                            <?php 
                                                    if (($quod !=null) && ($ind < count($quod)))
                                                    { 
                                                        if($quod[$ind]->unitPrice == "")
                                                                echo " - ";
                                                            else
                                                                echo $quod[$ind]->unitPrice;
                                                                                                          
                                                    }
                                                    else
                                                        echo " - ";
                                            ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php 
                                                    if($row['customerPOdate'] != null){
                                                            if($row['customerPOdate'] == "")
                                                                echo " - ";
                                                            else
                                                                echo $row['customerPOdate'];
                                                        }
                                                        else
                                                            echo " - ";
                                                 
                                        ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php 
                                                if($row['pounitPrice'] != null){
                                                            if($row['pounitPrice'] == "")
                                                                echo " - ";
                                                            else
                                                                echo $row['pounitPrice'];
                                                 }
                                                else
                                                    echo " - ";

                                        ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                            <?php 
                                            
                                                   if($row['deliveryDate'] != null){
                                                            if($row['deliveryDate'] == "")
                                                                echo " - ";
                                                            else
                                                                echo $row['deliveryDate'];
                                                 }
                                                else
                                                    echo " - ";
                                                    
                                                 
                                           ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                            <?php if($row['depositAmount'] != null){
                                                            if($row['depositAmount'] == "")
                                                                echo " - ";
                                                            else
                                                                echo $row['depositAmount'];
                                                 }
                                                else
                                                    echo " - ";
                                                    
                                                    
                                            ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php 
                                               if($rowpay !=null ) 
                                                   echo $rowpay[0]['lastpayment'];
                                               else
                                                   echo " - ";
                                         ?>
                                    </center>
                                </td>
                       </tr>  
                              <?php   $ind++; ?>
 <?php
                    }
            }
?> 

                        
                  </tbody>
                </table>

<?php    
               
            	$this->widget('CLinkPager', array(
                'pages'=>$pages,
                'maxButtonCount'=>30,
                ));
?>
 <br/><br/>