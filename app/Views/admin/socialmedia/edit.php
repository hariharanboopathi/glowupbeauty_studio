<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('socialmedia');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/socialmedia/manage" class="btn btn-primary"><span><?=getlang('back');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/socialmedia/manage" class="btn btn-icon btn-primary"><span><?=getlang('back');?></a>
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
						

                        <?php echo form_open_multipart("beheerpaneel/socialmedia/edit/".$socialmedia_data[0]->id,array('id'=>'hometick_edit'));?>
						    
						<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('name');?></label>    
                                <div class="form-control-wrap">    
                                    <input type="text" name="name" class="form-control" id="default-01" placeholder="<?=getlang("name");?>" value="<?= $socialmedia_data[0]->name; ?>">    
                                </div>
                            </div>

                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('link');?></label>    
                                <div class="form-control-wrap">    
                                    <input type="text" name="link" class="form-control" id="default-01" placeholder="<?=getlang("link");?>" value="<?= $socialmedia_data[0]->link; ?>">    
                                </div>
                            </div>

							<div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="1"<?php if($socialmedia_data[0]->active == '1'){echo "checked";}?> name="active"  id="active" >
                                    <label class="custom-control-label" for="active"> <?=getlang("active");?></label>
                                </div>
                            </div>

							<div class="form-group">
                                <label class="form-label"><?=getlang("icon");?></label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" accept=".png,.jpg,.jpeg,.webp,.svg" name="icon" class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang('choose_file')?></label>
                                    </div>
                                </div>
                            </div>

							<?php if($socialmedia_data[0]->icon){?>
								<div class="form-group" style="background-color:#000">
                                            <img src="<?php echo image_url('uploads/socialmedia/'.$socialmedia_data[0]->icon)?>" height="200" width="200">
							</div>
                                        <?php }  else{?>
                                            <?php echo ""?>
                                        <?php } ?>
							
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
$("#socialmedia_edit").validate({ 
	rules: { 
        name: {
            required: true,            
        },
		link: {
            required: true,            
        },
		icon: {
			required: true, 
		}
    },

});

</script>