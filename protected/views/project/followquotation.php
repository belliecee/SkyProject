<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>


<script>
    
    $(function(){
        $('.inputtext').keypress(function(e){
            if(e.which == 13)
                $("#fq").submit();
        });
        
         $('#search').click(function(){
                $("#fq").submit();
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
          ajaxautocomplete($("#type"),"type");
           
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

 

<div class="title2" style="border-bottom: none;">Follow Quotation</div>
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
    
    
<div id="show-contain" class="ui-widget" style="margin:40px 0 0 0;">

<?php 

          
        $quod = quod::model()->findAll();



?>
  
   
       
          
                <table id='payment_table_view' class="table_view1">
                  <thead>
                    <tr  class="table_view1_header">
                     <th style="min-width:50px;">Project No.</th>
                      <th style="min-width:70px;">Customer</th>
                      <th style="min-width:70px;">Vendor</th>
                      <th style="min-width:70px;">Model</th>
                      <th style="min-width:70px;">Type</th>
                      <th style="min-width:70px;">Qty</th>
                       <th style="min-width:70px;">Price</th>
                      <th style="min-width:70px;">Follow Date </th>
                      <th style="min-width:70px;">Contact</th>
                      <th style="min-width:70px;">Detail</th>
                      <th style="min-width:70px;">Follow by</th>
                      
                    </tr>
                    <tr  class="table_view1_header" style="height:20px;">
                      <div class="form"> 
                      <form id="fq" method="POST">
                       <th style="min-width:50px; background-color:white; "><input type="text" name="projectNo" style="width:100%;height:20px; "class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" id="customer" name="customer" style="width:100%;height:20px; "class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" id="vendor" name="vendor"  style="width:100%; height:20px;" class="inputtext"/></th>  
                       <th style="min-width:50px; background-color:white; "><input type="text" id="product"  name="product"  style="width:100%; height:20px;" class="inputtext"/></th> 
                       <th style="min-width:50px; background-color:white; "><input type="text" id="type" name="type"  style="width:100%; height:20px;" class="inputtext"/></th>  
                       <th style="min-width:50px; background-color:white; "></th> 
                       <th style="min-width:50px; background-color:white; "></th> 
                     
                       <th style="min-width:50px; background-color:white; "><input type="text" name="followedDate" style="width:100%; height:20px;" class="inputtext"/></th>  
                      <th style="min-width:50px; background-color:white; "><input type="text" name="contact" style="width:100%;height:20px; " class="inputtext"/></th>    
                      <th style="min-width:50px; background-color:white; "><input type="text" name="detail" style="width:100%; height:20px;" class="inputtext"/></th>
                      <th style="min-width:50px; background-color:white; "><input type="text"  name="followedBy" style="width:100%; height:20px;" class="inputtext"/></th>  
                      </form>
                          
                    
                      </div>
                    </tr>
                  </thead>
                  <tbody>
<?php 


               $con = "WHERE sky1_project.mcstatus LIKE '%Follow Quotation%' and sky1_quoh.status = 1 ";
  
              if($projectNo != "")
                    $con =  "$con and sky1_project.projectNo LIKE '$projectNo' ";
             
                if($customer != "")
                    $con =    "$con and sky1_customer.name LIKE '$customer' ";
                if($vendor != "")
                    $con =    "$con and sky1_vendor.name LIKE '$vendor' ";
                if($product != "")
                    $con =    "$con and sky1_product.name LIKE '$product' ";
                if($type != "")
                    $con =    "$con and sky1_type.name LIKE '$type' ";
                
               
                
              
               
              
                              ;


                $sql   =   "
                            SELECT 
                            sky1_project.id project_id, 
                            sky1_project.projectNo, 
                            sky1_enquiry.customer customer_id,
                            sky1_customer.name customer_name,
                            sky1_quoh.id quoh_id,
                            sky1_vendor.name,
                            sky1_quoh.quoteNo,
                            sky1_quod.vendor_id,
                            sky1_quod.product_id,
                            sky1_quod.type_id,
                            sky1_quod.qty,
                            sky1_quod.unitPrice,
                             sky1_vendor.name vendor,
                            sky1_product.name product,
                            sky1_type.name type
                            
                            

                       
                            
                            from sky1_project
                            
                            LEFT JOIN sky1_enquiry
                            ON sky1_project.id = sky1_enquiry.project_id

                            JOIN sky1_customer
                            ON sky1_customer.id = sky1_enquiry.customer
                            
                            
                            
                            JOIN sky1_quoh
                            ON sky1_project.id = sky1_quoh.project_id
                            
                            RIGHT JOIN sky1_quod
                            on sky1_quod.quoH_id = sky1_quoh.id
                            
                            LEFT JOIN sky1_vendor
                            ON sky1_vendor.id = sky1_quod.vendor_id
                            
                            LEFT JOIN sky1_product
                            ON sky1_product.id = sky1_quod.product_id
                            
                            LEFT JOIN sky1_type
                            ON sky1_type.id = sky1_quod.type_id


                             $con
                            ORDER BY sky1_project.id DESC, sky1_quoh.id  ASC, sky1_quod.id  ASC 
                     
                            ;
                              ";
               
                
                $rows = Yii::app()->db->createCommand($sql)->queryAll();
                $index = -1;
                $sortedlist = array();
                foreach($rows as $row)
                {
                    $index++;
               $con2 = "";
               $con2 = "$con2 WHERE sky1_quotefollow.quoH_id = ".$row['quoh_id'];
               
                 if($contact != "")
                    $con2 =    "$con2 and sky1_quotefollow.contact LIKE '%$contact%' ";
                 if($detail != "")
                    $con2 =    "$con2 and sky1_quotefollow.detail LIKE '%$detail%' ";
                  if($followedBy != "")
                    $con2 =    "$con2 and sky1_user.username LIKE '%$followedBy%' ";
               
                if($followedDate != "")
                {
                   
                      
                    
                            if($followedDate != null){
                                $explodeStr = explode("/",$followedDate);
                                $newDate = ""; 
                                $count = 0;
                                foreach($explodeStr as $eachStr){
                                    if($count == 0)
                                        $newDate = $newDate.$eachStr;
                                    else
                                        $newDate = $eachStr."-".$newDate;
                                    $count++;
                                }
                                $followedDate = date("Y-m-d", strtotime($newDate));
                                 $con2 =    "$con2 and sky1_quotefollow.followedDate = '$followedDate' and  sky1_quotefollow.followedDate != '' ";
                            }else{
                                $followedDate = null;
                        }
                  
                    
               }  
               
               
                        
                     $sqlmax   =   "
                            SELECT 
                            max(sky1_quotefollow.id) as lastest, 
                            sky1_quotefollow.followedDate  lastfollowedDate, 
                            sky1_quotefollow.contact  lastcontact,
                            sky1_quotefollow.detail lastdetail,
                            sky1_user.username,
                            sky1_quotefollow.followedBy lastfollowedBy
                          
                            from sky1_quotefollow
                            JOIN sky1_user
                            ON sky1_user.id = sky1_quoteFollow.followedBy
                            
                            
                            
                            $con2
                            GROUP BY sky1_quotefollow.quoH_id
                           
                            
                            ;
                              ";
                     
                      $sqlmax2   =   "
                            SELECT 
                            sky1_quotefollow.id  lastest,
                            sky1_quotefollow.followedDate  lastfollowedDate, 
                            sky1_quotefollow.contact  lastcontact,
                            sky1_quotefollow.detail lastdetail,
                            sky1_user.username,
                            sky1_quotefollow.followedBy lastfollowedBy
                          
                            from sky1_quotefollow
                            JOIN sky1_user
                            ON sky1_user.id = sky1_quoteFollow.followedBy
                            
                            
                            
                            $con2
                            ORDER BY sky1_quotefollow.followedDate desc, sky1_quotefollow.id desc
                            limit 1
                           
                            
                            ;
                              ";
                        $quote = Yii::app()->db->createCommand($sqlmax2)->queryAll();

                      

                        
 ?>
                      
                      
             <?php 
             
              
             
                       if($quote != null){
                           
                           
                            $sortedlist[$index]["projectNo"]        = $row['projectNo'];
                            $sortedlist[$index]["customer_name"]    = $row['customer_name'];
                            $sortedlist[$index]["vendor"]           = $row['vendor'];
                            $sortedlist[$index]["product"]          = $row['product'];
                            $sortedlist[$index]["type"]             = $row['type'];
                            $sortedlist[$index]["qty"]              = $row['qty'];
                            $sortedlist[$index]["unitPrice"]        = $row['unitPrice'];
                            $sortedlist[$index]["project_id"]       = $row['project_id'];
                            $sortedlist[$index]["quoh_id"]          = $row['quoh_id'];
                            
                            $sortedlist[$index]["lastfollowedDate"] = $quote[0]['lastfollowedDate'];
                            $sortedlist[$index]["lastcontact"]      = $quote[0]['lastcontact'];
                            $sortedlist[$index]["lastdetail"]       = $quote[0]['lastdetail'];
                            $sortedlist[$index]["username"]         = $quote[0]['username'];
                            
              ?>
       
                              

                            

 <?php
                       }   // CHECK quote is null or not
            } // Foreach Loop
            /*
                         function sortinglist($a, $b) {
                                if($a["lastfollowedDate"] == $b["lastfollowedDate"]){ return 0 ; }
                                return ($a["lastfollowedDate"] > $b["lastfollowedDate"]) ? -1 : 1;
                        }
                        function sortingsame($a, $b) {
                                if($a["projectNo"] == $b["projectNo"]){ return 0 ; }
                                return ($a["projectNo"] > $b["projectNo"]) ? -1 : 1;
                        }
            */            
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
                        $sortedlist = msort($sortedlist, array('lastfollowedDate', 'projectNo'));
  /*                      
                        echo "<pre>";
                        print_r($sortedlist);
                        echo "</pre>";
                        
                        
                        
                        

                      
                        echo "-------------------------------------------------------------------------<br/>";
                         echo "<pre>";
                        print_r($sortedlist);
                         echo "</pre>";
   * 
   */
                        
                       // usort($sortedlist,'sortings');
      /*                  
                if($quote !=null){
                        if($quote[0]['lastfollowedDate'] != null){
                                  $quote[0]['lastfollowedDate'] = date("d/m/Y", strtotime($quote[0]['lastfollowedDate']));
                        }else{
                                  $quote[0]['lastfollowedDate'] = "";
                       }
                }
       * 
       */
                        
                        while (list($key, $value) = each($sortedlist)) 
                        {
?>
                                <tr class="table_tr_quod" >
                                    <td><center><?php echo CHtml::link($value['projectNo'],array('quoh/index','project_id'=>$value['project_id']));  ?></center></td>
                                    <td><center><?php  echo $value['customer_name']; ?></center></td>
                                    <td><center><?php  if($value['vendor'] === null || $value['vendor'] === ""){echo "-";} else{ echo $value['vendor'];} ?></center></td>
                                    <td><center><?php  if($value['product'] === null || $value['product'] === ""){echo "-";} else{ echo $value['product'];} ?></center></td>
                                    <td><center><?php   if($value['type'] === null || $value['type'] === ""){echo "-";} else{ echo $value['type'];} ?></center></td>
                                    <td><center><?php   if($value['qty'] === null || $value['qty'] === ""){echo "-";} else{ echo $value['qty'];} ?></center></td>
                                    <td><center><?php   if($value['unitPrice'] === null || $value['unitPrice'] === ""){echo "-";} else{ echo $value['unitPrice'];} ?></center></td>
                                    <td><center>
                                    <?php 
                                                        if($value['lastfollowedDate'] != null){
                                                               $value['lastfollowedDate'] = date("d/m/Y", strtotime($value['lastfollowedDate']));
                                                                echo CHtml::link($value['lastfollowedDate'] ,array('quotefollow/index','quoh_id'=>$value['quoh_id'],'project_id'=>$value['project_id']));
                                                                
                                                        }else{
                                                            echo "-";
                                                        }
                                    
                                    
                                    
                                    ?></center></td>
                                    <td><center><?php  if($value['lastcontact'] != null) echo $value['lastcontact']; ?></center></td>
                                    <td><center><?php if($value['lastdetail'] != null) echo $value['lastdetail'] ?></center></td>
                                    <td><center><?php if($value['username']){ echo $value['username'];} //if( user::model()->findByPk($quote[0]['username'])) echo user::model()->findByPk($quote[0]['followedBy'])->username;} ?></center></td>
                               </tr>  
                               
<?php                          
                        }
?> 

                               
                               
                               
                        
                  </tbody>
                </table>