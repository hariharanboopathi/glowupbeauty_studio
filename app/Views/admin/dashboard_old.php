<!-- content @s -->
<div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-xl">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title"><?=getlang('Company_Management')?></h3>
                                        <div class="nk-block-des text-soft">
                                            <!-- <p>Welcome to Campaign Management Dashboard.</p> -->
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                    <div class="nk-block-head-content">
                                        <div class="toggle-wrap nk-block-tools-toggle">
                                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                            <!-- <div class="toggle-expand-content" data-content="pageMenu">
                                                <ul class="nk-block-tools g-3">
                                                    <li>
                                                        <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em><span><span class="d-md-none">Add</span><span class="d-none d-md-block">Add Campaign</span></span></a>
                                                    </li>
                                                    <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                                                </ul>
                                            </div> -->
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="row g-gs">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="card h-100 bg-primary">
                                            <div class="nk-cmwg nk-cmwg1">
                                                <div class="card-inner pt-3">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="flex-item">
                                                            <div class="text-white d-flex flex-wrap">
                                                                <span class="fs-2 me-1"><?php if(!empty($product_count)){echo $product_count; } ?></span>
                                                            </div>
                                                            <h6 class="text-white"><?=getlang("Total_products")?></h6>
                                                        </div>
                                                    </div>
                                                </div><!-- .card-inner -->
                                                <div class="nk-ck-wrap mt-auto overflow-hidden rounded-bottom">
                                                    <div class="nk-cmwg1-ck">
                                                        <canvas class="campaign-line-chart-s1 rounded-bottom" id="runningCampaign"></canvas>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-cmwg -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="card h-100 bg-info">
                                            <div class="nk-cmwg nk-cmwg1">
                                                <div class="card-inner pt-3">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="flex-item">
                                                            <div class="text-white d-flex flex-wrap">
                                                                <span class="fs-2 me-1"><?php if(!empty($order_count)){echo $order_count; } ?></span>
                                                            </div>
                                                            <h6 class="text-white"><?=getlang("Total_orders")?></h6>
                                                        </div>
                                                    </div>
                                                </div><!-- .card-inner -->
                                                <div class="nk-cmwg1-ck mt-auto">
                                                    <canvas class="campaign-line-chart-s1 rounded-bottom" id="totalAudience"></canvas>
                                                </div>
                                            </div><!-- .nk-cmwg -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="card h-100 bg-warning">
                                            <div class="nk-cmwg nk-cmwg1">
                                                <div class="card-inner pt-3">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="flex-item">
                                                            <div class="text-white d-flex flex-wrap">
                                                            <?php $db = \Config\Database::connect();

                                                                // Fetch the overall views count
                                                                $query = $db->table('views')->selectSum('views')->get();

                                                                // Get the result row
                                                                $result = $query->getRow();

                                                                // Get the overall views count
                                                                $overallViewsCount = $result->views;
                                                                ?>
                                                                <span class="fs-2 me-1"><?php if(!empty($overallViewsCount)){ echo $overallViewsCount; }?></span>
                                                            </div>
                                                            <h6 class="text-white"><?=getlang("No_of_visits")?></h6>
                                                        </div>
                                                    </div>
                                                </div><!-- .card-inner -->
                                                <div class="nk-ck-wrap mt-auto overflow-hidden rounded-bottom">
                                                    <div class="nk-cmwg1-ck">
                                                        <canvas class="campaign-bar-chart-s1 rounded-bottom" id="avgRating"></canvas>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-cmwg -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="card h-100 bg-danger">
                                            <div class="nk-cmwg nk-cmwg1">
                                                <div class="card-inner pt-3">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="flex-item">
                                                            <div class="text-white d-flex flex-wrap">
                                                            <span class="fs-2 me-1"><?php if(!empty($news_count)){echo $news_count; } ?></span>
                                                            </div>
                                                            <h6 class="text-white"><?=getlang("Total_news")?></h6>
                                                        </div>
                                                    </div>
                                                </div><!-- .card-inner -->
                                                <div class="nk-ck-wrap mt-auto overflow-hidden rounded-bottom">
                                                    <div class="nk-cmwg1-ck">
                                                        <canvas class="campaign-line-chart-s1 rounded-bottom" id="newSubscriber"></canvas>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-cmwg -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div><!-- .nk-block -->
                        </div>
                    </div>
                </div>
                <!-- content @e -->