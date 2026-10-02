<?php //echo form_open_multipart(ADMIN_URL.'/orders/save_client_info/'.$order_data->id,array('id'=>'order_editclientinfoform'));?>
<input type="hidden" name="order_id" id="order_id" value="<?=$order_id;?>"> 
<div class="row">

    <div class="form-group col-6">   
        <label class="form-label" name="voornaam" for="fva-Product_name"><?=getlang('voornaam');?></label>  
        <div class="form-control-wrap">
            <input type="text" name="voornaam"  class="form-control" id="voornaam" value="<?php echo !empty($order_data) ? $order_data->voornaam : ''; ?>" required>    
        </div>
    </div>
    
    <div class="form-group col-6">
        <label class="form-label" for="default-05"><?=getlang("achternaam");?></label>
        <div class="form-control-wrap">
        <input type="text" name="achternaam"  class="form-control" id="achternaam" value="<?php echo !empty($order_data) ? $order_data->achternaam : ''; ?>" required>    
        </div>
    </div>
</div>
<div class="row">

    <div class="form-group col-6">
        <label class="form-label" for="default-05"><?=getlang("telefoon");?></label>
        <div class="form-control-wrap">
        <input type="text" name="telefoon"  class="form-control" id="telefoon" value="<?php echo !empty($order_data) ? $order_data->telefoon : ''; ?>" required>    
        </div>
    </div>
    <div class="form-group col-6">
        <label class="form-label" for="default-05"><?=getlang("email");?></label>
        <div class="form-control-wrap">
        <input type="text" name="email"  class="form-control" id="email" value="<?php echo !empty($order_data) ? $order_data->email : ''; ?>" required>    
        </div>
    </div>
</div>
<div class="form-group">
    <label class="form-label" for="default-05"><?=getlang("Land");?></label>
    <div class="form-control-wrap">
    <select name="land_ragio" id="land_ragio"  class="form-select">
        <?php if(!empty($country)){ foreach($country as $c){?>
            <option value="<?=$c->id;?>" <?php if(!empty($order_data) && $order_data->country_code == $c->id){
                echo "selected";
            } ?>><?=$c->name;?></option>
        <?php } }?>
    </select>  
    </div>
</div>
<div class="row dft_add">

    <div class="form-group col-4">
        <label class="form-label pcod" for="default-05"><?=getlang("postcode");?></label>
        <div class="form-control-wrap">
        <input type="text" name="postcode"  class="pst form-control" id="pst" value="<?php echo !empty($order_data) ? $order_data->postcode : ''; ?>" required>    
        </div>
    </div>
    <div class="form-group col-4">
        <label class="form-label num" for="default-05"><?=getlang("hno");?></label>
        <div class="form-control-wrap">
        <input type="text" name="hno"  class="hmb form-control" id="hmb" value="<?php echo !empty($order_data) ? $order_data->hno : ''; ?>" required>    
        </div>
    </div>
    <div class="form-group col-4 lthi">
        <label class="form-label" for="default-05"><?=getlang("toev");?></label>
        <div class="form-control-wrap">
        <input type="text" name="toev"  class="addition form-control" id="addition" value="<?php echo !empty($order_data) ? $order_data->toev : ''; ?>" >    
        </div>
    </div>
</div>
<div class="row">

    <div class="form-group col-6">
        <label class="form-label" for="default-05"><strong id="ship_street_name_label"><?=getlang("straat");?></strong></label>
        <div class="form-control-wrap">
        <input type="text" name="straat"  class="form-control" id="street" value="<?php echo !empty($order_data) ? $order_data->straat : ''; ?>" required>    
        </div>
    </div>
    <div class="form-group col-6">
        <label class="form-label" for="default-05"><?=getlang("plaats");?></label>
        <div class="form-control-wrap">
        <input type="text" name="plaats"  class="form-control" id="plaats" value="<?php echo !empty($order_data) ? $order_data->plaats : ''; ?>" required>    
        </div>
    </div>
</div>
<input type="hidden" id="city" name="city" value="">
<input type="hidden" id="address" name="adres" value="" >
<div class="form-check">
    <label>
        <input class="form-check-input" type="checkbox" value="<?php echo !empty($order_data) ? $order_data->diff_ship : 0; ?>" id="diff_ship" name="diff_ship">
        <strong><?=getlang('Klant heeft een ander adres geselecteerd om zijn bestelling te verzenden');?></strong>
    </label>
</div>
<div class="check-opn-items diff_shiping" style="display:none;">

    <!-- Shipping details -->
    <label class="form-label" for="default-05"><?=getlang("shipped_to_a_different_address");?></label>
    <div class="row">
    
        <div class="form-group col-6">   
            <label class="form-label" name="voornaam" for="fva-Product_name"><?=getlang('voornaam');?></label>  
            <div class="form-control-wrap">
                <input type="text" name="ship_voornaam"  class="form-control" id="ship_voornaam" value="<?php echo !empty($order_data) ? $order_data->ship_voornaam : ''; ?>" >    
            </div>
        </div>
        
        <div class="form-group col-6">
            <label class="form-label" for="default-05"><?=getlang("achternaam");?></label>
            <div class="form-control-wrap">
            <input type="text" name="ship_achternaam"  class="form-control" id="ship_achternaam" value="<?php echo !empty($order_data) ? $order_data->ship_achternaam : ''; ?>" >    
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="default-05"><?=getlang("Land");?></label>
        <div class="form-control-wrap">
        <select name="ship_land_ragio" id="ship_land_ragio"  class="form-select">
            <?php if(!empty($country)){ foreach($country as $c){?>
                <option value="<?=$c->id;?>" <?php if(!empty($order_data) && $order_data->ship_country_code == $c->id){
                echo "selected";
            } ?>><?=$c->name;?></option>
            <?php } }?>
        </select>  
        </div>
    </div>
    <div class="row">
    
        <div class="form-group col-4">
            <label class="form-label pcod" for="default-05"><?=getlang("postcode");?></label>
            <div class="form-control-wrap">
            <input type="text" name="ship_postcode"  class="ship_pst form-control" id="ship_pst" value="<?php echo !empty($order_data) ? $order_data->ship_postcode : ''; ?>" >    
            </div>
        </div>
        <div class="form-group col-4">
            <label class="form-label num" for="default-05"><?=getlang("hno");?></label>
            <div class="form-control-wrap">
            <input type="text" name="ship_hno"  class="ship_hmb form-control" id="ship_hmb" value="<?php echo !empty($order_data) ? $order_data->ship_hno : ''; ?>" >    
            </div>
        </div>
        <div class="form-group col-4 lthi">
            <label class="form-label" for="default-05"><?=getlang("toev");?></label>
            <div class="form-control-wrap">
            <input type="text" name="ship_toev"  class="ship_addition form-control" id="ship_addition" value="<?php echo !empty($order_data) ? $order_data->ship_toev : ''; ?>" >    
            </div>
        </div>
    </div>
    <div class="row">
    
        <div class="form-group col-6">
            <label class="form-label" for="default-05"><?=getlang("straat");?></label>
            <div class="form-control-wrap">
            <input type="text" name="ship_straat"  class="form-control" id="ship_street" value="<?php echo !empty($order_data) ? $order_data->ship_straat : ''; ?>" >    
            </div>
        </div>
        <div class="form-group col-6">
            <label class="form-label" for="default-05"><?=getlang("plaats");?></label>
            <div class="form-control-wrap">
            <input type="text" name="ship_plaats"  class="form-control" id="ship_plaats" value="<?php echo !empty($order_data) ? $order_data->ship_plaats : ''; ?>" >    
            </div>
        </div>
    </div>
    <input type="hidden" id="ship_city" name="ship_city" value="" > 
    <input type="hidden" id="ship_address" name="ship_adres" value="">
</div>
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
<script type="text/javascript">
    $(document).ready(function(){
        if(($('#diff_ship').val() == 1) && $('#ship_pst').val() != ''){
            $('#diff_ship').prop('checked',true);
            $('.diff_shiping').show();
        }
        $.getlookupb=function(){  
            if($('.pst').val()!='' && $('.hmb').val()!=''){
                var csrfName = '<?= csrf_token() ?>';
                var csrfHash = '<?= csrf_hash() ?>';
                $('.pst').val($('.pst').val().replace(/\s/g,''));
                $('.result').html('<a href="#">Uw adresgegevens ophalen...</a>');
                $.post('<?php echo base_url().'beheerpaneel/orders/postcodecheck'; ?>',{ post_code: $('.pst').val() , home_no: $('.hmb').val()},  function(data) {
                    //alert(data);
                    var result = new Array;
                    result=JSON.parse(data);
                    if(result['exception']){
                        // alert(result['exception']);
                        if(result['exception'] == 'Combination does not exist.')
                        {
                            resultfin = '<?=getlang('post_code_combination_error')?>';
                        }else{
                            resultfin = result['exception'].replace("is not a valid postcode.", "is geen geldige postcode.");
                        }
                        $('.result').html('<p style="color:red">'+resultfin+'</p>');
                        }else{
                        var street = result['street'];
                        var city = result['city'];
                        var province = result['province'];
                        var houseNumber = result['houseNumber'];
                        var postcode = result['postcode'];
                        $('.result').html('');
                        $('#address').val(street+','+houseNumber+''+$('#addition').val()+'\n'+city+'\n'+province+'\n');
                        $('#plaats').val(city);
                        $('#street').val(street);
                        $('#city').val(province);
                        $('#address').attr('readonly', true);
                    }
                });
                } else {
                $('#address').attr('readonly', false);
                $('#address').val('');
                $('#plaats').val('');
            }
        }

        $.getlookupb1=function(){  
            if($('.ship_pst').val()!='' && $('.ship_hmb').val()!=''){
                var csrfName = '<?= csrf_token() ?>';
                var csrfHash = '<?= csrf_hash() ?>';
                $('.ship_pst').val($('.ship_pst').val().replace(/\s/g,''));
                $('.ship_result').html('<a href="#">Uw adresgegevens ophalen...</a>');
                $.post('<?php echo base_url().'beheerpaneel/orders/postcodecheck'; ?>',{ post_code: $('.ship_pst').val() , home_no: $('.ship_hmb').val()},  function(data) {
                    //alert(data);
                    var result = new Array;
                    result=JSON.parse(data);
                    if(result['exception']){
                        // alert(result['exception']);
                        if(result['exception'] == 'Combination does not exist.')
                        {
                            resultfin = '<?=getlang('post_code_combination_error')?>';
                        }else{
                            resultfin = result['exception'].replace("is not a valid postcode.", "is geen geldige postcode.");
                        }
                        $('.ship_result').html('<p style="color:red">'+resultfin+'</p>');
                        }else{
                        var street = result['street'];
                        var city = result['city'];
                        var province = result['province'];
                        var houseNumber = result['houseNumber'];
                        var postcode = result['postcode'];
                        $('.ship_result').html('');
                        $('#ship_address').val(street+','+houseNumber+''+$('#ship_addition').val()+'\n'+city+'\n'+province+'\n');
                        $('#ship_plaats').val(city);
                        $('#ship_street').val(street);
                        $('#ship_city').val(province);
                        $('#ship_address').attr('readonly', true);
                    }
                });
                } else {
                $('#ship_address').attr('readonly', false);
                $('#ship_address').val('');
                $('#ship_plaats').val('');
            }
        }
        //$(".hmb , .pst, .addition").live("change" , function() {
        $(".hmb , .pst, .addition").on("change" , function() {
          $.getlookupb();
        });

        $(".ship_hmb , .ship_pst, .ship_addition").on("change" , function() {
            $.getlookupb1();
        });


        $("#land_ragio").on("change" , function() {
          if($(this).val() != '1'){
            $('.dft_add .lthi').hide();
          } else {
            $('.dft_add .lthi').show();

          }
        });


        $("#ship_land_ragio").on("change" , function() {
          if($(this).val() != '1'){
            $('.diff_shiping .lthi').hide();
          } else {
            $('.diff_shiping .lthi').show();
          }
        });
        $('#diff_ship').on('change', function() {
            if ($(this).is(':checked')) {
                $('.diff_shiping').show();
                $(this).val(1);
            } else {
                $('.diff_shiping').hide();
                $(this).val(0);

            }
        });
        

    });
</script>
<?php if(!empty($order_data) && $order_data->country_code != 1){ ?>
    <script>
        $(document).ready(function(){
            $('.dft_add .lthi').hide();
        });    
    </script>
<?php } ?>
<?php if(!empty($order_data) && $order_data->country_code != 1){ ?>
    <script>
        $(document).ready(function(){
            $('.diff_shiping .lthi').hide();
        });    
    </script>
<?php } ?>