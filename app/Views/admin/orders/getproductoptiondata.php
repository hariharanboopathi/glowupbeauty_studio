<?php $prod_image = product_images($product_id);
if(!empty($prod_image))
{
    $prod_first_image = $prod_image[0]->image;
}
else
{
    $prod_first_image = '';
}

if(!empty($product_options)){
foreach($product_options as $p_o){
    
    ?>
<?php 
$product_variants = array();
if(!empty($product_variants)){
$product_variants = json_decode($order_item_data[0]->product_variants, true);
}
?>
<?php $get_options_name = $general_model->fetch_data('product_options_with_product',array('option_id'=>$p_o->option_id,'product_id'=>$product_id));
if(!empty($get_options_name)){ 

$get_options_variants = $general_model->fetch_data('product_options_variants_with_product',array('option_id'=>$p_o->option_id,'product_id'=>$product_id,'status'=>'A','quantity>'=>0));
if(!empty($get_options_variants)){
    if($get_options_name[0]->field_type=='select'){?>
    <div class="com-fle">
        <p><?=$get_options_name[0]->optionname;?> :</p>
        <div class="clr siz">
        <?php foreach($get_options_variants as $g_o_v){?>

            <?php 
            $optionid = 0;
            if(!empty($product_variants)){
                if(!empty($product_variants['sizeoption_name']) && !empty($product_variants['sizeoption_id']) && !empty($product_variants['sizeoptionName']) && !empty($product_variants['sizeoption_price'])){ 
                    $optionid = $product_variants['sizeoption_id'];
                }
            }
             ?>
            <label>
            <input type="radio" name="size" data-addprice="<?=$g_o_v->price;?>" value="<?=$g_o_v->id;?>#<?=$g_o_v->name;?>#<?=$g_o_v->price;?>#<?php if(!empty($g_o_v->image)){ echo base_url('uploads/product_options'.'/'.$g_o_v->image); }else { echo base_url('uploads/product'.'/'.$prod_first_image);}?>#<?=$get_options_name[0]->optionname;?>" id="option_list"  class="option-list-radio" <?php if($optionid == $g_o_v->id){echo "checked";}?> required>
            <strong><?=$g_o_v->name;?></strong>
            </label>
        <?php } ?>
        </div>
        </div>
    <?php }
}
}?>
<?php if(!empty($get_options_variants)){?>
<?php if($get_options_name[0]->field_type=='image'){ ?>
    <div class="com-fle">
    <p><?=$get_options_name[0]->optionname;?> :</p>
    <div class="clr siz">
    <?php foreach($get_options_variants as $g_o_v){?>
        <?php 
            $optionid = 0;
            if(!empty($product_variants)){
                if(!empty($product_variants['coloroption_name']) && !empty($product_variants['coloroption_id']) && !empty($product_variants['coloroptionName']) && !empty($product_variants['coloroption_price'])){ 
                    $optionid = $product_variants['coloroption_id'];
                } 
            }?>
        <label>
            <input type="radio" name="color"  data-addprice="<?=$g_o_v->price;?>" value="<?=$g_o_v->id;?>#<?=$g_o_v->name;?>#<?=$g_o_v->price;?>#<?php if(!empty($g_o_v->image)){ echo image_url('uploads/product_options'.'/'.$g_o_v->image); }else { echo image_url('uploads/product'.'/'.$prod_first_image);}?>#<?=$get_options_name[0]->optionname;?>" id="option_list"  class="option-list-radio" <?php if($optionid == $g_o_v->id){echo "checked";}?> required>
            <span> <img src="<?php if(!empty($g_o_v->image)){ echo image_url('uploads/product_options'.'/'.$g_o_v->image); }else { echo image_url('uploads/product'.'/'.$prod_first_image);}?>" loading="lazy" height="50" width="50"></span>
    </label>                     
        <?php } ?>
    </div>
    </div>
<?php } } ?>
<?php if(!empty($get_options_variants)){?>
    <?php if($get_options_name[0]->field_type=='battery'){ ?>
        <div class="com-fle">
        <p><?=$get_options_name[0]->optionname;?> :</p>
        <div class="clr siz">
        <?php foreach($get_options_variants as $g_o_v){?>
            <?php 
            $optionid = 0;
            if(!empty($product_variants)){
                if(!empty($product_variants['batteryoption_name']) && !empty($product_variants['batteryoption_id']) && !empty($product_variants['batteryoptionName']) && !empty($product_variants['batteryoption_price'])){ 
                    $optionid = $product_variants['batteryoption_id'];
                } 
            }
            ?>
            <label>
            <input type="radio" name="battery" data-addprice="<?=$g_o_v->price;?>" value="<?=$g_o_v->id;?>#<?=$g_o_v->name;?>#<?=$g_o_v->price;?>#<?php if(!empty($g_o_v->image)){ echo base_url('uploads/product_options'.'/'.$g_o_v->image); }else { echo base_url('uploads/product'.'/'.$prod_first_image);}?>#<?=$get_options_name[0]->optionname;?>" id="option_list"  class="option-list-radio" <?php if($optionid == $g_o_v->id){echo "checked";}?> required>
            <strong><?=$g_o_v->name;?></strong>
        </label>
        <?php } ?>
        </div>
        </div>
<?php } } ?>

<?php } }?>