<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('Login_page_content')?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                            
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
					      <?php $uri = current_url(true);?> 
						
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
                        <?php echo form_open_multipart("beheerpaneel/settings/loginpageimage",array('id'=>'loginlogoform'));?>

                            <div class="form-group">
                                <label class="form-label" for="default-05"><?=getlang("content");?></label>
                                <div class="form-control-wrap">
                                    <textarea name="login_text" class="summernote-basic"><?php if(!empty($login_text)){ echo $login_text[0]->value;}?></textarea>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="form-label"><?=getlang("image");?></label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" accept=".png,.jpg,.jpeg,.webp" name="loginlogo" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang('choose_file')?></label>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                            <?php if($setting_data[0]->value){?>
                                            <img src="<?php echo !empty($setting_data[0]->value)?image_url('uploads/logo/'.$setting_data[0]->value):''; ?>" width="50%" >
                                        <?php }  else{?>
                                            <?php echo ""?>
                                        <?php } ?>
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
$("#loginlogoform").validate({ 
	rules: { 
        logo: {
            required: true,            
        },
    },

});

</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>