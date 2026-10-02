 <!-- content @s -->
 <div class="nk-content nk-content-fluid lander_page_bk">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('add');?> <?=getlang('lander');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(ADMIN_URL); ?>/lander/lander_product_manage" class="btn btn-primary"><span><?=getlang('back_to_lander');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(ADMIN_URL); ?>/lander/lander_product_manage" class="btn btn-icon btn-primary"><?=getlang('back_to_lander');?></a>
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
						<!-- <form method="post" action="" id="pageform" enctype="multipart/form-data"> -->
                            <?php echo form_open_multipart(ADMIN_URL."/lander/lander_product_add",array('id'=>'lander_product_form'));?>
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1"><?=getlang('general')?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2"><?php echo getlang('media'); ?></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem1">
                                    
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang("titel");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="title" class="form-control" id="default-01" placeholder="<?=getlang("titel");?>" value="<?= old('title', $previousInput['title'] ?? ''); ?>" >    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang("Inhoud");?></label>    
                                        <div class="form-control-wrap">        
                                            
                                            <textarea name="content" class="summernote-basic"><?= old('content', $previousInput['content'] ?? ''); ?></textarea>   
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('Inhoud in knop');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="button_text" class="form-control" id="default-01" placeholder="<?=getlang("Inhoud in knop");?>" value="<?= old('button_text', $previousInput['button_text'] ?? ''); ?>" >    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('knop-URL');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="button_url" class="form-control" id="default-01" placeholder="<?=getlang("knop-URL");?>" value="<?= old('button_url', $previousInput['button_url'] ?? ''); ?>" >    
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabItem2">
                                    <div class="form-group">
                                        <label class="form-label"><?php echo getlang("image");?></label>
                                        <div class="form-control-wrap">
                                            <div class="form-file">
                                                <input type="file" name="image" accept=".png,.jpg,.jpeg,.webp" class="form-file-input" id="customMultipleFiles">
                                                <label class="form-file-label" for="customMultipleFiles"></label>
                                            </div>
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
$("#lander_product_form").validate({ 
	rules: { 
        title: {
            required: true,            
        },
        // image: {
        //     required: true,            
        // },
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