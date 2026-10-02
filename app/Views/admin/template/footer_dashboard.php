<?php 
$db = \Config\Database::connect();

$paymentTypesData = $db->table('boeskool_orders')
    ->select('payment_type') 
    ->where('payment_type !=', '') 
    ->groupBy('payment_type')
    ->get()
    ->getResultArray();

$paymentTypes = array_column($paymentTypesData, 'payment_type');

$paymentTypesJson = json_encode($paymentTypes);
?>
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

 <script>
      var paymentTypes = <?php echo $paymentTypesJson; ?>;
      function getColorForPaymentType(type) {
          const colors = {
              ideal: "#ff1c1c",
              creditcard: "#a6c011",
              paypal: "#5490bd",
              klarna: "#dd4e80",
              bancontact: "#e37432",
              klarnapaylater: "#777c80",
          };
          return colors[type] || "#000000";
      }
      var datasets = paymentTypes.map(type => ({
        label: type,
        color: getColorForPaymentType(type),
        data: [0]
    }));
    var paymentMethodBarChart1 = {
      labels: ["1"],
        dataUnit: '',
        datasets: datasets,
        legend:true,
    };
  var chartInstance = null;

function barChart1(selector, set_data) {
    // console.log(selector);
    var $selector = selector ? $(selector) : $('.bar-chart1');
    $selector.each(function () {
        var $self = $(this),
            _self_id = $self.attr('id'),
            _get_data = typeof set_data === 'undefined' ? paymentMethodBarChart1 : set_data,
            _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;
        var selectCanvas = document.getElementById(_self_id).getContext("2d");
        
        if (chartInstance) {
            chartInstance.destroy();
        }

        var chart_data = [];
        for (var i = 0; i < _get_data.datasets.length; i++) {
            chart_data.push({
                label: _get_data.datasets[i].label,
                data: _get_data.datasets[i].data,
                backgroundColor: _get_data.datasets[i].color,
                borderWidth: 2,
                borderColor: 'transparent',
                hoverBorderColor: 'transparent',
                borderSkipped: 'bottom',
                barPercentage: 0.8,
                categoryPercentage: 0.6
            });
        }

        chartInstance = new Chart(selectCanvas, {
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
                            stepSize: 20,
                            font: {
                                size: 12
                            },
                            color: '#9eaecf',
                            // callback: function (value) {
                            //     return value + '%';
                            // }
                        },
                        min: 0,
                        max: 100,
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
                          padding: 15,
                          margin:50,
                            font: {
                                size: 12
                            },
                            color: '#9eaecf',
                            source: 'auto',
                            reverse: NioApp.State.isRTL
                        },
                        grid: {
                            color: "transparent",
                            tickLength: 10,
                            zeroLineColor: 'transparent',
                            drawTicks: false
                        }
                    }
                }
            }
        });
    });
}
function processDataForChart1(jsonData, startDateFormatted, days) {
      const labels = [];
      const paymentCounts = {};

      for (let i = 0; i < days; i++) {
        // labels.push(i + 1);

        const date = new Date(startDateFormatted + 'T00:00:00');

        date.setDate(date.getDate() + i);  
    const formattedDate = date.toLocaleDateString('en-CA');
    labels.push(formattedDate);


        paymentCounts[formattedDate] = {};
        jsonData.paymentTypesData.forEach((paymentType) => {
            paymentCounts[formattedDate][paymentType.payment_type] = 0;
        });
    }

      jsonData.data.forEach((entry) => {
          const orderDate = entry.order_created.split(' ')[0];
          const paymentType = entry.payment_type;

          if (paymentCounts[orderDate]) {
              paymentCounts[orderDate][paymentType] = (paymentCounts[orderDate][paymentType] || 0) + 1;
          }
      });

      const paymentTypes = jsonData.paymentTypesData.map(function (item) {
          return item.payment_type;
      });


      const datasets = paymentTypes.map((type) => ({
          label: type.charAt(0).toUpperCase() + type.slice(1),
          color: getColorForPaymentType(type),
          data: labels.map((_, index) => paymentCounts[Object.keys(paymentCounts)[index]]?.[type] || 0)
      }));

      return { labels, datasets, paymentTypes };
  }

  function getColorForPaymentType(type) {
      const colors = {
          ideal: "#ff1c1c",
          creditcard: "#a6c011",
          paypal: "#5490bd",
          klarna: "#dd4e80",
          bancontact: "#e37432",
          klarnapaylater: "#777c80",
      };
      return colors[type] || "#000000";
  }

    const response = <?php echo getPaymentDataByDateRange(); ?>;
    const start = new Date(response[0].startDate);
    const end = new Date(response[0].endDate);

    let dynamicNumberOfDays = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;


const chartData = processDataForChart1(response[0], response[0].startDate, dynamicNumberOfDays);

var paymentMethodBarChart = {
    labels: chartData.labels,
    dataUnit: '',
    datasets: chartData.datasets,
    legend: true,
};

barChart1(null, paymentMethodBarChart);
$('#dateField3').on('apply.daterangepicker', function (ev, picker) {
  const dateRange = $(this).val();
    const dates = dateRange.split(' - ');
    const startDate = dates[0] ? new Date(dates[0].trim()) : null;
    const endDate = dates[1] ? new Date(dates[1].trim()) : null;

    const startDateFormatted = startDate ? startDate.toLocaleDateString('en-CA') : null; // 'en-CA' uses YYYY-MM-DD format
    const endDateFormatted = endDate ? endDate.toLocaleDateString('en-CA') : null;

    var csrfhash = $('[name=<?=csrf_token();?>]').val();

    // console.log('Start Datestart:', startDateFormatted);
    // console.log('End Dateend:', endDateFormatted);

    if (startDateFormatted && endDateFormatted) {
        $.ajax({
            url: '<?= base_url(ADMIN_URL) ?>dashboard/getPaymentDataByDateRange',
            type: 'POST',
            data: {
                start_date: startDateFormatted,
                end_date: endDateFormatted,
                '<?=csrf_token();?>': csrfhash
            },
            success: function (response) {
              // console.log('res',response);
                if (response.success) {
                    function processDataForChart(jsonData, startDateFormatted, days) {
                        const labels = [];
                        const paymentCounts = {};

                        for (let i = 0; i < days; i++) {
                          // labels.push(i + 1);

                          const date = new Date(startDateFormatted + 'T00:00:00');
                          date.setDate(date.getDate() + i);
                          const formattedDate = date.toLocaleDateString('en-CA');
                          // console.log(formattedDate); 
                          labels.push(formattedDate);
                          paymentCounts[formattedDate] = {};
                          response.paymentTypesData.forEach((paymentType) => {
                              paymentCounts[formattedDate][paymentType.payment_type] = 0;
                          });
                      }

                        jsonData.data.forEach((entry) => {
                            const orderDate = entry.order_created.split(' ')[0]; 
                            const paymentType = entry.payment_type;

                            if (paymentCounts[orderDate]) {
                                paymentCounts[orderDate][paymentType] = (paymentCounts[orderDate][paymentType] || 0) + 1;
                            }
                        });

                        const paymentTypes = response.paymentTypesData.map(function (item) {
                            return item.payment_type;
                        });
                        // console.log('Payment Types:', paymentTypes);

                        const datasets = paymentTypes.map((type) => ({
                            label: type.charAt(0).toUpperCase() + type.slice(1),
                            color: getColorForPaymentType(type),
                            data: labels.map((_, index) => paymentCounts[Object.keys(paymentCounts)[index]]?.[type] || 0)
                        }));

                        return { labels, datasets, paymentTypes };
                    }

                    function getColorForPaymentType(type) {
                        const colors = {
                            ideal: "#ff1c1c",
                            creditcard: "#a6c011",
                            paypal: "#5490bd",
                            klarna: "#dd4e80",
                            bancontact: "#e37432",
                            klarnapaylater: "#777c80",
                        };
                        return colors[type] || "#000000";
                    }

                    let startDate = dates[0] ? new Date(dates[0].trim()) : null;
    let endDate = dates[1] ? new Date(dates[1].trim()) : null;

    let startDateFormatted = startDate ? startDate.toLocaleDateString('en-CA') : null; 
    let endDateFormatted = endDate ? endDate.toLocaleDateString('en-CA') : null;

                    const start = new Date(response.startDate);
                    const end = new Date(response.endDate);
                    const dynamicNumberOfDays = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;

                    // console.log('Start Date:', startDateFormatted);
                    // console.log('End Date:', endDateFormatted);
                    // console.log('Number of Days:', dynamicNumberOfDays);

                    const chartData = processDataForChart(response, startDateFormatted, dynamicNumberOfDays);

                    var paymentMethodBarChart = {
                        labels: chartData.labels,
                        dataUnit: '',
                        datasets: chartData.datasets,
                        legend: true,
                    };

                    // console.log(paymentMethodBarChart);
                    barChart1(null, paymentMethodBarChart); 
                } else {
                    console.error('No data found for the selected date range.');
                }
            },
            complete: function() {
            $.get("<?=base_url('home/getcsrfkey') ?>", function(keyupdate){
                $('[name=<?=csrf_token();?>]').val(keyupdate);
            });
        },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    } else {
        alert('Please select a valid date range.');
    }
});



const initialData = <?php echo getBestSoldProductDataByDateRange(); ?>;

    const labels = initialData.map(item => item.product_name);
    const values = initialData.map(item => parseInt(item.sold_count));

    const staticColors = [
    "#e57431", "#a5c139", "#5291be", "#de4e80", 
    "#ffcc00", "#8e44ad", "#2ecc71", "#3498db", 
    "#e67e22", "#9b59b6"
];
    const backgroundColors = values.map((count, index) => {
        if (count === -1) {
            return "#808080";
        } else {
            return staticColors[index % staticColors.length];
        }
    });

    const soldProductDoughnutChart = {
        labels: labels,
        dataUnit: '',
        legend: false,
        datasets: [{
            borderColor: "#fff",
            background: backgroundColors,
            data: values
        }]
    };

  var chartInstanceDoughnut = null;

  function doughnutChart1(selector, set_data) {
    var $selector = selector ? $(selector) : $('.doughnut-chart');
    $selector.each(function () {
      var $self = $(this),
        _self_id = $self.attr('id'),
        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;
      var selectCanvas = document.getElementById(_self_id).getContext("2d");

      if (chartInstanceDoughnut) {
        chartInstanceDoughnut.destroy();
        }

      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          backgroundColor: _get_data.datasets[i].background,
          borderWidth: 5,
          borderColor: _get_data.datasets[i].borderColor,
          hoverBorderColor: _get_data.datasets[i].borderColor,
          data: _get_data.datasets[i].data
        });
      }
      chartInstanceDoughnut = new Chart(selectCanvas, {
        type: 'doughnut',
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
                boxWidth: 12,
                padding: 20,
                color: '#6783b8'
              }
            },
            tooltip: {
              enabled: true,
              rtl: NioApp.State.isRTL,
              callbacks: {
                label: function label(context) {
                  return "".concat(context.parsed, " ").concat(_get_data.dataUnit);
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
          rotation: 1,
          cutoutPercentage: 40,
          maintainAspectRatio: false
        }
      });
    });
  }

  NioApp.coms.docReady.push(function () {
    doughnutChart1();

});

$('#dateField4').on('apply.daterangepicker', function (ev, picker) {

    const dateRange = $(this).val();
    const dates = dateRange.split(' - ');
    const startDate = dates[0] ? new Date(dates[0].trim()) : null;
    const endDate = dates[1] ? new Date(dates[1].trim()) : null;

    const startDateFormatted = startDate ? startDate.toLocaleDateString('en-CA') : null;
    const endDateFormatted = endDate ? endDate.toLocaleDateString('en-CA') : null;

    var csrfhash = $('[name=<?=csrf_token();?>]').val();

    // console.log('Start Date1111:', startDateFormatted);
    // console.log('End Date111:', endDateFormatted);

    if (startDateFormatted && endDateFormatted) {
        $.ajax({
            url: '<?= base_url(ADMIN_URL) ?>dashboard/getBestSoldProductDataByDateRange',
            type: 'POST',
            data: {
                start_date: startDateFormatted,
                end_date: endDateFormatted,
                '<?=csrf_token();?>': csrfhash
            },
            success: function (response) {
                // console.log(response);
                const data = response.data;

            const labels = data.map(item => item.product_name);
            const values = data.map(item => parseInt(item.sold_count));
            
            const staticColors = [
    "#e57431", "#a5c139", "#5291be", "#de4e80", 
    "#ffcc00", "#8e44ad", "#2ecc71", "#3498db", 
    "#e67e22", "#9b59b6"
];
    const backgroundColors = values.map((count, index) => {
        if (count === -1) {
            return "#808080";
        } else {
            return staticColors[index % staticColors.length];
        }
    });
            const soldProductDoughnutChart = {
                labels: labels,
                dataUnit: '',
                legend: false,
                datasets: [{
                    borderColor: "#fff",
                    background: backgroundColors,
                    data: values
                }]
            };

            doughnutChart1(null, soldProductDoughnutChart);
               
            },
            complete: function() {
            $.get("<?=base_url('home/getcsrfkey') ?>", function(keyupdate){
                $('[name=<?=csrf_token();?>]').val(keyupdate);
            });
        },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    } else {
        alert('Please select a valid date range.');
    }
});

var gs_straightLineChart = {
    labels: '',
    dataUnit: 'BTC',
    lineTension: 0,
    legend: true,
    datasets: [
        {
            label: "Gross sales",
            color: "#a6c011",
            background: 'transparent',
            data: ''
        },
        {
            label: "Returns",
            color: "#e37432",
            background: 'transparent',
            data: ''
        },
        {
            label: "Taxes",
            color: "#5490bd",
            background: 'transparent',
            data: ''
        },
        {
            label: "Shipping costs",
            color: "#dd4e80",
            background: 'transparent',
            data: ''
        },
        {
            label: "Total value",
            color: "#131313",
            background: 'transparent',
            data: ''
        },
        {
            label: "Previous year Gross sales",
            color: "#caeb14",
            background: 'transparent',
            data: ''
        },
        {
            label: "Previous year Returns",
            color: "#ea9462",
            background: 'transparent',
            data: ''
        },
        {
            label: "Previous year Taxes",
            color: "#91b7d4",
            background: 'transparent',
            data: ''
        },
        {
            label: "Previous year Shipping costs",
            color: "#e77ea3",
            background: 'transparent',
            data: ''
        },
        {
            label: "Previous year Total value",
            color: "#404040",
            background: 'transparent',
            data: ''
        },
    ]
  };


  var gs_lineChartInstanceDoughnut = null;
  

  function gs_lineChart(selector, set_data) {
    var $selector = selector ? $(selector) : $('.gs_line-chart');
    $selector.each(function () {
      var $self = $(this),
        _self_id = $self.attr('id'),
        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;
      var selectCanvas = document.getElementById(_self_id).getContext("2d");
      if (gs_lineChartInstanceDoughnut) {
    gs_lineChartInstanceDoughnut.destroy();
        }
      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          label: _get_data.datasets[i].label,
          tension: _get_data.lineTension,
          backgroundColor: _get_data.datasets[i].background,
          fill: true,
          borderWidth: 2,
          borderColor: _get_data.datasets[i].color,
          pointBorderColor: _get_data.datasets[i].color,
          pointBackgroundColor: '#fff',
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: _get_data.datasets[i].color,
          pointBorderWidth: 2,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 2,
          pointRadius: 4,
          pointHitRadius: 4,
          data: _get_data.datasets[i].data
        });
      }
       gs_lineChartInstanceDoughnut = new Chart(selectCanvas, {
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
                boxWidth: 12,
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
              position: NioApp.State.isRTL ? "right" : "left",
              ticks: {
                beginAtZero: false,
                font: {
                  size: 12
                },
                color: '#9eaecf',
                padding: 10
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
              ticks: {
                font: {
                  size: 12
                },
                color: '#9eaecf',
                source: 'auto',
                padding: 15,
                reverse: NioApp.State.isRTL
              },
              grid: {
                color: "transparent",
                tickLength: 10,
                zeroLineColor: NioApp.hexRGB("#526484", .2),
                offset: true,
                drawTicks: false
              }
            }
          }
        }
      });
    });
  }

  var grossSaleBarChart = {
    labels: '',
    dataUnit: 'BTC',
    lineTension: 0,
    legend: true,
    datasets: [
        {
            label: "Gross sales",
            color: "#a6c011",
            background: 'transparent',
            data: ''
        },
        {
            label: "Returns",
            color: "#e37432",
            background: 'transparent',
            data: ''
        },
        {
            label: "Taxes",
            color: "#5490bd",
            background: 'transparent',
            data: ''
        },
        {
            label: "Shipping costs",
            color: "#dd4e80",
            background: 'transparent',
            data: ''
        },
        {
            label: "Total value",
            color: "#131313",
            background: 'transparent',
            data: ''
        },
        {
            label: "Previous year Gross sales",
            color: "#caeb14",
            background: 'transparent',
            data: ''
        },
        {
            label: "Previous year Returns",
            color: "#ea9462",
            background: 'transparent',
            data: ''
        },
        {
            label: "Previous year Taxes",
            color: "#91b7d4",
            background: 'transparent',
            data: ''
        },
        {
            label: "Previous year Shipping costs",
            color: "#e77ea3",
            background: 'transparent',
            data: ''
        },
        {
            label: "Previous year Total value",
            color: "#404040",
            background: 'transparent',
            data: ''
        },
    ]
  };

  var barChart2Instance = null;

  
  function barChart2(selector, set_data) {
    var $selector = selector ? $(selector) : $('.bar-chart2');
    $selector.each(function () {
      var $self = $(this),
        _self_id = $self.attr('id'),
        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
        _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;


        if (barChart2Instance) {
            barChart2Instance.destroy();
        }

      var selectCanvas = document.getElementById(_self_id).getContext("2d");
      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          label: _get_data.datasets[i].label,
          data: _get_data.datasets[i].data,
          backgroundColor: _get_data.datasets[i].color,
          borderWidth: 2,
          borderColor: 'transparent',
          hoverBorderColor: 'transparent',
          borderSkipped: 'bottom',
          barPercentage: NioApp.State.asMobile ? .95 : .75,
          categoryPercentage: NioApp.State.asMobile ? .95 : .75
        });
      }
      barChart2Instance = new Chart(selectCanvas, {
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
                  size: 12
                },
                color: '#9eaecf',
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
              padding: 15,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                font: {
                  size: 12
                },
                color: '#9eaecf',
                source: 'auto',
                reverse: NioApp.State.isRTL
              },
              grid: {
                color: "transparent",
                tickLength: 10,
                zeroLineColor: 'transparent',
                drawTicks: false
              }
            }
          }
        }
      });
    });
  }

  function growthPercent(totalNewAmount, totalOldAmount) {
    totalNewAmount = parseFloat(totalNewAmount) || 0;
totalOldAmount = parseFloat(totalOldAmount) || 0;
    let growthPercentage, arrowClass;

    if (totalNewAmount == 0 && totalOldAmount == 0) {
        growthPercentage = 0;
        arrowClass = "ni-arrow-right";
        return {
            growthPercentage,
            arrowClass
        };
    }

    if (totalOldAmount === 0 || totalOldAmount === 0.00) {
        growthPercentage = 100;
        arrowClass = "ni-arrow-up-right"; 
    } else {
        growthPercentage = ((totalNewAmount - totalOldAmount) / totalOldAmount) * 100;
        growthPercentage = growthPercentage.toFixed(2);

        if (growthPercentage > 0) {
            arrowClass = "ni-arrow-up-right";
        } else if (growthPercentage < 0) {
            arrowClass = "ni-arrow-down-right";
        } else {
            arrowClass = "ni-arrow-right"; 
        }
    }

    return {
        growthPercentage,
        arrowClass
    };
}

$('#dateField1').on('apply.daterangepicker', function (ev, picker) {
    const dateRange = $('#dateField1').val();
    const dates = dateRange.split(' - ');
    const startDate = dates[0] ? new Date(dates[0].trim()) : null;
    const endDate = dates[1] ? new Date(dates[1].trim()) : null;

    const startDateFormatted = startDate ? startDate.toLocaleDateString('en-CA') : null;
    const endDateFormatted = endDate ? endDate.toLocaleDateString('en-CA') : null;

    const dateRange1 = $('#dateField2').val();
    const dates1 = dateRange1.split(' - ');
    const startDate1 = dates1[0] ? new Date(dates1[0].trim()) : null;
    const endDate1 = dates1[1] ? new Date(dates1[1].trim()) : null;

    const startDateFormatted1 = startDate1 ? startDate1.toLocaleDateString('en-CA') : null;
    const endDateFormatted1 = endDate1 ? endDate1.toLocaleDateString('en-CA') : null;

    var csrfhash = $('[name=<?=csrf_token();?>]').val();


    if (startDateFormatted && endDateFormatted) {
        $.ajax({
            url: '<?= base_url(ADMIN_URL) ?>dashboard/getCurrentYearDataByDateRange',
            type: 'POST',
            data: {
                start_date: startDateFormatted,
                end_date: endDateFormatted,
                start_date1: startDateFormatted1,
                end_date1: endDateFormatted1,
                '<?=csrf_token();?>': csrfhash
            },
            success: function (response) {
                if (response.status === 'success') {
                  const oldData = response.data.oldData || [];
                    const newData = response.data.newData || [];
                    const old_amount = response.data.total_amount_old || [];
                    const new_amount = response.data.total_amount_new || [];

                    const new_vat_amount = response.data.new_vat_amount || 0;
                    const old_vat_amount = response.data.old_vat_amount || 0;

                    const new_vat_amount1 = response.data.new_vat_amount1 || 0;
                    const old_vat_amount1 = response.data.old_vat_amount1 || 0;

                    const new_shipping_amount = response.data.new_shipping_amount || [];
                    const old_shipping_amount = response.data.old_shipping_amount || [];


                    const groupedData = response.data.groupedData;
                  const groupedData2 = response.data.groupedData2;

                  // let ord_total_amount = [];
                  // let ord_returns = [];
                  // let ord_vat = [];
                  // let ord_ship_amount = [];
                  // let ord_total_gross = [];

                  // for (const date in groupedData2) {
                  //     const data = groupedData2[date];
                  //     ord_total_amount.push(data.total_amount?data.total_amount:0);
                  //     ord_returns.push(data.returns);
                  //     ord_vat.push(data.vat);
                  //     ord_ship_amount.push(data.ship_amount);
                  //     ord_total_gross.push(data.total_gross);
                  //   }

                  //   let new_ord_total_amount = [];
                  //   let new_ord_returns = [];
                  //   let new_ord_vat = [];
                  //   let new_ord_ship_amount = [];
                  //   let new_ord_total_gross = [];

                  // for (const date in groupedData) {
                  //     const data = groupedData[date];
                  //     new_ord_total_amount.push(data.total_amount?data.total_amount:0);
                  //     new_ord_returns.push(data.returns);
                  //     new_ord_vat.push(data.vat);
                  //     new_ord_ship_amount.push(data.ship_amount);
                  //     new_ord_total_gross.push(data.total_gross);
                      
                  //   }

                  const mergedData = { ...groupedData2, ...groupedData };

                  const allDates = Object.keys(mergedData);

                  let new_ord_total_amount = [];
                  let new_ord_returns = [];
                  let new_ord_vat = [];
                  let new_ord_ship_amount = [];
                  let new_ord_total_gross = [];

                  let ord_total_amount = [];
                  let ord_returns = [];
                  let ord_vat = [];
                  let ord_ship_amount = [];
                  let ord_total_gross = [];

                  allDates.forEach(date => {
                      const data1 = groupedData[date] || { total_amount: 0, returns: 0, vat: 0, ship_amount: 0, total_gross: 0 };
                      new_ord_total_amount.push(parseFloat(data1.total_amount).toFixed(2));
                      new_ord_returns.push(parseFloat(data1.returns).toFixed(2));
                      new_ord_vat.push(parseFloat(data1.vat).toFixed(2));
                      new_ord_ship_amount.push(parseFloat(data1.ship_amount).toFixed(2));
                      new_ord_total_gross.push(parseFloat(data1.total_gross).toFixed(2));

                      const data2 = groupedData2[date] || { total_amount: 0, returns: 0, vat: 0, ship_amount: 0, total_gross: 0 };
                      ord_total_amount.push(parseFloat(data2.total_amount).toFixed(2));
                      ord_returns.push(parseFloat(data2.returns).toFixed(2));
                      ord_vat.push(parseFloat(data2.vat).toFixed(2));
                      ord_ship_amount.push(parseFloat(data2.ship_amount).toFixed(2));
                      ord_total_gross.push(parseFloat(data2.total_gross).toFixed(2));
                  });


                
                  const tableBody = $('.table-container tbody');
                  tableBody.empty();

                    //total amount
                    const totalOldAmount = oldData.reduce((acc, curr) => acc + parseFloat(curr), 0);
                    const totalNewAmount = newData.reduce((acc, curr) => acc + parseFloat(curr), 0);

                    let ord_array = [];
                    for (const date in mergedData) {
                      const data = mergedData[date];
                      ord_array.push(data.order_created);
                      
                    }

                    if (!mergedData || Object.keys(mergedData).length === 0) {
                        tableBody.append(`
                            <tr>
                                <td colspan="7" style="text-align: center;">No data available for this date range.</td>
                            </tr>
                        `);
                    } else {
                      for (const date in mergedData) {
                        const data = mergedData[date];
                        const formattedTotalAmount = `€ ${parseFloat(data.total_amount).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                        const formattedReturns = `€ ${parseFloat(data.returns).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                        const formattedVat = `€ ${parseFloat(data.vat).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                        const formattedShipAmount = `€ ${parseFloat(data.ship_amount).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

                        tableBody.append(`
                            <tr>
                                <td>${data.order_created}</td>
                                <td>${data.orders}</td>
                                <td>${formattedTotalAmount}</td>
                                <td>${formattedReturns}</td>
                                <td>${formattedVat}</td>
                                <td>${formattedShipAmount}</td>
                                <td>${formattedTotalAmount}</td>
                            </tr>
                        `);
                    }
                  }

                    const { growthPercentage, arrowClass } = growthPercent(totalNewAmount, totalOldAmount);


                    $('.sales .ns-value')
                    .removeClass('bear bull')
                    .addClass(growthPercentage > 0 ? 'bull' : growthPercentage < 0 ? 'bear' : '')
                    .html(`
                        <em class="icon ni ${arrowClass}"></em>${growthPercentage}%
                    `);


                    $('.values .ns-value')
                    .removeClass('bear bull')
                    .addClass(growthPercentage > 0 ? 'bull' : growthPercentage < 0 ? 'bear' : '')
                    .html(`
                        <em class="icon ni ${arrowClass}"></em>${growthPercentage}%
                    `);

                    const formattedOldAmount = `€ ${totalOldAmount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    const formattedNewAmount = `€ ${totalNewAmount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

                    //shipping amount
                    const tot_old_shipping_amount = old_shipping_amount.reduce((acc, curr) => acc + parseFloat(curr), 0);
                    const tot_new_shipping_amount = new_shipping_amount.reduce((acc, curr) => acc + parseFloat(curr), 0);

                    const { growthPercentage: growthPercentageShip, arrowClass: arrowClassShip } = growthPercent(tot_new_shipping_amount, tot_old_shipping_amount);


                    $('.shipping .ns-value')
                    .removeClass('bear bull')
                    .addClass(growthPercentageShip > 0 ? 'bull' : growthPercentageShip < 0 ? 'bear' : '')
                    .html(`
                        <em class="icon ni ${arrowClassShip}"></em>${growthPercentageShip}%
                    `);

                    const formattedOldShip = `€ ${tot_old_shipping_amount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    const formattedNewShip = `€ ${tot_new_shipping_amount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

                    //vat amount
                    // const tot_old_vat_amount = old_vat_amount.reduce((acc, curr) => acc + parseFloat(curr), 0);
                    // const tot_new_vat_amount = new_vat_amount.reduce((acc, curr) => acc + parseFloat(curr), 0);


                    const { growthPercentage: growthPercentageTax, arrowClass: arrowClassTax } = growthPercent(new_vat_amount, old_vat_amount);


                    $('.taxes .ns-value')
                    .removeClass('bear bull')
                    .addClass(growthPercentageTax > 0 ? 'bull' : growthPercentageTax < 0 ? 'bear' : '')
                    .html(`
                        <em class="icon ni ${arrowClassTax}"></em>${growthPercentageTax}%
                    `);

                    const formattedOldVat = `€ ${old_vat_amount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    const formattedNewVat = `€ ${new_vat_amount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

                    // console.log(totalOldAmount);

                    // if(totalOldAmount != 0){
                    //   $('.previousyear').show()
                    // }
                    
                    $('#custom').text(formattedNewAmount);

                    $('#gross_sales').text(formattedNewAmount);

                    $('#customtotal').text(formattedNewAmount);

                    $('#customship').text(formattedNewShip);

                    $('#customvat').text(formattedNewVat);

                    function formatDate(dateString) {
                        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        const date = new Date(dateString);
                        const day = date.getDate();
                        const month = months[date.getMonth()];
                        const year = date.getFullYear();
                        return `${month} ${day}, ${year}`;
                    }

                    const dateRange = $('#dateField1').val();
                    const [startDate, endDate] = dateRange.split(' - ');

                    const dateRange2 = $('#dateField2').val();
                    const [startDate_1, endDate_1] = dateRange2.split(' - ');

                    $('#customdate').text('Current (' + formatDate(startDate) + ' - ' + formatDate(endDate) + ')');


                    const maxLength = Math.max(oldData.length, newData.length);

                    const dynamicLabels = Array.from({ length: maxLength }, (_, index) => `${index + 1}`);

                    const chartData = {
                        labels: ord_array,
                        dataUnit: '',
                        legend: true,
                        datasets: [
                            {
                                label: "Gross sales",
                                color: "#a6c011",
                                background: 'transparent',
                                data: new_ord_total_amount
                            },
                            {
                                label: "Returns",
                                color: "#e37432",
                                background: 'transparent',
                                data: new_ord_returns
                            },
                            {
                                label: "Taxes",
                                color: "#5490bd",
                                background: 'transparent',
                                data: new_ord_vat
                            },
                            {
                                label: "Shipping costs",
                                color: "#dd4e80",
                                background: 'transparent',
                                data: new_ord_ship_amount
                            },
                            {
                                label: "Total value",
                                color: "#131313",
                                background: 'transparent',
                                data: new_ord_total_gross
                            },
                        ]
                    };
   
                    gs_lineChart(null, chartData);

                    if (barChart2Instance) {
                        barChart2Instance.destroy();
                    }

                    barChart2(null, chartData);
                } else {
                    alert(response.message || 'Failed to fetch data');
                }
            },complete: function() {
            $.get("<?=base_url('home/getcsrfkey') ?>", function(keyupdate){
                $('[name=<?=csrf_token();?>]').val(keyupdate);
            });
        },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    } else {
        alert('Please select valid date ranges.');
    }
});

$('#dateField2').on('apply.daterangepicker', function (ev, picker) {
  $('.previousyear').show();
  
    const dateRange = $('#dateField1').val();
    const dates = dateRange.split(' - ');
    const startDate = dates[0] ? new Date(dates[0].trim()) : null;
    const endDate = dates[1] ? new Date(dates[1].trim()) : null;

    const startDateFormatted = startDate ? startDate.toLocaleDateString('en-CA') : null;
    const endDateFormatted = endDate ? endDate.toLocaleDateString('en-CA') : null;

    const dateRange1 = $('#dateField2').val();
    const dates1 = dateRange1.split(' - ');
    const startDate1 = dates1[0] ? new Date(dates1[0].trim()) : null;
    const endDate1 = dates1[1] ? new Date(dates1[1].trim()) : null;

    const startDateFormatted1 = startDate1 ? startDate1.toLocaleDateString('en-CA') : null;
    const endDateFormatted1 = endDate1 ? endDate1.toLocaleDateString('en-CA') : null;

    var csrfhash = $('[name=<?=csrf_token();?>]').val();


    if (startDateFormatted && endDateFormatted) {
        $.ajax({
            url: '<?= base_url(ADMIN_URL) ?>dashboard/getCurrentYearDataByDateRange',
            type: 'POST',
            data: {
                start_date: startDateFormatted,
                end_date: endDateFormatted,
                start_date1: startDateFormatted1,
                end_date1: endDateFormatted1,
                '<?=csrf_token();?>': csrfhash
            },
            success: function (response) {
                if (response.status === 'success') {
                  const oldData = response.data.oldData || [];
                    const newData = response.data.newData || [];
                    const old_amount = response.data.total_amount_old || [];
                    const new_amount = response.data.total_amount_new || [];

                    const new_vat_amount = response.data.new_vat_amount || 0;
                    const old_vat_amount = response.data.old_vat_amount || 0;

                    const new_vat_amount1 = response.data.new_vat_amount1 || 0;
                    const old_vat_amount1 = response.data.old_vat_amount1 || 0;

                    const new_shipping_amount = response.data.new_shipping_amount || [];
                    const old_shipping_amount = response.data.old_shipping_amount || [];


                    const groupedData = response.data.groupedData;
                  const groupedData2 = response.data.groupedData2;

                  const mergedData = { ...groupedData2, ...groupedData };

                  const allDates = Object.keys(mergedData);

                  let new_ord_total_amount = [];
                  let new_ord_returns = [];
                  let new_ord_vat = [];
                  let new_ord_ship_amount = [];
                  let new_ord_total_gross = [];

                  let ord_total_amount = [];
                  let ord_returns = [];
                  let ord_vat = [];
                  let ord_ship_amount = [];
                  let ord_total_gross = [];

                  allDates.forEach(date => {
                      const data1 = groupedData[date] || { total_amount: 0, returns: 0, vat: 0, ship_amount: 0, total_gross: 0 };
                      new_ord_total_amount.push(parseFloat(data1.total_amount).toFixed(2));
                      new_ord_returns.push(parseFloat(data1.returns).toFixed(2));
                      new_ord_vat.push(parseFloat(data1.vat).toFixed(2));
                      new_ord_ship_amount.push(parseFloat(data1.ship_amount).toFixed(2));
                      new_ord_total_gross.push(parseFloat(data1.total_gross).toFixed(2));

                      const data2 = groupedData2[date] || { total_amount: 0, returns: 0, vat: 0, ship_amount: 0, total_gross: 0 };
                      ord_total_amount.push(parseFloat(data2.total_amount).toFixed(2));
                      ord_returns.push(parseFloat(data2.returns).toFixed(2));
                      ord_vat.push(parseFloat(data2.vat).toFixed(2));
                      ord_ship_amount.push(parseFloat(data2.ship_amount).toFixed(2));
                      ord_total_gross.push(parseFloat(data2.total_gross).toFixed(2));
                  });


                
                  const tableBody = $('.table-container tbody');
                  tableBody.empty();

                    //total amount
                    const totalOldAmount = oldData.reduce((acc, curr) => acc + parseFloat(curr), 0);
                    const totalNewAmount = newData.reduce((acc, curr) => acc + parseFloat(curr), 0);

                    let ord_array = [];
                    for (const date in mergedData) {
                      const data = mergedData[date];
                      ord_array.push(data.order_created);
                      
                    }

                    if (!mergedData || Object.keys(mergedData).length === 0) {
                        tableBody.append(`
                            <tr>
                                <td colspan="7" style="text-align: center;">No data available for this date range.</td>
                            </tr>
                        `);
                    } else {
                      for (const date in mergedData) {
                        const data = mergedData[date];
                        const formattedTotalAmount = `€ ${parseFloat(data.total_amount).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                        const formattedReturns = `€ ${parseFloat(data.returns).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                        const formattedVat = `€ ${parseFloat(data.vat).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                        const formattedShipAmount = `€ ${parseFloat(data.ship_amount).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

                        tableBody.append(`
                            <tr>
                                <td>${data.order_created}</td>
                                <td>${data.orders}</td>
                                <td>${formattedTotalAmount}</td>
                                <td>${formattedReturns}</td>
                                <td>${formattedVat}</td>
                                <td>${formattedShipAmount}</td>
                                <td>${formattedTotalAmount}</td>
                            </tr>
                        `);
                    }
                  }

                    const { growthPercentage, arrowClass } = growthPercent(totalNewAmount, totalOldAmount);


                    $('.sales .ns-value')
                    .removeClass('bear bull')
                    .addClass(growthPercentage > 0 ? 'bull' : growthPercentage < 0 ? 'bear' : '')
                    .html(`
                        <em class="icon ni ${arrowClass}"></em>${growthPercentage}%
                    `);


                    $('.values .ns-value')
                    .removeClass('bear bull')
                    .addClass(growthPercentage > 0 ? 'bull' : growthPercentage < 0 ? 'bear' : '')
                    .html(`
                        <em class="icon ni ${arrowClass}"></em>${growthPercentage}%
                    `);

                    const formattedOldAmount = `€ ${totalOldAmount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    const formattedNewAmount = `€ ${totalNewAmount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

                    //shipping amount
                    const tot_old_shipping_amount = old_shipping_amount.reduce((acc, curr) => acc + parseFloat(curr), 0);
                    const tot_new_shipping_amount = new_shipping_amount.reduce((acc, curr) => acc + parseFloat(curr), 0);

                    const { growthPercentage: growthPercentageShip, arrowClass: arrowClassShip } = growthPercent(tot_new_shipping_amount, tot_old_shipping_amount);


                    $('.shipping .ns-value')
                    .removeClass('bear bull')
                    .addClass(growthPercentageShip > 0 ? 'bull' : growthPercentageShip < 0 ? 'bear' : '')
                    .html(`
                        <em class="icon ni ${arrowClassShip}"></em>${growthPercentageShip}%
                    `);

                    const formattedOldShip = `€ ${tot_old_shipping_amount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    const formattedNewShip = `€ ${tot_new_shipping_amount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

                    //vat amount
                    // const tot_old_vat_amount = old_vat_amount.reduce((acc, curr) => acc + parseFloat(curr), 0);
                    // const tot_new_vat_amount = new_vat_amount.reduce((acc, curr) => acc + parseFloat(curr), 0);


                    const { growthPercentage: growthPercentageTax, arrowClass: arrowClassTax } = growthPercent(new_vat_amount, old_vat_amount);


                    $('.taxes .ns-value')
                    .removeClass('bear bull')
                    .addClass(growthPercentageTax > 0 ? 'bull' : growthPercentageTax < 0 ? 'bear' : '')
                    .html(`
                        <em class="icon ni ${arrowClassTax}"></em>${growthPercentageTax}%
                    `);

                    const formattedOldVat = `€ ${old_vat_amount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    const formattedNewVat = `€ ${new_vat_amount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;


                    // if(totalOldAmount != 0){
                    //   $('.previousyear').show()
                    // }
                    
                    $('#custom').text(formattedNewAmount);
                    $('#previous').text(formattedOldAmount);

                    $('#gross_sales').text(formattedNewAmount);
                    $('#pre_gross_sales').text(formattedOldAmount);

                    $('#customtotal').text(formattedNewAmount);
                    $('#previoustotal').text(formattedOldAmount);

                    $('#customship').text(formattedNewShip);
                    $('#previousship').text(formattedOldShip);

                    $('#customvat').text(formattedNewVat);
                    $('#previousvat').text(formattedOldVat);

                    function formatDate(dateString) {
                        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        const date = new Date(dateString);
                        const day = date.getDate();
                        const month = months[date.getMonth()];
                        const year = date.getFullYear();
                        return `${month} ${day}, ${year}`;
                    }

                    const dateRange = $('#dateField1').val();
                    const [startDate, endDate] = dateRange.split(' - ');

                    const dateRange2 = $('#dateField2').val();
                    const [startDate_1, endDate_1] = dateRange2.split(' - ');

                    $('#customdate').text('Current (' + formatDate(startDate) + ' - ' + formatDate(endDate) + ')');
                    $('#previousdate').text('Previous (' + formatDate(startDate_1) + ' - ' + formatDate(endDate_1) + ')');


                    const maxLength = Math.max(oldData.length, newData.length);

                    const dynamicLabels = Array.from({ length: maxLength }, (_, index) => `${index + 1}`);

                    const chartData = {
                        labels: ord_array,
                        dataUnit: '',
                        legend: true,
                        datasets: [
                            {
                                label: "Gross sales",
                                color: "#a6c011",
                                background: 'transparent',
                                data: new_ord_total_amount
                            },
                            {
                                label: "Returns",
                                color: "#e37432",
                                background: 'transparent',
                                data: new_ord_returns
                            },
                            {
                                label: "Taxes",
                                color: "#5490bd",
                                background: 'transparent',
                                data: new_ord_vat
                            },
                            {
                                label: "Shipping costs",
                                color: "#dd4e80",
                                background: 'transparent',
                                data: new_ord_ship_amount
                            },
                            {
                                label: "Total value",
                                color: "#131313",
                                background: 'transparent',
                                data: new_ord_total_gross
                            },
                            {
                                label: "Previous year Gross sales",
                                color: "#caeb14",
                                background: 'transparent',
                                data: ord_total_amount
                            },
                            {
                                label: "Previous year Returns",
                                color: "#ea9462",
                                background: 'transparent',
                                data: ord_returns
                            },
                            {
                                label: "Previous year Taxes",
                                color: "#91b7d4",
                                background: 'transparent',
                                data: ord_vat
                            },
                            {
                                label: "Previous year Shipping costs",
                                color: "#e77ea3",
                                background: 'transparent',
                                data: ord_ship_amount
                            },
                            {
                                label: "Previous year Total value",
                                color: "#404040",
                                background: 'transparent',
                                data: ord_total_gross
                            },
                        ]
                    };
   
                    gs_lineChart(null, chartData);

                    if (barChart2Instance) {
                        barChart2Instance.destroy();
                    }

                    barChart2(null, chartData);
                } else {
                    alert(response.message || 'Failed to fetch data');
                }
            },complete: function() {
            $.get("<?=base_url('home/getcsrfkey') ?>", function(keyupdate){
                $('[name=<?=csrf_token();?>]').val(keyupdate);
            });
        },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
    } else {
        alert('Please select valid date ranges.');
    }
});

var response_data = <?php echo getCurrentYearDataByDateRange(); ?>;

var response_data = response_data[0];

const oldData = response_data.data.oldData || [];
                    const newData = response_data.data.newData || [];
                    const old_amount = response_data.data.total_amount_old || [];
                    const new_amount = response_data.data.total_amount_new || [];

                    const new_vat_amount = response_data.data.new_vat_amount || 0;
                    const old_vat_amount = response_data.data.old_vat_amount || 0;

                    const new_vat_amount1 = response_data.data.new_vat_amount1 || 0;
                    const old_vat_amount1 =  0;

                    const new_shipping_amount = response_data.data.new_shipping_amount || [];
                    const old_shipping_amount = response_data.data.old_shipping_amount || [];


                    const groupedData = response_data.data.groupedData;
                  const groupedData2 = response_data.data.groupedData2;

                 

                  const mergedData = { ...groupedData2, ...groupedData };

                  const allDates = Object.keys(mergedData);

                  let new_ord_total_amount = [];
                  let new_ord_returns = [];
                  let new_ord_vat = [];
                  let new_ord_ship_amount = [];
                  let new_ord_total_gross = [];

                  let ord_total_amount = [];
                  let ord_returns = [];
                  let ord_vat = [];
                  let ord_ship_amount = [];
                  let ord_total_gross = [];

                  allDates.forEach(date => {
                      const data1 = groupedData[date] || { total_amount: 0, returns: 0, vat: 0, ship_amount: 0, total_gross: 0 };
                      new_ord_total_amount.push(parseFloat(data1.total_amount).toFixed(2));
                      new_ord_returns.push(parseFloat(data1.returns).toFixed(2));
                      new_ord_vat.push(parseFloat(data1.vat).toFixed(2));
                      new_ord_ship_amount.push(parseFloat(data1.ship_amount).toFixed(2));
                      new_ord_total_gross.push(parseFloat(data1.total_gross).toFixed(2));

                      const data2 = groupedData2[date] || { total_amount: 0, returns: 0, vat: 0, ship_amount: 0, total_gross: 0 };
                      ord_total_amount.push(parseFloat(data2.total_amount).toFixed(2));
                      ord_returns.push(parseFloat(data2.returns).toFixed(2));
                      ord_vat.push(parseFloat(data2.vat).toFixed(2));
                      ord_ship_amount.push(parseFloat(data2.ship_amount).toFixed(2));
                      ord_total_gross.push(parseFloat(data2.total_gross).toFixed(2));
                  });


                
                  const tableBody = $('.table-container tbody');
                  tableBody.empty();

                    //total amount
                    const totalOldAmount = oldData.reduce((acc, curr) => acc + parseFloat(curr), 0);
                    const totalNewAmount = newData.reduce((acc, curr) => acc + parseFloat(curr), 0);

                    let ord_array = [];
                    for (const date in mergedData) {
                      const data = mergedData[date];
                      ord_array.push(data.order_created);
                      
                    }

                    if (!mergedData || Object.keys(mergedData).length === 0) {
                        tableBody.append(`
                            <tr>
                                <td colspan="7" style="text-align: center;">No data available for this date range.</td>
                            </tr>
                        `);
                    } else {
                      for (const date in mergedData) {
                        const data = mergedData[date];
                        const formattedTotalAmount = `€ ${parseFloat(data.total_amount).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                        const formattedReturns = `€ ${parseFloat(data.returns).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                        const formattedVat = `€ ${parseFloat(data.vat).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                        const formattedShipAmount = `€ ${parseFloat(data.ship_amount).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

                        tableBody.append(`
                            <tr>
                                <td>${data.order_created}</td>
                                <td>${data.orders}</td>
                                <td>${formattedTotalAmount}</td>
                                <td>${formattedReturns}</td>
                                <td>${formattedVat}</td>
                                <td>${formattedShipAmount}</td>
                                <td>${formattedTotalAmount}</td>
                            </tr>
                        `);
                    }
                  }

                    const { growthPercentage, arrowClass } = growthPercent(totalNewAmount, totalOldAmount);


                    $('.sales .ns-value')
                    .removeClass('bear bull')
                    .addClass(growthPercentage > 0 ? 'bull' : growthPercentage < 0 ? 'bear' : '')
                    .html(`
                        <em class="icon ni ${arrowClass}"></em>${growthPercentage}%
                    `);


                    $('.values .ns-value')
                    .removeClass('bear bull')
                    .addClass(growthPercentage > 0 ? 'bull' : growthPercentage < 0 ? 'bear' : '')
                    .html(`
                        <em class="icon ni ${arrowClass}"></em>${growthPercentage}%
                    `);

                    const formattedOldAmount = `€ ${totalOldAmount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    const formattedNewAmount = `€ ${totalNewAmount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

                    //shipping amount
                    const tot_old_shipping_amount = old_shipping_amount.reduce((acc, curr) => acc + parseFloat(curr), 0);
                    const tot_new_shipping_amount = new_shipping_amount.reduce((acc, curr) => acc + parseFloat(curr), 0);

                    const { growthPercentage: growthPercentageShip, arrowClass: arrowClassShip } = growthPercent(tot_new_shipping_amount, tot_old_shipping_amount);


                    $('.shipping .ns-value')
                    .removeClass('bear bull')
                    .addClass(growthPercentageShip > 0 ? 'bull' : growthPercentageShip < 0 ? 'bear' : '')
                    .html(`
                        <em class="icon ni ${arrowClassShip}"></em>${growthPercentageShip}%
                    `);

                    const formattedOldShip = `€ ${tot_old_shipping_amount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    const formattedNewShip = `€ ${tot_new_shipping_amount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

                    //vat amount
                    // const tot_old_vat_amount = old_vat_amount.reduce((acc, curr) => acc + parseFloat(curr), 0);
                    // const tot_new_vat_amount = new_vat_amount.reduce((acc, curr) => acc + parseFloat(curr), 0);


                    const { growthPercentage: growthPercentageTax, arrowClass: arrowClassTax } = growthPercent(new_vat_amount, old_vat_amount);


                    $('.taxes .ns-value')
                    .removeClass('bear bull')
                    .addClass(growthPercentageTax > 0 ? 'bull' : growthPercentageTax < 0 ? 'bear' : '')
                    .html(`
                        <em class="icon ni ${arrowClassTax}"></em>${growthPercentageTax}%
                    `);

                    const formattedOldVat = `€ ${old_vat_amount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    const formattedNewVat = `€ ${new_vat_amount.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                    
                    $('#custom').text(formattedNewAmount);
                    $('#previous').text(formattedOldAmount);

                    $('#gross_sales').text(formattedNewAmount);
                    $('#pre_gross_sales').text(formattedOldAmount);

                    $('#customtotal').text(formattedNewAmount);
                    $('#previoustotal').text(formattedOldAmount);

                    $('#customship').text(formattedNewShip);
                    $('#previousship').text(formattedOldShip);

                    $('#customvat').text(formattedNewVat);
                    $('#previousvat').text(formattedOldVat);

                    function formatDate(dateString) {
                        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        const date = new Date(dateString);
                        const day = date.getDate();
                        const month = months[date.getMonth()];
                        const year = date.getFullYear();
                        return `${month} ${day}, ${year}`;
                    }

                    const dateRange = $('#dateField1').val();
                    const [startDate, endDate] = dateRange.split(' - ');

                    const dateRange2 = $('#dateField2').val();
                    const [startDate_1, endDate_1] = dateRange2.split(' - ');

                    $('#customdate').text('Current (' + formatDate(startDate) + ' - ' + formatDate(endDate) + ')');
                    $('#previousdate').text('Previous (' + formatDate(startDate_1) + ' - ' + formatDate(endDate_1) + ')');


                    const maxLength = Math.max(oldData.length, newData.length);

                    const dynamicLabels = Array.from({ length: maxLength }, (_, index) => `${index + 1}`);

                    const chartDatarange = {
                        labels: ord_array,
                        dataUnit: '',
                        legend: true,
                        datasets: [
                            {
                                label: "Gross sales",
                                color: "#a6c011",
                                background: 'transparent',
                                data: new_ord_total_amount
                            },
                            {
                                label: "Returns",
                                color: "#e37432",
                                background: 'transparent',
                                data: new_ord_returns
                            },
                            {
                                label: "Taxes",
                                color: "#5490bd",
                                background: 'transparent',
                                data: new_ord_vat
                            },
                            {
                                label: "Shipping costs",
                                color: "#dd4e80",
                                background: 'transparent',
                                data: new_ord_ship_amount
                            },
                            {
                                label: "Total value",
                                color: "#131313",
                                background: 'transparent',
                                data: new_ord_total_gross
                            },
                            {
                                label: "Previous year Gross sales",
                                color: "#caeb14",
                                background: 'transparent',
                                data: ord_total_amount
                            },
                            {
                                label: "Previous year Returns",
                                color: "#ea9462",
                                background: 'transparent',
                                data: ord_returns
                            },
                            {
                                label: "Previous year Taxes",
                                color: "#91b7d4",
                                background: 'transparent',
                                data: ord_vat
                            },
                            {
                                label: "Previous year Shipping costs",
                                color: "#e77ea3",
                                background: 'transparent',
                                data: ord_ship_amount
                            },
                            {
                                label: "Previous year Total value",
                                color: "#404040",
                                background: 'transparent',
                                data: ord_total_gross
                            },
                        ]
                    };

//   NioApp.coms.docReady.push(function () {
  gs_lineChart(null, chartDatarange);

if (barChart2Instance) {
    barChart2Instance.destroy();
}

barChart2(null, chartDatarange);
// });

$('#downloadCsvButton').on('click', function (ev, picker) {
    const dateRange = $('#dateField1').val();
    const dates = dateRange.split(' - ');
    const startDate = dates[0] ? new Date(dates[0].trim()) : null;
    const endDate = dates[1] ? new Date(dates[1].trim()) : null;

    const startDateFormatted = startDate ? startDate.toLocaleDateString('en-CA') : null;
    const endDateFormatted = endDate ? endDate.toLocaleDateString('en-CA') : null;

    const dateRange1 = $('#dateField2').val();
    const dates1 = dateRange1.split(' - ');
    const startDate1 = dates1[0] ? new Date(dates1[0].trim()) : null;
    const endDate1 = dates1[1] ? new Date(dates1[1].trim()) : null;

    const startDateFormatted1 = startDate1 ? startDate1.toLocaleDateString('en-CA') : null;
    const endDateFormatted1 = endDate1 ? endDate1.toLocaleDateString('en-CA') : null;

    var csrfhash = $('[name=<?=csrf_token();?>]').val();

    if (startDateFormatted && endDateFormatted) {
        const url = `<?= base_url(ADMIN_URL) ?>dashboard/downloadCsv`;
        const form = $('<form>', {
            method: 'POST',
            action: url,
        });

        form.append($('<input>', {
            type: 'hidden',
            name: 'start_date',
            value: startDateFormatted,
        }));
        form.append($('<input>', {
            type: 'hidden',
            name: 'end_date',
            value: endDateFormatted,
        }));
        form.append($('<input>', {
            type: 'hidden',
            name: 'start_date1',
            value: startDateFormatted1,
        }));
        form.append($('<input>', {
            type: 'hidden',
            name: 'end_date1',
            value: endDateFormatted1,
        }));
        form.append($('<input>', {
            type: 'hidden',
            name: '<?=csrf_token();?>',
            value: csrfhash,
        }));
       
        $('body').append(form);
        form.submit();
    } else {
        alert('Please select valid date ranges.');
    }
});
  
 </script>