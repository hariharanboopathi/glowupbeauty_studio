<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="nk-block">
                <div class="card">
                    <div class="card-aside-wrap">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <h3 class="nk-block-title page-title"><?=getlang('logo')?></h3>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card">
                                    <div class="card-inner card-inner-xl">
                                        <?php echo form_open_multipart("beheerpaneel/settings/logo",array('id'=>'logoform'));?>

                                        <div class="form-group">
                                            <label class="form-label"><?=getlang("image");?></label>
                                            <div class="form-control-wrap">
                                                <div class="form-file">
                                                    <input type="file" accept=".png,.jpg,.jpeg,.webp,.svg" name="logo" multiple class="form-file-input" id="customMultipleFiles">
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

                                        <div class="form-group">
                                            <label class="form-label"><?=getlang("image");?></label>
                                            <div class="form-control-wrap">
                                                <div class="form-file">
                                                    <input type="file" accept=".png,.jpg,.jpeg,.webp,.svg" name="slogo" multiple class="form-file-input" id="customMultipleFiles">
                                                    <label class="form-file-label" for="customMultipleFiles"><?=getlang('choose_file')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <?php if($sticky_data[0]->value){?>
                                                        <img src="<?php echo !empty($sticky_data[0]->value)?image_url('uploads/logo/'.$sticky_data[0]->value):''; ?>" width="50%" >
                                                    <?php }  else{?>
                                                        <?php echo ""?>
                                                    <?php } ?>
                                        </div>


                                        <div class="form-group">
                                            <label class="form-label"><?=getlang("admin_mobile_view_logo");?></label>
                                            <div class="form-control-wrap">
                                                <div class="form-file">
                                                    <input type="file" accept=".png,.jpg,.jpeg,.webp,.svg" name="amvlogo" multiple class="form-file-input" id="customMultipleFiles">
                                                    <label class="form-file-label" for="customMultipleFiles"><?=getlang('choose_file')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <?php if($amvlogo_data[0]->value){?>
                                                        <img src="<?php echo !empty($amvlogo_data[0]->value)?image_url('uploads/logo/'.$amvlogo_data[0]->value):''; ?>" width="50%" >
                                                    <?php }  else{?>
                                                        <?php echo ""?>
                                                    <?php } ?>
                                        </div>



                                        <div class="form-group">
                                            <label class="form-label"><?=getlang("admin_login_banner");?></label>
                                            <div class="form-control-wrap">
                                                <div class="form-file">
                                                    <input type="file" accept=".png,.jpg,.jpeg,.webp,.svg" name="albanner" multiple class="form-file-input" id="customMultipleFiles">
                                                    <label class="form-file-label" for="customMultipleFiles"><?=getlang('choose_file')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        <?php if($adminlbanner_data[0]->value){?>
                                            <img src="<?php echo !empty($adminlbanner_data[0]->value)?image_url('uploads/logo/'.$adminlbanner_data[0]->value):''; ?>" width="50%" >
                                        <?php }  else{?>
                                            <?php echo ""?>
                                        <?php } ?>
                                        </div>

                                        
                                        


                                        <!-- <div class="form-group">
                                                            
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" value="1" name="enable_captcha"  <?php if($enable_captcha[0]->value){ ?> checked="checked" <?php } ?> id="fv-com-email" >
                                                    <label class="custom-control-label" for="fv-com-email"><?=getlang("enable_captcha");?></label>
                                            </div>
                                        </div> -->


                                        
                                    
                                        <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
                                        </form>
                                        <?php //echo form_close();?>
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                        </div><!-- .card-inner -->
                        <?php echo view('beheerpaneel/settings/settingstableftmenu');?>
                    </div><!-- .card-aside-wrap -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>
</div>

<?php echo minifier('adminvalidate.min.js'); ?>

