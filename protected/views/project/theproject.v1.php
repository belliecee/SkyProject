<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>


<script>
    
    $(function(){
        
        var machineType = '<?php echo $machineType; ?>';
        var status = '<?php echo $status; ?>';
        
        $('.inputtext').keypress(function(e){
            if(e.which == 13)
                $("#theproject").submit();
        });
          $('#search').click(function(){
                $("#theproject").submit();
        });
/*        
        $('#machinetype').change(function(){
                $("#theproject").submit();
        });
         $('#status').change(function(){
                $("#theproject").submit();
        });
*/        
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



<div class="title2" style="border-bottom: none;">All Projects</div>
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
              $machineType = 0;
              
          if($status == null)
              $status = "";

         

?>
    
<div id="show-contain" class="ui-widget" style="margin:40px 0 0 50px;">


  
   
       
          
                <table id='payment_table_view' class="table_view1">
                  <thead>
                    <tr  class="table_view1_header">
                     <th style="min-width:50px;" >No.</th>
                      <th style="min-width:50px;">Project No.</th>
                      <th style="min-width:70px;">Machine Type</th>
                      <th style="min-width:100px;">Status</th>
                      <th style="min-width:70px;">Customer</th>
                       <th style="min-width:70px;">Vendor</th>
                     
                      
                    </tr>
                    <tr  class="table_view1_header" style="height:20px;">
                      <div class="form"> 
                       <form id="theproject" method="POST">
                      <th style="min-width:50px; background-color:white; "></th>
                     <th style="min-width:50px; background-color:white; "><input type="text" name="projectNo" style="width:100%; height:20px;" class="inputtext"/></th>
                     <th style="min-width:50px; background-color:white; ">
                     
                              <select name="machineType"  style="width:100%; height:30px;" class="inputtext" id="machinetype" value="$machineType"> 
                             <option value="">All</option>      
                            <option value="1" >Taiwan</option> 
                             <option value="2" >Made </option> 
                            <option value="3" >Stock</option>
                            
                            </select>
                        <!--  <input type="text" name="machineType" style="width:100%; height:20px;" class="inputtext"/> -->
                     </th>
                      <th style="min-width:50px; background-color:white; ">
                        <select name="status"  style="width:100%; height:30px;" class="inputtext" id="status">
                          <?php
                                
                     
                               $mctype = array("Create Project","Customer Enquiry","Send Enquiry to Vendor","Vendor sends Quotation back","Send Quotation to Customer","Follow Quotation","Customer PO","Customer Deposit","PO to Vendor","Goods arrive office","Delivery","Completed","Cancel","Waiting");
                               
                               
                                 echo "<option value=''>All</option>";
                                 foreach($mctype as $mc){
                                    echo "<option value='".$mc."'>".$mc."</option>";
                                 }
                                  
                         ?>              
                            </select>
                         </th>
                        <th style="min-width:50px; background-color:white; "><input type="text" id="customer" name="customer" style="width:100%; height:20px;" class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" id="vendor" name="vendor" style="width:100%; height:20px;" class="inputtext"/></th>
                      
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

                        if(($machineType == 2) && ($status == 13)){
                              $statusstr = "Goods finished date"; 
                         }
                         else if(($machineType == 2) && ($status == 8)){
                             $status = 12; 
                         }
                         
                      
                        
                        

              $con = "";
              $con =  "$con  WHERE sky1_project.projectNo LIKE '%$projectNo%' ";
    
                   if($vendor != "")
                    $con =    "$con and sky1_vendor.name LIKE '%$vendor%' ";
                   if($customer != "")
                    $con =    "$con and sky1_customer.name LIKE '%$customer%' ";
                  
                   if($machineType != "" && $machineType != 4)
                    $con =    "$con and sky1_project.machineType = '$machineType' ";
                    if($status != "")
                        $con =    "$con and sky1_project.mcstatus LIKE '%$status%' ";
                   
                   
                   
           
              
                $sql   =   "
                            SELECT 
                            sky1_project.id project_id,
                            sky1_project.projectNo, 
                            sky1_enquiry.customer customer_id,
                            sky1_customer.name,
                            sky1_project.machinetype,
                            sky1_project.status,  
                             sky1_project.mcstatus,  
                            sky1_vendorprocess.vendor_id, 
                            sky1_vendor.name
                            
                         


                            from sky1_project

                            LEFT JOIN sky1_enquiry
                            ON sky1_project.id = sky1_enquiry.project_id
                            
                            LEFT JOIN sky1_customer
                            ON sky1_customer.id = sky1_enquiry.customer
                            

                            LEFT JOIN sky1_vendorprocess
                            ON sky1_project.id = sky1_vendorprocess.project_id
                            

                            
                            
                            LEFT JOIN sky1_vendor
                            ON sky1_vendor.id = sky1_vendorprocess.vendor_id
                          
                             
                              $con
                                  
                              ORDER BY project_id DESC

                            ;

                              

                             
                              ";
                $rowNo = 0;
                
                $rows = Yii::app()->db->createCommand($sql)->queryAll();
                foreach($rows as $row)
                {
                        
                    

 ?>
                      
                      
        
           


                               <tr class="table_tr_quod" >
                                <td><center><?php echo ++$rowNo; ?>.</center></td>
                                <td><center><?php echo CHtml::link($row['projectNo'],array('enquiry/index','project_id'=>$row['project_id']));  ?></center></td>
                               
                                 <td><center><?php 
                                         if (projectstatus::model()->findByPk($row['machinetype']) != null){
                                                if (projectstatus::model()->findByPk($row['machinetype'])->id >= 1 && projectstatus::model()->findByPk($row['machinetype'])->id <= 3){
                                                     echo machineType::model()->findByPk($row['machinetype'])->type; 
                                                }else
                                                {
                                                     echo "-"; 
                                                }
                                         }else{
                                             echo "-"; 
                                               
                                         }
                                      
                                      
                                      
                                      ?></center></td>
                                            <td><center><?php 
                                            
                                                echo $row['mcstatus'];
                                            
                                            /*
                                                              if(($machineType == 2) && ($status == 13)){
                                                                    echo "Goods finish"; 
                                                               }
                                                               else if(($machineType == 2) && ($status == 12)){
                                                                   echo "Customer Deposit";  
                                                               }
                                                               else{
                        
                                                                            if (projectstatus::model()->findByPk($row['status']) != null){
                                                                              if/*(*/ //(projectstatus::model()->findByPk($row['status'])->id >= 1 && projectstatus::model()->findByPk($row['status'])->id <=19) //|| projectstatus::model()->findByPk($row['status'])->id == 18)
                                                           /*                             echo projectstatus::model()->findByPk($row['status'])->status;  
                                                                                  else
                                                                                         echo "-";  

                                                                             }
                                                                             else{
                                                                                  echo "-";  
                                                                             }
                                                               }
                                                 */
                                                ?>
                
                                              </center></td>
                                  <td><center><?php
                                             if($row['machinetype'] == 3){
                                                 echo "-";
                                             }else{
                                                 if(customer::model()->findByPk($row['customer_id']) != null) echo customer::model()->findByPk($row['customer_id'])->name; else{echo "-";} 
                                            
                                                 
                                             }
                                                ?></center></td>
                                  <td><center><?php
                                            if($row['machinetype'] != 3){
                                                
                                                if(vendor::model()->findByPk($row['vendor_id']) != null) echo vendor::model()->findByPk($row['vendor_id'])->name; else{echo "-";} 
                                            }else{
                                                if(vendor::model()->findByPk($row['customer_id']) != null) echo vendor::model()->findByPk($row['customer_id'])->name; else{echo "-";} 
                                            }
                                                
                                                
                                             ?></center></td>
                                
                               
                              
                               
                  

                               </tr>  
               

 <?php
            }
?> 

                        
                  </tbody>
                </table>