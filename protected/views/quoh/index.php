<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>




<br/><br/>
<?php  
     $project_model = project::model()->findByPk($model->project_id);
     
     //echo $project_model->existInStock;
?>
<div class="other_header" style="margin-top:-32px;">
<?php
     $this->renderPartial('//project/_form',array('model'=>$project_model)); 
?>
</div>
         
<?php

         if(Yii::app()->user->isGuest){
             $this->redirect(Yii::app()->homeUrl);
         }
          else{
            $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
            $auth = usergroup::model()->findByAttributes(array('name'=>$group));
             if($auth->quoh_read == 0){
                  $this->redirect(Yii::app()->homeUrl);
             }
            
         }

 
        if($project_model->status  == 5 || $project_model->status  == 4)
        {
            if(!Yii::app()->user->isGuest){

                    $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
                    $auth = usergroup::model()->findByAttributes(array('name'=>$group));
                     if($auth->quoh_update == 0){
                          $dis = true;
                     }
                     else{
                          $dis = false;
                     }
                        
            }else{
                $this->redirect(Yii::app()->homeUrl);
            }
        }
        else
        {
            $dis = true;
        }
        
        
?>
 
<script> 
    
    $(function(){
        
        
        
     
       
         var quohurl = '<?php echo $this->createUrl("quoh/create"); ?>';
          $("#addQuotation").click(function(){
                        var project_id =  '<?php echo $project_id; ?>' ; //$(this).data('projectID');
                       
                       //var submitstatus = 3; 
                       $.ajax({
                                    url: quohurl,
                                    data: {project_id:project_id},
                                    type: 'get',
                                    dataType: 'html',
                                    success:function(data){
                                        
                                          $("#show_quoh").append(data);
                                    },
                                    error: function() { // if error occured
                                          alert("Error: Add Quotation  occured.please try again");    
                                     }
                             }); 
                                    
            });
            
            $(".quohfield").click(function(){
                        var project_id =  '<?php echo $project_id; ?>' ; //$(this).data('projectID');

                       //var submitstatus = 3; 
                       $.ajax({
                                    url: quohurl,
                                    data: {project_id:project_id},
                                    type: 'get',
                                    dataType: 'html',
                                    success:function(data){
                                        
                                          $("#show_quoh").append(data);
                                    },
                                    error: function() { // if error occured
                                          alert("Error: Add Quotation  occured.please try again");    
                                     }
                             }); 
                                    
            });
            
            
         
          
    });
    
    
</script>


<div class="index_content" style=" margin: 0 0 20px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 70px 0 0;width:1000px;">

<?php
   
      if($auth->quoh_update == 1){       
          
    if($project_model->status  == 4)
    {
          
?>  
            <div id="addQuotation" class="simple_button" style="display: inline-block;float: right;">Add Quotation</div>
<?php }} ?>
    
<!--    
    <div id="addQuotation" class="simple_button" style="float: right;"> Add Quotation</div>
-->    
    <div class="title2" style="border-bottom: none;"> Sky Quotation </div>
    
    <div id="show_quoh">
         <?php  $quoh_model = quoh::model()->findAll('project_id=:project_id',array(":project_id"=>$project_id)); ?>
        <?php
            foreach($quoh_model as $_model)
             {
              
                echo '<div id="realContent">';
                    $this->renderPartial('_form',array('model'=>$_model,'project_model'=>$project_model));
                echo '</div>';
                
              
                
             }
             
         ?>
  </div>
</div> 


<div id="viewdetail">    
<?php
    $this->renderPartial('//quoteFollow/index',array('project_id'=>$project_id)); 
?>
</div> 

<script> 
    
    $(function(){
      
              
              
              
              
              var plusurl = '<?php echo $this->createUrl("project/plusstatus"); ?>';
              var minusurl = '<?php echo $this->createUrl("project/minusstatus"); ?>';
              var rejecturl = '<?php echo $this->createUrl("project/rejectstatus"); ?>';
 /*             
               $("#submit").click(function(){
                        var project_id =  <?php echo $project_model->id; ?> ; //$(this).data('projectID');

                       //var submitstatus = 3; 
                       $.ajax({
                                    url: plusurl,
                                    data: {project_id:project_id},
                                    type: 'get',
                                    dataType: 'html',
                                    success:function(data){
                                          $(".other_header").html(data);
                                    },
                                    error: function() { // if error occured
                                          alert("Error  occured.please try again");    
                                     }
                             }); 
                                    
            });
            
            $("#reject").click(function(){
                        var project_id =  <?php echo $project_model->id; ?> ; //$(this).data('projectID');

                       //var submitstatus = 2; 
                       $.ajax({
                                    url: minusurl,
                                    data: {project_id:project_id},
                                    type: 'get',
                                    dataType: 'html',
                                    success:function(data){
                                          $(".other_header").html(data);
                                    },
                                    error: function() { // if error occured
                                          alert("Error  occured.please try again");    
                                     }
                             }); 
                                    
            });
            
            $("#cancel").click(function(){
                        var project_id =  <?php echo $project_model->id; ?> ; //$(this).data('projectID');

                      // var submitstatus = 17; 
                       $.ajax({
                                    url: rejecturl,
                                    data: {project_id:project_id},
                                    type: 'get',
                                    dataType: 'html',
                                    success:function(data){
                                          $(".other_header").html(data);
                                    },
                                    error: function() { // if error occured
                                          alert("Error  occured.please try again");    
                                     }
                             }); 
                                    
            });
*/          
           
            
    });
    
    
</script>



<?php
     if($project_model->machineType == 1){
             if($project_model->existInStock == 2){
                 $move_forward = "poh"; $next_status = 18;
                 $move_backward = "enquiry"; $pre_status = 1;
            }
            else{
                $move_forward = "poh"; $next_status = 18;
                $move_backward = "vendorprocess"; $pre_status = 3;
            }
           
        }
        else if($project_model->machineType == 2){
            $move_forward = "poh"; $next_status = 18;
            $move_backward = "enquiry"; $pre_status = 1;
        }else
            
        {
            $move_forward = "pOtoVendor"; $next_status = 7;
            $move_backward = "vendorprocess"; $pre_status = 3;
        }    
      
     //  $backward_direction = "enquiry"; $backward_status = 1;
       
       
   /* ******************************************************  */    
       
       if($project_model->status == 4){
         $forward_direction = "quoh"; $forward_status = 5;
         $backward_direction = $move_backward; $backward_status = $pre_status;
       }else if($project_model->status == 5){
        $forward_direction = $move_forward; $forward_status = $next_status;
         $backward_direction = "quoh"; $backward_status = 4;
         
       }
       else{
         $forward_direction = "poh"; $forward_status = 5;
         $backward_direction = "quoh"; $backward_status = 3;
       }
 

?>
 


<?php 

     if($dis== false){ 
                         $quo = null;
                          $lock =true;
                          $quo = quoh::model()->findAll("status=:status AND project_id=:project_id",array(":status"=>2,":project_id"=>$model->project_id));
                          if($quo != null){
                              $lock = false;
                          }
                if($lock == true){
                  
?>

<div class="operation_footer" style="margin: 10px 0 50px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 50px 0 0;width:1000px;height:50px">
  <?php  

     echo CHtml::link("<div id='cancel' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Cancel</div>",array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=>"enquiry",'project_status'=>17));
     echo CHtml::link("<div id='delete' class='simple_button' style='float: right;margin-top:10px; margin-right: 10px;'> Delete</div>",array("project/remove",'id'=>$project_model->id),array('confirm'=>'Are you sure to delete project?'));
   
      
    if($project_model->status == 5){
      echo CHtml::link('<div id="reject" class="simple_button" style="width:200px ;float: right;margin-top:10px; margin-right: 10px;">Submit to Quotation</div>',array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=> $backward_direction,'project_status'=>$backward_status));
    }else{
          echo CHtml::link('<div id="reject" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;"> Back</div>',array("project/plusstatus",'project_id'=>$project_model->id,'redirect'=> $backward_direction,'project_status'=>$backward_status));
    }
    
                   
?>   
    <?php if($project_model->status == 5){ ?>
                <div id="submit" class="simple_button" style="width:200px ; float: right;margin-top:10px; margin-right: 10px;">Submit to PO Process</div>
     <?php }else{ ?> 
         
                 <div id="submit" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;">Submit</div>
      <?php       
      
                } 
      ?> 
</div>

<?php 
 
                 }   
            
        } 

?>


<form id="goforward" method="POST">
      
</form>  
<!---------------------   DIALOG  ---------------------------->

<script>
   $(function(){
         $("#submit").click(function() {
              var is_savequoteno = true;
              var is_savedate = true;
              
            
             
             var ind = 1;
              var msg = "โปรดใส่ข้อมูลดังรายการข้างล่าง อย่าเว้นว่างไว้ \n\n";
             var logic = 1;
              $(".savequoteno").each(function(){
                    if($(this).val() == ''){
                        logic = 0;
                        msg = msg  + "Quoation ลำดับที่ "+(ind)+" \n";
                        msg = msg  + "  ● Quotation No.\n";
                        var savedate = $("#"+$(this).parent().find('.savedate').attr('id'));
                       
                        if(savedate.val() == '')
                        {    
                            logic = 0;
                             msg = msg  + "  ● Quotation Date\n";
                        }
                    }else{

                            var savedate = $("#"+$(this).parent().find('.savedate').attr('id'));
                            if(savedate.val() == '')
                            {
                                logic = 0;
                                msg = msg  + "Quoation ลำดับที่ "+(ind)+" \n";
                                 msg = msg  + "  ● Quotation Date\n";
                            }
                    }
                    ind++
              });
            
          
             
          
             
               if(logic == 0)
                {
                     alert(msg);
                }
                else{
                    
                var forward_direction = '<?php echo $forward_direction; ?>' ; 
                var input1 = $("<input>").attr("type", "hidden").attr("name", "project_id").val("<?php echo $project_model->id; ?>");
                var input2 = $("<input>").attr("type", "hidden").attr("name", "redirect").val(forward_direction);
                var input3 = $("<input>").attr("type", "hidden").attr("name", "project_status").val("<?php echo $forward_status; ?>");

                var goforward = $("#goforward").append($(input1)).append($(input2)).append($(input3));
                 
                    $(goforward).submit();
          }   
            
         });
  });
  
  
</script>
          
