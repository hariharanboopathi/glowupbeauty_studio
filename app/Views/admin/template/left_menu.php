<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <meta name="theme-color" content="#db2525">

    <!-- Fav Icon  -->
    <?php 
		$general_model = new App\Models\General_model();
		$favicon = $general_model->fetch_data('settings',array('code'=>'FAVICON'))[0]->value;
		if($favicon){
	?>
	<link rel="icon" href="<?=base_url('uploads/favicon').'/'.$favicon?>">
	<?php } ?>
    <!-- <link rel="shortcut icon" href="<?php echo base_url();?>/images/favicon.png"> -->
    <!-- Page Title  -->

    <title><?php if($current_page){ echo $current_page[0]->meta_title; } else { echo getFuncName().' '.getCntlrName(); } ?> - <?=get_settings('site_name')?></title>
    <!-- StyleSheets  -->
    <?php echo minifier('adminheader.min.css');   ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify/dist/css/dropify.min.css">
    <?php echo minifier('adminheader.min.js');   ?>

  
</head>
 
        <?php
        // Check if a cookie named 'your_cookie_name' is set
        if (isset($_COOKIE['darkMode'])) {
            $darkMode = 'dark-mode'; // Specify the CSS class to add
        } else {
            $darkMode = ''; // No class to add
        }
        ?>   
        <!-- <style>
            .head_top_bar{
                width:auto;
                height:45px;
                background-color:black;
            }
            .head_top_bar button{
                color:white;
            }
            .head_top_bar button:hover{
                color:#66CCFF;
            }
        </style> -->
<!-- <div  class="head_top_bar">
    <button class="btn btn-primary" onclick="toggleDarkMode()">Dashboard</button>
    <button class="btn" onclick="location.href= '<?php //echo admin_url(); ?>'+'dashboard';">Dashboard</button>
    <button class="btn">Edit page</button>
    <button class="btn">Quick edit</button>
    <button class="btn">SEO score </button>
    <button class="btn" onclick = "location.href='<?php //echo base_url(ADMIN_URL)?>'+'/admin_menu/clean_cache';">Clear site cache</button>




</div> -->

<body class="nk-body ui-rounder has-sidebar <?php echo $darkMode; ?> ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main <?php if(service('router')->controllerName() == '\App\Controllers\Beheerpaneel\Settings' || service('router')->controllerName() == '\App\Controllers\Beheerpaneel\Language_content' || service('router')->controllerName() == '\App\Controllers\Beheerpaneel\Languages' || service('router')->controllerName() == '\App\Controllers\Beheerpaneel\Socialmedia' || service('router')->controllerName() == '\App\Controllers\Beheerpaneel\Uspcontents'){ //echo "setting_tab"; 
}?>">
            <!-- sidebar @s -->
            <div class="nk-sidebar is-light nk-sidebar-fixed is-light " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <?php 
		                   $slogo      = $general_model->fetch_data('settings',array('code'=>'SLOGO'));
                           $amvlogo      = $general_model->fetch_data('settings',array('code'=>'AMVLOGO'));

	                    ?>
                        <a href="<?php echo base_url(ADMIN_URL);?>" class="logo-link">
                            <img class="logo-img logo-img-lg" src="<?php echo image_url('uploads/logo/'.$slogo[0]->value);?>" srcset="<?php echo image_url('uploads/logo/'.$slogo[0]->value);?>" alt="logo" style="background-color:black;">
                            <img class="logo-dark logo-img logo-img-small" src="<?php if(!empty($amvlogo[0]->value)){echo image_url('uploads/logo/'.$amvlogo[0]->value);}?>" srcset="<?php if(!empty($amvlogo[0]->value)){echo image_url('uploads/logo/'.$amvlogo[0]->value);}?>" alt="logo-dark">

                        </a>
                    </div>
                    <div class="nk-menu-trigger me-n2">
                        <a href="javascript:void(0);" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">

                                <?php if(!empty($menuItems)){
                                    $menuArray = generateMenuArray();
                                    if(!empty($menuArray)){
                                        foreach($menuArray as $menu){ ?>

                                            <?php if($menu['url'] == 'dashboard/index'){ ?> 
                                                
                                                <!-- .nk-menu-item -->
                                                <li class="nk-menu-heading">
                                                    <h6 class="overline-title text-primary-alt"><?=getlang('dashboard')?></h6>
                                                </li>
                                                <!-- .nk-menu-item -->
                                            
                                                <li class="nk-menu-item <?php if(getCntlrFuncName() == 'dashboard/index'){ echo 'active';} ?>">
                                                    <a href="<?php echo base_url(ADMIN_URL.'/'.$menu['name'])?>" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em class="icon ni ni-presentation"></em></span>
                                                        <span class="nk-menu-text"><?php echo $menu['name'] ; ?></span>
                                                    </a>
                                                </li><!-- .nk-menu-item -->
                                                <li class="nk-menu-item <?php if(getCntlrFuncName() == 'dashboard/report_dashboard'){ echo 'active';} ?>">
                                                    <a href="<?php echo base_url(ADMIN_URL.'/'.'dashboard/report_dashboard')?>" class="nk-menu-link">
                                                        <span class="nk-menu-icon"><em class="icon ni ni-presentation"></em></span>
                                                        <span class="nk-menu-text"><?=getlang('Rapport_dashboard')?></span>
                                                    </a>
                                                </li><!-- .nk-menu-item -->
                                                <li class="nk-menu-heading">
                                                    <h6 class="overline-title text-primary-alt"><?=getlang('applications')?></h6>
                                                </li><!-- .nk-menu-heading -->
                                            
                                            <?php }
                                            
                                            if($role=='administrator' || $role =='sub-administrator' && !empty($menuaccess) && in_array($menu['id'], $menuaccess)){?>
                                   
                                                <?php if($menu['url'] == 'settings/manage' || $menu['url'] == '/settings/manage'){
                                                    ?>

                                                    <li class="nk-menu-item <?php if(getCntlrFuncName() == 'settings/manage'){ echo 'active';} ?>">
                                                        <a href="<?php echo base_url(ADMIN_URL.'/settings/manage')?>" class="nk-menu-link">
                                                            <span class="nk-menu-icon"><em class="icon ni <?=$menu['icon'];?>"></em></span>
                                                            <span class="nk-menu-text"><?=$menu['name'];?></span>
                                                        </a>
                                                    </li>

                                                <?php } else if($menu['url'] != 'dashboard/index' && $menu['url'] != 'dashboard/report_dashboard'){
                                                     $ur =getCntlrFuncName();
                                                     $urls = array_map(function($item) {
                                                        return $item['url'];
                                                    }, $menu['submenu']);
                                                   
                                                    

                                                    ?>

                                                    <li class="nk-menu-item <?php if(!empty($menu['submenu'])){ echo  "has-sub";} if(in_array($ur ,$urls)){
                                                        echo " "."active";
                                                    } ?>">
                                                        <a href="<?php if(!empty($menu['submenu'])){ echo  "#";}else { echo base_url(ADMIN_URL.'/'.$menu['url']);}?>" class="nk-menu-link <?php if(!empty($menu['submenu'])){ echo  "nk-menu-toggle";}?>">
                                                            <span class="nk-menu-icon"><em class="icon ni <?php if(!empty($menu['icon'])){ echo $menu['icon'];} else{ echo 'ni-files';}?>"></em></span>
                                                            <span class="nk-menu-text"><?=$menu['name'];?></span>
                                                        </a>
                                                        <?php if(!empty($menu['submenu'])){?>
                                                            <ul class="nk-menu-sub">
                                                                <?php foreach($menu['submenu'] as $submenu){

                                                                   $ur =getCntlrFuncName();
                                                                   
                                                                    ?>
                                                                    <li class="nk-menu-item <?php if($submenu['url'] == $ur){  echo 'active current-page'.' '.$ur; } ?>">
                                                                        <a href="<?php echo base_url(ADMIN_URL.'/'.$submenu['url']);?>" class="nk-menu-link"><span class="nk-menu-text"><?=$submenu['name']?></span></a>
                                                                    </li>
                                                                <?php }  ?>
                                                            </ul>
                                                        <?php }  ?>
                                                    </li>
                                                <?php } ?>

                                            <?php }
                                        } ?>
                                <?php } 
                                }?>
                          
                                <li class="nk-menu-item">
                                    <a href="<?php echo base_url(ADMIN_URL.'/dashboard/logout')?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-signout"></em></span>
                                        <span class="nk-menu-text"><?=getlang('sign_out')?></span>
                                    </a>
                                </li>
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
           