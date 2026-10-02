<input type="hidden" name="order_id" id="order_id" value="<?=$order_id;?>"> 
<div class="form-group">   
<label class="form-label" name="Product_name" for="fva-Product_name"><?=getlang('Product_name');?></label>  
    <?php if(!empty($products)){

$firstprice = $products[0]->rprice;
if(!empty($products[0]->regoffprice) && $products[0]->regoffprice != '0.00')
{
    $firstprice = $products[0]->regoffprice;
}
        
        ?>
    <div class="form-control-wrap ">                               
        <select class="form-select js-select2" id="fva-product" name="product_id" data-placeholder="<?=getlang('Product_name');?>" required>
        <?php foreach($products as $p){

            $price = $p->rprice;
            if(!empty($p->regoffprice) && $p->regoffprice != '0.00')
            {
                $price = $p->regoffprice;
            }
            
            ?>

        <option value="<?=$p->id?>" data-price="<?=$price;?>"><?=$p->pname;?></option>
        <?php } ?>
        </select>                               
    </div>
    <?php }?>
</div>

<div class="prod_options_div">


</div>

<div class="form-group">
    <label class="form-label" for="default-05"><?=getlang("quantity");?></label>
    <div class="form-control-wrap">
    <input type="text" name="quantity"  class="form-control" id="quantity" value="1" required>    
    </div>
</div>
<div class="form-group">
    <label class="form-label" for="default-05"><?=getlang("Product_price");?></label>
    <div class="form-control-wrap">
        <input type="hidden" id="base_product_price" value="<?=$firstprice?>">
    <input type="text" name="price"  class="form-control" id="price" value="<?=$firstprice;?>"  placeholder="<?=getlang("Product_price");?>" required>    
    </div>
</div>
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var product_id = $('#fva-product').val();
        updateproductoptiondata(product_id);
        updateTotalPrice();
    });
    $('#fva-product').on('change',function(){
        var pro_id = $(this).val();
        $('.prod_options_div').html();
        var product_id = $(this).val();
        var order_id = $('#order_id').val();
        var csrfhash = $('[name=<?=csrf_token();?>]').val();
        var selectedOption = $(this).find('option:selected');
        $.ajax({  
            url : "<?php echo base_url(ADMIN_URL.'/orders/get_product_option_data') ?>", 
            type:"POST",  
            data:{product_id:product_id,order_id:order_id,'<?=csrf_token();?>': csrfhash},  
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
    function updateproductoptiondata(product_id) {
        $('.prod_options_div').html();
        var product_id = product_id;
        var order_id = $('#order_id').val();
        var csrfhash = $('[name=<?=csrf_token();?>]').val();
        var selectedOption = $(this).find('option:selected');
        $.ajax({  
            url : "<?php echo base_url(ADMIN_URL.'/orders/get_product_option_data') ?>", 
            type:"POST",  
            data:{product_id:product_id,order_id:order_id,'<?=csrf_token();?>': csrfhash},  
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
        if(selectedOption)
        {
            var price = selectedOption.data('price');
        } 
        else
        {
            var price = parseFloat($('#base_product_price').val());
        }
        
        $('#price').val(price);
        $('#quantity').val(1);
    }
    </script>

<script>
    $(document).on('change', '.option-list-radio', function () {
        updateTotalPrice();
    });
    function updateTotalPrice() {
        var total_price = parseFloat($('#base_product_price').val());
        $('.option-list-radio:checked').each(function () {
            
            var addition_price = $(this).data('addprice');
            total_price += parseFloat(addition_price);
        });
        console.log(total_price);
            $('#price').val(total_price.toFixed(2));
        
        
        
    }
</script>