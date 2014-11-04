<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>



<?php

         
        //$form = "follow_form_$model->id";
        $table_view = "follow_table_view";
        //$id = $model->id;
        //$followedDate = "followedDate_$model->id";
        //$contact = "contact_$model->id";
        //$detail = "detail_$model->id";
        //$followedBy = "followedBy_$model->id";
        //$quohID = "quoh_$model->id";
        //$follow_row = "follow_$model->id";
        //$dialog_form = "follow_dialog_form_$model->id";

        
?>

<br/><br/>
<?php  
     $project_model = project::model()->findByPk($project_id);?>
<div class="other_header" style="margin-top:-32px;">

<?php
     //$this->renderPartial('//project/_form',array('model'=>$project_model)); 
?>    
</div>
<div class="index_content" style=" margin: 0 0 20px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 70px 0 0;width:1000px; min-height: 500px;">

<!------------------ The Button for add an ITEM  ------------------->

 

<div id="addFollow" class="simple_button" style="float: right;"> Add Follow</div>
<div class="title2" style="border-bottom: none;"> Follow Quotation </div>
<div class="bottomline"></div>
    <!--------------------------- Start Table ----------------------------------------->

<?php $quoh = quoh::model()->findAll("project_id=:project_id",  array(":project_id"=>$project_id));   ?>


        <div id="follow-contain" class="ui-widget" style="margin:40px 0 0 50px;">
<?php
        //if($follow_model == null ){
            //echo "<div id = 'noresult' style='background-color:lightyellow;margin: 20px 0 ;padding: 10px 10px;font-weight:bold;font-size: 18px;'>Result Not Found</div>"; 
          
        //}
        //else{
       
?>
   
       
          
                <table id='follow_table_view' class="table_view1">
                  <thead>
                    <tr  class="table_view1_header">
                      <th class="table_date" style="min-width:100px;">Quote No.</th>
                      <th class="table_date" style="min-width:100px;">Date</th>
                      <th class="table_contact" style="width:200px;">Contact</th>
                      <th class="table_detail" style="width:250px;">Detail</th>
                      <th class="table_by" style="min-width:100px;">By</th>
                      <th class="table_operation" style="min-width:50px;"> </th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
<?php
                foreach($quoh as $_quoh)
                {
                
                    $follow_model = quoteFollow::model()->findAll("quoH_id=:quoh_id",  array(":quoh_id"=>$_quoh->id));   
                    foreach($follow_model as $_model)
                     {
                        
                      
                       $this->renderPartial('//quoteFollow/_followform',array('model'=>$_model));

                     }
               }
?>
                      </tr>    
                  </tbody>
                </table>
    </div>    
    
<?php            
        //}
        
?>    
    
<script> 
    
    $(function(){
        
              $('.cuttext').click(function(){ $(this).text().slice(2,10).css('background-color', 'red'); });
              
              var delurl = '<?php echo $this->createUrl("quoteFollow/delete"); ?>';
           
           
            $(".del").click(function(){
                var click_row = $(this).parent().parent().attr('id');
                var theID = $(this).attr('title');
               
/*                
                   
                    $( "#dialog-confirm" ).dialog({
                        resizable: false,
                        height:140,
                        modal: true,
                        buttons: {
                          "Delete all items": function() {
                            $( this ).dialog( "close" );
                          },
                          Cancel: function() {
                            $( this ).dialog( "close" );
                          }
                        }
                      });
*/  

               $.ajax({
                            url: delurl,
                            data: {id:theID},
                            type: 'get',
                            success:function(){
                                $("#".concat(click_row)).hide('fast');
                            },
                            error: function() { // if error occured
                                  alert("Error  occured.please try again");    
                             }
                     }); 
                                    
            });
          
           
            
    });
</script> 
    
    
<?php //$this->renderPartial('_form',array('model'=>$model,'project_id'=>$project_id,'quoh_id'=>$quoh_id)); ?>



</div>  <!--------------------------- End of Content ----------------------------------------->






  <!---------------- Dialog with Ajax ------------------------------ -->
  
   <style>

    fieldset { padding:0; border:0;margin-top:25px;}
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    /*
    .ui-dialog .ui-state-error { padding: .3em; }
    */
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
 
 <script>
  $(function() {
        
            
      var follow_dialog_form =  "#follow_dialog_form";
      var followedDate = $("#followedDate"),
      contact = $("#contact"),
      detail = $("#detail"),
      followedBy = $("#followedBy"),
      quohID = $("#quohID"),
      allFields = $( [] ).add( followedDate ).add( contact ).add( detail ).add( followedBy ),
      tips = $( ".validateTips" );
  
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
   
    $(follow_dialog_form).dialog({
      autoOpen: false,
      height: 400,
      width: 420,
      modal: true,
      buttons: {
        "Add an follow": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          //bValid = bValid && checkLength( followDate, "followDate", 3, 16 );
          //bValid = bValid && checkLength( contact, "contact", 6, 80 );
          //bValid = bValid && checkLength( detail, "detail", 5, 16 );
 
          //bValid = bValid && checkRegexp( followDate, /^([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
          // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
          //bValid = bValid && checkRegexp( contact, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
          //bValid = bValid && checkRegexp( detail, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 
          if ( bValid ) {
              
                    var tourl = '<?php echo $this->createUrl("quoteFollow/create"); ?>';
                  //  var  follow_id =  '<?php// echo $model->id;?>';

                    //var  js_product =  "#".concat('<?php //echo $followDate;?>');
                    //var  js_qty =  "#".concat('<?php //echo $qty;?>');
                    //var  js_unitPrice =  "#".concat('<?php //echo $unitPrice;?>');

                    var followid;
                    var followedDateValue = followedDate.val();
                    var contactValue= contact.val();
                    var detailValue= detail.val();
                    var followedByValue = <?php echo Yii::app()->user->id ?>;
                    var quohIDValue = quohID.val();
                    var followedByShow = '<?php echo CHtml::encode(user::model()->findByPk(Yii::app()->user->id)->username); ?>';
                    $.ajax({
                    url:  tourl,
                    data: {quoh_id:quohIDValue,followedDate:followedDateValue,contact:contactValue,detail:detailValue,followedBy:followedByValue},
                    type: 'get',
                    dataType: 'json',
                    success:function(response){
                           
                   // $("#follow_table_view").html(response);

                              followid =  response.followID;
 
                             
                             var table_view = "#follow_table_view";
                          
    
                        
// CHANGE: BEGIN: addrow                       
                              var addRow = "follow_"+response.followID;
                              var updateRow = "update_"+addRow;
                              var deleteRow = "delete_"+addRow;
// END   

// CHANGE: BEGIN: _table_view/attribute  

                              $(table_view).append(
                                "<tr id='"+ addRow +"' class='.quod_table_view'>" +
                                  "<td><center>" + response.quoteNo + "</center></td>" +
                                  "<td><center>" + followedDateValue + "</center></td>" +
                                  "<td><center>" + contactValue + "</center></td>" +
                                  "<td><center>" + detailValue + "</center></td>" +
                                  "<td><center>" + followedByShow + "</center></td>" +                              
                                  "<td>&nbsp;<span id='" + updateRow + "' class='update' title='"+response.followID +"'>Upd</span>&nbsp;&nbsp;&nbsp;<span id='" + deleteRow + "' class='del'  title='"+response.followID +"'>Del</span></td>"+
                                  
                                "</tr>" 
// END                             
                                );
      
/* CHANGE ACTION NAME*/   
                                var delurl = '<?php echo $this->createUrl("quoteFollow/delete"); ?>';
                                var deleteRowID = "#".concat(deleteRow);
                                //$(".delete_quod").click(function(){ alert("SUCCESS"); });
                                $(deleteRowID).click(function(){ 
                                    alert(addRow);
                                    $.ajax({
                                            url: delurl,
/* CHANGE response. ...ID */                                              
                                            data: {id:response.followID},
                                            type: 'get',
                                            success:function(){
                                                     $("#".concat(addRow)).hide('fast');
                                            },
                                            error: function() { // if error occured
                                                  alert("Error  occured.please try again");    
                                             }
                                     }); 

                            });
                          

                            $( this ).dialog( "close" );
                                 allFields.val( "" ).removeClass( "ui-state-error" );
                                  
                  },
                 error: function() { // if error occured
                                          alert("Error: "+followedDateValue);    
               }
            });

            $( this ).dialog( "close" );
          }
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 

  
    
    $('#addFollow').click(function() { 
        $(follow_dialog_form).dialog( "open" );
        $("#followedByShow").val('<?php echo CHtml::encode(user::model()->findByPk(Yii::app()->user->id)->username); ?>');
       
        followedBy.val('<?php echo CHtml::encode(Yii::app()->user->id); ?>');
        
      });
   
          
  });
  </script>
  
  

  
  
  
 <div id='follow_dialog_form'  title="Add New Item">
  <p class="validateTips"></p>
 
  <?php $form=$this->beginWidget('CActiveForm', 
        array(
            'id'=>"asdf",
            'enableAjaxValidation'=>false,
            'htmlOptions' => array("class"=>"dialog_form"),
      )); 
   ?>
  
<?php $follow_model = new quoteFollow; ?> 
  <fieldset style="margin-left: -20px;">
      <?php echo $form->errorSummary($follow_model); ?>
                &nbsp;&nbsp;&nbsp;&nbsp;<span>Quote</span>&nbsp;&nbsp;
                 <?php echo $form->dropDownList($follow_model, 'quoH_id', CHtml::listData(quoh::model()->findAll('project_id=:project_id',array(':project_id'=>$project_id)), 'id', 'quoteNo'),array(/*'empty'=>' Select Quotation ',*/'name'=>'quohID' ,'id'=>'quohID','class'=>'project','maxlength'=>25));?>
                <br/><br/>
                 <?php //echo $form->hiddenField($follow_model,'quoH_id',array('id'=>'quohID','class'=>"text ui-widget-content ui-corner-all",'value'=>$quoh_id,)); ?>
		<?php echo $form->error($follow_model,'quoH_id'); ?>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Date</span>&nbsp;&nbsp;
                
                
                <input type="date" name='followDate' id='followedDate' class="text ui-widget-content ui-corner-all" />
                <br/><br/>
                
                &nbsp;&nbsp;&nbsp;<span>Contact</span>&nbsp;
                <input type="text" name='contact' id='contact' class="text ui-widget-content ui-corner-all" />
                <br/><br/>  
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Detail</span>&nbsp;&nbsp;
                <textarea name='detail' id='detail' class="text ui-widget-content ui-corner-all" /></textarea>
		
                <br/><br/>
                
          
                 <span>Follow by  </span>&nbsp;
                <input type="text"  id='followedByShow' class="text ui-widget-content ui-corner-all" readonly/>
 		
              
                 <?php echo $form->hiddenField($follow_model,'followedBy',array('id'=>'followedBy','class'=>"text ui-widget-content ui-corner-all")); ?>
		<?php echo $form->error($follow_model,'followedBy'); ?>
              
                
    
 
 </fieldset>
 <?php $this->endWidget(); ?>
</div>


<!---------------- OPERATION FOOTER --------------------------------------------------->


    
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
                        var project_id =  <?php echo $project_id ?> ; //$(this).data('projectID');

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
                        var project_id =  <?php echo $project_id; ?> ; //$(this).data('projectID');

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
<!--
<div class="operation_footer" style="margin: 10px 0 50px 50px; border: 1px solid rgb(217,217,217);border-radius: 5px;padding: 0 50px 0 0;width:1000px;height:50px">
      <div id="cancel" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;"> Cancel</div>
      <div id="reject" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;"> Reject</div>
      <div id="submit" class="simple_button" style="float: right;margin-top:10px; margin-right: 10px;">Submit</div>
     
      
</div>
-->