 <!-- content @s -->
 <div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('adminmenu');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(ADMIN_URL); ?>/admin_menu/menu_settings" class="btn btn-primary"><span><?=getlang('adminmenu');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(ADMIN_URL); ?>/admin_menu/menu_settings" class="btn btn-icon btn-primary"><?=getlang('adminmenu');?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card menu_form">
                        <div class="card-inner card-inner-xl">
						<!-- <form method="post" action="" id="pageform" enctype="multipart/form-data"> -->
                            <?php echo form_open_multipart(ADMIN_URL."/admin_menu/edit/".$adminmenu->id,array('id'=>'adminmenu_form'));?>
						    <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('name');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="name" class="form-control" id="default-01" placeholder="<?=getlang("name");?>" value="<?=$adminmenu->name;?>" >    
                                </div>
                            </div>

                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("url");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="url" class="form-control" id="default-01" placeholder="<?=getlang("url");?>" value="<?=$adminmenu->url;?>" >    
                                </div>
                            </div>

                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('meta_title');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="meta_title" class="form-control" id="default-01" placeholder="<?=getlang("meta_title");?>" value="<?=$adminmenu->meta_title;?>" >    
                                </div>
                            </div>

                            <div class="form-group menu_radio"> 
                                <div class="form-control-wrap">
                                    <label class="form-label" for="default-01"><?=getlang("icon");?></label> 
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-presentation" name="icon" class="custom-control-input" value="ni-presentation" <?php if($adminmenu->icon == 'ni-presentation'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-presentation"><em class="icon ni ni-presentation"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-files" name="icon" class="custom-control-input" value="ni-files" 
                                    <?php if($adminmenu->icon == 'ni-files'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-files"><em class="icon ni ni-files"></em></label>
                                </div>

                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-bag" name="icon" class="custom-control-input" value="ni-bag" <?php if($adminmenu->icon == 'ni-bag'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-bag"><em class="icon ni ni-bag"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-cart" name="icon" class="custom-control-input" value="ni-cart" <?php if($adminmenu->icon == 'ni-cart'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-cart"><em class="icon ni ni-cart"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-cc-alt2" name="icon" class="custom-control-input" value="ni-cc-alt2" <?php if($adminmenu->icon == 'ni-cc-alt2'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-cc-alt2"><em class="icon ni ni-cc-alt2"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-growth" name="icon" class="custom-control-input" value="ni-growth" <?php if($adminmenu->icon == 'ni-growth'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-growth"><em class="icon ni ni-growth"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-users" name="icon" class="custom-control-input" value="ni-users" <?php if($adminmenu->icon == 'ni-users'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-users"><em class="icon ni ni-users"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-tranx" name="icon" class="custom-control-input" value="ni-tranx" <?php if($adminmenu->icon == 'ni-tranx'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-tranx"><em class="icon ni ni-tranx"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-file-docs" name="icon" class="custom-control-input" value="ni-file-docs" <?php if($adminmenu->icon == 'ni-file-docs'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-file-docs"><em class="icon ni ni-file-docs"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-card-view" name="icon" class="custom-control-input" value="ni-card-view" <?php if($adminmenu->icon == 'ni-card-view'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-card-view"><em class="icon ni ni-card-view"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-mail" name="icon" class="custom-control-input" value="ni-mail" <?php if($adminmenu->icon == 'ni-mail'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-mail"><em class="icon ni ni-mail"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-img" name="icon" class="custom-control-input" value="ni-img" <?php if($adminmenu->icon == 'ni-img'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-img"><em class="icon ni ni-img"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-setting-alt-fill" name="icon" class="custom-control-input" value="ni-setting-alt-fill" <?php if($adminmenu->icon == 'ni-setting-alt-fill'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-setting-alt-fill"><em class="icon ni ni-setting-alt-fill"></em></label>
                                </div>

                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-ni-notice" name="icon" class="custom-control-input" value="ni-notice" <?php if($adminmenu->icon == 'ni-notice'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-ni-notice"><em class="icon ni ni-notice"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-navigate" name="icon" class="custom-control-input" value="ni-navigate" <?php if($adminmenu->icon == 'ni-navigate'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-ni-navigate"><em class="icon ni ni-navigate"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-cloud" name="icon" class="custom-control-input" value="ni-cloud" <?php if($adminmenu->icon == 'ni-cloud'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-ni-cloud"><em class="icon ni ni-cloud"></em></label>
                                </div>
                                <div class="custom-control custom-radio">    
                                    <input type="radio" id="ni-ni-box" name="icon" class="custom-control-input" value="ni-box" <?php if($adminmenu->icon == 'ni-box'){ echo "checked"; }?>>    
                                    <label class="custom-control-label" for="ni-ni-box"><em class="icon ni ni-box"></em></label>
                                </div>
                            </div>
                            <!-- <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("icon");?>
                                <em class="icon ni ni-presentation">

                                </em>
                            </label>    
                                <div class="form-control-wrap">
                                    <span class="ni-files">
                                        <input type="checkbox" name="icon" class="form-control" id="default-01" placeholder="<?=getlang("url");?>" value="ni-files" >
                                    </span>
                            </div>
                            </div> -->
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
$("#adminmenu_form").validate({ 
	rules: { 
        name: {
            required: true,            
        },
        // url: {
        //  	required: true,
        // },
    },

});

</script>