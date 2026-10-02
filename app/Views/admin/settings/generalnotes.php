<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="nk-block">
                <div class="card">
                    <div class="card-aside-wrap">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <h3 class="nk-block-title page-title"><?=getlang('General_Notes')?></h3>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card card-preview">
                                    <div class="card-inner card-inner-xl">
                                            <div class="sitemap button_div">
                                                <a href="<?php echo base_url('cron/sitemap');?>"> <?=getlang('Regenerate_XML_sitemap')?></a>
                                                <a href="<?php echo image_url('sitemap.xml');?>" download>  <?=getlang('Download_XML_sitemap')?></a>
                                            </div>

                                            <div class="googlefeed button_div">
                                                <a href="<?php echo base_url('cron/productfeed');?>"> <?=getlang('Regenerate_Google_shopping_feed')?></a>
                                                <a href="<?php echo image_url('product-feed.xml');?>" download>  <?=getlang('Download_XML_shopping')?></a>
                                            </div>
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




</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>
