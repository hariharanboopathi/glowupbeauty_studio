

<?php if(!empty($menuItems)){
                // $menuArray = renderMenu($menuItems);
                $menuArray = generateMenuArray();
                if(!empty($menuArray)){
                ?>
<?php foreach($menuArray as $menu){?>
            <?php if($menu['url'] =='settings/manage'){?>
                <?php if(!empty($menu['submenu'])){ foreach($menu['submenu'] as $submenu){

$controller = $request->uri->getSegment(2);
if(count($request->uri->getSegments()) <= 3)
{
    $url = $controller;
    if(count($request->uri->getSegments()) == 3)
    {
        if(!empty($request->uri->getSegment(3)))
        {
            $method = $request->uri->getSegment(3);
            $url = $controller.'/'.$method;
        }
    }
    
    if($submenu['url'] == $url || $url =='settings/manage'){
    

                    
                    ?>
                
                
            

<!-- <div class="setting_menu desktop">
    <ul class="nk-menu">
        <li class="nk-menu-item has-sub">
            
            <?php if(!empty($menuItems)){
                // $menuArray = renderMenu($menuItems);
                $menuArray = generateMenuArray();
                if(!empty($menuArray)){
                ?>
            <?php foreach($menuArray as $menu){?>
            <?php if($menu['url'] =='settings/manage'){?>
            <ul class="nk-menu-sub">
            <?php if(!empty($menu['submenu'])){ foreach($menu['submenu'] as $submenu){?>
            <?php if($role=='administrator' || $role =='sub-administrator' && !empty($menuaccess) && in_array($submenu['id'], $menuaccess)){?>
                <li class="nk-menu-item">
                    <a href="<?php if(!empty($submenu['url'])){ echo base_url(ADMIN_URL.'/'.$submenu['url']);}else { echo base_url(ADMIN_URL.'/settings/manage');}?>" class="nk-menu-link"><span class="nk-menu-text"><?=$submenu['name'];?></span></a>
                </li>
            <?php } } }?>
                
                
            </ul>
            <?php } }?>
            <?php } }?>
        </li>
    </ul>
    
</div>   -->
<?php } } } } } } } }?>
        
          <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header is-light nk-header-fixed is-light">
                    <div class="container-xl wide-xl">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1 me-3">
                                <a href="<?php echo base_url(ADMIN_URL);?>" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="<?php echo base_url(ADMIN_URL); ?>" class="logo-link">
                                    <img class="logo-light logo-img" src="<?php if(!empty($slogo[0]->value)){echo image_url('uploads/logo/'.$slogo[0]->value);}?>" srcset="<?php if(!empty($slogo[0]->value)){echo image_url('uploads/logo/'.$slogo[0]->value);}?>" alt="logo"> 
                                    <img class="logo-dark logo-img logo-img-small" src="<?php if(!empty($amvlogo[0]->value)){echo image_url('uploads/logo/'.$amvlogo[0]->value);}?>" srcset="<?php if(!empty($amvlogo[0]->value)){echo image_url('uploads/logo/'.$amvlogo[0]->value);}?>" alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-menu is-light">
                                <div class="nk-header-menu-inner">
                                    <!-- Menu -->
                                    <ul class="nk-menu nk-menu-main">
                                        <li class="nk-menu-item has-sub">
                                            <a href="<?php echo admin_url('dashboard'); ?>" class="nk-menu-link">
                                                <span class="nk-menu-text">Dashboard</span>
                                            </a> 
                                        </li><!-- .nk-menu-item -->
                                        
<?php if($current_page){
foreach($current_page as $cinfo){ ?>

                                        <li class="nk-menu-item has-sub">
                                            <a href="#" class="nk-menu-link">
                                                <span class="nk-menu-text"><?php echo parent_admin_menu_name($cinfo->parent_id); ?></span>
                                            </a> 
                                        </li> 

                                        <li class="nk-menu-item">
                                            <a href="<?php echo admin_url($cinfo->url); ?>" class="nk-menu-link">
                                                <span class="nk-menu-text"><?php echo $cinfo->name; ?></span>
                                            </a>
                                        </li> 
<?php } 
} ?>
                                    </ul>
                                    <!-- Menu -->
                                </div>
                            </div><!-- .nk-header-menu -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <!-- .dropdown -->
                                    <?php if($role=='administrator' || $role =='sub-administrator' && !empty($dashaccess) && in_array('notifications', $dashaccess)){?>
                                    <li class="dropdown notification-dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                            <div class="dropdown-head">
                                                
                                                <span class="sub-title nk-dropdown-title"><?=getlang('Notifications');?></span>
                                                <?php if(!empty($unread_orders)){?>
                                                <a href="<?=base_url(ADMIN_URL.'/orders/all_read');?>" ><?=getlang('Mark_All_as_Read');?></a>
                                                <?php } ?>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">
                                                    <?php if(!empty($unread_orders)){?>
                                                        <?php foreach($unread_orders as $unread){?>
                                                    <div class="nk-notification-item dropdown-inner" onclick="location.href='<?php echo base_url(ADMIN_URL.'/orders/details/'.$unread->id); ?>';">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-primary-dim ni ni-spark"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <?php $get_status_data = $general_model->fetch_data('orderstatuses',array('key'=>$unread->payment_status));?>
                                                            <div class="nk-notification-text"><?=$unread->voornaam.' '.$unread->achternaam;?> <span>#<?=$unread->order_id;?></span> &euro; <?php echo number_format($unread->total_amount,2,",","."); ?> <?php if(!empty($get_status_data)){?><span style="color:<?=$get_status_data[0]->color;?>;text-transform:capitalize;"><?php echo $unread->payment_status;?></span><?php } ?></div>
                                                            <?php
                                                            $givenDateTime = new DateTime($unread->order_created);
                                                            $currentDateTime = new DateTime();
                                                            $timeDifference = $currentDateTime->diff($givenDateTime);
                                                            $totalMinutes = ($timeDifference->days * 24 * 60) + ($timeDifference->h * 60) + $timeDifference->i;

                                                            if ($totalMinutes >= 1440) {
                                                                $diff = floor($totalMinutes / 1440) . ' day(s) ago';
                                                            } elseif ($totalMinutes >= 60) {
                                                                $diff = floor($totalMinutes / 60) . ' hour(s) ago';
                                                            } else {
                                                                $diff = $totalMinutes . ' minute(s) ago';
                                                            }
                                                            
                                                            ?>
                                                            <div class="nk-notification-time"><?=$diff;?></div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    <?php } else {?>
                                                        <div class="nk-notification-item dropdown-inner">
                                                            <div class="nk-notification-icon">
                                                                <em class="icon icon-circle bg-primary-dim ni ni-spark"></em>
                                                            </div>
                                                            <div class="nk-notification-content">
                                                                <div class="nk-notification-text">
                                                                <?=getlang('No_Notifications_at_the_moment!')?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <?php } ?>
                                                    
                                                </div><!-- .nk-notification -->
                                            </div><!-- .nk-dropdown-body -->

                                            <div class="dropdown-foot center">
                                                <?php if(!empty($unread_orders)){?>
                                                <a href="<?=base_url(ADMIN_URL.'/orders/manage')?>"><?=getlang('View_All');?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    <!-- <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                                        <a href="javascript:void(0);" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                            <div class="quick-icon border border-light">
                                                <?php 
                                                $get_seesion_code = $session->get('lang');
                                                $get_session_langdetails = $general_model->fetch_data('languages',array('lang_code'=>$get_seesion_code));
                                                if(!empty($get_session_langdetails)){
                                                ?>
                                                <img class="icon" src="<?php echo image_url('uploads/languages/'.$get_session_langdetails[0]->image);?>" srcset="<?php echo image_url('uploads/languages/'.$get_session_langdetails[0]->image);?>" alt="language">
                                            <?php } else {?>
                                                <img class="icon" src="<?php echo image_url('assets/img/flags/english-sq.png');?>" srcset="<?php echo image_url('assets/img/flags/english-sq.png');?>" alt="language">
                                            <?php } ?>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="language-list">
                                                <?php 
                                                $get_languages = $general_model->fetch_data('languages');
                                                ?>
                                                <?php if(!empty($get_languages)){
                                                    foreach($get_languages as $key=>$languages){
                                                        ?>
                                                <li>
                                                    <a href="javascript:void(0);" class="language-item" onclick="lang_change('<?=$languages->lang_code?>')">
                                                        <img src="<?php echo image_url('uploads/languages/'.$languages->image);?>" srcset="<?php echo image_url('uploads/languages/'.$languages->image);?>" alt="language" class="language-flag" >
                                                        <span class="language-name"><?=$languages->name?></span>
                                                    </a>
                                                </li>
                                            <?php } }?> 
                                            </ul>
                                        </div> 
                                    </li>-->
                                    <li class="dropdown user-dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
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
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <!-- <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li> -->
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span><?=getlang('dark_mode')?></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?php echo base_url(ADMIN_URL.'/dashboard/changepassword')?>"><em class="icon ni ni-edit"></em><span><?=getlang('change_password')?></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?php echo base_url(ADMIN_URL.'/dashboard/editprofile')?>"><em class="icon ni ni-edit"></em><span><?=getlang('edit_profile')?></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?php echo base_url(ADMIN_URL.'/admin_menu/menu_settings')?>"><em class="icon ni ni-edit"></em><span><?=getlang('Admin_Left_Menu')?></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?php echo base_url(ADMIN_URL.'/admin_menu/clean_cache')?>"><em class="icon ni ni-edit"></em><span><?=getlang('Clean_cache')?></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?php echo base_url(ADMIN_URL.'/dashboard/logout')?>"><em class="icon ni ni-signout"></em><span><?=getlang('sign_out')?></span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->

                
<script>
      //  function lang_change(lang_code) {
        //    window.location.href = '<?php echo base_url(); ?>' + '/home/languages/' + lang_code;
            // window.location.href = '<?php echo base_url(); ?>' + 'ktpgroup/languages/' + lang_code;

     //   }
        
    </script>

    