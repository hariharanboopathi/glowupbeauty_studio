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
                            
                                    <li class="delete_butn"><?=getlang('Selecteer alles');?>     <input type="checkbox" class="custom-control-input" id="selectAll">
                                            <label class="custom-control-label" for="selectAll"></label></li>
                                    <li id="delselect" style="display:none" data-type="product">
                                        <button type="button" id="deleteSelected"><?=getlang('delete_selected');?></button>
                                    </li>
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="<?php echo base_url(ADMIN_URL.'/product/add');?>"><span><?=getlang('add')?> <?=getlang('products')?></span></a></li>
                                                    <li><a href="<?php echo base_url(ADMIN_URL.'/bulkimport/add');?>"><span><?=getlang('add')?> <?=getlang('bulkimport')?></span></a></li>
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
                                    <th class="nk-tb-col nk-tb-col-check">
                                        <div class="">
                                            <!-- <input type="checkbox" class="custom-control-input" id="uid"> -->
                                            <!-- <input type="checkbox" class="custom-control-input" id="selectAll"> -->
                                            <!-- <label class="custom-control-label" for="selectAll"></label> -->
                                            <!-- <label class="custom-control-label" for="uid"></label> -->
                                        </div>
                                    </th>
                                    <th class="nk-tb-col"><span class="sub-text"><?=getlang('product_name');?></span></th>
                                    <th class="nk-tb-col"><span class="sub-text"><?=getlang('sku');?></span></th>
                                    <th class="nk-tb-col"><span class="sub-text"><?=getlang('EAN');?></span></th>
                                    <th class="nk-tb-col tb-col-sm"><span class="sub-text"><?=getlang("price");?></span></th>
                                    <th class="nk-tb-col tb-col-sm"><span class="sub-text"><?=getlang("stock");?></span></th>
                                    <th class="nk-tb-col tb-col-md"><span class="sub-text"><?=getlang('category');?></span></th>
                                    <th class="nk-tb-col nk-tb-col-tools"><span class="sub-text"><?=getlang('...');?></span></th>
                                </tr>
 
                                    
                                </thead>
                                <tbody>
                                      <?php if(!empty($product_detail)){

                                                foreach($product_detail as $key => $p){ 
													$rp = $p->rprice;
														$rop = $p->regoffprice;
														
										?>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col tb-col-sm">
                                            <span class="tb-product">
                                            <?php 
                                            $pimg = product_images($p->id);
                                                if(!empty($pimg) && file_exists(FCPATH . 'uploads/product/' . $pimg[0]->image)){?>
                                            <img src="<?php echo image_url('uploads/product/'.$pimg[0]->image);?>" class="thumb">
                                                <?php }  ?>
                                            <span class="title"><?php echo $p->pname;?></span>
                                            </span>
                                        </td>
                                        <td class="nk-tb-col">
                                             <span class="tb-sub"><?php echo $p->product_sku;?></span>
                                        </td>
										<td class="nk-tb-col">
                                             <span class="tb-lead"><strike><?php echo $rp;?></strike> <?php echo $rop;?></span>
                                        </td>
										<td class="nk-tb-col">
                                            <span class="tb-sub"><?php echo $p->quantity;?></span>       
                                        </td>
										<td class="nk-tb-col tb-col-md">
                                        <span class="tb-sub"><?php echo $p->cat_id;?></span>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                            <li><a href="<?php echo base_url(ADMIN_URL)?>/product/edit/<?php echo $p->id; ?>"><em class="icon ni ni-edit"></em><span><?=getlang('edit');?></span></a></li>
                                                                <li><a href="<?php echo base_url(ADMIN_URL)?>/product/delete/<?php echo $p->id; ?>"><em class="icon ni ni-delete"></em><span><?=getlang('remove');?></span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr><!-- .nk-tb-item  -->
                                        <?php } }?>
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
    
    // // Show loader
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
      columns: [{ className: 'nk-tb-col nk-tb-col-check' }, { className: 'nk-tb-col' }, { className: 'nk-tb-col' }, { className: 'nk-tb-col' }, { className: 'nk-tb-col tb-col-sm' }, { className: 'nk-tb-col tb-col-sm' },{ className: 'nk-tb-col tb-col-md' },{ className: 'nk-tb-col nk-tb-col-tools' }],

      initComplete: function () {
        // Hide loader when DataTable is initialized
        $('#datatable-loader-products').removeClass('spin').hide();
        
      }
    });

  </script>
