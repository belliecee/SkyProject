<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>




<br/><br/>
<div class="other_header" style="margin-top:-32px;">
<?php  
     //$project_model = project::model()->findByPk($project_id);
     //$this->renderPartial('//project/_form',array('model'=>$project_model)); 
?>    
</div>
<div class="index_content" style=" margin: 0 0 20px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 70px 0 0;width:1000px; min-height: 500px;">

    
    
    
<!------------------ The Button for add an ITEM  ------------------->

 

<div class="title2" style="border-bottom: none;">Taiwan Quotation</div>
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
                      <th style="min-width:50px; background-color:white; "><input type="text" style="width:70px; height:20px;"/></th>
                     <th style="min-width:50px; background-color:white; "><input type="text" style="width:90px;height:20px; "/></th>
                     <th style="min-width:50px; background-color:white; "><input type="text" style="width:100px;height:20px; "/></th>
                      <th style="min-width:50px; background-color:white; "><input type="text" style="width:70px; height:20px;"/></th>
                        <th style="min-width:50px; background-color:white; "><input type="text" style="width:70px;height:20px; "/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" style="width:70px;height:20px; "/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" style="width:70px;height:20px; "/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" style="width:90px; height:20px;"/></th>
                        <th style="min-width:50px; background-color:white; "><input type="text" style="width:100px; height:20px;"/></th>
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
                $sql   =   "
                            SELECT 
                            sky1_project.id project_id,
                            sky1_project.projectNo, 
                            sky1_project.machinetype,
                            sky1_project.status,
                            sky1_enquiry.customer customer_id,
                            sky1_vendorprocess.vendor_id,
                            sky1_pod.product_id,
                            sky1_pod.qty,
                            sky1_potovendor.vendorDeliverydate,
                            sky1_poh.customerDeliveryDate 


                            from sky1_project

                            JOIN sky1_enquiry
                            ON sky1_project.id = sky1_enquiry.project_id
                            JOIN sky1_vendorprocess
                            ON sky1_project.id = sky1_vendorprocess.project_id
                            JOIN sky1_potovendor
                            ON sky1_project.id = sky1_potovendor.project_id
                            
                            JOIN sky1_poh
                            ON sky1_project.id = sky1_poh.project_id

                            JOIN sky1_pod
                            ON sky1_pod.poh_id = sky1_poh.id

                           WHERE (sky1_project.mcstatus LIKE '%PO to Vendor%' AND sky1_project.machineType = 1) 
                                  OR (sky1_project.mcstatus LIKE '%PO to Vendor%' AND sky1_project.machineType = 3)
                              
                            ORDER BY sky1_pod.id ASC
                              ;
                              ";
                $rowNo = 0;
                
                $rows = Yii::app()->db->createCommand($sql)->queryAll();
                foreach($rows as $row)
                {
                        
                    

 ?>
             <?php 
                    if($row['vendorDeliverydate'] !=null  ){
                         if(DateTime::createFromFormat('Y-m-d', $row['vendorDeliverydate'])){
                            $newDate = DateTime::createFromFormat('Y-m-d', $row['vendorDeliverydate']);
                            $row['vendorDeliverydate'] = $newDate->format('d/m/Y');
                         }
                    }
              ?>
             <?php 
                    if($row['customerDeliveryDate'] !=null  )
                    {
                         if(DateTime::createFromFormat('Y-m-d', $row['customerDeliveryDate'])){
                            $newDate = DateTime::createFromFormat('Y-m-d', $row['customerDeliveryDate']);
                            $row['customerDeliveryDate'] = $newDate->format('d/m/Y');
                         }
                    }
              ?>


                               <tr class="table_tr_quod" >
                                <td><center><?php echo ++$rowNo; ?>.</center></td>
                                <td><center><?php echo CHtml::link($row['projectNo'],array('poh/index','project_id'=>$row['project_id']));  ?></center></td>
                               
                                 <td><center><?php echo machineType::model()->findByPk($row['machinetype'])->type; ?></center></td>
                                 <td><center><?php echo projectstatus::model()->findByPk($row['status'])->status;  ?></center></td>
                                   <td><center><?php echo customer::model()->findByPk($row['customer_id'])->name; ?></center></td>
                                  <td><center><?php echo vendor::model()->findByPk($row['vendor_id'])->name; ?></center></td>
                                 <td><center><?php echo product::model()->findByPk($row['product_id'])->name; ?></center></td>
                                 <td><center><?php echo $row['vendorDeliverydate']; ?></center></td>
                                <td><center><?php echo $row['customerDeliveryDate']; ?></center></td>
                               
                              
                               
                  

                               </tr>  
               

 <?php
            }
?> 

                        
                  </tbody>
                </table>