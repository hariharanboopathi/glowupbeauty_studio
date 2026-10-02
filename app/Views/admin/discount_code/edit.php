<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('Discount_Code');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/discountcode/manage" class="btn btn-primary"><span><?=getlang('back_to_discountcodes');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/discountcode/manage" class="btn btn-icon btn-primary"><span><?=getlang('back_to_discountcodes');?></a>
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
						

                        <?php echo form_open("beheerpaneel/discountcode/edit/".$discountcode[0]->id,array('id'=>'languagecontentform'));?>
						    
						    <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('code');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="code" class="form-control" id="default-01" placeholder="<?=getlang('code');?>"  value="<?php echo $discountcode[0]->code;?>" >    
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-02"><?=getlang("Discount_Type");?></label> 

                                <div class="custom-control custom-radio radion_btn" >    
                                        <input type="radio" id="customRadio1" name="type" value="percentage" <?php if($discountcode[0]->type == 'percentage'){ echo 'checked';}?> class="custom-control-input">    
                                        <label class="custom-control-label" for="customRadio1"><?=getlang('Percentage')?></label>
                                    </div> 
                                    <div class="custom-control custom-radio radion_btn" >    
                                        <input type="radio" id="customRadio2" name="type" <?php if($discountcode[0]->type == 'amount'){ echo 'checked';}?> value="amount" class="custom-control-input">    
                                        <label class="custom-control-label" for="customRadio2"><?=getlang('Amount')?></label>
                                    </div>
                            </div>

                            <div class="form-group">    
                                <label class="form-label"><?=getlang('Discountcode_Valid_Date')?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" class="form-control date-picker" name="valid_date" placeholder="<?=getlang("Discountcode_Valid_Date");?>" value="<?php echo $discountcode[0]->valid_date;?>">    
                                    </div>    
                                    <div class="form-note"><?=getlang('Date_format');?> <code>mm/dd/yyyy</code></div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label"><?=getlang('Discount_Amount')?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" class="form-control" name="amount" placeholder="<?=getlang("Discount_Amount");?>" value="<?php echo $discountcode[0]->amount;?>">    
                                    </div>    
                            </div>

                            <div class="form-group">    
                                <label class="form-label"><?=getlang('Discount_Count')?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" class="form-control" name="count" placeholder="<?=getlang("Discount_Count");?>" value="<?php echo $discountcode[0]->count;?>">    
                                    </div>    
                            </div>
							
							<div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
							</form>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div><!-- .content-page -->
        </div>
    </div>
</div>
<!-- content @e -->


<?php echo minifier('adminvalidate.min.js'); ?>

<script>
$("#languagecontentform").validate({ 
	rules: { 
        keyword: {
            required: true,            
        },
        type: {
         	required: true,
        },
        valid_date:
        {
            required: true, 
        },
        amount:
        {
            required: true, 
        }
    },

});

</script>