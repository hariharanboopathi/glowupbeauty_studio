<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="nk-block">
                <div class="card">
                    <div class="card-aside-wrap">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title"><?=getlang('Page_caching')?></h3>
                                        <div class="nk-block-des text-soft">
                                        
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <!-- <div class="nk-block-head-content">
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
                                        </div>
                                    </div> -->

                                    
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card card-preview">
                                    <div class="card-inner card-inner-xl">
                                        <?php echo form_open_multipart("beheerpaneel/settings/cache",array('id'=>'settingscache'));?>

                                    
                                        <?php if($cache_status){ ?>

                                        <div class="col-md-3 col-sm-6">
                                            <div class="preview-block">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" value="1" name="cache_status" class="custom-control-input" <?php if($cache_status[0]->value == '1'){ ?> checked <?php } ?> id="customSwitch2">
                                                    <label class="custom-control-label" for="customSwitch2">Enable page caching</label>
                                                </div>
                                            </div>
                                        </div>

                                        <?php } ?>

                                        </br></br>
                                                            
                                        <?php if($cache_time){ ?>
                                        <div class="form-group">    
                                            <label class="form-label" for="default-01"><?=getlang('cache_life_time (in seconds) ');?></label>    
                                            <div class="form-control-wrap">        
                                                <input type="text" name="cache_time" class="form-control" id="default-01" placeholder="<?=getlang("cache_time");?>"  value="<?php echo $cache_time[0]->value; ?>" >
                                            </div>
                                        </div>
                                
                                        <p>Time after which a cached version is created again</p>    
                                        <?php } ?>

                                        <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
                                
                                        </form>
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

<script>
$("#settingscache").validate({ 
	rules: { 
        cache_time: {
            required: true,            
        }
		


    },

});

  </script>


</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>
