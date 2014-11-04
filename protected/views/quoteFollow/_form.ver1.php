<?php
/* @var $this QuoteFollowController */
/* @var $model quoteFollow */
/* @var $form CActiveForm */

$follow_row = "follow_$model->id"
?>





 <tr id='<?php echo $follow_row; ?>' class="table_tr_quod" >
                               <!--<input type="hidden" id='<?//php echo "hidden_$quod_row"; ?>' value='<?//php echo $detail->id;?>'> -->
                                  
                                   <?php 
                    
                                    if($model->followedDate != null){
                                        $model->followedDate = date("d/m/Y", strtotime($model->followedDate));
                                    }else{
                                        $model->followedDate = "";
                                    }

                            ?>   
                                   
                                <td><?php echo CHtml::encode($model->followedDate); ?></td>
                                <td><?php echo CHtml::encode($model->contact); ?></td>
                                <td><?php echo CHtml::encode($model->detail); ?></td>
                                <td><?php echo CHtml::encode(user::model()->findByPk($model->followedBy)->username); ?></td>
                               <td>&nbsp;<span id='<?php echo "update_$follow_row" ?>' class="update" title='<?php echo $model->id; ?>'>Upd</span>&nbsp;&nbsp;&nbsp;<span id='<?php echo "delete_$follow_row" ?>' class="del" title='<?php echo $model->id;?>'  >Del</span></td>
</tr>


