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

                function msort($array, $key, $sort_flags = SORT_REGULAR) {
                                if (is_array($array) && count($array) > 0) {
                                    if (!empty($key)) {
                                        $mapping = array();
                                        foreach ($array as $k => $v) {
                                            $sort_key = '';
                                            if (!is_array($key)) {
                                                $sort_key = $v[$key];
                                            } else {
                                                // @TODO This should be fixed, now it will be sorted as string
                                                foreach ($key as $key_key) {
                                                    $sort_key .= $v[$key_key];
                                                }
                                                $sort_flags = SORT_STRING;
                                            }
                                            $mapping[$k] = $sort_key;
                                        }
                                        arsort($mapping, $sort_flags);
                                        $sorted = array();
                                        foreach ($mapping as $k => $v) {
                                            $sorted[] = $array[$k];
                                        }
                                        return $sorted;
                                    }
                                }
                                return $array;
                        }
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
             
                 $con2 = $con;
                  if($product != ""){
                      $con2 =    "$con and sky1_productenquiry.name LIKE '%$product%' "; 
                      $con  =    "$con and sky1_product.name LIKE '%$product%' "; 
                      
                  }
                  
                 
                
                  
                  $sql2   =   "
                            SELECT 
                            sky1_project.id project_id, 
                            sky1_project.projectNo, 
                            sky1_productenquiry.name product_name,
                            sky1_productenquiry.qty podqty,
                            sky1_enquiry.customer vendor_id,
                            sky1_vendor.name vendor_name,
                            sky1_potovendor.orderDate,
                            sky1_potovendor.vendorDeliveryDate
                          
                            
                            from sky1_project
                            
                            JOIN sky1_enquiry
                            ON sky1_project.id = sky1_enquiry.project_id
                            
                        
                           
                            
                            LEFT JOIN sky1_potovendor
                            ON sky1_project.id = sky1_potovendor.project_id
                            
                          
                           
                            LEFT JOIN sky1_vendor
                            ON sky1_vendor.id = sky1_enquiry.customer
                            
                            RIGHT JOIN sky1_productenquiry
                            ON sky1_project.id = sky1_productenquiry.project_id
                            
                          
                            
                            $con2
                           
                        
                            ;
                              ";
               
// There is no ST group if finding with customer or customerDeliveryDate
           $rows2 = array();
            if(($customer == "" || $customer == null)&&($duecustomerdate == "" || $duecustomerdate == null)){
                $rows2 = Yii::app()->db->createCommand($sql2)->queryAll();
                 foreach($rows2 as $_rows2)
                     {
                            $_rows2['custommer_id'] = null;
                            $_rows2['customerDeliveryDate'] = null;
                   
                     }  
            }
                
                
                   
                
    /**************** Because there is no customerduedate and cusotmer in SQL2  **********************/      
                 if($customer != "")
                    $con =    "$con and sky1_customer.name LIKE '%$customer%' ";
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
                            sky1_project.id project_id, 
                            sky1_project.projectNo, 
                            sky1_enquiry.customer,
                            sky1_customer.id customer_id,
                            sky1_customer.name customer_name,
                            sky1_pod.product_id,
                            sky1_pod.vendor_id,
                            sky1_vendor.name vendor_name,
                            sky1_pod.qty podqty,
                            sky1_product.name product_name,
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
                           
                         
                            ;
                              ";
               
                $rows = array();
                $rows = Yii::app()->db->createCommand($sql)->queryAll();
                
                
              
                
                          
                
                   
  
                     //$sortedlist = array($rows,$rows2);

            $index = -1;
            $sortedlist = array();
             foreach($rows as $row)
             {
                  $index++;
                       if($rows != null){
                           
                            $sortedlist[$index]["project_id"]              = $row['project_id'];
                            $sortedlist[$index]["projectNo"]               = $row['projectNo'];
                            $sortedlist[$index]["customer_name"]           = $row['customer_name'];
                            $sortedlist[$index]["vendor_name"]             = $row['vendor_name'];
                            $sortedlist[$index]["product_name"]            = $row['product_name'];
                            $sortedlist[$index]["podqty"]                  = $row['podqty'];
                            $sortedlist[$index]["orderDate"]               = $row['orderDate'];
                            $sortedlist[$index]["vendorDeliveryDate"]      = $row['vendorDeliveryDate'];
                            $sortedlist[$index]["customerDeliveryDate"]    = $row['customerDeliveryDate'];
            
                       }
             }
         if($rows2 != null){ 
             foreach($rows2 as $row)
             {
                  $index++;
                     
                           
                            $sortedlist[$index]["project_id"]            = $row['project_id'];
                            $sortedlist[$index]["projectNo"]             = $row['projectNo'];
                            $sortedlist[$index]["customer_name"]         = null;
                            $sortedlist[$index]["vendor_name"]           = $row['vendor_name'];
                            $sortedlist[$index]["product_name"]          = $row['product_name'];
                            $sortedlist[$index]["podqty"]                = $row['podqty'];
                            $sortedlist[$index]["orderDate"]             = $row['orderDate'];
                            $sortedlist[$index]["vendorDeliveryDate"]    = $row['vendorDeliveryDate'];
                            $sortedlist[$index]["customerDeliveryDate"]  = null;
                      
              }
           }       
            
             
            
                      //  echo"<pre>";     print_r($sortedlist) ; echo"</pre>"; 
                       $newsortedlist = msort($sortedlist, array('vendorDeliveryDate','projectNo'));
                    //   echo "<br/><br/><br/><br/><br/>";
                    //   echo"<pre>";     print_r($newsortedlist) ; echo"</pre>"; 
              ?>
                
                
                
            
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
<?php                

/*
                // REVERSE 
echo "<br/>";echo "<br/>";echo "<br/>";
                $len =  count($newsortedlist)-1;
                $ind = 0;
                foreach ($newsortedlist as $rev){
                    
                    echo $ind." ::: ".$newsortedlist[$ind]['product_name']." ::: ".$newsortedlist[$ind]['vendorDeliveryDate'];
                    echo "<br/>";
                    $ind++;
                }
      
 * 
 */          
                 //while (list($key, $value) = each($newsortedlist)) 
                 for($i=count($newsortedlist)-1;$i>=0;$i--)
                 {
                        

 ?>
             <?php 
                    
       
                     if($newsortedlist[$i]['orderDate'] != null){
                            $newsortedlist[$i]['orderDate'] = date("d/m/Y", strtotime($newsortedlist[$i]['orderDate']));
                        }else{
                            $newsortedlist[$i]['orderDate'] = "";
                        }
                   
           
                     if($newsortedlist[$i]['vendorDeliveryDate'] != null){
                            $newsortedlist[$i]['vendorDeliveryDate'] = date("d/m/Y", strtotime($newsortedlist[$i]['vendorDeliveryDate']));
                        }else{
                            $newsortedlist[$i]['vendorDeliveryDate'] = "";
                        }
                   
            
              
                    if($newsortedlist[$i]['customerDeliveryDate'] != null){
                            $newsortedlist[$i]['customerDeliveryDate'] = date("d/m/Y", strtotime($newsortedlist[$i]['customerDeliveryDate']));
                        }else{
                            $newsortedlist[$i]['customerDeliveryDate'] = "";
                        }
                   
          
              ?>
       


                               <tr class="table_tr_quod" >
                
                                <td><center><?php echo CHtml::link($newsortedlist[$i]['projectNo'],array('poh/index','project_id'=>$newsortedlist[$i]['project_id']));  ?></center></td>
                                <td><center><?php if($newsortedlist[$i]['customer_name'] != null &&  $newsortedlist[$i]['customer_name'] !="" ){ echo $newsortedlist[$i]['customer_name'];}else echo "-"; ?></center></td>
                                <td><center><?php if($newsortedlist[$i]['vendor_name'] != null &&  $newsortedlist[$i]['vendor_name'] !="" ){ echo $newsortedlist[$i]['vendor_name'];}else echo "-"; ?></center></td>
                                <td><center><?php if($newsortedlist[$i]['product_name'] != null &&  $newsortedlist[$i]['product_name'] !="" ){ echo $newsortedlist[$i]['product_name'];}else echo "-"; ?></center></td>                
                                <td><center><?php echo $newsortedlist[$i]['podqty']; ?></center></td>
                                <td><center><?php echo $newsortedlist[$i]['orderDate']; ?></center></td>
                                <td><center><?php echo $newsortedlist[$i]['vendorDeliveryDate']; ?></center></td>
                                <td><center><?php if($newsortedlist[$i]['customerDeliveryDate'] != null &&  $newsortedlist[$i]['customerDeliveryDate'] !="" ){ echo $newsortedlist[$i]['customerDeliveryDate'];}else echo "-"; ?></center></td>
                               </tr>  
               

 <?php
            }
          
?> 

                        
                  </tbody>
                </table>