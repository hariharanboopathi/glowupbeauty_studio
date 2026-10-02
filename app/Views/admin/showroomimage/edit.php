<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('showroomimage');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/pages/showroomimagemanage" class="btn btn-primary"><span><?=getlang('back_to_showroomimages');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/pages/showroomimagemanage" class="btn btn-icon btn-primary"><span><?=getlang('back_to_showroomimages');?></a>
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
						

                        <?php echo form_open_multipart("beheerpaneel/pages/showroomimageedit/".$showroomimage[0]->id,array('id'=>'showroomimage_edit_form'));?>
						    
						    <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('alt');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="name" class="form-control" id="default-01" placeholder="<?=getlang('name');?>"  value="<?php echo $showroomimage[0]->name;?>" >    
                                </div>
                            </div>
                            

                            <div class="form-group">
                                <label class="form-label"><?=getlang("showroomimage");?></label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" accept=".png,.jpg,.jpeg,.webp" name="showroomimage" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                            <?php if($showroomimage[0]->showroomimage){?>
                                            <img src="<?php echo !empty($showroomimage[0]->showroomimage)?image_url('uploads/showroomimage/'.$showroomimage[0]->showroomimage):''; ?>" width="50%">
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
$("#showroomimage_edit_form").validate({ 
	rules: { 
        showroomimage: {
            required: true,            
        },
    },

});

</script>