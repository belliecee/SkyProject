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

 

<div class="title2" style="border-bottom: none;">Waiting Quotation</div>
<div class="bottomline"></div>
<!--------------------------- Start Table ----------------------------------------->

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
                      <th style="min-width:70px;">Customer</th>
                      <th style="min-width:70px;">Vendor</th>
                      <th style="min-width:70px;">Quote No</th>
                    
                      <th style="min-width:70px;">Follow Date </th>
                      <th style="min-width:70px;">Contact</th>
                      <th style="min-width:70px;">Detail</th>
                      <th style="min-width:70px;">Follow by</th>
                      
                    </tr>
                    <tr  class="table_view1_header" style="height:20px;">
                      <div class="form"> 
                      
                       <th style="min-width:50px; background-color:white; "><input type="text" style="width:100%;height:20px; "class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" style="width:100%;height:20px; "class="inputtext"/></th>
                       <th style="min-width:50px; background-color:white; "><input type="text" style="width:100%; height:20px;" class="inputtext"/></th>  
                      <th style="min-width:50px; background-color:white; "><input type="text" style="width:100%;height:20px; " class="inputtext"/></th> 
                       <th style="min-width:50px; background-color:white; "><input type="text" style="width:100%; height:20px;" class="inputtext"/></th>  
                      <th style="min-width:50px; background-color:white; "><input type="text" style="width:100%;height:20px; " class="inputtext"/></th>    
                      <th style="min-width:50px; background-color:white; "><input type="text" style="width:100%; height:20px;" class="inputtext"/></th>
                      <th style="min-width:50px; background-color:white; "><input type="text" style="width:100%; height:20px;" class="inputtext"/></th>  
                      
                          
                    
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
                            sky1_enquiry.customer customer_id,
                            sky1_vendorprocess.vendor_id,
                            sky1_quoh.id quoh_id,
                            sky1_quoh.quoteNo
                           
                            

                       
                            
                            from sky1_project
                            
                            JOIN sky1_enquiry
                            ON sky1_project.id = sky1_enquiry.project_id
                            
    
                            JOIN sky1_vendorprocess
                            ON sky1_project.id = sky1_vendorprocess.project_id
                            
                            JOIN sky1_quoh
                            ON sky1_project.id = sky1_quoh.project_id
                            
                            WHERE sky1_quoh.status = 2
                            ;
                              ";
               
                
                $rows = Yii::app()->db->createCommand($sql)->queryAll();
                foreach($rows as $row)
                {
                        
                     $sqlmax   =   "
                            SELECT 
                            max(sky1_quotefollow.id) as lastest, 
                            sky1_quotefollow.followedDate, 
                            sky1_quotefollow.contact,
                            sky1_quotefollow.detail,
                            sky1_quotefollow.followedBy
 
                            from sky1_quotefollow
                            WHERE sky1_quotefollow.quoH_id = ".$row['quoh_id']."
                            GROUP BY sky1_quotefollow.quoH_id
                           
                            
                            ;
                              ";
                        $quote = Yii::app()->db->createCommand($sqlmax)->queryAll();

 ?>
             <?php 
              if($quote !=null){
                    if($quote[0]['followedDate'] !=null  ){
                         if(DateTime::createFromFormat('Y-m-d', $quote[0]['followedDate'])){
                            $newDate = DateTime::createFromFormat('Y-m-d', $quote[0]['followedDate']);
                            $quote[0]['followedDate'] = $newDate->format('d/m/Y');
                         }
                    }
              }
              ?>
       


                               <tr class="table_tr_quod" >
                
                                <td><center><?php echo CHtml::link($row['projectNo'],array('quoh/index','project_id'=>$row['project_id']));  ?></center></td>
                                <td><center><?php if(customer::model()->findByPk($row['customer_id']) != null)  echo customer::model()->findByPk($row['customer_id'])->name; ?></center></td>
                                <td><center><?php if(vendor::model()->findByPk($row['vendor_id']) != null) echo vendor::model()->findByPk($row['vendor_id'])->name; ?></center></td>
                                <td><center><?php  echo  CHtml::link($row['quoteNo'],array('quoh/index','project_id'=>$row['project_id'])); ?></center></td>          
                                <td><center><?php if($quote != null) echo CHtml::link($quote[0]['followedDate'],array('quotefollow/index','quoh_id'=>$row['quoh_id'],'project_id'=>$row['project_id']));  ?></center></td>
                                <td><center><?php  if($quote != null) echo $quote[0]['contact']; ?></center></td>
                                <td><center><?php if($quote != null) echo $quote[0]['detail']; ?></center></td>
                                <td><center><?php if($quote){  if( user::model()->findByPk($quote[0]['followedBy'])) echo user::model()->findByPk($quote[0]['followedBy'])->username;} ?></center></td>
                               </tr>  
               
               

 <?php
            }
?> 

                        
                  </tbody>
                </table>