<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('Generalsettings_Info')?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/settings/manage" class="btn btn-primary"><span><?=getlang('back_to_Generalsettings_Info')?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/settings/manage" class="btn btn-icon btn-primary"><?=getlang('back_to_Generalsettings_Info')?></a>
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
						<?php echo form_open_multipart('beheerpaneel/settings/edit/'.$general_settings[0]->id,array('id'=>'settingsform'));?>
						    
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('naam');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="name" class="form-control" id="default-01" placeholder="<?=getlang("naam");?>"  value="<?php echo $general_settings[0]->name;?>">    
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('code');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="code" class="form-control" id="default-01" placeholder="<?=getlang("code");?>"  value="<?php echo $general_settings[0]->code;?>" readonly>    
                                </div>
                            </div>
                            <?php if($general_settings[0]->type == 'text'){?>
                                <input type="hidden" name="type" value="text">
						    <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('content');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="value" class="form-control" id="default-01" placeholder="<?=getlang("content");?>"  value="<?php echo $general_settings[0]->value;?>">    
                                </div>
                            </div>
                            <?php } elseif($general_settings[0]->type =='textarea'){?>
                                <input type="hidden" name="type" value="textarea">
                                <div class="form-group">
                                    <label class="form-label" for="default-06"><?=getlang('content');?></label>
                                    <div class="form-control-wrap">
                                        <textarea name="value" class="summernote-basic"><?php echo $general_settings[0]->value;?></textarea>
                                    </div>
                                </div>
                                <?php } elseif($general_settings[0]->type == 'checkbox'){?>
                                    <input type="hidden" name="type" value="checkbox">
                                        <div class="form-group">
                                                
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" value="1" name="value"  <?php if($general_settings[0]->value){ ?> checked="checked" <?php } ?> id="fv-com-email" >
                                                    <label class="custom-control-label" for="fv-com-email"><?=getlang("enable");?></label>
                                            </div>
                                        </div>
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
$("#settingsform").validate({ 
	rules: { 
        name: {
            required: true,            
        },
        code: {
            required: true,            
        },
        contents: {
            required: true,            
        },
		// status: {
        //     required: true,            
        // },



    },

});
</script>
<?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>