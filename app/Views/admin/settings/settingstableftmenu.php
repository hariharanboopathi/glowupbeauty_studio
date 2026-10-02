<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="user-card">
                                        <div class="user-avatar bg-primary" style="color: #000000;background: #66ccff !important;">
                                            <?php 
                                            $session = \Config\Services::session();
                                            $auth_model = new \App\Models\Auth_model;
                                            $admin_id = $session->get('admin_id');
                                            $admin = $auth_model->getMemberByCondition(array('id'=>$admin_id));
                                            ?>
                                            <span><?php echo strtoupper(substr($admin[0]->name,0, 2));?></span>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text"><?php echo $admin[0]->name;?></span>
                                            <span class="sub-text"><?php echo $admin[0]->email;?></span>
                                        </div>
                                        <div class="user-action">
                                            <div class="dropdown">
                                                <a class="btn btn-icon btn-trigger me-n2" data-bs-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="<?php echo base_url(ADMIN_URL.'/dashboard/changepassword')?>"><em class="icon ni ni-camera-fill"></em><span><span><?=getlang('change_password')?></span></a></li>
                                                        <li><a href="<?php echo base_url(ADMIN_URL.'/dashboard/editprofile')?>"><em class="icon ni ni-edit-fill"></em><span><?=getlang('edit_profile')?></span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner p-0">
                                <?php if(!empty($menuItems)){
                                // $menuArray = renderMenu($menuItems);
                                $menuArray = generateMenuArray();
                                if(!empty($menuArray)){
                                ?>
                            <?php foreach($menuArray as $menu){?>
                            <?php if($menu['url'] =='settings/manage'){?>
                            <ul class="link-list-menu">
                            <?php if(!empty($menu['submenu'])){ foreach($menu['submenu'] as $submenu){?>
                            <?php if($role=='administrator' || $role =='sub-administrator' && !empty($menuaccess) && in_array($submenu['id'], $menuaccess)){

                                $current_url = current_url();
                                $current_url = str_replace(base_url().ADMIN_URL.'/','',$current_url);
                                $current_url = rtrim($current_url,'/');

                                ?>
                                <li>
                                    <a href="<?php if(!empty($submenu['url'])){ echo base_url(ADMIN_URL.'/'.$submenu['url']);}else { echo base_url(ADMIN_URL.'/settings/manage');}?>" data-url = "<?=$current_url;?>" data-url1 = "<?=$submenu['url'];?>" <?php if($current_url == $submenu['url']){?>class="active" <?php } ?>><em class="icon ni <?php if(!empty($submenu['icon'])){echo $submenu['icon'];}else{ echo 'ni ni-user-fill-c'; }?>"></em><span><?=$submenu['name'];?></span></a>
                                </li>
                            <?php } } }?>
                                
                                
                            </ul><!-- .nk-menu-sub -->
                            <?php } }?>
                            <?php } }?>
                                    <!-- <ul class="link-list-menu">
                                        <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                                        <li><a href="html/user-profile-notification.html"><em class="icon ni ni-bell-fill"></em><span>Notifications</span></a></li>
                                        <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li>
                                        <li><a class="active" href="html/user-profile-setting.html"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
                                        <li><a href="html/user-profile-social.html"><em class="icon ni ni-grid-add-fill-c"></em><span>Connected with Social</span></a></li>
                                    </ul> -->
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card-aside -->