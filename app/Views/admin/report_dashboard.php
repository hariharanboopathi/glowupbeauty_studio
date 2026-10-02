
<div class="nk-content nk-content-fluid db">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">

            
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title"><?=getlang('Report')?></h3>

                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->


            <div class="nk-block stat-top">
                <div class="row g-gs">
                    <div class="col-12">
                        <div class="num-stat card">
                            <div class="card-inner">
                                <div class="nstat-head card-head">
                                    <div class="dates">
                                        <input type="text" id="dateField1" name="daterange1" class="form-control">
                                    </div>
                                    <strong>VS</strong>
                                    <div class="dates">
                                        <input type="text" id="dateField2" name="daterange1" class="form-control">

                                    </div>
                                    <span style="float:right"><button id="downloadCsvButton" class="btn btn-primary" ><?=getlang('Download_CSV')?></button></span>
                                        
                                </div>
                                <div class="nstat-of">
                                    <div class="nstat-in">

                                            <div class="card sales">
                                                <div class="nk-cmwg nk-cmwg1">
                                                    <div class="card-inner">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="flex-item">
                                                                <div class="d-flex nstat-logo">
                                                                    <span class="icon"><img src="<?=image_url('uploads/dashboard_new/trade-up-icon.svg')?>" alt="trade up"></span>
                                                                        <span class="align-self-end ns-value">
                                                                            <em class="icon ni ni-arrow-right"></em>0%
                                                                        </span>
                                                                </div>
                                                                <span>
                                                                    <h6 id="gross_sales">€ 0,00</h6>
                                                                    <strong><?=getlang('Gross_sales')?></strong>
                                                                    <b class="previousyear" style="display:none"><?=getlang('Previous_year')?> :<span id="pre_gross_sales">€ 0,00</span></b>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-inner -->
                                                </div><!-- .nk-cmwg -->
                                            </div><!-- .card -->

                                            <div class="card returns">
                                                <div class="nk-cmwg nk-cmwg1">
                                                    <div class="card-inner">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="flex-item">
                                                                <div class="d-flex nstat-logo">
                                                                    <span class="icon"><img src="<?=image_url('uploads/dashboard_new/arrow-icon.svg')?>" alt="return"></span>
                                                                    <span class="align-self-end ns-value"><em class="icon ni ni-arrow-right"></em>0%</span>
                                                                </div>
                                                                <h6>€0.00</h6>
                                                                <strong><?=getlang('Returns')?></strong>
                                                                <b class="previousyear" style="display:none"><?=getlang('Previous_year')?> :<span>€0.00</span></b>
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-inner -->
                                                </div><!-- .nk-cmwg -->
                                            </div><!-- .card -->

                                            <div class="card taxes">
                                                <div class="nk-cmwg nk-cmwg1">
                                                    <div class="card-inner">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="flex-item">
                                                                <div class="d-flex nstat-logo">
                                                                    <span class="icon"><img src="<?=image_url('uploads/dashboard_new/doc-icon.svg')?>" alt="doc"></span>
                                                                    <span class="align-self-end ns-value"><em class="icon ni ni-arrow-right"></em>0%</span>
                                                                </div>
                                                                <h6 id="customvat">€0.00</h6>
                                                                <strong><?=getlang('Taxes')?></strong>
                                                                <b class="previousyear" style="display:none"><?=getlang('Previous_year')?> :<span id="previousvat">€0.00</span></b>
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-inner -->
                                                </div><!-- .nk-cmwg -->
                                            </div><!-- .card -->

                                            <div class="card shipping">
                                                <div class="nk-cmwg nk-cmwg1">
                                                    <div class="card-inner">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="flex-item">
                                                                <div class="d-flex nstat-logo">
                                                                    <span class="icon"><img src="<?=image_url('uploads/dashboard_new/truck-icon.svg')?>" alt="truck"></span>
                                                                    <span class="align-self-end ns-value"><em class="icon ni ni-arrow-right"></em>0%</span>
                                                                </div>
                                                                <h6 id="customship">€0.00</h6>
                                                                <strong><?=getlang('Shipping_costs')?></strong>
                                                                <b class="previousyear" style="display:none"><?=getlang('Previous_year')?> :<span id="previousship">€0.00</span></b>
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-inner -->
                                                </div><!-- .nk-cmwg -->
                                            </div><!-- .card -->

                                            <div class="card values">
                                                <div class="nk-cmwg nk-cmwg1">
                                                    <div class="card-inner">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="flex-item">
                                                                <div class="d-flex nstat-logo">
                                                                    <span class="icon"><img src="<?=image_url('uploads/dashboard_new/value-icon.svg')?>" alt="value"></span>
                                                                    <span class="align-self-end ns-value"><em class="icon ni ni-arrow-right"></em>0%</span>
                                                                </div>
                                                                <h6 id="customtotal">€0.00</h6>
                                                                <strong><?=getlang('Total_value')?></strong>
                                                                <b class="previousyear" style="display:none"><?=getlang('Previous_year')?> :<span id="previoustotal">€0.00</span></b>
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-inner -->
                                                </div><!-- .nk-cmwg -->
                                            </div><!-- .card -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .row -->
            </div><!-- .nk-block -->

            <div class="nk-block stat-graph">
                <div class="card card-preview">
                    <div class="card-inner">
                        <div class="card-head">
                            <h6 class="title"><?=getlang('Gross_sales')?></h6>
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#graphChart"><img src="<?=image_url('uploads/dashboard_new/g-icon.svg')?>" alt="graph icon"></a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#barChart"><img src="<?=image_url('uploads/dashboard_new/b-icon.svg')?>" alt="bar icon"></a></li>
                            </ul>
                        </div>
                        <!-- <div class="nk-ck"> -->
                            <div class="tab-content">
                                <div id="graphChart" class="tab-pane fade active show">
                                    <div class="nk-ck">
                                        <canvas class="gs_line-chart" id="gs_straightLineChart"></canvas>
                                    </div>
                                </div>
                                <div id="barChart" class="tab-pane fade">
                                    <div class="nk-ck">
                                        <canvas class="bar-chart2" id="grossSaleBarChart"></canvas> 
                                    </div>
                                </div>
                            </div>
                        <div class="gValue">
                            <label class="dateOne"><b id="customdate"></b></label><strong id="custom">€0.00</strong>
                        </div>
                        <div class="gValue previousyear" style="display:none">
                            <label class="dateTwo"><b id="previousdate"></b></label><strong id="previous">€0.00</strong>
                        </div>
                        
                    </div>
                   
                    

                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col"><?=getlang('Date')?></th>
                                    <th scope="col"><?=getlang('Orders')?></th>
                                    <th scope="col"><?=getlang('Gross_sales')?></th>
                                    <th scope="col"><?=getlang('Returns')?></th>
                                    <th scope="col"><?=getlang('Taxes')?></th>
                                    <th scope="col"><?=getlang('Shipping')?></th>
                                    <th scope="col"><?=getlang('Total_sales')?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7" style="text-align: center;"><?=getlang('No data available for this date range')?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                                   
                </div><!-- .card-preview -->
            </div><!-- .nk-block -->

            <div class="nk-block">
                <div class="row g-gs b-stat">
                    <div class="col stat-bar">
                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h6 class="title"><?=getlang('Payment methods')?></h6>
                                    <div class="dates">
                                        <input type="text" id="dateField3" name="daterange" class="form-control">
                                        <!-- <input type="date"> -->
                                    </div>
                                </div>
                                <div class="baroverflow">
                                    <div class="nk-ck">
                                        <canvas class="bar-chart1" id="paymentMethodBarChart"></canvas>
                                    </div>
                                </div>
                                
                                <!-- <div class="checkBoxs">
                                    <label class="iDeal check"><input type="checkbox" name="" class="iDeal" checked><b>iDeal</b></label>
                                    <label class="Creditcardl check"><input type="checkbox" name="Creditcardl" class="Creditcardl" checked><b>Creditcardl</b></label>
                                    <label class="Paypal check"><input type="checkbox" name="Paypal" class="Paypal" checked><b>Paypal</b></label>
                                    <label class="Overboeken check"><input type="checkbox" name="Overboeken" class="Overboeken" checked><b>Overboeken</b></label>
                                    <label class="Bancontact check"><input type="checkbox" name="Bancontact" class="Bancontact" checked><b>Bancontact</b></label>
                                    <label class="Klarna-Betaal check"><input type="checkbox" name="Klarna-Betaal" class="Klarna-Betaal" checked><b>Klarna Betaal</b></label>
                                    <label class="Przelewy24 check"><input type="checkbox" name="Przelewy24" class="Przelewy24" checked><b>Przelewy24</b></label>
                                </div> -->
                            </div>
                        </div><!-- .card-preview -->
                    </div>
                    <div class="col stat-pie">
                        <div class="card card-preview">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h6 class="title"><?=getlang('Best sold products')?></h6>
                                    <div class="dates">
                                        <input type="text" id="dateField4" name="daterange" placeholder="MM-DD-YYYY" value="" class="form-control">
                                        <!-- <input type="date"> -->
                                    </div>
                                </div>
                                <div class="nk-ck">
                                    <canvas class="doughnut-chart" id="soldProductDoughnutChart"></canvas>
                                </div>
                            </div>
                        </div><!-- .card-preview -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- content @e -->

<script src="<?=base_url('assets/admin_new/js/dashboard-chart.js')?>"></script>
