


         <?php $pod_model = pod::model()->findAll("poh_id=:poh_id",  array(":poh_id"=>$poh_id));   ?>
         <table id='pod_table_view' class="table_view1">
                  <thead>
                    <tr  class="table_view1_header">
                      <th class="table_ind" style="max-width:50px;">No.</th>
                      <th class="table_paymentDate" style="min-width:100px;">Product</th>
                      <th class="table_amount" style="max-width:70px;">Qty</th>
                      <th class="table_operation" style="max-width:70px; ">Unit Price</th>
                       <th class="table_operation" style="max-width:70px; ">Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                   <div id="showPod">     
<?php
                    $ind = 0;
                    foreach($pod_model as $_model)
                    {
                        ++$ind;
                        $pod_row = "pod_$_model->id";

?>




                                <tr id='<?php echo $pod_row; ?>' class="table_tr_quod" >
                               <!--<input type="hidden" id='<?//php echo "hidden_$quod_row"; ?>' value='<?//php echo $detail->id;?>'> -->
                                <td><center><?php echo CHtml::encode($ind); ?>.</center></td>
                                <td><?php echo CHtml::encode($_model->product_id); ?></td>
                                <td><?php echo CHtml::encode($_model->qty); ?></td>
                                <td><?php echo CHtml::encode($_model->unitPrice); ?></td>
                                <td><?php echo ($_model->qty * $_model->unitPrice) ?></td>
                               
                               <td>
                                
                                  

                                   &nbsp;<span id='<?php echo "update_$pod_row" ?>' class="update" data-id='<?php echo $_model->id; ?>' data-poh='<?php echo $_model->pod_id; ?>'>Upd</span>&nbsp;&nbsp;&nbsp;<span id='<?php echo "delete_$pod_row" ?>' class="del" data-id='<?php echo $_model->id;?>' data-poh='<?php echo $_model->poh_id; ?>' >Del</span></td>
                         
</tr>  


<?php
                    }
     
?>                    
 </div>
                   
                        
</tbody>
</table>
 
        
        <!------------- TABLE POD ---------------------------------->