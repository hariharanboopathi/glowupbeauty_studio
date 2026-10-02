<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("add");?> <?=getlang("home_banners");?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url()?>/beheerpaneel/pages/manage_banners" class="btn btn-primary"><span><?=getlang("back_to_home_banner");?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url()?>/beheerpaneel/pages/manage_banners" class="btn btn-icon btn-primary"><?=getlang("back_to_home_banner");?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
					      <?php $uri = current_url(true);?> 
						
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
                        <?php //echo form_open_multipart();?>
						
						<?php echo form_open_multipart("beheerpaneel/pages/add_banner",array('id'=>'add_banner'))?>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('titel');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="banner_title" class="form-control" id="default-01" placeholder="<?=getlang("titel");?>" value="<?= old('banner_title', $previousInput['banner_title'] ?? ''); ?>" >    
                                </div>
                            </div>
							<div class="form-group">
                                <label class="form-label" for="default-05"><?=getlang("description");?></label>
                                <div class="form-control-wrap">
                                    <textarea name="bdesc" class="summernote-basic"><?= old('bdesc', $previousInput['bdesc'] ?? ''); ?></textarea>
                                </div>
                            </div>  
							<div class="form-group">
                                <label class="form-label"><?=getlang("image");?></label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" accept=".jpg,.png,.jpeg,.webp" name="bimage" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                    </div>
                                </div>
                            </div>
							

                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("url");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="burl" class="form-control" id="default-01" value="<?= old('burl', $previousInput['burl'] ?? ''); ?>" >    
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('korting');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="korting" class="form-control" id="default-01" placeholder="<?=getlang("korting");?>" value="<?= old('korting', $previousInput['korting'] ?? ''); ?>" >    
                                </div>
                            </div>


                            
                            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
						</form>
						
							<?php //echo form_close();?>
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
$("#add_banner").validate({ 
	rules: { 
        bdesc: {
            required: true,            
         },
         bimage: {
         	required: true,
         },
         burl: {
         	required: true,
         },
      },

});

</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>