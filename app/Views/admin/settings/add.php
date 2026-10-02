<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('add');?> <?=getlang('Generalsettings_Info')?></h3>
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
						<?php echo form_open_multipart('beheerpaneel/settings/add/',array('id'=>'settingsform'));?>
						    
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('naam');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="name" class="form-control" id="default-01" placeholder="<?=getlang("naam");?>"  value="">    
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('code');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="code" class="form-control" id="default-01" placeholder="<?=getlang("code");?>"  value="" >    
                                </div>
                            </div>
						    <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('content');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="value" class="form-control" id="default-01" placeholder="<?=getlang("content");?>"  value="">    
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