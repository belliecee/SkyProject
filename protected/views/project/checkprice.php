<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>

<script>
    
    $(function(){
        $('.inputtext').keypress(function(e){
            if(e.which == 13)
                $("#ck").submit();
        });
        
         $('#search').click(function(){
                $("#ck").submit();
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
ini_set('memory_limit', '-1');
?>    
</div>
<div class="index_content" style=" margin: 0 0 20px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 70px 0 0;width:1000px; min-height: 500px;">

    
    
    
<!------------------ The Button for add an ITEM  ------------------->

 

<div class="title2" style="border-bottom: none;">Check Price</div>
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
    
    
<div id="show-contain" class="ui-widget" style="margin:40px 0 0 -20px;">

   
       
          
                <table id='payment_table_view' class="table_view1">
                  <thead>
                    <tr  class="table_view1_header">
                      <th style="max-width:70px;">Project No.</th>
                      <th style="max-width:70px;">Quote Date</th>
                      <th style="max-width:50px;">Quote No.</th>
                      <th style="max-width:70px;">Customer</th>
                       <th style="max-width:70px;">Vendor</th>
                      <th style="max-width:70px;">Model</th>
                      <th style="max-width:70px;">(Quote)<br/>Qty</th>
                      <th style="max-width:70px;">(Quote)<br/>Price</th>
                      <th style="max-width:70px;">Customer <br/>PO Date</th>
                      <th style="max-width:70px;">(PO)<br/>Qty</th>
                      <th style="max-width:70px;">(PO)<br/>Price</th>
                      
                    </tr>
                    <tr  class="table_view1_header" style="height:20px;">
                    <div class="form"> 
                    <form id="ck" method="POST">
                      <th style="min-width:50px; background-color:white; "><input type="text" name="projectNo" style="width:100%;height:20px; "class="inputtext"/></th>
                      <th style="min-width:50px; background-color:white; "><input type="text" name="quoteDate" style="width:100%;height:20px; "class="inputtext"/></th>
                      <th style="min-width:50px; background-color:white; "><input type="text" name="quoteNo" style="width:100%; height:20px;" class="inputtext"/></th>  
                      <th style="min-width:50px; background-color:white; "><input type="text" id="customer" name="customer" style="width:100%;height:20px; " class="inputtext"/></th> 
                      <th style="min-width:50px; background-color:white; "><input type="text" id="vendor" name="vendor" style="width:100%; height:20px;" class="inputtext"/></th>  
                      <th style="min-width:50px; background-color:white; "><input type="text" id="product" name="product" style="width:100%;height:20px; " class="inputtext"/></th>    
                      <th style="min-width:50px; background-color:white; "></th>  
                      <th style="min-width:50px; background-color:white; "></th> 
                      <th style="min-width:70px; background-color:white; "><input type="text" name="customerPOdate" style="width:100%; height:20px;" class="inputtext"/></th>
                      <th style="min-width:70px; background-color:white; "></th>  
                      <th style="min-width:70px; background-color:white; "></th>  
                 
                   </form>
                    
                      </div>
                    </tr>
                  </thead>
                  <tbody>
<?php 
//  LOAD QUOD
// Find project parameters

              $con = "";
              $con = "$con  WHERE sky1_project.status >= 4 ";
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
                                 $con =    "$con and sky1_quoh.vendorQuoteDate = '$quoteDate' and  sky1_quoh.vendorQuoteDate != '' ";
                            }else{
                                $quoteDate = null;
                        }
                }
                
 //              
              
                
                
                
                if($vendor != "")
                    $con =    "$con and sky1_vendor.name LIKE '$vendor' ";
                if($quoteNo != "")
                    $con =    "$con and sky1_quoh.quoteNo LIKE '$quoteNo' ";
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
            

                $sql   =   "
                            SELECT 
                            sky1_project.id,
                            sky1_project.machineType,
                            sky1_project.projectNo, 
                            sky1_quoh.vendorQuoteDate,
                            sky1_quoh.quoteNo,
                            sky1_enquiry.customer customer_id,
                            sky1_customer.name,
                            sky1_quod.product_id,
                            sky1_quod.qty,
                            sky1_quod.vendor_id,
                            sky1_quod.type_id,
                            sky1_quod.unitPrice quodunitPrice,
                            sky1_vendor.name vendor_name,
                            sky1_product.name product_name,
                            sky1_product.name type_name,
                            sky1_poh.customerPOdate,
                            sky1_quoh.id quoh_id
                            
                            
                            from   sky1_project
                            
                            JOIN sky1_enquiry
                            ON sky1_project.id = sky1_enquiry.project_id
                            
                            LEFT JOIN sky1_customer
                            ON sky1_customer.id = sky1_enquiry.customer
                            
                            LEFT JOIN sky1_vendorprocess
                            ON sky1_project.id = sky1_vendorprocess.project_id

                            LEFT JOIN sky1_quoh
                            ON sky1_quoh.project_id = sky1_project.id
                            
                            LEFT JOIN sky1_poh
                            ON sky1_poh.quoh_id = sky1_quoh.id
                                
                            RIGHT JOIN sky1_quod
                            ON sky1_quod.quoh_id = sky1_quoh.id

                           LEFT JOIN sky1_vendor
                           ON sky1_vendor.id = sky1_quod.vendor_id
                            
                            LEFT JOIN sky1_product
                            ON sky1_product.id = sky1_quod.product_id
                            
                             LEFT JOIN sky1_type
                            ON sky1_type.id = sky1_quod.type_id
                            
                          
                          
                          $con
                            
                          ORDER BY sky1_project.id DESC, sky1_quoh.id ASC, sky1_quod.id ASC
                         
                           
                            ;
                              ";
               
                
                $rows = Yii::app()->db->createCommand($sql)->queryAll();
                
                
        // CHECK QUOH in POH
            /*    
      
          
                $projid = -1; $projlist = array(); $projcount = -1;
                foreach($rows as $r){
                      $projcount++;
                      if($projid != $r["id"]){
                            $projid != $r["id"];
                            $projlist[$projcount]["id"] = $r["id"];
                            $projlist[$projcount]["val"] = 0;
                            $projlist[$projcount]["qid"] = 0;
                            //$projlist = array($projlist,$inner);
                            $_quohi = quoh::model()->findAll("project_id=:project_id",array(":project_id"=>$r["id"]));
                            
                            $q_id = 0;
                            foreach($_quohi as $_q){
                                $_poh = poh::model()->find("quoh_id=:quoh_id",array(":quoh_id"=>$_q->id));
                                 if($_poh != null){
                                
                                      $projlist[$projcount]["qid"] = $_q->id;
                                       $projlist[$projcount]["val"] = 1;
                                      break;
                                 }
                               
                           }
                            
                                                    
                      }else{
                          
                          break;
                      }
                }
             * 
             */
/*
 *      $ind :: INDEX for count quod in quoh (for the biggest loop)
 *      $pod_index :: Group of index of $pods. This is unit vector to math quod and pod. 1 is no math, otherwise is 0
 *      $case :: value 1 is #pod_row is more than #quod_row    
 */
                
                $ind = 0; $count = 0; $quohcmp = 0;$pod_index = array();
                foreach($rows as $row)
                {
                    
                     $poh = poh::model()->find("quoh_id=:quoh_id",array(":quoh_id"=>$row['quoh_id'])) ;
                     if($poh != null){
                                $pods = pod::model()->findAll("poh_id=:poh_id",array(":poh_id"=>$poh->id));
                                $quods = quod::model()->findAll("quoH_id=:quoh_id",array(":quoh_id"=>$row['quoh_id']));
                                $case = 0;

                                if(count($quods) >= count($pods)){
                                     $case =  0;
                                     $rowmax = count($quods);
                                }else{
                                     $case = 1;
                                     $rowmax = count($pods);
                                }
       // POD INDEX
                             if($ind == 0){
      // CREATE UNIT VECTOR :: Initialize POD INDEX : SET to unit array (1)
                                 $pod_index = array();
                                 for($m=0;$m<count($pods);$m++){
                                     $pod_index[$m] = 1;
                                 }  
                             }
    // END OF INITIATION                         
                            $podrow = 0; $compare_index = -1;
                            foreach($pods as $a_pod){
                                    if($a_pod->vendor_id==$row['vendor_id'] && $a_pod->product_id==$row['product_id'] && $a_pod->type_id==$row['type_id']){
                                        $pod_index[$podrow] = 0; $compare_index = $podrow;
                                        break;
                                    }
                                    $podrow++;
                            }
                             
                                

                     }else{
                                $poh = null; $pods = null; $quods = null;
                                $rowmax = count($quods); $case = 0;
                                $pod_index = null;
                     }
                     
                    // $quoh = quoh::model()->findByPk($row['quoh_id']);
               /*
                    if ($quohcmp != $row['quoh_id'])
                    {
                            $ind = 0;
                            $quohcmp =  $row['quoh_id'];
                    }

                    //    }
                     $count++;
                     $quod = quod::model()->findAll("quoH_id=:quoH_id",array(":quoH_id"=>$row['quoh_id']));
                 */

 ?>
                      
               
        
               <?php 
                    
                            if($row['vendorQuoteDate'] != null){
                                $row['vendorQuoteDate'] = date("d/m/Y", strtotime($row['vendorQuoteDate']));
                            }else{
                                $row['vendorQuoteDate'] = "";
                            }
                  
            ?>         
                      
                      
              
                
                               <tr class="table_tr_quod" >
                
                                <td><center><?php echo CHtml::link($row['projectNo'],array('enquiry/index','project_id'=>$row['id']));  ?></center></td>
                               
                                <td>
                                    <center>
                                          <?php 
                                          
                                                    if($row['vendorQuoteDate'] == "" || $row['vendorQuoteDate'] == null)
                                                        echo " - ";
                                                    else
                                                        echo $row['vendorQuoteDate'];
                                               
                                          
                                          ?>
                                    </center>
                                </td>
                                 <td>
                                    <center>
                                          <?php 
                                          
                                                 if($row['quoteNo'] == "" || $row['quoteNo'] == null)
                                                        echo " - ";
                                                    else
                                                        echo $row['quoteNo'];
                                               
                                             
                                          ?>
                                    </center>
                                </td>
                               
                                <td>
                                    <center>
                                            <?php 
                                                if( customer::model()->findByPk($row['customer_id']) != null ) 
                                                    if(customer::model()->findByPk($row['customer_id'])->name == "")
                                                        echo " - ";
                                                    else
                                                        echo customer::model()->findByPk($row['customer_id'])->name; 
                                                else 
                                                     echo " - "; 
                                           ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php 
                                            if(vendor::model()->findByPk($row['vendor_id']) != null) 
                                                if(vendor::model()->findByPk($row['vendor_id'])->name == "")
                                                     echo " - ";
                                                 else
                                                      echo vendor::model()->findByPk($row['vendor_id'])->name; 
                                            else 
                                                echo " - ";  
                                        ?>
                                    </center>
                               </td>
                                <td>
                                    <center>
                                            <?php 
                                                    if(product::model()->findByPk($row['product_id']) != null)
                                                        if(product::model()->findByPk($row['product_id'])->name == "")
                                                            echo " - ";
                                                        else
                                                            echo product::model()->findByPk($row['product_id'])->name; 
                                                    else 
                                                        echo " - ";  ?>
                                    </center>
                                </td>  
                                
                                <td>
                                    <center>
                                              <?php 
                                                 if($row['qty'] !=null)
                                                    if($row['qty'] == "")
                                                        echo " - ";
                                                    else
                                                        echo $row['qty'];
                                                 else
                                                    echo " - ";
                                          ?>
                                    </center>
                               </td>
                                    
                                
                                 <td>
                                    <center>
                                          <?php 
                                                 if($row['quodunitPrice'] !=null)
                                                    if($row['quodunitPrice'] == "")
                                                        echo " - ";
                                                    else
                                                        echo $row['quodunitPrice'];
                                                 else
                                                    echo " - ";
                                          ?>
                                    </center>
                                </td>
                               
                                
                               
                                <td>
                                    <center>
                                          <?php 
                                          
                
                        if($row['customerPOdate'] != null){
                           $row['customerPOdate'] = date("d/m/Y", strtotime($row['customerPOdate']));
                        }else{
                            $row['customerPOdate'] = "";
                        }
                   
                
                                                    if($row['customerPOdate'] == "" || $row['customerPOdate'] == null)
                                                        echo " - ";
                                                    else
                                                        echo $row['customerPOdate'];
                
                                              
                                                   
                                                    
                                          ?>
                                    </center>
                                </td>
                                
                                 
                                <td>
                                    <center>
                                               <?php 
                                                        if($poh != null){
                                                                if ($compare_index >= 0) 
                                                                        echo $pods[$compare_index]->qty;
                                                                else
                                                                      echo " - "; 
                                                        } else echo " - ";
                                                       
                                                  
                                                
                                                ?>
                                    </center>
                                </td>
                                
                                <td>
                                    <center>
                                                <?php 
                                                        if($poh != null){
                                                                if ($compare_index >= 0) 
                                                                        echo $pods[$compare_index]->unitPrice;
                                                                else
                                                                      echo " - "; 
                                                        } else echo " - ";
                                                       
                                                  
                                                
                                                ?>
                                    </center>
                                </td>
                               
                               </tr>  
                              <?php   $ind++; ?>
 <?php
// Initialize poh ::Des::  Count pod row that will be displayed
 /*
                       $podcount = 0;
                       for($l=0;$l<count($pod_index);$l++){
                             if($pod_index[$l] == 1){
                                    $podcount++;
                             }
                       }
 */
// ADD ADDITIONAL POH ROW 
                        if($case == 1 && $ind >= count($quods)){
                                //echo $row['projectNo'].'>>'.count($quods).'>>'.count($pods).'|||';
                                //for($k=0;$k<(count($pods)-count($quods));$k++ ){
                                            for($k=0;$k<count($pods);$k++ ){
                                               if($pod_index[$k] == 1){
                                                        $variables = array(  'projectNo'=>false,
                                                                             'quoteDate'=>false,
                                                                             'quoteNo'=>false,
                                                                             'customer'=>false,
                                                                             'vendor'=>false,
                                                                             'product'=>false,
                                                                             'customerPOdate'=>false
                                                                    );
                                                        $variables_val1 = array( 'projectNo'=>$projectNo,
                                                                             'quoteDate'=>$quoteDate,
                                                                             'quoteNo'=>$quoteNo,
                                                                             'customer'=>$customer,
                                                                             'vendor'=>$vendor,
                                                                             'product'=>$product,
                                                                             'customerPOdate'=>$customerPOdate
                                                                    );
                                                         if( customer::model()->findByPk($row['customer_id']) != null ) 
                                                                if(customer::model()->findByPk($row['customer_id'])->name == "")
                                                                     $val2_customer = "";
                                                                else
                                                                     $val2_customer = customer::model()->findByPk($row['customer_id'])->name; 
                                                          else 
                                                                 $val2_customer = ""; 
                                                          
                                                         if(vendor::model()->findByPk($pods[$k]->vendor_id) != null) 
                                                                    if(vendor::model()->findByPk($pods[$k]->vendor_id)->name == "")
                                                                         $val2_vendor = "";
                                                                     else
                                                                          $val2_vendor = vendor::model()->findByPk($pods[$k]->vendor_id)->name; 
                                                                else 
                                                                    $val2_vendor = "";
                                                                
                                                                
                                                         if(product::model()->findByPk($pods[$k]->product_id) != null)
                                                                        if(product::model()->findByPk($pods[$k]->product_id)->name == "")
                                                                            $val2_product = "";
                                                                        else
                                                                            $val2_product = product::model()->findByPk($pods[$k]->product_id)->name; 
                                                                    else 
                                                                        $val2_product = "";         
                                                                
                                                                
                                                        $variables_val2 = array( 'projectNo'=>$row['projectNo'],
                                                                             'quoteDate'=>$row['vendorQuoteDate'],
                                                                             'quoteNo'=>$row['quoteNo'],
                                                                             'customer'=>$val2_customer,
                                                                             'vendor'=>$val2_product,
                                                                             'product'=>$val2_product,
                                                                             'customerPOdate'=>$customerPOdate
                                                                    );
                                                        
                                                        $variables2 = $variables;
                                                        
                                                        if($projectNo!=null && $projectNo!="")$variables["projectNo"] = true;
                                                        if($quoteDate!=null && $quoteDate!="")$variables["quoteDate"] = true;
                                                        if($quoteNo!=null && $quoteNo!="")$variables["quoteNo"] = true;
                                                        if($customer!=null && $customer!="")$variables["customer"] = true;
                                                        if($vendor!=null && $vendor!="")$variables["vendor"] = true;
                                                        if($product!=null && $product!="")$variables["product"] = true;
                                                        if($customerPOdate!=null && $customerPOdate!="")$variables["customerPOdate"] = true;
                                                        
                                                        $res = ($variables["projectNo"] || $variables2["projectNo"]) || ($variables["quoteDate"] || $variables2["quoteDate"]) || ($variables["quoteNo"] || $variables2["quoteNo"]) || ($variables["customer"] || $variables2["customer"]) || ($variables["vendor"] || $variables2["vendor"]) || ($variables["product"] || $variables2["product"]) || ($variables["customerPOdate"] || $variables2["customerPOdate"]) ;
                                                        
                                                        $display = true;
                                                        
                                                        if($res == false){
                                                            $display = true;
                                                            //echo "DISPLAY TRUE  ";
                                                        }else{
                                                           // echo "DISPLAY FALSE  ";
                                                              foreach($variables as $key=>$value){
                                                                     if($value == true){
                                                                         /*
                                                                            echo $key." ::: ";
                                                                            echo $variables_val1[$key]." ::: ";
                                                                             echo $variables_val2[$key]." ::: ";
                                                                            echo ">>>>>>>>>>>>";
                                                                           */ 
                                                                            if(strpos($variables_val2[$key],$variables_val1[$key]) == false)
                                                                            {
                                                                                $display = false;
                                                                            }
                                                                     } 
                                                              }
                                                              
                                                        }
                                                        if($display == true){  
                                                        
                                                        
                                                        
                                                        
                    
            ?>

                                       <tr>

                                                             <td><center><?php echo CHtml::link($row['projectNo'],array('enquiry/index','project_id'=>$row['id']));  ?></center></td>

                                            <td>
                                                <center>
                                                      <?php 

                                                                if($row['vendorQuoteDate'] == "" || $row['vendorQuoteDate'] == null)
                                                                    echo " - ";
                                                                else
                                                                    echo $row['vendorQuoteDate'];


                                                      ?>
                                                </center>
                                            </td>
                                             <td>
                                                <center>
                                                      <?php 

                                                             if($row['quoteNo'] == "" || $row['quoteNo'] == null)
                                                                    echo " - ";
                                                                else
                                                                    echo $row['quoteNo'];


                                                      ?>
                                                </center>
                                            </td>

                                            <td>
                                                <center>
                                                        <?php 
                                                            if( customer::model()->findByPk($row['customer_id']) != null ) 
                                                                if(customer::model()->findByPk($row['customer_id'])->name == "")
                                                                    echo " - ";
                                                                else
                                                                    echo customer::model()->findByPk($row['customer_id'])->name; 
                                                            else 
                                                                 echo " - "; 
                                                       ?>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                            <?php 
                                                                if(vendor::model()->findByPk($pods[$k]->vendor_id) != null) 
                                                                    if(vendor::model()->findByPk($pods[$k]->vendor_id)->name == "")
                                                                         echo " - ";
                                                                     else
                                                                          echo vendor::model()->findByPk($pods[$k]->vendor_id)->name; 
                                                                else 
                                                                    echo " - ";  
                                                            ?>
                                                        
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    
                                                           <?php 
                                                                    if(product::model()->findByPk($pods[$k]->product_id) != null)
                                                                        if(product::model()->findByPk($pods[$k]->product_id)->name == "")
                                                                            echo " - ";
                                                                        else
                                                                            echo product::model()->findByPk($pods[$k]->product_id)->name; 
                                                                    else 
                                                                        echo " - ";  
                                                          ?>
                                                       
                                                </center>
                                           </td>
                                           <td>
                                                <center>
                                                          -
                                                </center>
                                          </td>
                                          <td>
                                                <center>
                                                   -
                                                </center>
                                        </td>
                                        <td>
                                                <center>
                                                           <?php
                                                            if($row['customerPOdate'] != null){
                                                                    $row['customerPOdate'] = date("d/m/Y", strtotime($row['customerPOdate']));
                                                                 }else{
                                                                     $row['customerPOdate'] = "";
                                                                 }

                                                    if($row['customerPOdate'] == "" || $row['customerPOdate'] == null)
                                                        echo " - ";
                                                    else
                                                        echo $row['customerPOdate'];
                
                                                          ?>
                                                </center>
                                            
                                        </td>
                                        <td>
                                                <center>
                                                          <?php    
                                                              echo $pods[$k]->qty;
                                                            ?>
                                                </center>
                                            
                                        </td>
                                        <td>
                                            <center>
                                                      <?php    
                                                            echo $pods[$k]->unitPrice;
                                                      ?>
                                            </center>
                                            
                                        </td>

                         </tr>

            <?php                                } // DISPLAY    
                                            }
                                         }

                        }
                        if($ind >= count($quods)){ $ind = 0; $case = 0; $pods=null; $quods = null;$pod_index = array();}
            }
?> 

                        
                  </tbody>
                </table>