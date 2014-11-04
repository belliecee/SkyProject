
<?php $quoh = quoh::model()->findAll("project_id=:project_id",  array(":project_id"=>$project_id));  

      
              $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
               $auth = usergroup::model()->findByAttributes(array('name'=>$group));
                
     
 ?>
<script> 
    
    $(function(){
        
              //$('.cuttext').click(function(){ $(this).text().slice(2,10).css('background-color', 'red'); });
              
              var delurl = '<?php echo $this->createUrl("quoteFollow/delete"); ?>';
           
           
            $(".del").one('click',function(){
                var click_row = $(this).parent().parent().attr('id');
                var theID = $(this).data('id');
                var project_id = <?php echo $project_id; ?>;
                //alert(click_row+"    "+theID);
               $.ajax({
                            url: delurl,
                            data: {id:theID,project_id:project_id},
                            type: 'get',
                            dataType: 'html',
                            success:function(data){
                                 $("#follow_contain").html(data);
                                 $("#fake2").submit();
                                //$("#".concat(click_row)).hide('fast');
                            },
                            error: function() { // if error occured
                                  alert("Error  occured.please try again");    
                             }
                     }); 
                                    
            });
          
           
            
    });
</script> 

        <div id="follow-contain" class="ui-widget" style="margin:40px 0 0 50px;">
       
                <table id='follow_table_view' class="table_view1" style="margin-left:-50px; width:950px;">
                  <thead>
                    <tr  class="table_view1_header">
                      <th class="table_date" style="width:100px;">Quote No.</th>
                      <th class="table_date" style="width:100px;">Date</th>
                      <th class="table_contact" style="width:200px;">Contact</th>
                      <th class="table_detail" style="width:250px;">Detail</th>
                      <th class="table_by" style="width:100px;">By</th>
                      <th class="table_operation" style="width:50px;"> </th>
                    </tr>
                  </thead>
                  <tbody>
                     
                      
                   
<?php
                foreach($quoh as $_quoh)
                {
                    $cdb = new CDbCriteria;
                    $cdb->condition = "quoH_id=:quoh_id";
                    $cdb->params = array(":quoh_id"=>$_quoh->id);
                    $cdb->order = "id ASC";
                    $follow_model = quoteFollow::model()->findAll($cdb);   
                 
                     foreach($follow_model as $_model)
                     {
                           $follow_row = "follow_$_model->id";
                           if($_model->followedDate != null){
                                $_model->followedDate = date("d/m/Y", strtotime($_model->followedDate));
                            }else{
                                $_model->followedDate = "";
                            }
                            
?>                         
              <tr id="<?php echo"$follow_row"; ?>">         
                              <td><center><?php echo CHtml::encode($_quoh->quoteNo); ?></center></td> 
                               <td><center><?php echo CHtml::encode($_model->followedDate); ?></center></td>
                                <td><center><?php echo CHtml::encode($_model->contact); ?></center></td>
                                <td><center><?php echo CHtml::encode($_model->detail); ?></center></td>
                                <td><center><?php echo CHtml::encode(user::model()->findByPk($_model->followedBy)->username); ?></center></td>
                                           <td><center><!--&nbsp;<span id='<?php //echo "update_$follow_row" ?>' class="update" data-hidden="true" data-id='<?php// echo $_model->id; ?>'>Upd</span>&nbsp;&nbsp;&nbsp;--><?php  if($auth->quoh_delete == 1){ ?><span id='<?php echo "delete_$follow_row" ?>'  class="del" data-id='<?php echo $_model->id;?>'  >&nbsp;&nbsp;&nbsp;&nbsp;</span><?php } ?></center></td>
              </tr>         
                     
<?php
                     }
               } 

?>
                         


                      
                  </tbody>
                </table>
    </div>    
    
