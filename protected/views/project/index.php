<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>

<?php
/* @var $this ProjectController */
/* @var $dataProvider CActiveDataProvider */
/* @var $projecttype machineType */



?>
        
<script>
 
       $(function(){
  /*         
               function findmax(){
                 <?php
                  /*
                      $criteria = new CDbCriteria;
                      $criteria->select = "MAX(id) as id";
                      $project_model = project::model()->find($criteria);
                      $lastID = $project_model->id;  
                   */  
                 ?>
                 
             }
*/
             function createProject(){
                 
                
             }
            var project_id=0;
           var urlstart = '<?php echo $this->createUrl("project/start"); ?>';
           var enquiryurl = '<?php echo $this->createUrl("enquiry/req"); ?>';
           <?php // echo '<script language=\"javascript\">fash(\"the key is: $your_name\");</script>'?>
            $("#createProject").mouseup(function(){
                $(this).hide();});

       });
    
</script>

<!--
<div id="createProject" class="simple_button" style="display: inline-block;float: right;">Create Project</div>
-->
<?php
        
     if(Yii::app()->user->isGuest){
             echo CHtml::link('<div id="createProject" class="simple_button" style="display: inline-block;float: right;">Create Project</div>',
                                array("site/login")
                                
                           );
        
     }else{
        
            
            echo CHtml::ajaxLink('<div id="createProject" class="simple_button" style="display: inline-block;float: right;">Create Project</div>',
                                array("project/start",'projecttype'=>$projecttype),
                                array(
                                        'update' => '#form_header'
                                   
                           ));
     }
    
?>
<div id="form_header"></div>


