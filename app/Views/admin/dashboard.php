<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title"><?=getlang('Dashboard');?></h3>
                        <div class="nk-block-des text-soft">
                            <!-- <p>Welcome to Sales Dashboard Template.</p> -->
                        </div>
                    </div>
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-xxl-7">
                        <div class="row g-gs">
                        <?php if($role=='administrator' || $role =='sub-administrator' && !empty($dashaccess) && in_array('orders_revenue', $dashaccess)){?>
                            <div class="col-lg-7 col-xxl-12">
                                <div class="card">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-2">
                                            <div class="card-title">
                                                <h6 class="title"><?=getlang('Orders_Revenue')?></h6>
                                                <!-- <p>In last 30 days revenue from subscription.</p> -->
                                            </div>
                                            <div class="card-tools">
                                                <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="<?=getlang('Revenue_from_orders')?>"></em>
                                            </div>
                                        </div>
                                        <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">

                                        <?php 
                                        $get_last_month_order_total = get_last_month_order_total();
                                        $get_this_month_order_total = get_this_month_order_total();
                                        $get_last_week_order_total = get_last_week_order_total();
                                        $get_this_week_order_total = get_this_week_order_total();                                        
                                        $lastMonthPercentageChange = calculatePercentageChange($get_last_month_order_total, $get_this_month_order_total);
                                        $lastWeekPercentageChange = calculatePercentageChange($get_last_week_order_total, $get_this_week_order_total);
                                        ?>

                                            <div class="nk-sale-data-group flex-md-nowrap g-4">
                                                <div class="nk-sale-data">

                                                

                                                    <span class="amount">&euro; <?=number_format($get_this_month_order_total,2,",",".")?> <span class="<?=$lastMonthPercentageChange['text_class']?>"><em class="icon ni ni-arrow-long-<?=$lastMonthPercentageChange['class']?>"></em>
                                                    <?php if(!empty($lastMonthPercentageChange['percentage'])){?>
                                                    <?=($lastMonthPercentageChange['percentage'] % 100)?>
                                                    <?php } ?>%</span></span>
                                                    <span class="sub-title"><?=getlang('This_Month')?></span>
                                                </div>
                                                <div class="nk-sale-data">
                                                    <span class="amount">&euro; <?=number_format($get_this_week_order_total,2,",",".")?> <span class="<?=$lastWeekPercentageChange['text_class']?>"><em class="icon ni ni-arrow-long-<?=$lastWeekPercentageChange['class']?>"></em><?=$lastWeekPercentageChange['percentage']?>%</span></span>
                                                    <span class="sub-title"><?=getlang('This_Week')?></span>
                                                </div>
                                            </div>
                                            <div class="nk-sales-ck sales-revenue">
                                                <canvas class="sales-bar-chart" id="salesRevenue"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <?php } ?>
                            <div class="col-lg-5 col-xxl-12">
                                <div class="row g-gs">
                                <?php if($role=='administrator' || $role =='sub-administrator' && !empty($dashaccess) && in_array('active_visitors', $dashaccess)){?>
                                    <div class="col-sm-6 col-lg-12 col-xxl-6">
                                        <div class="card">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title"><?=getlang('Active_Visitors')?></h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="<?=getlang('Total_Active_Visitors')?>"></em>
                                                    </div>
                                                </div>
                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data">
                                                    <?php
                                                        $getoverallviewscount = getoverallviewscount();
                                                        $lastmonth_viewcount = lastmonth_viewcount();
                                                        $currentmonth_viewcount = currentmonth_viewcount();

                                                        

                                                        $currentMonthCount = $currentmonth_viewcount->current_month_count;
                                                        $lastMonthCount = $lastmonth_viewcount->last_month_count;
                                                        $percentageDifference = abs(($currentMonthCount - $lastMonthCount) / (($currentMonthCount + $lastMonthCount) / 2)) * 100;

                                                        
                                                        $changeClass = ($percentageDifference >= 0) ? 'up text-success' : 'down text-danger';
                                                        $arrowClass = ($percentageDifference >= 0) ? 'ni ni-arrow-long-up' : 'ni ni-arrow-long-down';
                                                        ?>
                                                        <span class="amount"><?=$getoverallviewscount->overall_count?></span>
                                                        <span class="sub-title"><span class="change <?=$changeClass?>"><em class="icon ni <?=$arrowClass?>"></em><?=number_format(($percentageDifference % 100), 2)?>%</span><?=getlang('since_last_month');?></span>
                                                    </div>
                                                    <div class="nk-sales-ck">
                                                        <canvas class="views-bar-chart" id="activeSubscription"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <?php } ?>
                                    <?php if($role=='administrator' || $role =='sub-administrator' && !empty($dashaccess) && in_array('daily_visitors', $dashaccess)){?>
                                    <div class="col-sm-6 col-lg-12 col-xxl-6">
                                        <div class="card">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title"><?=getlang('Daily_Visitors')?></h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="<?=getlang('Daily_Avg_Visitors_total')?>"></em>
                                                    </div>
                                                </div>
                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data">
                                                    <?php
                                                        $current_day = $general_model->fetch_data('views',array('date'=>date('y-m-d')));
                                                        $lastweek_viewcount = lastweek_viewcount();

                                                        $currentweek_viewcount = currentweek_viewcount();

                                                        $currentWeekCount = $currentweek_viewcount->current_week_count;
                                                        $lastWeekCount = $lastweek_viewcount->last_week_count;

                                                        $percentageDifference = ($currentWeekCount - $lastWeekCount) / (($currentWeekCount + $lastWeekCount) / 2) * 100;

                                                        $changeClass = ($percentageDifference >= 0) ? 'up text-success' : 'down text-danger';
                                                        $arrowClass = ($percentageDifference >= 0) ? 'ni ni-arrow-long-up' : 'ni ni-arrow-long-down';
                                                        ?>

                                                        <span class="amount"><?php if(!empty($current_day)){ echo $current_day[0]->views;}else { echo '0';}?></span>
                                                        <span class="sub-title"><span class="change <?= $changeClass ?>"><em class="icon ni <?= $arrowClass ?>"></em><?= number_format(abs($percentageDifference), 2) ?>%</span> <?= getlang('since_last_week'); ?></span>


                                                        <!-- <span class="amount">346.2</span>
                                                        <span class="sub-title"><span class="change up text-success"><em class="icon ni ni-arrow-long-up"></em>2.45%</span>since last week</span> -->
                                                    </div>
                                                    <div class="nk-sales-ck">
                                                        <canvas class="weekly-views-bar-chart" id="weeklyViews"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <?php } ?>
                                </div><!-- .row -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .col -->
                    <?php if($role=='administrator' || $role =='sub-administrator' && !empty($dashaccess) && in_array('orders_overview', $dashaccess)){?>
                    <div class="col-xxl-5">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="card-title-group align-start gx-3 mb-3">
                                    <div class="card-title">
                                        <h6 class="title"><?=getlang('Orders_Overview')?></h6>
                                        <p><?=getlang('In_30_days_sales_of_products.')?></p>
                                    </div>
                                    
                                </div>
                                <div class="nk-sale-data-group align-center justify-between gy-3 gx-5">
                                    <div class="nk-sale-data">

                                    <?php 
                                    $getmonthlyincome = getmonthlyincome();
                                    $monthlyData = array_column($getmonthlyincome, 'monthly_income');
                                    ?>
                                        <span class="amount">&euro; <?=number_format(array_sum($monthlyData),2,",",".")?></span>
                                    </div>
                                    
                                </div>
                                <div class="nk-sales-ck large pt-4">
                                    <canvas class="sales-overview-chart" id="salesOverview"></canvas>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <?php } ?>

                    <?php if($role=='administrator' || $role =='sub-administrator' && !empty($dashaccess) && in_array('transactions', $dashaccess)){?>
                    <?php if(!empty($dash_orders)){?>
                    <div class="col-xxl-8">
                        <div class="card card-full">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title"><span class="me-2"><?=getlang('Transactions');?></span> <a href="<?php echo base_url(ADMIN_URL.'/orders/manage')?>" class="link d-none d-sm-inline"><?=getlang('See_History')?></a></h6>
                                    </div>
                                    <!-- <div class="card-tools">
                                        <ul class="card-tools-nav">
                                            <li><a href="#"><span>Paid</span></a></li>
                                            <li><a href="#"><span>Pending</span></a></li>
                                            <li class="active"><a href="#"><span>All</span></a></li>
                                        </ul>
                                    </div> -->
                                </div>
                            </div>
                            <div class="card-inner p-0 border-top">
                                <div class="nk-tb-list nk-tb-orders">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span><?=getlang('id');?></span></div>
                                        <div class="nk-tb-col tb-col-sm"><span><?=getlang('naam');?></span></div>
                                        <div class="nk-tb-col tb-col-md"><span><?=getlang('date');?></span></div>
                                        <div class="nk-tb-col tb-col-lg"><span><?=getlang('Email');?></span></div>
                                        <div class="nk-tb-col"><span><?=getlang('Totaal_betaald');?></span></div>
                                        <div class="nk-tb-col"><span class="d-none d-sm-inline"><?=getlang('Order_Status');?></span></div>
                                        <div class="nk-tb-col"><span>&nbsp;</span></div>
                                    </div>
                                    <?php 
                                    $classes = array('bg-azure', 'bg-purple', 'bg-success');
                                    shuffle($classes);
                                    foreach($dash_orders as $dash_ord){
                                        $randomClass = array_pop($classes);
                                        ?>
                                    <?php 
                                    $config         = new \Config\Encryption();
                                    $config->key    = 'aBigsecret_ofAtleast32Characters';
                                    $config->driver = 'OpenSSL';

                                    $encrypter = \Config\Services::encrypter($config);
                                    $encryptedorderid = $encrypter->encrypt($dash_ord->order_id);

                                    $base64urlEncodedorderid = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($encryptedorderid));
                                    ?>
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <span class="tb-lead"><a href="<?php echo base_url(ADMIN_URL)?>/orders/details/<?php echo $dash_ord->id; ?>">#<?php echo !empty($dash_ord->order_id)?$dash_ord->order_id:$dash_ord->id;?></a></span>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <div class="user-card">
                                                <div class="user-avatar user-avatar-sm <?=$randomClass;?>">
                                                    <span><?php echo strtoupper(substr($dash_ord->voornaam,0, 2));?></span>
                                                </div>
                                                <div class="user-name">
                                                    <span class="tb-lead"><?php echo $dash_ord->voornaam;?>  <?php echo $dash_ord->achternaam;?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-md">
                                        <?php $date = strtotime($dash_ord->order_created);?>
                                            <span class="tb-sub"><?php echo date('d-m-Y H:i:s',$date);?></span>
                                        </div>
                                        <div class="nk-tb-col tb-col-lg">
                                            <span class="tb-sub text-primary"><?php echo $dash_ord->email;?></span>
                                        </div>
                                        <div class="nk-tb-col">
                                            <span class="tb-sub tb-amount">&euro; <?=number_format((float)$dash_ord->total_amount,2,",","")?></span>
                                        </div>
                                        <div class="nk-tb-col">
                                        <?php $get_status_data = $general_model->fetch_data('orderstatuses',array('key'=>$dash_ord->payment_status));
                                        ?>
                                            <span class="badge badge-dot badge-dot-xs bg-success <?php if(!empty($get_status_data)){?>style='color:<?=$get_status_data[0]->color;?>;'<?php } ?>"><?php echo $dash_ord->payment_status;?></span>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-action">
                                            <div class="dropdown">
                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                    <ul class="link-list-plain">
                                                        <li><a href="<?php echo base_url(ADMIN_URL)?>/orders/details/<?php echo $dash_ord->id; ?>"><?=getlang('Order_Detail');?></a></li>
                                                        <li><a href="<?=base_url(ADMIN_URL.'/orders/download_invoice/'.$base64urlEncodedorderid);?>"><?=getlang('Invoice');?></a></li>
                                                        <!-- <li><a href="#">Print</a></li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                            <div class="card-inner-sm border-top text-center d-sm-none">
                                <a href="<?php echo base_url(ADMIN_URL.'/orders/manage')?>" class="btn btn-link btn-block"><?=getlang('See_History')?></a>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <?php } ?>
                    <?php } ?>
                    <!-- <div class="col-md-6 col-xxl-4">
                        <div class="card card-full">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Recent Activities</h6>
                                    </div>
                                    <div class="card-tools">
                                        <ul class="card-tools-nav">
                                            <li><a href="#"><span>Cancel</span></a></li>
                                            <li class="active"><a href="#"><span>All</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <ul class="nk-activity">
                                <li class="nk-activity-item">
                                    <div class="nk-activity-media user-avatar bg-success"><img src="./images/avatar/c-sm.jpg" alt=""></div>
                                    <div class="nk-activity-data">
                                        <div class="label">Keith Jensen requested to Widthdrawl.</div>
                                        <span class="time">2 hours ago</span>
                                    </div>
                                </li>
                                <li class="nk-activity-item">
                                    <div class="nk-activity-media user-avatar bg-warning">HS</div>
                                    <div class="nk-activity-data">
                                        <div class="label">Harry Simpson placed a Order.</div>
                                        <span class="time">2 hours ago</span>
                                    </div>
                                </li>
                                <li class="nk-activity-item">
                                    <div class="nk-activity-media user-avatar bg-azure">SM</div>
                                    <div class="nk-activity-data">
                                        <div class="label">Stephanie Marshall got a huge bonus.</div>
                                        <span class="time">2 hours ago</span>
                                    </div>
                                </li>
                                <li class="nk-activity-item">
                                    <div class="nk-activity-media user-avatar bg-purple"><img src="./images/avatar/d-sm.jpg" alt=""></div>
                                    <div class="nk-activity-data">
                                        <div class="label">Nicholas Carr deposited funds.</div>
                                        <span class="time">2 hours ago</span>
                                    </div>
                                </li>
                                <li class="nk-activity-item">
                                    <div class="nk-activity-media user-avatar bg-pink">TM</div>
                                    <div class="nk-activity-data">
                                        <div class="label">Timothy Moreno placed a Order.</div>
                                        <span class="time">2 hours ago</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                    <?php if($role=='administrator' || $role =='sub-administrator' && !empty($dashaccess) && in_array('new_users', $dashaccess)){?>
                    <?php if(!empty($new_users)){?>
                    <div class="col-md-6 col-xxl-4">
                        <div class="card card-full">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title"><?=getlang('New_Users')?></h6>
                                        </div>
                                        <!-- <div class="card-tools">
                                            <a href="<?=base_url(ADMIN_URL.'/subadmin/manage_sub_admin');?>" class="link"><?=getlang('View_All')?></a>
                                        </div> -->
                                    </div>
                                </div>

                                <?php 
                                $classes = array('bg-pink-dim', 'bg-primary-dim', 'bg-warning-dim','bg-success-dim');
                                shuffle($classes);
                                foreach($new_users as $new_user){
                                    $randomClass = array_pop($classes);
                                    ?>
                                <div class="card-inner card-inner-md">
                                    <div class="user-card">
                                        <div class="user-avatar <?=$randomClass;?>">
                                            <span><?php echo strtoupper(getFirstLetters($new_user->name,2));?></span>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text"><?php echo $new_user->name;?> <?php echo $new_user->last_name;?></span>
                                            <span class="sub-text"><?php echo $new_user->email;?></span>
                                        </div>
                                        <!-- <div class="user-action">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger me-n1" data-bs-toggle="dropdown" aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="<?=base_url(ADMIN_URL.'/subadmin/edit_sub_admin/'.$new_user->id)?>"><em class="icon ni ni-setting"></em><span><?=getlang('edit')?></span></a></li>
                                                       
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <?php } ?>
                                
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <?php } ?>
                    <?php } ?>

                    <!-- <?php if($role=='administrator' || $role =='sub-administrator' && !empty($dashaccess) && in_array('contact_messages', $dashaccess)){?>
                    <?php if(!empty($contact_messages)){?>
                    <div class="col-lg-6 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title"><?=getlang('Contact_Messages');?></h6>
                                    </div>
                                    <div class="card-tools">
                                        <a href="<?=base_url(ADMIN_URL.'/settings/contact_messages');?>" class="link"><?=getlang('View_All');?></a>
                                    </div>
                                </div>
                            </div>
                            <ul class="nk-support scroll_ul">
                                <?php
                                $classes = array('bg-purple', 'bg-warning','bg-success');
                                shuffle($classes); 
                                foreach($contact_messages as $contact_message){
                                    $randomClass = array_pop($classes);
                                    ?>
                                <?php
                                $givenDateTime = new DateTime($contact_message->created_at);
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
                                <li class="nk-support-item">
                                    <div class="user-avatar <?=$randomClass?>">
                                    <span><?php echo strtoupper(getFirstLetters($contact_message->name,2));?></span>
                                    </div>
                                    <div class="nk-support-content">
                                        <div class="title">
                                            <span><?php echo $contact_message->name;?></span>
                                        </div>
                                        <p><?php echo substr($contact_message->subject,0, 200);?>...</p>
                                        <p><?php echo $contact_message->comment;?></p>
                                        <span class="time"><?=$diff?></span>
                                    </div>
                                </li>
                                <?php } ?>
                                
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>

                    <?php if($role=='administrator' || $role =='sub-administrator' && !empty($dashaccess) && in_array('general_notes', $dashaccess)){?>
                    <div class="col-lg-6 col-xxl-4">
                        <div class="card h-100">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title"><?=getlang('General_Notes')?></h6>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-inner">
                                <div class="sitemap button_div">
                                    <a href="<?php echo base_url('cron/sitemap');?>"> <?=getlang('Regenerate_XML_sitemap')?></a>
                                    <a href="<?php echo base_url('sitemap.xml');?>" download>  <?=getlang('Download_XML_sitemap')?></a>
                                </div>

                                <div class="googlefeed button_div">
                                    <a href="<?php echo base_url('cron/productfeed');?>"> <?=getlang('Regenerate_Google_shopping_feed')?></a>
                                    <a href="<?php echo base_url('product-feed.xml');?>" download>  <?=getlang('Download_XML_shopping')?></a>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                    <?php } ?> -->
                </div><!-- .row -->
            </div><!-- .nk-block -->
        </div>
    </div>
</div>
<!-- content @e -->

