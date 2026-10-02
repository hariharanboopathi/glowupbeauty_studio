<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('brand');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/brand/manage" class="btn btn-primary"><span><?=getlang('back_to_brand');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/brand/manage" class="btn btn-icon btn-primary"><span><?=getlang('back_to_brand');?></a>
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
						

                        <?php echo form_open_multipart("beheerpaneel/brand/edit/".$brands[0]->id,array('id'=>'brand_edit_form'));?>
						    
						    <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('name');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="name" class="form-control" id="default-01" placeholder="<?=getlang('name');?>"  value="<?php echo $brands[0]->name;?>" >    
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-02"><?=getlang("brand_url");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="b_url"  class="form-control" id="default-02" placeholder="<?=getlang("brand_url");?>" value="<?php echo $brands[0]->b_url;?>">    
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label"><?=getlang("image");?></label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" name="brand_image" accept=".jpg,.png,.jpeg,.webp" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                            <?php if($brands[0]->brand_image){?>
                                            <img src="<?php echo !empty($brands[0]->brand_image)?image_url('uploads/brand/'.$brands[0]->brand_image):''; ?>" width="50%">
                                        <?php }  else{?>
                                            <?php echo ""?>
                                        <?php } ?>
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
$("#brand_edit_form").validate({ 
	rules: { 
        name: {
            required: true,            
        },
    },

});

</script>