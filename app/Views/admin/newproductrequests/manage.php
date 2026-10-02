<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="components-preview wide-xl mx-auto">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("manage");?> <?=getlang("order_newproduct_requests");?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->

                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools g-3">
                                    <li class="delete_butn"><?=getlang('Selecteer alles');?>     <input type="checkbox" class="custom-control-input" id="selectAll">
                                            <label class="custom-control-label" for="selectAll"></label></li>
                                    <li id="delselect" style="display:none" data-type="order_newproduct_requests">
                                        <button type="button" id="deleteSelected"><?=getlang('delete_selected');?></button>
                                    </li>
                                    <!-- <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="<?php echo base_url(ADMIN_URL.'/blog/add');?>"><span><?=getlang('add')?> <?=getlang('news')?></span></a></li>
                                                  
                                                </ul>
                                            </div>
                                        </div>
                                    </li> -->
                                </ul>
                            </div><!-- .nk-block-head-content -->




                            
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                        <ul class="nav nav-tabs mt-n3">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1"><?=getlang('all')?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabItem2"><?=getlang('completed')?></a>
                            </li>
                        </ul>
                        <div class="spinner-border spin" role="status" id="datatable-loader-order_newproduct_requests">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tabItem1">
                                <table id="datatable-orders-general" class="datatable-init-blog nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col nk-tb-col-check">
                                                <!-- <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="selectAll">
                                                    <label class="custom-control-label" for="selectAll"></label>
                                                </div> -->
                                            </th>
                                            <th class="nk-tb-col tb-col-sm"><span class="sub-text"><?=getlang('id');?></span></th>
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('name');?></span></th>
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('email');?></span></th>
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('order_id');?></span></th>
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('product_name');?></span></th>
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('message');?></span></th>
                                            <th class="nk-tb-col tb-col-sm"><span class="sub-text"><?=getlang('date');?></span></th>
                                            <th class="nk-tb-col tb-col-sm"><span class="sub-text"><?=getlang('status');?></span></th>
                                            <th class="nk-tb-col tb-col-lg text-end"><span class="sub-text"><?=getlang('...');?></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane " id="tabItem2">
                                <table id="datatable-orders-completed" class="datatable-init-blog nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col nk-tb-col-check">
                                                <!-- <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="selectAll">
                                                    <label class="custom-control-label" for="selectAll"></label>
                                                </div> -->
                                            </th>
                                            <th class="nk-tb-col tb-col-sm"><span class="sub-text"><?=getlang('id');?></span></th>
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('name');?></span></th>
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('email');?></span></th>
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('order_id');?></span></th>
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('product_name');?></span></th>
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('message');?></span></th>
                                            <th class="nk-tb-col tb-col-sm"><span class="sub-text"><?=getlang('date');?></span></th>
                                            <th class="nk-tb-col tb-col-sm"><span class="sub-text"><?=getlang('status');?></span></th>
                                            <th class="nk-tb-col tb-col-lg text-end"><span class="sub-text"><?=getlang('...');?></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div><!-- .card-preview -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    // Show loader
    $('#datatable-loader-order_newproduct_requests').show();

    NioApp.DataTable('.datatable-init-blog', {
      responsive: {
        details: true
      },
      serverSide:true,
      createdRow: function (row) {
        
        $(row).addClass('nk-tb-item');
      },
      columnDefs: [
        { 
          targets: '_all',
          createdCell: function (td) {
            $(td).addClass('nk-tb-col');
          }  
        },
      ],
      columns: [{ className: 'nk-tb-col nk-tb-col-check' }, { className: 'nk-tb-col tb-col-sm' }, { className: 'nk-tb-col' }, { className: 'nk-tb-col' }, { className: 'nk-tb-col tb-col-sm' }, { className: 'nk-tb-col tb-col-sm' }, { className: 'nk-tb-col tb-col-sm' }, { className: 'nk-tb-col tb-col-sm' },{ className: 'nk-tb-col nk-tb-col-tools' }],
      language: {
        search: "",
        searchPlaceholder: "<?=getlang('Type_in_to_Search')?>",
        lengthMenu: "<span class='d-none d-sm-inline-block'><?=getlang('Show')?></span><div class='form-control-select'> _MENU_ </div>",
        info: "_START_ -_END_ of _TOTAL_",
        infoEmpty: "0",
        infoFiltered: "( Total _MAX_  )",
        paginate: {
        "first": "<?=getlang('First')?>",
        "last": "<?=getlang('Last')?>",
        "next": "<?=getlang('Next')?>",
        "previous": "<?=getlang('Prev')?>"
        }
      },
      initComplete: function () {
        // Hide loader when DataTable is initialized
        $('#datatable-loader-order_newproduct_requests').removeClass('spin').hide();
        
      }
    });

  </script> -->

  <script>
    $(document).ready(function() {
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
            columns: [{ className: 'nk-tb-col nk-tb-col-check' }, { className: 'nk-tb-col tb-col-sm' }, { className: 'nk-tb-col' }, { className: 'nk-tb-col' }, { className: 'nk-tb-col tb-col-sm' }, { className: 'nk-tb-col tb-col-sm' }, { className: 'nk-tb-col tb-col-sm' }, { className: 'nk-tb-col tb-col-sm' },{ className: 'nk-tb-col tb-col-sm' },{ className: 'nk-tb-col nk-tb-col-tools' }],
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
                $('#datatable-loader-order_newproduct_requests').removeClass('spin').hide();
            }
        });
    }

    // Initialize the first tab
    initializeDataTable("#tabItem1", "#datatable-orders-general", "<?= base_url('beheerpaneel/newproductrequest/manage') ?>", "general");


    // Show loader
    $('#datatable-loader-order_newproduct_requests').show();

    // Handle tab switch
    $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        var tabId = $(e.target).attr("href"); // Get activated tab
        // Show loader
        $('#datatable-loader-order_newproduct_requests').show();
        switch(tabId) {
            case '#tabItem1':
                initializeDataTable(tabId, "#datatable-orders-general", "<?= base_url('beheerpaneel/newproductrequest/manage') ?>", "general");
                break;
            case '#tabItem2':
                initializeDataTable(tabId, "#datatable-orders-completed", "<?= base_url('beheerpaneel/newproductrequest/manage') ?>", "completed");
                break;
            
        }
    });
});

</script>