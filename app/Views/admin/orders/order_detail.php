<!-- content @s -->
<link rel="stylesheet" href="<?php echo base_url('assets/frontend');?>/css/view_ord.css">
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('Order_Details');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/orders/manage" class="btn btn-primary"><span><?=getlang('Orders');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/orders/manage" class="btn btn-icon btn-primary"><?=getlang('Orders');?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
                        <?php echo form_open("beheerpaneel/orders/details/".$order_data[0]->id, array('id' => 'orderdetailsform')); ?>  
                        <input type="hidden" name="order_id" value="<?=$order_data[0]->id;?>">
                            <div class="form-group">
                                <label class="form-label" for="fw-field_type"><?=getlang('order_status')?></label>
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
                                    <input type="checkbox" class="custom-control-input" value="1" name="notify_customer"  id="fv-com-email" checked>
                                        <label class="custom-control-label" for="fv-com-email"><?=getlang("Notify_customer");?></label>
                                </div> 
                                
                            </div>
                        <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang('submit');?></button></div>
                    <?php echo form_close();?>

            <section class="ordersdetail_page_main">
                <div class="container">
                    <div class="order_head">
                        <b><?=getlang('Bestelling');?></b>
                        <h1><?=getlang('Bestelling');?> #<?=$order_data[0]->order_id?></h1>
                    </div>
                    <div class="order_details">
                        <?php 
                        $config         = new \Config\Encryption();
                        $config->key    = 'aBigsecret_ofAtleast32Characters';
                        $config->driver = 'OpenSSL';

                        $encrypter = \Config\Services::encrypter($config);
                        $encryptedorderid = $encrypter->encrypt($order_data[0]->order_id);

                        $base64urlEncodedorderid = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encryptedorderid));
                        ?>
                        <div class="od_content">
                            <div class="od_cont_head">
                                <div class="left">
                                    <a href="javascript:void(0);" class="open"><?=getlang('open');?></a>
                                    <a href="javascript:void(0);" class="print"><img
                                            src="<?=base_url();?>/assets/frontend/images/print1.svg"></a>
                                    <a href="<?=base_url('beheerpaneel/orders/download_invoice/'.$base64urlEncodedorderid);?>" class="down"><img
                                            src="<?=base_url();?>/assets/frontend/images/fax.svg"></a>
                                </div>
                                <div class="right">
                                    
                                    <a href="<?=base_url('beheerpaneel/orders/invoice_pdf/'.$base64urlEncodedorderid);?>" class="pdf"><img
                                            src="<?=base_url();?>/assets/frontend/images/pdf.svg"></a>
                                    <a href="javascript:void(0);" class="fullscrn"><img
                                            src="<?=base_url();?>/assets/frontend/images/full.svg"></a>
                                </div>
                            </div>
                            <div class="od_body">
                                <div class="odb_contents">
                                    <div class="odb_logo">
                                        <img src="<?=image_url('assets/frontend/images/cart-img.svg');?>">
                                        <div class="cust_details">
                                            <h4><?=$order_data[0]->voornaam?>  <?=$order_data[0]->achternaam?></h4>
                                            <p><?=$order_data[0]->straat?> <?=$order_data[0]->hno?> <?=$order_data[0]->toev?></p>
                                            <p><?=$order_data[0]->postcode?> <?=$order_data[0]->plaats?></p>
                                            <p><?=$order_data[0]->city?>  <?=$order_data[0]->land_ragio?></p>
                                            <span class="tele"><b><?=getlang('Tel')?>:</b> <a
                                                    href="tel:+<?=$order_data[0]->telefoon?>"><?=$order_data[0]->telefoon?></a></span>
                                            <span class="email"><b><?=getlang('E-mail')?>:</b>
                                                <a href="mailto:<?=$order_data[0]->email?>"><?=$order_data[0]->email?></a></span>
                                            <span class="ord"><b><?=getlang('Order_ID')?>:</b>
                                                <a href="javascript:void(0);"><?=$order_data[0]->order_id?></a></span>
                                        </div>
                                    </div>
                                    <div class="odb_cont">
                                    <?php $getcompanyinfo = getcompanyinfo();?>
                                        <h3><?php if(!empty($getcompanyinfo) && !empty($getcompanyinfo[0]->company_name)){ ?> <?=$getcompanyinfo[0]->company_name?><?php } ?></h3>
                                        <?php if(!empty($getcompanyinfo) && !empty($getcompanyinfo[0]->contact_address)){ ?> <?=$getcompanyinfo[0]->contact_address?><?php } ?>
                                        <!-- <p>Mossendamsdwarsweg 2</p>
                                        <p>7472 DB Goor (Overijssel)</p> -->
                                        <ul>
                                            <li><?=getlang('KVK')?>: <a href="javascript:void(0);"><?php if(!empty($getcompanyinfo) && !empty($getcompanyinfo[0]->kvk)){ ?> <?=$getcompanyinfo[0]->kvk?><?php } ?></a></li>
                                            <li><?=getlang('BTW')?>: <a href="javascript:void(0);"><?php if(!empty($getcompanyinfo) && !empty($getcompanyinfo[0]->btw)){ ?> <?=$getcompanyinfo[0]->btw?><?php } ?></a></li>
                                            <li><?=getlang('IBAN')?>: <a href="javascript:void(0);"><?php if(!empty($getcompanyinfo) && !empty($getcompanyinfo[0]->iban)){ ?> <?=$getcompanyinfo[0]->iban?><?php } ?></a></li>
                                        </ul>
                                        <span class="tele"><?=getlang('Tel')?> : <a href="tel:+<?php if(!empty($getcompanyinfo) && !empty($getcompanyinfo[0]->contact_telefoon)){ ?> <?=$getcompanyinfo[0]->contact_telefoon?><?php } ?>"><?php if(!empty($getcompanyinfo) && !empty($getcompanyinfo[0]->contact_telefoon)){ ?> <?=$getcompanyinfo[0]->contact_telefoon?><?php } ?></a></span>
                                        <span class="email"><?=getlang('E-Mail')?> : <a href="mailto:<?php if(!empty($getcompanyinfo) && !empty($getcompanyinfo[0]->contact_email)){ ?> <?=$getcompanyinfo[0]->contact_email?><?php } ?>"><?php if(!empty($getcompanyinfo) && !empty($getcompanyinfo[0]->contact_email)){ ?> <?=$getcompanyinfo[0]->contact_email?><?php } ?></a></span>

                                        <div class="ordnum-date">
                                            <p><b><?=getlang('Factuur_nr')?>:</b><span><?=$order_data[0]->order_id?></span></p>
                                            <?php $timestamp = strtotime($order_data[0]->order_created);
                                                    $formattedDate = date('d-M-Y', $timestamp);?>
                                            <p><b><?=getlang('Datum')?>:</b><span><?=$formattedDate?></span></p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="od_table table-responsive">
                                <table class="order_table">
                                    <thead>
                                        <tr>
                                            <th class="first">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th class="product"><?=getlang('Product');?></th>
                                                            <th class="quantity"><?=getlang('Product_nr');?></th>
                                                            <th class="price"><?=getlang('Prijs');?></th>
                                                            <th class="total"><?=getlang('Totaal');?></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="first">
                                                <table>
                                                    <tbody>
                                                    <?php if(!empty($order_items)){?>
                                                        <?php foreach($order_items as $oi){?>
                                                        <tr class="order_item">
                                                            <td class="product">
                                                                <p><?=$oi->product_name?></p>
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
                                                            <td class="quantity">
                                                                <p># <?=$oi->product_qty?></p>
                                                            </td>
                                                            <td class="price">
                                                                <p>&euro; <?=number_format((float)$price,2,",","")?></p>
                                                            </td>
                                                            <td class="total">
                                                                <?php $total = $price * $oi->product_qty; ?>
                                                                <p>&euro; <?=number_format((float)$total,2,",","")?></p>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                        
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="second">
                                                <table>
                                                    <tbody>
                                                        <tr class="order_totals">
                                                            <td>
                                                                <div
                                                                    class="order_total">
                                                                    <table>
                                                                        <tbody>
                                                                        <?php 
                                                                            $total_amount = $order_data[0]->total_amount;
                                                                            if(!empty($order_data[0]->discount_amount)){
                                                                                $total_amount = $order_data[0]->total_amount + $order_data[0]->discount_amount;
                                                                            }
                                                                        ?>
                                                                            <tr>
                                                                                <td><?=getlang('SubTotaal');?>:
                                                                                </td>
                                                                                <td>&euro; <?=number_format((float)$total_amount,2,",","")?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><?=getlang('Verzending');?>:</td>
                                                                                <td>&euro; <?=number_format((float)$order_data[0]->ship_amount,2,",","")?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><?=getlang('BTW');?>(21%):</td>
                                                                                <?php $vat_calulate= calculateVat($order_data[0]->total_amount,21);?>
                                                                                <td>&euro; <?=number_format((float)$vat_calulate['vatAmount'],2,",","")?></td>
                                                                            </tr>
                                                                            <?php if(!empty($order_data[0]->discount_amount)){?>
                                                                            <tr>
                                                                                <td><?=getlang('Discount_Amount');?>:</td>
                                                                                <td>&euro; <?=number_format((float)$order_data[0]->discount_amount,2,",","")?></td>
                                                                            </tr>
                                                                            <?php } ?>
                                                                            <tr>
                                                                                <td><?=getlang('Totaal_betaald');?>:</td>
                                                                                <td>&euro; <?=number_format((float)$order_data[0]->total_amount,2,",","")?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="order_note">
                            <h2><?=getlang('Notities');?>:</h2>
                            <p><?=get_settings('order_note_text')?></p>
                        </div>
                    </div>
                </div>
            </section>

        
                        </div>
                </div><!-- .nk-block -->
            </div><!-- .content-page -->
        </div>
    </div>
</div>
<!-- content @e -->

<?php echo minifier('adminvalidate.min.js'); ?>

<script>
$("#orderdetailsform").validate({ 
	rules: { 
        order_status: {
            required: true,            
         },
        
      },

});

</script>