<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit')?> <?=getlang('sub_admin')?></h3>
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
                                                <a href="<?php echo base_url(ADMIN_URL)?>/subadmin/manage_sub_admin" class="btn btn-primary"><span><?=getlang('manage')?> <?=getlang('sub_admin')?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(ADMIN_URL)?>/subadmin/manage_sub_admin" class="btn btn-icon btn-primary"><?=getlang('manage')?> <?=getlang('sub_admin')?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
					      <?php $uri = current_url(true);?> 
						
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
                            <?php echo form_open_multipart(ADMIN_URL."/subadmin/edit_sub_admin/".$admin_details[0]->id,array('id'=>'subadminform'));?>
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1"><?=getlang('general')?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2"><?=getlang('media')?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3"><?=getlang('privileges')?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem4"><?=getlang('dashboard_privileges')?></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem1">
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang("name");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="name" class="form-control" id="default-01" value="<?php echo !empty($admin_details) ? $admin_details[0]->name : '';?>" >    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang("email");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="email" name="email" class="form-control" id="default-01" value="<?php echo !empty($admin_details) ? $admin_details[0]->email : '';?>" >    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang("password");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="password" name="oldpassword" class="form-control" id="default-01" value="<?php echo !empty($admin_details) ? $admin_details[0]->password : '';?>" > 
                                        </div>
                                    </div>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" name="enable_2fa"  id="fv-com-enable-2fa" <?php if(!empty($admin_details) && $admin_details[0]->enable_2fa == 1 ){ echo "checked";} ?>>
                                        <label class="custom-control-label" for="fv-com-enable-2fa"> <?=getlang("Enable-2FA");?></label>
                                    </div>

                                </div>
                                <div class="tab-pane" id="tabItem2">
                                    <div class="form-group">
                                        <label class="form-label"><?=getlang("image");?></label>
                                        <div class="form-control-wrap">
                                            <div class="form-file">
                                                <input type="file" name="image" accept=".png,.jpg,.jpeg,.webp" multiple class="form-file-input" id="customMultipleFiles">
                                                <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php if($admin_details[0]->image){?>
                                            <img src="<?php echo !empty($admin_details[0]->image)?image_url('uploads/user/'.$admin_details[0]->image):''; ?>" width="50%">
                                        <?php }  else{?>
                                            <img src="<?php echo image_url('uploads/noimage.jpg')?>" alt="<?php echo $admin_details[0]->name; ?>" width="60" height="50">
                                        <?php } ?>
                                    </div>

                                </div>
                                <div class="tab-pane" id="tabItem3">
                                <?php 
                                if(!empty($menuItems)){
                                $menuArray = renderMenu($menuItems);
                                if(!empty($menuArray)){?>
                                    <?php foreach($menuArray as $menu){?>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" onclick="relatedsubcheck(this);" data-id = "<?php echo $menu['id']; ?>" value="<?=$menu['id']?>" name="options[]"  id="fv-com-frontend<?=$menu['id']?>" <?php echo !empty($access) && in_array($menu['id'], $access) ? 'checked' : ''; ?>>
                                                <label class="custom-control-label" for="fv-com-frontend<?=$menu['id']?>"> <?=$menu['name']?></label>
                                            </div>
                                            <?php if(!empty($menu['submenu'])){
                                                foreach($menu['submenu'] as $submenu){
                                                ?>
                                            <!-- -------- -->
                                            <div class="sub_cat">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input cls_<?php echo $menu['id']; ?>" value="<?=$submenu['id']?>" name="options[]"  id="fv-com-frontend<?=$submenu['id']?>" <?php echo !empty($access) && in_array($menu['id'], $access) ? 'checked' : ''; ?> disabled>
                                                <label class="custom-control-label" for="fv-com-frontend<?=$submenu['id']?>"> <?=$submenu['name']?></label>
                                            </div>
                                            </div>
                                            <?php }  }?>

                                        </div>
                                             
                                    <?php }?>

                                <?php } ?>
                                <?php } ?>
                                
                                    

                                </div>

                                <div class="tab-pane" id="tabItem4">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="orders_revenue" name="dashboardoptions[]"  id="fv-com-orders_revenue" <?php echo !empty($dashboardaccess) && in_array('orders_revenue', $dashboardaccess) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="fv-com-orders_revenue"> <?=getlang("Orders_Revenue");?></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="active_visitors" name="dashboardoptions[]"  id="fv-com-active_visitors" <?php echo !empty($dashboardaccess) && in_array('active_visitors', $dashboardaccess) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="fv-com-active_visitors"> <?=getlang("Active_Visitors");?></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="daily_visitors" name="dashboardoptions[]"  id="fv-com-daily_visitors" <?php echo !empty($dashboardaccess) && in_array('daily_visitors', $dashboardaccess) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="fv-com-daily_visitors"> <?=getlang("Daily_Visitors");?></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="orders_overview" name="dashboardoptions[]"  id="fv-com-orders_overview" <?php echo !empty($dashboardaccess) && in_array('orders_overview', $dashboardaccess) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="fv-com-orders_overview"> <?=getlang("Orders_Overview");?></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="transactions" name="dashboardoptions[]"  id="fv-com-transactions" <?php echo !empty($dashboardaccess) && in_array('transactions', $dashboardaccess) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="fv-com-transactions"> <?=getlang("Transactions");?></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="new_users" name="dashboardoptions[]"  id="fv-com-new_users" <?php echo !empty($dashboardaccess) && in_array('new_users', $dashboardaccess) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="fv-com-new_users"> <?=getlang("New_Users");?></label>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="contact_messages" name="dashboardoptions[]"  id="fv-com-contact_messages" <?php echo !empty($dashboardaccess) && in_array('contact_messages', $dashboardaccess) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="fv-com-contact_messages"> <?=getlang("Contact_Messages");?></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="general_notes" name="dashboardoptions[]"  id="fv-com-general_notes" <?php echo !empty($dashboardaccess) && in_array('general_notes', $dashboardaccess) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="fv-com-general_notes"> <?=getlang("General_Notes");?></label>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="notifications" name="dashboardoptions[]"  id="fv-com-notifications" <?php echo !empty($dashboardaccess) && in_array('notifications', $dashboardaccess) ? 'checked' : ''; ?>>
                                            <label class="custom-control-label" for="fv-com-notifications"> <?=getlang("Notifications");?></label>
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                        
                              
                            </br>
                            </br>   
							
                        
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

<script>
$("#subadminform").validate({ 
	rules: { 
        name: {
            required: true,            
        },
        email: {
         	required: true,
        },
        password: {
            required: true,            
        },
    },

});

</script>
<script>
    function relatedsubcheck(e){
        const dataId = e.getAttribute('data-id');
        console.log(dataId);

        $('input[type="checkbox"]').each(function() {
                if ($(this).hasClass('cls_'+dataId)) {
                    // Set the checkbox to be checked
                    
                    if($(this).prop('checked') == true){
                        $(this).prop('checked', false);
                    }else{

                        $(this).prop('checked', true);
                    }
                }
        });
    }
</script>