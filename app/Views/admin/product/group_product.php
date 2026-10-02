<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="components-preview wide-xl mx-auto">
                <div class="nk-block nk-block-lg"> 
                    <div class="nk-block-head">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("manage");?> <?=getlang("products");?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->

                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="<?php echo base_url(ADMIN_URL.'/product/group_product_add');?>"><span><?=getlang('add')?> <?=getlang('products')?></span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div><!-- .nk-block-head-content -->



                            
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    </div>


                    
                    <div class="card card-preview prd_tb">
                        <div class="card-inner">
                        <div class="spinner-border spin" role="status" id="datatable-loader-products">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                            <table class="datatable-init_products nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                <thead>

                                <tr class="nk-tb-item nk-tb-head">
                                    <!-- <th class="nk-tb-col nk-tb-col-check">
                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                            <input type="checkbox" class="custom-control-input" id="uid">
                                            <label class="custom-control-label" for="uid"></label>
                                        </div>
                                    </th> -->
                                    <th class="nk-tb-col"><span class="sub-text"><?=getlang('product_name');?></span></th>
                                    <th class="nk-tb-col"><span class="sub-text"><?=getlang('Product and Sku');?></span></th>
                                    <th class="nk-tb-col nk-tb-col-tools"><span class="sub-text"><?=getlang('...');?></span></th>
                                </tr>
 
                                    
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    // Show loader
    $('#datatable-loader-products').show();

    NioApp.DataTable('.datatable-init_products', {
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
      columns: [{ className: 'nk-tb-col' }, { className: 'nk-tb-col' },{ className: 'nk-tb-col nk-tb-col-tools' }],

      initComplete: function () {
        // Hide loader when DataTable is initialized
        $('#datatable-loader-products').removeClass('spin').hide();
        
      }
    });

  </script>