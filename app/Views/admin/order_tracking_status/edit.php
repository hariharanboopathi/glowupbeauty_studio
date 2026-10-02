<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('order_tracking_status');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(ADMIN_URL); ?>/ordertrackingstatus/manage" class="btn btn-primary"><span><?=getlang('back_to_order_tracking_status');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(ADMIN_URL); ?>/ordertrackingstatus/manage" class="btn btn-icon btn-primary"><span><?=getlang('back_to_order_tracking_status');?></a>
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
						

                        <?php echo form_open_multipart(ADMIN_URL."/ordertrackingstatus/edit/".$order_tracking_status[0]->id,array('id'=>'order_tracking_status_form'));?>
						    
						    <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('content');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="content" class="form-control" id="default-01" placeholder="<?=getlang('content');?>"  value="<?php echo $order_tracking_status[0]->content;?>" >    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label"><?=getlang("image");?></label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" name="image" accept=".jpg,.png,.jpeg,.webp,.svg" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                            <?php if($order_tracking_status[0]->image){?>
                                            <img src="<?php echo !empty($order_tracking_status[0]->image)?image_url('uploads/order_tracking_status/'.$order_tracking_status[0]->image):''; ?>" width="50%">
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
$("#order_tracking_status_form").validate({ 
	rules: { 
        content: {
            required: true,            
        },
    },

});

</script>