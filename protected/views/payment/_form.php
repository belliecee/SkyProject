<?php
/* @var $this PaymentController */
/* @var $model payment */
/* @var $form CActiveForm */
?>
<?php

    $payment_row = "payment_$model->id"
?>


<script>
    $(function(){
        var btn = "#delete".concat(<?php echo $payment_row; ?>);
        $(btn).click(function(){
            alert($(this).attr('id'));
        });
        
    });
</script>




 <tr id='<?php echo $payment_row; ?>' class="table_tr_quod" >
                               <!--<input type="hidden" id='<?//php echo "hidden_$quod_row"; ?>' value='<?//php echo $detail->id;?>'> -->
                                <td><center><?php echo CHtml::encode($ind); ?>.</center></td>
                                <td><?php echo CHtml::encode($model->paymentDate); ?></td>
                                <td><?php echo CHtml::encode($model->amount); ?></td>
                               
                               <td>
                                 <?php
                                   echo CHtml::ajaxLink('<div id="delete_'.$payment_row.'" class="simple_button" style="display: inline-block;">Delete</div>',
                                        array("payment/delete2",'id'=>$model->id,'project_id'=>$model->project_id),
                                        array(
                                                'update' => '#payment-contain'
                                          ));
                               ?>

                                   &nbsp;<span id='<?php echo "update_$payment_row" ?>' class="update" data-id='<?php echo $model->id; ?>'>&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<span id='<?php echo "delete_$payment_row" ?>' class="del" data-id='<?php echo $model->id;?>'  >&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
</tr>                           


