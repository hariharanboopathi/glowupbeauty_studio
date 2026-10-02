<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="components-preview wide-xl mx-auto">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h3 class="nk-block-title page-title"><?=getlang('manage');?> <?=getlang('email');?></h3>
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
                                                    <li><a href="<?php echo base_url(ADMIN_URL.'/email/email_add');?>"><span><?=getlang('add')?> <?=getlang('email_template')?></span></a></li>
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
                        <div class="spinner-border spin" role="status" id="datatable-loader-emailmanage">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                            <table class="datatable-init-emailmanage nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="selectAll">
                                                <label class="custom-control-label" for="selectAll"></label>
                                            </div>
                                        </th>
                                        <th class="nk-tb-col tb-col-sm"><span class="sub-text"><?=getlang('id');?></span></th>
                                        <th class="nk-tb-col"><span class="sub-text"><?=getlang('title');?></span></th>
                                        <th class="nk-tb-col"><span class="sub-text"><?=getlang('subject');?></span></th>
                                        <th class="nk-tb-col tb-col-sm"><span class="sub-text"><?=getlang('status');?></span></th>
                                        <th class="nk-tb-col tb-col-lg text-end"><?=getlang('...');?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($email_informations)) {
                                        foreach ($email_informations as $key => $email) { ?>
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input selectCheckbox"
                                                            name="<?php echo $email->key; ?>" id="<?php echo $key; ?>">
                                                        <label class="custom-control-label" for="<?php echo $key; ?>"></label>
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col dis_res">
                                                <a href="<?php echo base_url(ADMIN_URL) ?>/email/email_edit/<?php if (!empty($email->id)) {
                                                                               echo $email->id;
                                                                           } ?>">
                                                    <?php if (!empty($email->key)) {
                                                        echo $email->key;
                                                    } ?>
                                                    </a>
                                                </td>
                                                <td class="nk-tb-col tb-col-mb">
                                                    <?php if (!empty($email->subject)) {
                                                        echo $email->subject;
                                                    } ?>

                                                </td>
                                                <td class="nk-tb-col tb-col-md">
                                                    <?php 
                                                    $status = getlang('inactive');
                                                    if (!empty($email->status) && $email->status == 1) {
                                                        $status = getlang('active');
                                                    } ?>
                                                    <?=$status?>
                                                </td>
                                                <td class="nk-tb-col nk-tb-col-tools">
                                                    <ul class="nk-tb-actions gx-1">
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                                    data-bs-toggle="dropdown"><em
                                                                        class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="<?php echo base_url(ADMIN_URL) ?>/email/email_edit/<?php if (!empty($email->id)) {
                                                                               echo $email->id;
                                                                           } ?>"><em
                                                                                    class="icon ni ni-edit"></em><span><?=getlang('edit');?></span></a>
                                                                        </li>
                                                                        <li><a href="<?php echo base_url(ADMIN_URL) ?>/email/email_delete/<?php if (!empty($email->id)) {
                                                                               echo $email->id;
                                                                           } ?>"><em
                                                                                    class="icon ni ni-delete"></em><span><?=getlang('remove');?></span></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr><!-- .nk-tb-item  -->
                                        <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div>
            </div>
        </div>
    </div>
</div><script>
    // Show loader
    $('#datatable-loader-emailmanage').show();

    NioApp.DataTable('.datatable-init-emailmanage', {
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
      { className: 'nk-tb-col tb-col-sm' }, 
      { className: 'nk-tb-col nk-tb-col-tools' }],

      initComplete: function () {
        // Hide loader when DataTable is initialized
        $('#datatable-loader-emailmanage').removeClass('spin').hide();
        
      }
    });

  </script>