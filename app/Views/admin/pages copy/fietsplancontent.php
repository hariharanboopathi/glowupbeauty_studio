<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("fietsplan_content");?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
						<?php echo form_open_multipart("beheerpaneel/pages/fietsplancontent",array('id'=>'fietsplancontent'))?>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 1</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_1" class="summernote-basic"><?php echo $fietsplancontent[0]->content_1;?></textarea>   
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 2</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_2" class="summernote-basic"><?php echo $fietsplancontent[0]->content_2;?></textarea>   
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 3</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_3" class="summernote-basic"><?php echo $fietsplancontent[0]->content_3;?></textarea>   
                                </div>
                            </div>
							<div class="form-group">
                                <label class="form-label"><?=getlang("image");?> 1</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" name="image_1" accept=".png,.jpg,.jpeg,.webp" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                            <?php if($fietsplancontent[0]->image_1){?>
                                            <img src="<?php echo !empty($fietsplancontent[0]->image_1)?image_url('uploads/fietsplancontent/'.$fietsplancontent[0]->image_1):''; ?>" width="50%">
                                        <?php }  else{?>
                                            <?php echo ""?>
                                        <?php } ?>
							</div>

							<div class="form-group">
                                <label class="form-label"><?=getlang("image");?> 2</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" name="image_2" accept=".png,.jpg,.jpeg,.webp" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                            <?php if($fietsplancontent[0]->image_2){?>
                                            <img src="<?php echo !empty($fietsplancontent[0]->image_2)?image_url('uploads/fietsplancontent/'.$fietsplancontent[0]->image_2):''; ?>" width="50%">
                                        <?php }  else{?>
                                            <?php echo ""?>
                                        <?php } ?>
							</div>

							<div class="form-group">
                                <label class="form-label"><?=getlang("image");?> 3</label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" name="image_3" accept=".png,.jpg,.jpeg,.webp" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                            <?php if($fietsplancontent[0]->image_3){?>
                                            <img src="<?php echo !empty($fietsplancontent[0]->image_3)?image_url('uploads/fietsplancontent/'.$fietsplancontent[0]->image_3):''; ?>" width="50%">
                                        <?php }  else{?>
                                            <?php echo ""?>
                                        <?php } ?>
							</div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 4</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_4" class="summernote-basic"><?php echo $fietsplancontent[0]->content_4;?></textarea>   
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
<!-- content @e --><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>