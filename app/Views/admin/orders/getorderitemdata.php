<input type="hidden" name="order_id" id="order_id" value="<?=$order_item_data[0]->order_id;?>"> 
<input type="hidden" name="order_itemid" id="order_itemid" value="<?=$order_item_data[0]->id;?>"> 
<div class="form-group">   
<label class="form-label" name="Product_name" for="fva-Product_name"><?=getlang('Product_name');?></label>  
    <?php if(!empty($products)){?>
    <div class="form-control-wrap ">                               
        <select class="form-select js-select2" id="fva-product" name="product_id" data-placeholder="<?=getlang('Product_name');?>" required>
        <?php foreach($products as $p){

            $price = $p->rprice;
            if(!empty($p->regoffprice) && $p->regoffprice != '0.00')
            {
                $price = $p->regoffprice;
            }
            
            ?>

        <option value="<?=$p->id?>" <?php if($order_item_data[0]->product_id == $p->id){ echo "selected";}?> data-price="<?=$price;?>"><?=$p->pname;?></option>
        <?php } ?>
        </select>                               
    </div>
    

    <?php }else { ?>
        <div class="form-control-wrap">        
            <input type="text" name="product_id"  class="form-control" id="default-02" value="<?=$order_item_data[0]->product_name;?>"  placeholder="<?=getlang("Product_name");?>" required>    
        </div>
    <?php } ?>
</div>

<div class="prod_options_div">
<?php 

$product_options = $general_model->fetch_data('product_options_with_product',array('product_id'=>$order_item_data[0]->product_id));
// echo "<pre>";
// print_r($product_options);
// exit;
$prod_image = product_images($order_item_data[0]->product_id);
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
<?php $product_variants = json_decode($order_item_data[0]->product_variants, true);?>
<?php $get_options_name = $general_model->fetch_data('product_options_with_product',array('option_id'=>$p_o->option_id,'product_id'=>$order_item_data[0]->product_id));
if(!empty($get_options_name)){ 

$get_options_variants = $general_model->fetch_data('product_options_variants_with_product',array('option_id'=>$p_o->option_id,'product_id'=>$order_item_data[0]->product_id,'status'=>'A','quantity>'=>0));
if(!empty($get_options_variants)){
    if($get_options_name[0]->field_type=='select'){?>
    <div class="com-fle">
        <p><?=$get_options_name[0]->optionname;?> :</p>
        <div class="clr siz">
        <?php foreach($get_options_variants as $g_o_v){?>

            <?php 
            $optionid = 0;
            if(!empty($product_variants['sizeoption_name']) && !empty($product_variants['sizeoption_id']) && !empty($product_variants['sizeoptionName']) && !empty($product_variants['sizeoption_price'])){ 
                $optionid = $product_variants['sizeoption_id'];
            } ?>
            <label>
            <input type="radio" data-addprice="<?=$g_o_v->price;?>" name="size" value="<?=$g_o_v->id;?>#<?=$g_o_v->name;?>#<?=$g_o_v->price;?>#<?php if(!empty($g_o_v->image)){ echo base_url('uploads/product_options'.'/'.$g_o_v->image); }else { echo base_url('uploads/product'.'/'.$prod_first_image);}?>#<?=$get_options_name[0]->optionname;?>" id="option_list"  class="option-list-radio" <?php if($optionid == $g_o_v->id){echo "checked";}?> required>
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
            if(!empty($product_variants['coloroption_name']) && !empty($product_variants['coloroption_id']) && !empty($product_variants['coloroptionName']) && !empty($product_variants['coloroption_price'])){ 
                $optionid = $product_variants['coloroption_id'];
            } ?>
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
            if(!empty($product_variants['batteryoption_name']) && !empty($product_variants['batteryoption_id']) && !empty($product_variants['batteryoptionName']) && !empty($product_variants['batteryoption_price'])){ 
                $optionid = $product_variants['batteryoption_id'];
            } ?>
            <label>
            <input type="radio"data-addprice="<?=$g_o_v->price;?>"  name="battery" value="<?=$g_o_v->id;?>#<?=$g_o_v->name;?>#<?=$g_o_v->price;?>#<?php if(!empty($g_o_v->image)){ echo base_url('uploads/product_options'.'/'.$g_o_v->image); }else { echo base_url('uploads/product'.'/'.$prod_first_image);}?>#<?=$get_options_name[0]->optionname;?>" id="option_list"  class="option-list-radio" <?php if($optionid == $g_o_v->id){echo "checked";}?> required>
            <strong><?=$g_o_v->name;?></strong>
        </label>
        <?php } ?>
        </div>
        </div>
<?php } } ?>

<?php } }?>

</div>

<div class="form-group">
    <label class="form-label" for="default-05"><?=getlang("quantity");?></label>
    <div class="form-control-wrap">
    <input type="text" name="quantity"  class="form-control" id="quantity" value="<?=$order_item_data[0]->product_qty;?>"  placeholder="<?=getlang("quantity");?>" required>    
    </div>
</div>
<div class="form-group">
    <label class="form-label" for="default-05"><?=getlang("Product_price");?></label>
    <div class="form-control-wrap">
    <input type="hidden" id="base_product_price" value="<?=$order_item_data[0]->product_price;?>">
    <input type="text" name="price"  class="form-control" id="price" value="<?=$order_item_data[0]->product_price;?>"  placeholder="<?=getlang("Product_price");?>" required>    
    </div>
</div>
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('#fva-product').on('change',function(){
        $('.prod_options_div').html();
        var product_id = $(this).val();
        var order_id = $('#order_id').val();
        var order_itemid = $('#order_itemid').val();
        var csrfhash = $('[name=<?=csrf_token();?>]').val();
        var selectedOption = $(this).find('option:selected');
        $.ajax({  
            url : "<?php echo base_url(ADMIN_URL.'/orders/get_product_option_data') ?>", 
            type:"POST",  
            data:{product_id:product_id,order_itemid:order_itemid,order_id:order_id,'<?=csrf_token();?>': csrfhash},  
            success:function(data){
                if(data)
                {
                    $('.prod_options_div').html(data);
                    $('.prod_options_div').show();
                    
                }
                else
                {
                    var d = '';
                    $('.prod_options_div').hide();
                    $('.prod_options_div').html(d);

                }
            },  
            complete: function() {
                $.get("<?=base_url('home/getcsrfkey') ?>", function(keyupdate){
                    $('[name=<?=csrf_token();?>]').val(keyupdate);
                });
            }
        });  
        var price = selectedOption.data('price');
        $('#price').val(price);
        $('#quantity').val(1);
    });
    </script>

<script>
    $(document).ready(function(){
        updateTotalPrice();
    });
    $(document).on('change', '.option-list-radio', function () {
        updateTotalPrice();
    });
    function updateTotalPrice() {
        var total_price = parseFloat($('#base_product_price').val());
        $('.option-list-radio:checked').each(function () {
            
            var addition_price = $(this).data('addprice');
            total_price += parseFloat(addition_price);
        });
        $('#price').val(total_price.toFixed(2));
        
    }
</script>