<div class="nk-content nk-content-fluid invoice_pg">
    <div class="container-xl wide-xl">
        
        <div class="nk-content-body">
            <div class="nk-content-wrap">
                <div class="nk-block-head">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"><?=getlang('Invoice');?> <strong class="text-primary small" style="color:#66CCFF !important;">#<?=$order_data[0]->order_id?></strong></h3>
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
                            <a href="<?=base_url(ADMIN_URL.'/orders/manage')?>" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span><?=getlang('Back');?></span></a>
                            
                            <div class="dropdown">
                                <a class="dropdown-toggle btn btn-icon btn-light" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end">
                                     <?php echo $order_menus; ?>
                                </div>
                            </div>


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
                                    <img style="width:100%;height:50px;object-fit:contain;max-width:200px;" src="<?php echo image_url('uploads/logo/'.$invoice_logo);?>" alt="logo">   
                                <?php } else { ?>
                                    <img style="width:100%;height:50px;object-fit:contain;max-width:200px;" src="<?php echo image_url('assets/frontend/images/cart-img.svg');?>" alt="logo">
                                    <?php } ?>
                                </td>
                            </div>
                            <div class="invoice-head">
                                <div class="invoice-contact">
                                    <span class="overline-title"><?=getlang('Invoice_To')?></span>
                                    <div class="invoice-contact-info">
                                        <?php if($order_data[0]->diff_ship == '0'){ ?>
                                            <h4 class="title"><?=$order_data[0]->voornaam?>  <?=$order_data[0]->achternaam?></h4>
                                        <?php } else { ?>
                                            <h4 class="title"><?=$order_data[0]->ship_voornaam?>  <?=$order_data[0]->ship_achternaam?></h4>
                                        <?php } ?>
                                        <ul class="list-plain">
                                            <?php if($order_data[0]->diff_ship == '0'){ ?>
                                            <li><em class="icon ni ni-map-pin-fill"></em><span><?php //echo getlang('Address').' #'; ?><?=$order_data[0]->straat?> <?=$order_data[0]->hno?> <?=$order_data[0]->toev?> <?=$order_data[0]->postcode?> <?=$order_data[0]->plaats?><br><?=$order_data[0]->city?>  <?=$order_data[0]->land_ragio?></span></li>
                                            <?php } else { ?>
                                            <li><em class="icon ni ni-map-pin-fill"></em><span><?php //echo getlang('Shipping_Address').' #; ?><?=!empty($order_data[0]->ship_straat)?$order_data[0]->ship_straat:$order_data[0]->straat?> <?=!empty($order_data[0]->ship_hno)?$order_data[0]->ship_hno:$order_data[0]->hno?> <?=!empty($order_data[0]->ship_toev)?$order_data[0]->ship_toev:$order_data[0]->toev?> <?=!empty($order_data[0]->ship_postcode)?$order_data[0]->ship_postcode:$order_data[0]->postcode?> <?=!empty($order_data[0]->ship_plaats)?$order_data[0]->ship_plaats:$order_data[0]->plaats?><br><?=!empty($order_data[0]->ship_city)?$order_data[0]->ship_city:$order_data[0]->city?>  <?=!empty($order_data[0]->ship_land_ragio)?$order_data[0]->ship_land_ragio:$order_data[0]->land_ragio?></span></li>
                                            <?php } ?>
                                            <li><em class="icon ni ni-call-fill"></em><span><?=$order_data[0]->telefoon?></span></li>
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
                                        <li class="transaction_status"><span><?=getlang('BETALINGSSTATUS')?></span>:<span <?php if(!empty($get_status_color)){?>style="color:<?=$get_status_color;?>;"<?php } ?> ><?=getorderstatusname($order_data[0]->payment_status)?></span></li>
                                        <li class="tracking_status"><span><?=getlang('E-commerce geactiveerd')?></span>:<span><?php if($order_data[0]->is_tracked == 1 ){echo getlang('yes');}else{echo getlang('no');}?></span></li>
                                        <?php $shipping_name = get_shipping_name($order_data[0]->ship_method);
                                            if(!empty($shipping_name)){?>
                                        <li class="invoice-date"><span><?=getlang('Bezorg_info')?></span>:<span><?=$shipping_name?></span></li>
                                        <?php } ?>
                                        
                                        <?php if(!empty($order_data[0]->picqer_carrier_key)){ ?>
                                        <li class="invoice-date"><span><?=getlang('Naam aanbieder')?></span>:<span><?=$order_data[0]->picqer_carrier_key?></span></li>
                                        <?php } ?>
                                        <?php if(!empty($order_data[0]->picqer_trackingcode)){?>
                                        <li class="invoice-date"><span><?=getlang('Tracking Code')?></span>:<span><?=$order_data[0]->picqer_trackingcode?></span></li>
                                        <?php } ?>
                                        <?php if(!empty($order_data[0]->picqer_trackingurl)){?>
                                        <li class="invoice-date"><span><?=getlang('Tracking URL')?></span>: <a href="<?=$order_data[0]->picqer_trackingurl?>"><?php echo getlang('Om_te_volgen'); ?></a></li>
                                        <?php } ?>
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
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $vat_amt = 0; 
                                        $insurance_amount = 0;
                                        $sub_total = 0;
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
                                                <td><?php echo display_price($price); ?></td>
                                                <?php $total = $price * $oi->product_qty; ?>
                                                <td><?=display_price($total)?></td>
                                                
                                            </tr>
                                        <?php 
                                        $sub_total += $total; 
                                        $insurance_amount = (float)$insurance_amount + (float)$oi->insurance_price;
                                        $vat_rate = !empty(trim($oi->vat))?$oi->vat:21;
                                        $vamount =  calculateVat($total,$vat_rate);
                                        $vat_amt += $vamount['vatAmount'];
                                    } ?>
                                        <?php } ?>
                                            
                                        


                                        </tbody>
                                        <tfoot>
                                        <?php 
                                            $total_amount = $order_data[0]->total_amount;
                                            if(!empty($order_data[0]->discount_amount)){
                                                $total_amount = $order_data[0]->total_amount + $order_data[0]->discount_amount;
                                            }
                                        ?>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><?=getlang('SubTotaal');?></td>
                                                <td><?=display_price($sub_total)?></td>
                                            </tr>
                                            <!-- <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><?=getlang('Insurance_price');?>:</td>
                                                <td><?=display_price($insurance_amount)?></td>
                                            </tr> -->
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><?=getlang('Verzending');?></td>
                                                <td><?=display_price($order_data[0]->ship_amount)?>
                                                <?php $vat_shipping_array = calculateVat($order_data[0]->ship_amount,21);
                                                      $vat_shipping_price = $vat_shipping_array['vatAmount']; 
                                                      $final_vat = ((float)$vat_amt + (float)$vat_shipping_price);
                                                      
                                                      ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><?=getlang('BTW');?>:</td>
                                                <td><?=display_price($final_vat)?></td>
                                            </tr>
                                            <?php if(!empty($order_data[0]->discount_amount)){?>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><?=getlang('korting hoeveelheid');?>:</td>
                                                <td><?=display_price($order_data[0]->discount_amount)?></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td colspan="2"><?=getlang('Totaal_betaald');?>:</td>
                                                <td><?=display_price($order_data[0]->total_amount)?></td>
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
        <div class="row">
        <?php echo form_open(ADMIN_URL."/orders/details/".$order_data[0]->id, array('id' => 'orderdetailsform')); ?>  
        <input type="hidden" name="order_id" value="<?=$order_data[0]->id;?>">
            <div class="form-group">
                <label class="form-label" for="fw-field_type"><?=getlang('Bestelstatus')?></label>
                <div class="form-control-wrap ">
                    
                    <select class="form-select js-select2" data-msg="Required" id="fw-field_type" name="order_status">
                        
                        <option><?=getlang('select_order_status')?></option>
                        <?php foreach($order_statuses as $stati){?>
                        <option value="<?=$stati->id?>" <?php if($stati->key == $order_data[0]->payment_status){ echo "selected"; }?>><?=$stati->name;?></option>
                        <?php } ?>
                    </select>
                    
                </div>
            </div>
            <div class="form-group">   
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input notify_customer" value="0" name="notify_customer"  id="fv-com-email">
                        <label class="custom-control-label" for="fv-com-email"><?=getlang("Klant op de hoogte brengen");?></label>
                </div> 
                
            </div>
        <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang('submit');?></button></div>
        <?php echo form_close();?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $('.notify_customer').change(function() {
        if ($(this).is(':checked')) {

        $('.notify_customer').val(1);
        $(this).prop('checked', true);
    } else {
        
        $(this).prop('checked', false);
            $('.notify_customer').val(0);
        }
    });
});

</script>



 
        

