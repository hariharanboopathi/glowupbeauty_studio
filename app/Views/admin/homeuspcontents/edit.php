<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('Home_Ups_Contents')?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/homeuspcontents/manage" class="btn btn-primary"><span><?=getlang('back_to_Home_Ups_Contents')?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/homeuspcontents/manage" class="btn btn-icon btn-primary"><?=getlang('back_to_Home_Ups_Contents')?></a>
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
						<?php echo form_open_multipart('beheerpaneel/homeuspcontents/edit/'.$homeuspcontents[0]->id,array('id'=>'homeuspcontentsform'));?>
						    
						    <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('content');?></label>    
                                <div class="form-control-wrap">  
                                <input type="text" name="contents" class="form-control" id="default-01" placeholder="<?=getlang("subcontent");?>" value="<?php echo $homeuspcontents[0]->contents;?>">
                                    
                                </div>
                            </div>
                            
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('subcontent');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="subcontents" class="form-control" id="default-01" placeholder="<?=getlang("subcontent");?>" value="<?php echo $homeuspcontents[0]->subcontents;?>">    
                                </div>
                            </div>

                            <div class="form-group">
                                                
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="1" name="status" <?php if($homeuspcontents[0]->status == '1'){echo "checked";}?> id="fv-com-email" >
                                        <label class="custom-control-label" for="fv-com-email"><?=getlang("hide");?></label>
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
$("#homeuspcontentsform").validate({ 
	rules: { 
        contents: {
            required: true,            
        },
		// status: {
        //     required: true,            
        // },



    },

});