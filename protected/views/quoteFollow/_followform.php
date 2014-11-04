<?php
/* @var $this QuoteFollowController */
/* @var $model quoteFollow */
/* @var $form CActiveForm */

$follow_row = "follow_$model->id"
?>





 <tr id='<?php echo $follow_row; ?>' class="table_tr_quod" >
                               <!--<input type="hidden" id='<?//php echo "hidden_$quod_row"; ?>' value='<?//php echo $detail->id;?>'> -->
                                  
                                   
                                   <?php 
                                        if(($model->followedDate) !=null  ){
                                             if(DateTime::createFromFormat('Y-m-d', $model->followedDate)){
                                                $newDate = DateTime::createFromFormat('Y-m-d', $model->followedDate);
                                                $model->followedDate = $newDate->format('d/m/Y');
                                             }
                                        }
                                ?>
                                <td><center><?php if(quoh::model()->findByPk($model->quoH_id)) echo quoh::model()->findByPk($model->quoH_id)->quoteNo;  ; ?></center></td>
                                <td><center><?php echo CHtml::encode($model->followedDate); ?></center></td>
                                <td><center><?php echo CHtml::encode($model->contact); ?></center></td>
                                <td><center><?php echo CHtml::encode($model->detail); ?></center></td>
                                <td><center><?php echo CHtml::encode(user::model()->findByPk($model->followedBy)->username); ?></td>
                               <td>&nbsp;<span id='<?php echo "update_$follow_row" ?>' class="update" title='<?php echo $model->id; ?>'>Upd</span>&nbsp;&nbsp;&nbsp;<span id='<?php echo "delete_$follow_row" ?>' class="del" title='<?php echo $model->id;?>'  >Del</span></td>
</tr>


