<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('redirect_urls');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/settings/redirects_manage" class="btn btn-primary"><span><?=getlang('back_to_redirect_urls');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/settings/redirects_manage" class="btn btn-icon btn-primary"><span><?=getlang('back_to_redirect_urls');?></a>
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
						

                        <?php echo form_open("beheerpaneel/settings/edit_redirect/".$redirectsurl[0]->id,array('id'=>'redirecturlsform'));?>
						    
						    <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('old_url');?>
                                
                            </label>  
                            <br>
                            <p><span><?=getlang('note')?>: <?=getlang("Give_url_in_follow_format_'/voorbeeld_url'");?></span></p>  
                                <div class="form-control-wrap">        
                                <span><?=base_url();?></span><input type="text" name="old_url" class="form-control" id="default-01" placeholder="<?=getlang('old_url');?>"  value="<?php echo $redirectsurl[0]->old_url;?>" >    
                                </div>
                            </div>
						    <div class="form-group">    
                                <label class="form-label" for="default-new_url"><?=getlang('new_url');?>
                                
                            </label>
                            <br>    
                            <p><span><?=getlang('note')?>: <?=getlang("Give_url_in_follow_format_'/voorbeeld_url'");?></span></p>
                                <div class="form-control-wrap">        
                                <span><?=base_url();?></span><input type="text" name="new_url" class="form-control" id="default-new_url" placeholder="<?=getlang('new_url');?>"  value="<?php echo $redirectsurl[0]->new_url;?>" >    
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
$("#redirecturlsform").validate({ 
	rules: { 
        old_url: {
            required: true,            
        },
        new_url: {
         	required: true,
        },
        
    },

});

</script>