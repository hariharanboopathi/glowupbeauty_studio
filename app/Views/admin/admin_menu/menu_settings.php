 
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
<h3 class="nk-block-title page-title"><?=getlang("admin menu arrangements");?></h3>
                                 <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(ADMIN_URL.'/admin_menu/add');?>" class="btn btn-primary"><em class="icon ni ni-plus"></em><span><?=getlang('add')?> <?=getlang('adminmenu')?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(ADMIN_URL.'/admin_menu/add');?>" class="btn btn-icon btn-primary"><em class="icon ni ni-plus"></em><?=getlang('add')?> <?=getlang('adminmenu')?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
					      <?php $uri = current_url(true);?> 
						
                </div><!-- .nk-block-head -->
                <div class="nk-block ms_blk">
                    <div class="card menu_eblk">
                        <div class="card-inner card-inner-xl">
                        <?php echo form_open_multipart(ADMIN_URL."/admin_menu/menu_settings",array('id'=>'adminmenuform'));?>
						 
                        <input type="hidden" id="nestable-output" name="menu">
                        <div class="dd" id="nestable">
                                    <?php
                                        $html_menu = adminmenuTree();
                                        echo (empty($html_menu)) ? '<ol class="dd-list"></ol>' : $html_menu;
                                    ?>
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





