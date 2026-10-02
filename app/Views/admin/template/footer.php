 <!-- footer @s -->
 <style>
.ck-content {
    resize: both;
    overflow: auto;
    max-width: 100%; /* Set maximum width */
}
  </style>
 <div class="nk-footer">
                    <div class="container-xl wide-xl">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; <?=date('Y');?>. <a href="<?php echo base_url('beheerpaneel');?>" target="_blank">Boeskool</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
     

    
    <?php if(service('router')->controllerName() == '\App\Controllers\Beheerpaneel\Dashboard'){?>
      <script src="<?php echo base_url(); ?>/assets/admin_new/js/charts/gd-campaign.js?ver=3.2.2"></script>
      <script src="<?php echo base_url(); ?>/assets/admin_new/js/charts/gd-default.js?ver=3.2.2"></script>
    <?php } ?>

    <script src="<?php echo base_url(); ?>/assets/admin_new/plugins/bower_components/toast-master/js/jquery.toast.js"></script> 
 
    <script src="<?php echo base_url(); ?>/assets/admin_new/js/darkmode.js"></script> 
<script src="<?php echo base_url().'assets/admin_new/js/bootstrap.bundle.min.js'; ?>"></script>

      
     

    <script>


    $(document).ready(function() {
      
        <?php 
          $session = \Config\Services::session();
          if($session->getFlashdata('adminsuccess')){ ?>

        toastr.clear();
            NioApp.Toast('<?php echo $session->getFlashdata('adminsuccess'); ?>', 'success');


          <?php } elseif($session->getFlashdata('error')){ ?>

          toastr.clear();
            NioApp.Toast('<?php echo $session->getFlashdata('error'); ?>', 'error');



          <?php } elseif($session->getFlashdata('Success_message')){ ?>

            toastr.clear();
            NioApp.Toast('<?php echo $session->getFlashdata('Success_message'); ?>', 'success');

        <?php }?>
    }); 

    </script>


<script>
    $(document).on('change','.orderstatus',function(){
        var order_status = $(this).val();
        var order_id = $(this).data('orderid');
        var notify_customer = $('.notify_customer_to').val();
        $.ajax({
            url: "<?php echo base_url(); ?>beheerpaneel/orders/updateorderstatus",
            type: 'POST',
            dataType: 'JSON',
            data: { order_status: order_status,order_id: order_id,notify_customer: notify_customer},
            success: function (response) {
                toastr.clear();
                NioApp.Toast('<?php echo getlang('Order_status_updated_succesfully'); ?>', 'success');
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        });
        
    })
</script>





<?php if(service('router')->controllerName() == '\App\Controllers\Beheerpaneel\Dashboard'){?>

<!-- orders graph script start -->
<?php
$get_salesorder_graph = get_orders_history_graph_data();
?>
<?php if(!empty($get_salesorder_graph)){?>
<script>
    var salesOverview = {
        labels: ["<?=$get_salesorder_graph['labels'][0]?>", "<?=$get_salesorder_graph['labels'][1]?>", "<?=$get_salesorder_graph['labels'][2]?>", "<?=$get_salesorder_graph['labels'][3]?>", "<?=$get_salesorder_graph['labels'][4]?>", "<?=$get_salesorder_graph['labels'][5]?>", "<?=$get_salesorder_graph['labels'][6]?>", "<?=$get_salesorder_graph['labels'][7]?>", "<?=$get_salesorder_graph['labels'][8]?>", "<?=$get_salesorder_graph['labels'][9]?>", "<?=$get_salesorder_graph['labels'][10]?>", "<?=$get_salesorder_graph['labels'][11]?>", "<?=$get_salesorder_graph['labels'][12]?>", "<?=$get_salesorder_graph['labels'][13]?>", "<?=$get_salesorder_graph['labels'][14]?>", "<?=$get_salesorder_graph['labels'][15]?>", "<?=$get_salesorder_graph['labels'][16]?>", "<?=$get_salesorder_graph['labels'][17]?>", "<?=$get_salesorder_graph['labels'][18]?>", "<?=$get_salesorder_graph['labels'][19]?>", "<?=$get_salesorder_graph['labels'][20]?>", "<?=$get_salesorder_graph['labels'][21]?>", "<?=$get_salesorder_graph['labels'][22]?>", "<?=$get_salesorder_graph['labels'][23]?>", "<?=$get_salesorder_graph['labels'][24]?>", "<?=$get_salesorder_graph['labels'][25]?>", "<?=$get_salesorder_graph['labels'][26]?>", "<?=$get_salesorder_graph['labels'][27]?>", "<?=$get_salesorder_graph['labels'][28]?>", "<?=$get_salesorder_graph['labels'][29]?>"],
        dataUnit: 'EURO',
        lineTension: 0.1,
        datasets: [{
        label: "Sales Overview",
        color: "#66CCFF",
        background: NioApp.hexRGB('#66CCFF', .3),
        data: [<?=$get_salesorder_graph['data'][0]?>, <?=$get_salesorder_graph['data'][1]?>, <?=$get_salesorder_graph['data'][2]?>, <?=$get_salesorder_graph['data'][3]?>, <?=$get_salesorder_graph['data'][4]?>, <?=$get_salesorder_graph['data'][5]?>, <?=$get_salesorder_graph['data'][6]?>, <?=$get_salesorder_graph['data'][7]?>, <?=$get_salesorder_graph['data'][8]?>, <?=$get_salesorder_graph['data'][9]?>, <?=$get_salesorder_graph['data'][10]?>, <?=$get_salesorder_graph['data'][11]?>, <?=$get_salesorder_graph['data'][12]?>, <?=$get_salesorder_graph['data'][13]?>, <?=$get_salesorder_graph['data'][14]?>, <?=$get_salesorder_graph['data'][15]?>, <?=$get_salesorder_graph['data'][16]?>, <?=$get_salesorder_graph['data'][17]?>, <?=$get_salesorder_graph['data'][18]?>, <?=$get_salesorder_graph['data'][19]?>, <?=$get_salesorder_graph['data'][20]?>, <?=$get_salesorder_graph['data'][21]?>, <?=$get_salesorder_graph['data'][22]?>, <?=$get_salesorder_graph['data'][23]?>, <?=$get_salesorder_graph['data'][24]?>, <?=$get_salesorder_graph['data'][25]?>, <?=$get_salesorder_graph['data'][26]?>, <?=$get_salesorder_graph['data'][27]?>, <?=$get_salesorder_graph['data'][28]?>, <?=$get_salesorder_graph['data'][29]?>]
        }]
    };
    function lineSalesOverview(selector, set_data) {
        var $selector = selector ? $(selector) : $('.sales-overview-chart');
        $selector.each(function () {
        var $self = $(this),
            _self_id = $self.attr('id'),
            _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;
        var selectCanvas = document.getElementById(_self_id).getContext("2d");
        var chart_data = [];
        for (var i = 0; i < _get_data.datasets.length; i++) {
            chart_data.push({
            label: _get_data.datasets[i].label,
            tension: _get_data.lineTension,
            backgroundColor: _get_data.datasets[i].background,
            fill: true,
            borderWidth: 2,
            borderColor: _get_data.datasets[i].color,
            pointBorderColor: "transparent",
            pointBackgroundColor: "transparent",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: _get_data.datasets[i].color,
            pointBorderWidth: 2,
            pointHoverRadius: 3,
            pointHoverBorderWidth: 2,
            pointRadius: 3,
            pointHitRadius: 3,
            data: _get_data.datasets[i].data
            });
        }
        var chart = new Chart(selectCanvas, {
            type: 'line',
            data: {
            labels: _get_data.labels,
            datasets: chart_data
            },
            options: {
            plugins: {
                legend: {
                display: _get_data.legend ? _get_data.legend : false,
                rtl: NioApp.State.isRTL,
                labels: {
                    boxWidth: 30,
                    padding: 20,
                    color: '#6783b8'
                }
                },
                tooltip: {
                enabled: true,
                rtl: NioApp.State.isRTL,
                callbacks: {
                    label: function label(context) {
                    return "".concat(context.parsed.y, " ").concat(_get_data.dataUnit);
                    }
                },
                backgroundColor: '#eff6ff',
                titleFont: {
                    size: 13
                },
                titleColor: '#6783b8',
                titleMarginBottom: 6,
                bodyColor: '#9eaecf',
                bodyFont: {
                    size: 12
                },
                bodySpacing: 4,
                padding: 10,
                footerMarginTop: 0,
                displayColors: false
                }
            },
            maintainAspectRatio: false,
            scales: {
                y: {
                display: true,
                stacked: _get_data.stacked ? _get_data.stacked : false,
                position: NioApp.State.isRTL ? "right" : "left",
                ticks: {
                    beginAtZero: true,
                    font: {
                    size: 11
                    },
                    color: '#9eaecf',
                    padding: 10,
                    callback: function callback(value, index, values) {
                    return "€ " + value;
                    },
                    min: 100,
                    stepSize: 3000
                },
                grid: {
                    color: NioApp.hexRGB("#526484", .2),
                    tickLength: 0,
                    zeroLineColor: NioApp.hexRGB("#526484", .2),
                    drawTicks: false
                }
                },
                x: {
                display: true,
                stacked: _get_data.stacked ? _get_data.stacked : false,
                ticks: {
                    font: {
                    size: 9
                    },
                    color: '#9eaecf',
                    source: 'auto',
                    padding: 10,
                    reverse: NioApp.State.isRTL
                },
                grid: {
                    color: "transparent",
                    tickLength: 0,
                    zeroLineColor: 'transparent',
                    drawTicks: false
                }
                }
            }
            }
        });
        });
    }

    // init chart
    NioApp.coms.docReady.push(function () {
        lineSalesOverview();
    });
</script>
<?php } ?>

<!-- orders graph script end -->

<!-- daily view graph script start -->

<?php
$get_six_month_daily_views = get_six_month_daily_views_graph_data();
?>
<?php if(!empty($get_six_month_daily_views)){?>
<script>
var currentMonthIndex = new Date().getMonth(); // Get the index of the current month (0-based)

var activeSubscription = {
    labels: ["<?=$get_six_month_daily_views['labels'][0]?>", "<?=$get_six_month_daily_views['labels'][1]?>", "<?=$get_six_month_daily_views['labels'][2]?>", "<?=$get_six_month_daily_views['labels'][3]?>", "<?=$get_six_month_daily_views['labels'][4]?>", "<?=$get_six_month_daily_views['labels'][5]?>"],
    dataUnit: "NO's",
    stacked: true,
    datasets: [{
        label: "Active User",
        color: ["#66CCFF", "#66CCFF", "#66CCFF", "#66CCFF", "#66CCFF", "#66CCFF"], // Default color for all bars
        activeColor: "#66CCFF", // Color for the active bar
        data: [<?=$get_six_month_daily_views['data'][0]?>, <?=$get_six_month_daily_views['data'][1]?>, <?=$get_six_month_daily_views['data'][2]?>, <?=$get_six_month_daily_views['data'][3]?>, <?=$get_six_month_daily_views['data'][4]?>, <?=$get_six_month_daily_views['data'][5]?>]
    }]
};

// Update the color array to highlight the active bar
activeSubscription.datasets[0].color[currentMonthIndex] = activeSubscription.datasets[0].activeColor;

function ViewsBarChart(selector, set_data) {
    var $selector = selector ? $(selector) : $('.views-bar-chart');
    $selector.each(function () {
        var $self = $(this),
            _self_id = $self.attr('id'),
            _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
            _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;
        var selectCanvas = document.getElementById(_self_id).getContext("2d");
        var chart_data = [];
        for (var i = 0; i < _get_data.datasets.length; i++) {
            chart_data.push({
                label: _get_data.datasets[i].label,
                data: _get_data.datasets[i].data,
                // Styles
                backgroundColor: _get_data.datasets[i].color,
                borderWidth: 2,
                borderColor: 'transparent',
                hoverBorderColor: 'transparent',
                borderSkipped: 'bottom',
                barPercentage: .7,
                categoryPercentage: .7
            });
        }
        var chart = new Chart(selectCanvas, {
            type: 'bar',
            data: {
                labels: _get_data.labels,
                datasets: chart_data
            },
            options: {
                plugins: {
                    legend: {
                        display: _get_data.legend ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth: 30,
                            padding: 20,
                            color: '#6783b8'
                        }
                    },
                    tooltip: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function title() {
                                return false;
                            },
                            label: function label(context) {
                                return "".concat(context.parsed.y, " ").concat(_get_data.dataUnit);
                            }
                        },
                        backgroundColor: '#eff6ff',
                        titleFont: {
                            size: 11
                        },
                        titleColor: '#6783b8',
                        titleMarginBottom: 4,
                        bodyColor: '#9eaecf',
                        bodyFont: {
                            size: 10
                        },
                        bodySpacing: 3,
                        padding: 8,
                        footerMarginTop: 0,
                        displayColors: false
                    }
                },
                maintainAspectRatio: false,
                scales: {
                    y: {
                        display: false,
                        stacked: _get_data.stacked ? _get_data.stacked : false,
                        ticks: {
                            beginAtZero: true
                        }
                    },
                    x: {
                        display: false,
                        stacked: _get_data.stacked ? _get_data.stacked : false,
                        ticks: {
                            reverse: NioApp.State.isRTL
                        }
                    }
                }
            }
        });
    });
}

// init chart
NioApp.coms.docReady.push(function () {
    ViewsBarChart();
});
</script>

<?php } ?>
<!-- daily view graph script end -->




<?php

$get_weekly_views_graph_data = get_weekly_views_graph_data();

?>
<?php if(!empty($get_weekly_views_graph_data)){?>
<script>
var currentDayIndex = new Date().getDay(); // Get the index of the current day (0-based)

var weeklyViews = {
    labels: ["<?=$get_weekly_views_graph_data['labels'][0]?>", "<?=$get_weekly_views_graph_data['labels'][1]?>", "<?=$get_weekly_views_graph_data['labels'][2]?>", "<?=$get_weekly_views_graph_data['labels'][3]?>", "<?=$get_weekly_views_graph_data['labels'][4]?>", "<?=$get_weekly_views_graph_data['labels'][5]?>", "<?=$get_weekly_views_graph_data['labels'][6]?>"],
    dataUnit: "NO's",
    stacked: true,
    datasets: [{
        label: "Weekly Views",
        color: ["#66CCFF", "#66CCFF", "#66CCFF", "#66CCFF", "#66CCFF", "#66CCFF", "#66CCFF"], // Default color for all bars
        activeColor: "#66CCFF", // Color for the active bar
        data: [<?=$get_weekly_views_graph_data['data'][0]?>, <?=$get_weekly_views_graph_data['data'][1]?>, <?=$get_weekly_views_graph_data['data'][2]?>, <?=$get_weekly_views_graph_data['data'][3]?>, <?=$get_weekly_views_graph_data['data'][4]?>, <?=$get_weekly_views_graph_data['data'][5]?>, <?=$get_weekly_views_graph_data['data'][6]?>]
    }]
};

// Update the color array to highlight the active bar
weeklyViews.datasets[0].color[currentDayIndex] = weeklyViews.datasets[0].activeColor;

function WeeklyViewsBarChart(selector, set_data) {
    var $selector = selector ? $(selector) : $('.weekly-views-bar-chart');
    $selector.each(function () {
        var $self = $(this),
            _self_id = $self.attr('id'),
            _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;
        var selectCanvas = document.getElementById(_self_id).getContext("2d");
        var chart_data = [];
        for (var i = 0; i < _get_data.datasets.length; i++) {
            chart_data.push({
                label: _get_data.datasets[i].label,
                data: _get_data.datasets[i].data,
                // Styles
                backgroundColor: _get_data.datasets[i].color,
                borderWidth: 2,
                borderColor: 'transparent',
                hoverBorderColor: 'transparent',
                borderSkipped: 'bottom',
                barPercentage: .7,
                categoryPercentage: .7
            });
        }
        var chart = new Chart(selectCanvas, {
            type: 'bar',
            data: {
                labels: _get_data.labels,
                datasets: chart_data
            },
            options: {
                plugins: {
                    legend: {
                        display: _get_data.legend ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth: 30,
                            padding: 20,
                            color: '#6783b8'
                        }
                    },
                    tooltip: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function title() {
                                return false;
                            },
                            label: function label(context) {
                                return "".concat(context.parsed.y, " ").concat(_get_data.dataUnit);
                            }
                        },
                        backgroundColor: '#eff6ff',
                        titleFont: {
                            size: 11
                        },
                        titleColor: '#6783b8',
                        titleMarginBottom: 4,
                        bodyColor: '#9eaecf',
                        bodyFont: {
                            size: 10
                        },
                        bodySpacing: 3,
                        padding: 8,
                        footerMarginTop: 0,
                        displayColors: false
                    }
                },
                maintainAspectRatio: false,
                scales: {
                    y: {
                        display: false,
                        stacked: _get_data.stacked ? _get_data.stacked : false,
                        ticks: {
                            beginAtZero: true
                        }
                    },
                    x: {
                        display: false,
                        stacked: _get_data.stacked ? _get_data.stacked : false,
                        ticks: {
                            reverse: NioApp.State.isRTL
                        }
                    }
                }
            }
        });
    });
}

// init chart
NioApp.coms.docReady.push(function () {
    WeeklyViewsBarChart();
});
</script>
<?php } ?>



<!-- orders bar chart script start -->
<?php
$get_order_bar_chart_data = get_order_bar_chart_data();
?>
<?php if(!empty($get_order_bar_chart_data)){?>
<script>



var salesRevenue = {
    labels: ["<?=$get_order_bar_chart_data['labels'][0]?>", "<?=$get_order_bar_chart_data['labels'][1]?>", "<?=$get_order_bar_chart_data['labels'][2]?>", "<?=$get_order_bar_chart_data['labels'][3]?>", "<?=$get_order_bar_chart_data['labels'][4]?>", "<?=$get_order_bar_chart_data['labels'][5]?>", "<?=$get_order_bar_chart_data['labels'][6]?>", "<?=$get_order_bar_chart_data['labels'][7]?>", "<?=$get_order_bar_chart_data['labels'][8]?>", "<?=$get_order_bar_chart_data['labels'][9]?>", "<?=$get_order_bar_chart_data['labels'][10]?>", "<?=$get_order_bar_chart_data['labels'][11]?>"],
    dataUnit: 'EURO',
    stacked: true,
    datasets: [{
      label: "Sales Revenue",
      color: [NioApp.hexRGB("#66CCFF", .2), NioApp.hexRGB("#66CCFF", .2), NioApp.hexRGB("#66CCFF", .2), NioApp.hexRGB("#66CCFF", .2), NioApp.hexRGB("#66CCFF", .2), NioApp.hexRGB("#66CCFF", .2), NioApp.hexRGB("#66CCFF", .2), NioApp.hexRGB("#66CCFF", .2), NioApp.hexRGB("#66CCFF", .2), NioApp.hexRGB("#66CCFF", .2), NioApp.hexRGB("#66CCFF", .2), "#66CCFF"],
      data: [<?=$get_order_bar_chart_data['data'][1]?>, <?=$get_order_bar_chart_data['data'][2]?>, <?=$get_order_bar_chart_data['data'][3]?>, <?=$get_order_bar_chart_data['data'][4]?>, <?=$get_order_bar_chart_data['data'][5]?>, <?=$get_order_bar_chart_data['data'][6]?>, <?=$get_order_bar_chart_data['data'][7]?>, <?=$get_order_bar_chart_data['data'][8]?>, <?=$get_order_bar_chart_data['data'][9]?>, <?=$get_order_bar_chart_data['data'][10]?>, <?=$get_order_bar_chart_data['data'][11]?>, <?=$get_order_bar_chart_data['data'][12]?>]
    }]
  };
    function salesBarChart(selector, set_data) {
    var $selector = selector ? $(selector) : $('.sales-bar-chart');
    $selector.each(function () {
      var $self = $(this),
        _self_id = $self.attr('id'),
        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
        _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;
      var selectCanvas = document.getElementById(_self_id).getContext("2d");
      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          label: _get_data.datasets[i].label,
          data: _get_data.datasets[i].data,
          // Styles
          backgroundColor: _get_data.datasets[i].color,
          borderWidth: 2,
          borderColor: 'transparent',
          hoverBorderColor: 'transparent',
          borderSkipped: 'bottom',
          barPercentage: .7,
          categoryPercentage: .7
        });
      }
      var chart = new Chart(selectCanvas, {
        type: 'bar',
        data: {
          labels: _get_data.labels,
          datasets: chart_data
        },
        options: {
          plugins: {
            legend: {
              display: _get_data.legend ? _get_data.legend : false,
              rtl: NioApp.State.isRTL,
              labels: {
                boxWidth: 30,
                padding: 20,
                color: '#6783b8'
              }
            },
            tooltip: {
              enabled: true,
              rtl: NioApp.State.isRTL,
              callbacks: {
                title: function title() {
                  return false;
                },
                label: function label(context) {
                  return "".concat(context.parsed.y, " ").concat(_get_data.dataUnit);
                }
              },
              backgroundColor: '#eff6ff',
              titleFont: {
                size: 11
              },
              titleColor: '#6783b8',
              titleMarginBottom: 4,
              bodyColor: '#9eaecf',
              bodyFont: {
                size: 10
              },
              bodySpacing: 3,
              padding: 8,
              footerMarginTop: 0,
              displayColors: false
            }
          },
          maintainAspectRatio: false,
          scales: {
            y: {
              display: false,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                beginAtZero: true
              }
            },
            x: {
              display: false,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                reverse: NioApp.State.isRTL
              }
            }
          }
        }
      });
    });
  }
  // init chart
  NioApp.coms.docReady.push(function () {
    salesBarChart();
  });
</script>

<?php } ?>

<?php echo view('beheerpaneel/template/footer_dashboard'); ?>


<?php } ?>

<script>
    $(document).ready(function () {
      const selectAllCheckbox = $('#selectAll');
    const delselect = $('#delselect');

    // Attach event handlers to the document for event delegation
    $(document).on('change', '.selectCheckbox', function () {
        const checkboxes = $('.selectCheckbox');
        selectAllCheckbox.prop('checked', checkboxes.length === checkboxes.filter(':checked').length);
        toggleDelselectDisplay();
    });

    selectAllCheckbox.change(function () {
        const checkboxes = $('.selectCheckbox');
        checkboxes.prop('checked', selectAllCheckbox.prop('checked'));
        toggleDelselectDisplay();
    });

    function toggleDelselectDisplay() {
        const checkedCount = $('.selectCheckbox:checked').length;
        delselect.css('display', (checkedCount >= 1 || selectAllCheckbox.prop('checked')) ? 'block' : 'none');
    }
    // $(document).ready(function(){
    //     $("#selectAll1").change(function(){
    //         if($(this).is(":checked")){
    //             console.log("hii");
    //             $(".selectCheckbox1").prop("checked", true);
    //         } else {
    //             $(".selectCheckbox1").prop("checked", false);
    //         }
    //     });
    // });

    delselect.click(function () {
      const checkboxes = $('.selectCheckbox');
        const confirmation = confirm('Are you sure you want to delete the selected rows?');
        if (confirmation) {
        const checkedValues = checkboxes.filter(':checked').map(function () {
            return this.name;
        }).get();

        // console.log(checkedValues);
        const type = $(this).closest('li').data('type');
        // console.log(type);

        if (checkedValues.length > 0) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('beheerpaneel/pages/deleteselectedid') ?>' + type, 
                data: { values: checkedValues,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                success: function (response) {
                    console.log(response);
                    location.reload();
                     
                }
            });
        }
    }
    });
});
</script>


<script>
  function toggleDarkMode() {
    const body = document.body;
    const darkModeEnabled = document.body.classList.contains('dark-mode'); // Toggle dark mode class
    // Set or remove the cookie based on dark mode state
    if (darkModeEnabled == false) {
      document.cookie = `darkMode=enabled; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/`;
    } else {
      // Remove the cookie by setting an expiry date in the past
      document.cookie = `darkMode=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
    }
  }

  // Add an event listener to the Dark Mode <li> element
  const darkModeLi = document.querySelector('.dark-switch');
  darkModeLi.addEventListener('click', toggleDarkMode);


  const darkModeCookie = getCookie('darkMode');
  if (darkModeCookie === 'enabled') {
    document.body.classList.add('dark-mode');
  }

  // Function to get the value of a cookie by its name
  function getCookie(cookieName) {
    const cookies = document.cookie.split('; ');
    for (const cookie of cookies) {
      const [name, value] = cookie.split('=');
      if (name === cookieName) {
        return value;
      }
    }
    return null;
  }

 
</script>

<script>
function confirmDelete(event) {
    if (confirm('Weet je zeker dat je wilt verwijderen?')) {
        return true; // Proceed with the link
    } else {
        event.preventDefault(); // Prevent the default behavior of the link
        return false;
    }
}
function confirmDelete1(event, element) {
    event.preventDefault(); // Prevent the default behavior of the link
    
    // Get the data attributes from the element
    const currentUrl = element.dataset.url;
    // Set the hidden input value
    document.getElementById('hiddenid').value = currentUrl;

    // Show the modal
    let modal = new bootstrap.Modal(document.getElementById('modalAlert2'));
    modal.show();
}
</script>
<div class="modal fade" tabindex="-1" id="modalAlert2" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body modal-body-lg text-center">
                <div class="nk-modal">
                    <input type="hidden" id="hiddenid" value="">
                    <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross" bgcolor="66CCFF"></em>
                    <h4 class="nk-modal-title"><?=getlang('Belangrijk!')?></h4>
                    <div class="nk-modal-text">
                        <p class="lead"><?=getlang('Weet_je_zeker_dat_je_dit_wilt_verwijderen?')?></p>
                        
                    </div>
                    <div class="nk-modal-action mt-5">
                        <a href="javascript:void(0);" class="btn btn-lg btn-mw btn-light" id="modalReturnBtn" data-bs-dismiss="modal"><?=getlang('no')?></a>
                        <a style="background-color:#66CCFF;" href="javascript:void(0);" class="btn btn-lg btn-mw bl_btn" id="modalConfirmBtn"><?=getlang('yes')?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let currentHref = null;

        // document.querySelectorAll('.delete-action').forEach(function (deleteLink) {
            // $('.delete-action').on('click', function (event) {
            //     event.preventDefault();
            //     console.log('hi');
            //     currentid = this.data('orderid');
            //     $('#hiddenid').val(currentid);
            //     let modal = new bootstrap.Modal(document.getElementById('modalAlert2'));
            //     modal.show();
            // });
        // });

        document.getElementById('modalReturnBtn').addEventListener('click', function () {
            currentHref = null;
            let modalElement = document.getElementById('modalAlert2');
            modalElement.style.display = 'none';
            console.log('testing');
        });

        document.getElementById('modalConfirmBtn').addEventListener('click', function () {

             // Get the URL from the hidden input
            const currentHref = document.getElementById('hiddenid').value;
            
            // console.log('Deleting item with URL: ' + currentHref);
            
            // Redirect to the delete URL
            if (currentHref) {
                window.location.href = currentHref;
            } else {
                location.reload();
            }
        });
    });

    </script>

<script>

    // Create an observer instance linked to the callback function
var observer = new MutationObserver(function(mutationsList, observer) {
    // Loop through each mutation
    for (var mutation of mutationsList) {
        // Check if the added nodes include a modal-backdrop
        if (mutation.addedNodes.length > 0) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1 && node.classList.contains('modal-backdrop')) {
                    // Remove the 'show' class or the entire modal-backdrop div
                    node.classList.remove('modal-backdrop');
                    node.classList.remove('show');

                    // Or remove the entire node
                    // node.remove();
                }
            });
        }
    }
});

// Start observing the document with the configured parameters
observer.observe(document.body, {
    childList: true,
    subtree: true
});
$(document).ready(function() {
    $('.close').click(function() {
        $(this).closest('.modal').modal('hide');
    });

    $('.note-btn').click(function() {
        var noteBtnAriaLabel = $(this).attr('aria-label');

        if (noteBtnAriaLabel && noteBtnAriaLabel.includes('Picture')) {
            $(this).siblings('.modal').each(function() {
                var modalAriaLabel = $(this).attr('aria-label');
                
                if (modalAriaLabel && modalAriaLabel.includes('Insert Image')) {
                    $(this).modal('show');
                }
            });
        }
    });
});
</script>
<script>
        $(document).ready(function() {
            if ($('.summernote-basic').length > 0) {
            var script = document.createElement('script');
            script.src = "<?php echo base_url().'assets/admin_new/js/bootstrap.bundle.min.js'; ?>";
            script.onload = function() {
                // console.log('bootstrap.bundle.min.js has been loaded successfully.');
            };
           
            
            // Append the script to the body
            document.body.appendChild(script);

                $('.summernote-basic').summernote({
                    height: 300,                 // set the height of the editor
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: true,                 // set focus to editable area after initializing summernote
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
            }
        });
    </script>
 
<?php if($method == 'menu_settings'){ 
        echo minifier('nestable.min.css'); 
        echo minifier('nestable.min.js'); 
 } ?>

<?php echo minifier('bottomadminfooter.min.js');   ?>




</body>

</html>