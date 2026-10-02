<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="nk-block">
                <div class="card">
                    <div class="card-aside-wrap">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title"><?=getlang('manage');?> <?=getlang('redirect_urls');?></h3>
                                        <div class="nk-block-des text-soft">
                                            <!-- <p>You have total 95 projects.</p> -->
                                        </div>
                                    </div><!-- .nk-block-head-content -->

                                    <div class="nk-block-head-content">
                                        <ul class="nk-block-tools g-3">
                                            <li class="delete_butn"><?=getlang('Selecteer alles');?>     <input type="checkbox" class="custom-control-input" id="selectAll">
                                                    <label class="custom-control-label" for="selectAll"></label></li>
                                            <li id="delselect" style="display:none" data-type="discount">
                                                <button type="button" id="deleteSelected"><?=getlang('delete_selected');?></button>
                                            </li>
                                            <li>
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="<?php echo base_url(ADMIN_URL.'/settings/add_redirect');?>"><span><?=getlang('add')?> <?=getlang('redirect_urls')?></span></a></li>
                                                        <!--  <li><a id="deleteSelected" href="#"><span><?=getlang('delete_selected')?></span></a></li> -->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div><!-- .nk-block-head-content -->
                                    

                                    
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <div class="spinner-border spin" role="status" id="datatable-loader-discount">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <table class="datatable-init-discount nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                            <thead>
                                                <tr class="nk-tb-item nk-tb-head">
                                                    <th class="nk-tb-col nk-tb-col-check">
                                                        <!-- <div class="custom-control custom-control-sm custom-checkbox notext">
                                                            <input type="checkbox" class="custom-control-input" id="selectAll">
                                                            <label class="custom-control-label" for="selectAll"></label>
                                                        </div> -->
                                                    </th>
                                                    <th class="nk-tb-col tb-col-sm"><span class="sub-text"><?=getlang('id');?></span></th>
                                                    <th class="nk-tb-col"><span class="sub-text"><?=getlang('old_url');?></span></th>
                                                    <th class="nk-tb-col"><span class="sub-text"><?=getlang('new_url');?></span></th>
                                                    <th class="nk-tb-col tb-col-lg text-end"><span class="sub-text"><?=getlang('---');?></span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                        </div><!-- .card-inner -->
                        <?php echo view('beheerpaneel/settings/settingstableftmenu');?>
                    </div><!-- .card-aside-wrap -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>
</div>

<?php echo minifier('adminvalidate.min.js'); ?>
<script>
    // Show loader
    $('#datatable-loader-discount').show();

    NioApp.DataTable('.datatable-init-discount', {
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
        $('#datatable-loader-discount').removeClass('spin').hide();
        
      }
    });

  </script>


</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>
