<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Vacatures content</h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <!-- <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/pages/manage" class="btn btn-primary"><span>Manage Pages</span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="#" class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
						<?php echo form_open_multipart("beheerpaneel/pages/vacaturescontent",array('id'=>'vacaturescontent'))?>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=lang("general.content");?> 1</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_1" class="summernote-basic"><?php echo $vacaturescontent[0]->content_1;?></textarea>   
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=lang("general.content");?> 2</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_2" class="summernote-basic"><?php echo $vacaturescontent[0]->content_2;?></textarea>   
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=lang("general.content");?> 3</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_3" class="summernote-basic"><?php echo $vacaturescontent[0]->content_3;?></textarea>   
                                </div>
                            </div>

							<div class="form-group">
                                <label class="form-label"><?=lang("general.image");?> 1</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" accept=".png,.jpg,.jpeg,.webp" name="image_1" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles">Choose files</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($vacaturescontent[0]->image_1){?>
                                    <img src="<?php echo !empty($vacaturescontent[0]->image_1)?image_url('uploads/vacaturescontent/'.$vacaturescontent[0]->image_1):''; ?>" width="50%">
                                <?php }  else{?>
                                    <?php echo ""?>
                                <?php } ?>

                            </div>
                            
                            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=lang("general.submit");?></button></div>
							</form>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div><!-- .content-page -->
        </div>
    </div>
</div>
<!-- content @e --><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>