<!-- content @s -->
<div class="nk-content nk-content-fluid lander_header_page_bk">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('lander_header');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/lander_header/manage" class="btn btn-primary"><span><?=getlang('back_to_lander_header');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/lander_header/manage" class="btn btn-icon btn-primary"><span><?=getlang('back_to_lander_header');?></a>
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
						

                        <?php echo form_open_multipart("beheerpaneel/lander_header/edit/".$lander_header[0]->id,array('id'=>'lander_header_edit_form'));?>
						    
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1"><?=getlang('general')?></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem1">
                                    
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang("name");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="name" class="form-control" id="default-01" placeholder="<?=getlang("name");?>" value="<?php echo $lander_header[0]->name;?>" >    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('url');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="url" class="form-control" id="default-01" placeholder="<?=getlang("url");?>" value="<?php echo $lander_header[0]->url;?>" >    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('sort');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="sort" class="form-control" id="default-01" placeholder="<?=getlang("sort");?>" value="<?php echo $lander_header[0]->sort;?>" >    
                                        </div>
                                    </div>
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
$("#lander_header_edit_form").validate({ 
	rules: { 
        name: {
            required: true,            
        },
        sub_name: {
            required: true,            
        },
        lander_header: {
            required: true,            
        },
        
    },

});

</script>


<!-- Include rateYo library -->

<link rel="stylesheet" href="<?php echo base_url('assets/admin_new');?>/plugins/lightbox/css/baguetteBox.min.css">

<!-- Include rateYo library -->

<script src="<?php echo base_url('assets/admin_new');?>/plugins/lightbox/js/baguetteBox.min.js"></script>



<?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?><script>
$(document).ready(function() {
    let summernoteOptions = {
        height: 300
    }
  $('.summernote-basic').summernote(summernoteOptions);
});
</script>