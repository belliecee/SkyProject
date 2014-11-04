<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>




<br/><br/>
<?php  
     //$project_model = project::model()->findByPk($model->project_id);
?>
<div class="other_header" style="margin-top:-32px;">
    <?php
     $this->renderPartial('//project/_form',array('model'=>$model)); 
    ?>
</div>
<?php
    if($model->status  >=  11 && $model->status  <= 13)
        {
             if(user::model()->findByPk(Yii::app()->user->getId())->auth === "viewer"){
                  $dis = true;
             }
             else
                  $dis = false;
        }
        else
        {
            $dis = true;
        }
?>

<div class="index_content" style=" margin: 0 0 20px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 70px 0 0;width:1000px; min-height: 500px;">

   <?php  
     
     $this->renderPartial('_form_delivery',array('model'=>$model)); 
 ?>
</div>



    
<script> 
    
    $(function(){
      
              
              var plusurl = '<?php echo $this->createUrl("project/plusstatus"); ?>';
              var minusurl = '<?php echo $this->createUrl("project/minusstatus"); ?>';
              var rejecturl = '<?php echo $this->createUrl("project/rejectstatus"); ?>';
 /*             
               $("#submit").click(function(){
                        var project_id =  <?php echo $model->id; ?> ; //$(this).data('projectID');

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
                        var project_id =  <?php echo $model->id; ?> ; //$(this).data('projectID');

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
                        var project_id =  <?php echo $model->id; ?> ; //$(this).data('projectID');

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
