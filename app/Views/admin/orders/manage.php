<style>

    .orderstatus {
        /* color: white; */
        cursor: pointer;
    } 
    </style>
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="components-preview wide-xl mx-auto">
                <div class="nk-block nk-block-lg"> 
                    <div class="nk-block-head">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('manage');?> <?=getlang('orders');?></h3>
                                <div class="form-group">   
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input notify_customer_to" value="1" name="notify_customer"  id="notify_customer" >
                                            <label class="custom-control-label" for="notify_customer"><?=getlang("Notify_customer");?></label>
                                    </div> 
                                    
                                </div>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                             
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    </div>
                    <div class="card card-preview">

                        
                    <div class="card-inner">
                        <ul class="nav nav-tabs mt-n3" id="order-tabs"></ul>
                        <div class="spinner-border spin" role="status" id="datatable-loader-orders">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="tab-content" id="order-tab-content"></div>
                    </div>
                        
                    </div><!-- .card-preview -->
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    var orderStatuses = [
        {name: '<?=getlang('New')?>',code :'all'},
        <?php if(!empty($orderstatuses)){
            foreach($orderstatuses as $ordsta){?>
        { name: '<?=$ordsta->name?>', code: '<?=$ordsta->key?>' },
        <?php } } ?>
    //     { name: 'Shipped', code: 'shipped' },
    //     { name: 'Opgehaald', code: 'opgehaald' },
    //     { name: 'Geannuleerd', code: 'cancelled' }
    ];

    function createTabsAndTables() {
        var tabs = '';
        var tabContent = '';
        orderStatuses.forEach(function(status, index) {
            var activeClass = index === 0 ? 'active' : '';
            tabs += `
                <li class="nav-item">
                    <a class="nav-link ${activeClass}" data-bs-toggle="tab" href="#tabItem${status.code}">${status.name}</a>
                </li>`;
            tabContent += `
                <div class="tab-pane ${activeClass}" id="tabItem${status.code}">
                    <table id="datatable-orders-${status.code}" class="datatable-init-orders nk-tb-list nk-tb-ulist table table-tranx" data-auto-responsive="false">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th class="tb-tnx-id"><span class="">#</span></th>
                                <th class="tb-tnx-info">
                                    <span class="tb-tnx-desc d-none d-sm-inline-block">
                                        <span><?=getlang('bill_for');?></span>
                                    </span>
                                    <span class="tb-tnx-date d-md-inline-block d-none">
                                        <span class="d-md-none">Date</span>
                                        <span class="d-none d-md-block">
                                            <span><?=getlang('payment_date');?></span>
                                            <span><?=getlang('icon');?></span>
                                        </span>
                                    </span>
                                </th>
                                <th class="tb-tnx-amount is-alt">
                                    <span class="tb-tnx-total"><?=getlang('total');?></span>
                                    <span class="tb-tnx-status d-none d-md-inline-block">
                                            <?=getlang('status');?>
                                    </span>
                                </th>
                                <th class=" is-alt1"><span class="tb-tnx-picqer d-none d-md-inline-block"><?=getlang('Picqer Id');?></span></th>
                                <th class="tb-tnx-action">
                                    <span></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                        </tbody>
                    </table>
                </div>`;
        });
        $('#order-tabs').html(tabs);
        $('#order-tab-content').html(tabContent);
    }

    function initializeDataTable(tabId, tableId, ajaxUrl, tabIdentifier) {
        if ($.fn.DataTable.isDataTable(tableId)) {
            $(tableId).DataTable().clear().destroy();
        }

        $(tableId).DataTable({
            responsive: {
                details: true
            },
            ordering: false,
            serverSide: true,
            ajax: {
                url: ajaxUrl,
                type: 'GET',
                data: {
                    tab: tabIdentifier
                },
                error: function(xhr, error, code) {
                    console.log("AJAX Error: ", xhr, error, code);
                }
            },
            createdRow: function(row) {
                $(row).addClass('tb-tnx-item');
            },
            columnDefs: [
                {
                    targets: '_all',
                    createdCell: function(td) {
                        $(td).addClass('');
                    }
                }
            ],
            columns: [
                { className: 'tb-tnx-id' },
                { className: 'tb-tnx-info' },
                { className: 'tb-tnx-amount is-alt' },
                { className: 'is-alt' },
                { className: 'tb-tnx-action' }
            ],
            language: {
                search: "",
                searchPlaceholder: "Type in to Search",
                lengthMenu: "<span class='d-none d-sm-inline-block'>Show</span><div class='form-control-select'> _MENU_ </div>",
                info: "_START_ -_END_ of _TOTAL_",
                infoEmpty: "0",
                infoFiltered: "( Total _MAX_  )",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Prev"
                }
            },
            initComplete: function() {
                $('#datatable-loader-orders').removeClass('spin').hide();
            }
        });
    }

    function loadInitialTab() {
        var initialTab = orderStatuses[0].code;
        initializeDataTable(`#tabItem${initialTab}`, `#datatable-orders-${initialTab}`, "<?= base_url('beheerpaneel/orders/manage') ?>", initialTab);
    }

    createTabsAndTables();
    loadInitialTab();

    // Show loader
    $('#datatable-loader-orders').show();

    // Handle tab switch
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        var tabId = $(e.target).attr("href"); // Get activated tab
        console.log("Switching to tab: ", tabId);
        // Show loader
        $('#datatable-loader-orders').show();
        var tabIdentifier = tabId.replace('#tabItem', '');
        console.log("Tab Identifier: ", tabIdentifier);
        initializeDataTable(tabId, `#datatable-orders-${tabIdentifier}`, "<?= base_url('beheerpaneel/orders/manage') ?>", tabIdentifier);
    });
});
</script>

<script>
$(document).ready(function() {
    // Function to update the select elements with the correct background and text color
    function updateSelectElements() {
        var selectElements = document.querySelectorAll(".orderstatus");
        if (selectElements.length > 0) {
            selectElements.forEach(function(selectElement) {
                function updateSelectColor() {
                    var selectedOption = selectElement.options[selectElement.selectedIndex];
                    selectElement.style.backgroundColor = selectedOption.style.backgroundColor;
                    selectElement.style.color = selectedOption.style.color || 'white'; // Fallback to white if no color is set on the option
                }

                // Initial call to set color based on the currently selected option
                updateSelectColor();

                // Event listener for when the selected option changes
                selectElement.addEventListener('change', function() {
                    updateSelectColor();
                });
            });

            console.log("Total select elements found:", selectElements.length);
        }
    }

    // Declare the observer once
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            // When elements are added to the DOM, update select elements
            updateSelectElements();
        });
    });

    // Initial observation
    observer.observe(document.body, { childList: true, subtree: true });

    // Reinitialize observer and update select elements after pagination completes
    $(document).on('nioapp.paginationComplete', function() {
        observer.observe(document.body, { childList: true, subtree: true });
        // Ensure select elements are updated after pagination
        updateSelectElements();
    });
});
</script>
<script>
    $(document).ready(function() {
    $('.notify_customer_to').change(function() {
        if ($(this).is(':checked')) {

        $('.notify_customer_to').val(1);
        $(this).prop('checked', true);
    } else {
        
        $(this).prop('checked', false);
            $('.notify_customer_to').val(0);
        }
    });
});

</script>