<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="components-preview wide-xl mx-auto">
                <div class="nk-block nk-block-lg"> 
                    <div class="nk-block-head">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("manage");?> <?=getlang("faq_categories");?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->

                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools g-3">
                                <li class="delete_butn"><?=getlang('Selecteer alles');?>     <input type="checkbox" class="custom-control-input" id="selectAll">
                                        <label class="custom-control-label" for="selectAll"></label>
                                    </li>
                                    <li id="delselect" style="display:none" data-type="faq_cat">
                                        <button type="button" id="deleteSelected"><?=getlang('delete_selected');?></button>
                                    </li>
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                
                                                    
                                                    <li><a href="<?php echo base_url(ADMIN_URL.'/faq/faq_cat_add');?>"><span><?=getlang('add')?> <?=getlang('faq_categories')?></span></a></li>
                                                  <!--  <li><a id="deleteSelected" href="#"><span><?=getlang('delete_selected')?></span></a></li> -->
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div><!-- .nk-block-head-content -->


                            
                        </div><!-- .nk-block-between --> 
                    </div><!-- .nk-block-head -->

                    </div>

                    



                   <div class="card card-preview">
                        <div class="card-inner">
                        <div class="spinner-border spin" role="status" id="datatable-loader-faqcat">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                            <table class="datatable-init-faqcat nk-tb-list nk-tb-ulist" data-auto-responsive="false">
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
										<th class="nk-tb-col"><span class="sub-text"><?=getlang("status");?></span></th>
                                        <th class="nk-tb-col tb-col-lg text-end"><span class="sub-text"><?=getlang('...');?></span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                      <?php if(!empty($faq_category_detail)){

                                                foreach($faq_category_detail as $key => $cat){ ?>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input selectCheckbox" id="<?php echo $key;?>" name="<?php echo $cat->id;?>">
                                                <label class="custom-control-label" for="<?php echo $key;?>"></label>
                                            </div>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
                                        <?php echo $cat->id;?>
                                        </td>
                                        <td class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                                    <span><?php echo getFirstLetters($cat->name,2); ?></span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead"><?php echo $cat->name;?> <span class="dot dot-success d-md-none ms-1"></span></span>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- <td class="nk-tb-col tb-col-mb dis_res">
                                        <?php echo $cat->name;?>
                                        </td> -->
										<td class="nk-tb-col tb-col-mb">
                                        <?php if($cat->status == '1'){echo "inactive";}else{echo "active";}?>
                                        </td>
                                        <td class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1">
                                                <li>
                                                    <div class="drodown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="<?php echo base_url(ADMIN_URL)?>/faq/faq_cat_edit/<?php echo $cat->id; ?>"><em class="icon ni ni-edit"></em><span><?=getlang("edit");?></span></a></li>
                                                                <li><a href="<?php echo base_url(ADMIN_URL)?>/faq/faq_cat_delete/<?php echo $cat->id; ?>"><em class="icon ni ni-delete"></em><span><?=getlang("remove");?></span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                        <?php } }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Show loader
    $('#datatable-loader-faqcat').show();

    NioApp.DataTable('.datatable-init-faqcat', {
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
      columns: [
      { className: 'nk-tb-col nk-tb-col-check' }, 
      { className: 'nk-tb-col tb-col-sm' }, 
      { className: 'nk-tb-col' }, 
      { className: 'nk-tb-col' }, 
      { className: 'nk-tb-col nk-tb-col-tools' }],

      initComplete: function () {
        // Hide loader when DataTable is initialized
        $('#datatable-loader-faqcat').removeClass('spin').hide();
        
      }
    });

  </script>