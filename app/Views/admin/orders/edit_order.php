<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        
        <div class="nk-content-body">
            <div class="nk-content-wrap">
                <div class="nk-block-head">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?=getlang('Edit_Order');?> <strong class="text-primary small" style="color:#db2525 !important;">#<?=$order_data[0]->order_id?></strong></h3>
                            <div class="nk-block-des text-soft">
                                <ul class="list-inline">
                                <?php $timestamp = strtotime($order_data[0]->order_created);
                                                    // $formattedDate = date('d-M-Y h:i:s a', $timestamp);
                                                    $formattedDate = date('d-M-Y H:i:s', $timestamp);
                                                    ?>
                                    <li><?=getlang('Created_At');?>: <span class="text-base"><?=$formattedDate;?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <?php if($order_data[0]->is_edited ==1){?>
                            <a href="<?=base_url(ADMIN_URL.'/orders/notify_customer/'.$order_data[0]->id)?>" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-user"></em><span><?=getlang('Notify_Customer');?></span></a>
                            <a href="<?=base_url(ADMIN_URL.'/orders/notify_customer/'.$order_data[0]->id)?>" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-user"></em><span><?=getlang('Notify_Customer');?></span></a>
                            <?php } ?>
                            <a href="<?=base_url(ADMIN_URL.'/orders/manage')?>" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span><?=getlang('Back');?></span></a>
                            <a href="<?=base_url(ADMIN_URL.'/orders/manage')?>" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="invoice">
                        <div class="invoice-action">
                        <?php $encoded_url = get_encoded_url($order_data[0]->id);?>
                        <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" href="<?=base_url(ADMIN_URL.'/orders/invoice_pdf/'.$encoded_url.'/download');?>" ><em class="icon ni ni-download-cloud"></em></a>
                        <a href="<?=base_url(ADMIN_URL.'/orders/invoice_pdf/'.$encoded_url.'/view');?>" class="pdf">
                        <img src="<?=image_url('assets/frontend/images/pdf.svg');?>"> <img src="<?=image_url('assets/frontend/images/white_pdf.svg');?>"></a>
                        </div><!-- .invoice-actions -->
                        <div class="invoice-wrap">
                            <div class="invoice-brand text-center">

                            

                                <?php $invoice_logo=get_settings('invoice_logo');?>
                                <?php if(!empty($invoice_logo)){?>
                                    <img style="width:100%;height:50px;object-fit:contain;max-width:200px;" src="<?php echo base_url('uploads/logo/'.$invoice_logo);?>" alt="logo">   
                                <?php } else { ?>
                                    <img style="width:100%;height:50px;object-fit:contain;max-width:200px;" src="<?php echo base_url('assets/frontend/images/cart-img.svg');?>" alt="logo">
                                    <?php } ?>
                                </td>
                            </div>
                            <div class="invoice-head">
                                <div class="invoice-contact">
                                    <span class="overline-title"><?=getlang('Invoice_To')?></span>
                                    <button class="edit_client_info" id="<?php echo $order_data[0]->id; ?>" style="cursor:pointer;"><i class="icon ni ni-edit"></i></button>
                                    <div class="invoice-contact-info">
                                        <h4 class="title"><?=$order_data[0]->voornaam?>  <?=$order_data[0]->achternaam?></h4>
                                        <ul class="list-plain">
                                            <li><em class="icon ni ni-map-pin-fill"></em><span><?=getlang('Address')?> #<?=$order_data[0]->straat?> <?=$order_data[0]->hno?> <?=$order_data[0]->toev?> <?=$order_data[0]->postcode?> <?=$order_data[0]->plaats?><br><?=$order_data[0]->city?>  <?=$order_data[0]->land_ragio?></span></li>

                                            <li><em class="icon ni ni-map-pin-fill"></em><span><?=getlang('Shipping_Address')?> #<?=!empty($order_data[0]->ship_straat)?$order_data[0]->ship_straat:$order_data[0]->straat?> <?=!empty($order_data[0]->ship_hno)?$order_data[0]->ship_hno:$order_data[0]->hno?> <?=!empty($order_data[0]->ship_toev)?$order_data[0]->ship_toev:$order_data[0]->toev?> <?=!empty($order_data[0]->ship_postcode)?$order_data[0]->ship_postcode:$order_data[0]->postcode?> <?=!empty($order_data[0]->ship_plaats)?$order_data[0]->ship_plaats:$order_data[0]->plaats?><br><?=!empty($order_data[0]->ship_city)?$order_data[0]->ship_city:$order_data[0]->ship_city?>  <?=!empty($order_data[0]->ship_land_ragio)?$order_data[0]->ship_land_ragio:$order_data[0]->land_ragio?></span></li>

                                            <li>
                                                <em class="icon ni ni-call-fill"></em>
                                                <span><?=$order_data[0]->telefoon?></span>
                                                
                                            </li>
                                            <li><em class="icon ni ni-mail-fill"></em><span><?=$order_data[0]->email?></span></li>
                                        </ul>
                                        
                                    </div>
                                </div>
                                <div class="invoice-desc">
                                    <h3 class="title"><?=getlang('Invoice');?></h3>
                                    <ul class="list-plain">
                                        <li class="invoice-id"><span><?=getlang('Invoice_ID')?></span>:<span><?=$order_data[0]->order_id?></span></li>
                                        <li class="order-id"><span><?=getlang('Order_ID')?></span>:<span><?=$order_data[0]->transaction_id?></span></li>
                                        <?php $timestamp = strtotime($order_data[0]->order_created);
                                                    $formattedDate = date('d-M-Y', $timestamp);?>
                                        <li class="invoice-date"><span><?=getlang('Datum')?></span>:<span><?=$formattedDate?></span></li>
                                    </ul>
                                    <ul class="list-plain">
                                    <?php $get_status_color =getorderstatuscolor($order_data[0]->payment_status);
                                        ?>
                                        <li class="transaction_status"><span><?=getlang('Payment_status')?></span>:<span <?php if(!empty($get_status_color)){?>style="color:<?=$get_status_color;?>;"<?php } ?> ><?=getorderstatusname($order_data[0]->payment_status)?></span></li>

                                        
                                        
                                    </ul>
                                </div>
                            </div><!-- .invoice-head -->
                            <div class="invoice-bills">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th ><?=getlang('Product_Code');?></th>
                                                <th class="w-60"><?=getlang('Product');?></th>
                                                <th><?=getlang('Product_nr');?></th>
                                                <th><?=getlang('Prijs');?></th>
                                                <th><?=getlang('Totaal');?></th>
                                                <th><?=getlang('Action');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $vat_amt = 0; 
                                        if(!empty($order_items)){?>
                                            <?php 
                                            
                                                foreach($order_items as $oi){?>
                                            <tr>
                                                <td><?=$oi->product_sku?></td>
                                                <td class="product"><p><?=$oi->product_name?></p>
                                                <?php $price = $oi->product_price;?>
                                                <?php $product_variants = json_decode($oi->product_variants, true);?>
                                                <?php if(!empty($product_variants['sizeoption_name']) && !empty($product_variants['sizeoptionName']) && !empty($product_variants['sizeoption_price'])){ 
                                                    $price = $price + $product_variants['sizeoption_price'];
                                                    ?>
                                                    <span><?=$product_variants['sizeoptionName']?> : <?=$product_variants['sizeoption_name']?></span>
                                                <?php } ?>
                                                <?php if(!empty($product_variants['coloroption_name']) && !empty($product_variants['coloroptionName']) && !empty($product_variants['coloroption_price'])){ 
                                                    $price = $price + $product_variants['coloroption_price'];
                                                    ?>
                                                    <span><?=$product_variants['coloroptionName']?> : <?=$product_variants['coloroption_name']?></span>
                                                <?php } ?>
                                                <?php if(!empty($product_variants['batteryoption_name']) && !empty($product_variants['batteryoptionName']) && !empty($product_variants['batteryoption_price'])){ 
                                                    $price = $price + $product_variants['batteryoption_price'];
                                                    ?>
                                                    <span><?=$product_variants['batteryoptionName']?> : <?=$product_variants['batteryoption_name']?></span>
                                                <?php } ?>
                                                </td>
                                                <td>#<?=$oi->product_qty?></td>
                                                <td>&euro; <?php echo number_format($price,2,",","."); ?></td>
                                                <?php $total = $price * $oi->product_qty; ?>
                                                <td>&euro; <?=number_format($total,2,",",".")?></td>
                                                <td>
                                                <button class="view_data" id="<?php echo $oi->id; ?>" ><i class="icon ni ni-edit"></i></button>
                                                <button class="delete_data" id="<?php echo $oi->id; ?>" ><i class="icon ni ni-delete"></i></button>
                                                </td>
                                            </tr>
                                        <?php 
                                        $vat_rate = !empty(trim($oi->vat))?$oi->vat:21;
                                        $vamount =  calculateVat($total,$vat_rate);
                                        $vat_amt += $vamount['vatAmount'];
                                    } ?>
                                        <?php } ?>
                                        
                                        


                                        </tbody>
                                        

                                        <tfoot>
                                        <tr class="add_item_btn">
                                                <td>
                                                <a href="javascript:void(0);" class="icon ni ni-add add-item"><i class="icon ni ni-add"></i><?=getlang('Add_item');?></a></td>
                                        </tr>
                                        <?php 
                                            $total_amount = $order_data[0]->total_amount;
                                            if(!empty($order_data[0]->discount_amount)){
                                                $total_amount = $order_data[0]->total_amount + $order_data[0]->discount_amount;
                                            }
                                        ?>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><?=getlang('SubTotaal');?></td>
                                                <td>&euro; <?=number_format($total_amount,2,",",".")?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><?=getlang('Verzending');?></td>
                                                <td>&euro; <?=number_format($order_data[0]->ship_amount,2,",",".")?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><?=getlang('BTW');?>:</td>
                                                <td>&euro; <?=number_format($vat_amt,2,",",".")?></td>
                                            </tr>
                                            <?php if(!empty($order_data[0]->discount_amount)){?>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><?=getlang('Discount_Amount');?>:</td>
                                                <td>&euro; <?=number_format($order_data[0]->discount_amount,2,",",".")?></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><?=getlang('Totaal_betaald');?>:</td>
                                                <td>&euro; <?=number_format($order_data[0]->total_amount,2,",",".")?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="nk-notes ff-italic fs-12px text-soft"> <?=get_settings('order_note_text')?></div>
                                </div>
                            </div><!-- .invoice-bills -->
                        </div><!-- .invoice-wrap -->
                    </div><!-- .invoice -->
                </div><!-- .nk-block -->
            </div>
        </div>
        
    </div>
</div>

<!-- Modal -->
<div class="modal fade ord_mod" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        
    <div class="modal-dialog">
    
        <div class="modal-content">
            <?php echo form_open_multipart(ADMIN_URL.'/orders/edit_order/'.$order_data[0]->id,array('id'=>'order_editform'));?>
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><?=getlang('Edit_Order')?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="your_modal_detail">
            
                <div class="form-group">    
                    <label class="form-label" for="default-02"><?=getlang("title");?></label>    
                    <div class="form-control-wrap">        
                        <input type="text" name="title"  class="form-control" id="default-02" value=""  placeholder="<?=getlang("title");?>">    
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="default-05"><?=getlang("quantity");?></label>
                    <div class="form-control-wrap">
                    <input type="text" name="quantity"  class="form-control" id="default-02" value=""  placeholder="<?=getlang("quantity");?>">    
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="default-05"><?=getlang("rate");?></label>
                    <div class="form-control-wrap">
                    <input type="text" name="rate"  class="form-control" id="default-02" value=""  placeholder="<?=getlang("rate");?>">    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
            </div>
            </form>
        </div>
        
    </div>
   
</div>


<!-- Modal -->
<div class="modal fade ord_mod" id="additem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="additemLabel" aria-hidden="true">
                                        
    <div class="modal-dialog">
    
        <div class="modal-content">
            <?php echo form_open_multipart(ADMIN_URL.'/orders/add_orderitem/'.$order_data[0]->id,array('id'=>'order_addform'));?>
            <div class="modal-header">
                <h5 class="modal-title" id="additemLabel"><?=getlang('Add_item')?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="add_item_body">
            
                <div class="form-group">    
                    <label class="form-label" for="default-02"><?=getlang("title");?></label>    
                    <div class="form-control-wrap">        
                        <input type="text" name="title"  class="form-control" id="default-02" value=""  placeholder="<?=getlang("title");?>">    
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="default-05"><?=getlang("quantity");?></label>
                    <div class="form-control-wrap">
                    <input type="text" name="quantity"  class="form-control" id="default-02" value=""  placeholder="<?=getlang("quantity");?>">    
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="default-05"><?=getlang("rate");?></label>
                    <div class="form-control-wrap">
                    <input type="text" name="rate"  class="form-control" id="default-02" value=""  placeholder="<?=getlang("rate");?>">    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
            </div>
            </form>
        </div>
        
    </div>
   
</div>

<!-- Modal -->
<div class="modal fade ord_mod" id="editClientInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editClientInfoLabel" aria-hidden="true">
                                        
    <div class="modal-dialog">
    
        <div class="modal-content">
            <?php echo form_open_multipart(ADMIN_URL.'/orders/save_client_info/'.$order_data[0]->id,array('id'=>'order_editclientinfoform'));?>
            <div class="modal-header">
                <h5 class="modal-title" id="editClientInfoLabel"><?=getlang('Klantgegevens bewerken')?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="editClientInfoModalBody">
            
               
            </div>
            <div class="modal-footer">
            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
            </div>
            </form>
        </div>
        
    </div>
   
</div>
<!-- Modal end -->

<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>  
$(document).ready(function(){ 
    
    $('.view_data').click(function(){
     
    var csrfhash = $('[name=<?=csrf_token();?>]').val();
    var order_id = "<?=$order_data[0]->id;?>";
    var id = $(this).attr("id");  
    $.ajax({  
        url : "<?php echo base_url(ADMIN_URL).'/orders/get_order_item_data' ?>", 
        type:"POST",  
        data:{id:id,order_id:order_id,'<?=csrf_token();?>': csrfhash},  
        success:function(data){
        //alert(data);  
        $('#your_modal_detail').html(data);  
        $('#staticBackdrop').modal("show");  
        },  
        complete: function() {
            $.get("<?=base_url('home/getcsrfkey') ?>", function(keyupdate){
                $('[name=<?=csrf_token();?>]').val(keyupdate);
            });
        }
    });  
}); 


$('.add-item').click(function(){
     
        var csrfhash = $('[name=<?=csrf_token();?>]').val();
        var order_id = "<?=$order_data[0]->id;?>";
        $.ajax({  
            url : "<?php echo base_url(ADMIN_URL).'/orders/get_neworder_item_data' ?>", 
            type:"POST",  
            data:{order_id:order_id,'<?=csrf_token();?>': csrfhash},  
            success:function(data){
                //alert(data);  
                $('#add_item_body').html(data);  
                $('#additem').modal("show");  
            },  
            complete: function() {
                $.get("<?=base_url('home/getcsrfkey') ?>", function(keyupdate){
                    $('[name=<?=csrf_token();?>]').val(keyupdate);
                });
            }
        });  
});
$('.edit_client_info').click(function(){
     
     var csrfhash = $('[name=<?=csrf_token();?>]').val();
     var order_id = "<?=$order_data[0]->id;?>";
    //  var id = $(this).attr("id");  
     $.ajax({  
         url : "<?php echo base_url(ADMIN_URL).'/orders/get_client_info' ?>", 
         type:"POST",  
         data:{order_id:order_id,'<?=csrf_token();?>': csrfhash},  
         success:function(data){
            //alert(data);  
            $('#editClientInfoModalBody').html(data);  
            $('#editClientInfo').modal("show");  
         },  
         
     });  
 });
$('.btn-close').on('click',function(){
        location.reload();
    }); 
});  
</script>

<script>  
$(document).ready(function(){ 
$('.delete_data').click(function(){ 
    var csrfhash = $('[name=<?=csrf_token();?>]').val();
    var order_id = "<?=$order_data[0]->id;?>";
    var id = $(this).attr("id");  
    $.ajax({  
        url : "<?php echo base_url(ADMIN_URL).'/orders/delete_order_item_data' ?>", 
        type:"POST",  
        data:{id:id,order_id:order_id,'<?=csrf_token();?>': csrfhash},  
        success:function(data){
            if(data)
            {
                location.reload();
            }
        },  
        complete: function() {
            $.get("<?=base_url('home/getcsrfkey') ?>", function(keyupdate){
                $('[name=<?=csrf_token();?>]').val(keyupdate);
            });
        }
    });  
});  
});  
</script>

        

