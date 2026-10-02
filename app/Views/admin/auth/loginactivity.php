<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="nk-block">
                <div class="card">
                    <div class="card-aside-wrap">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <h3 class="nk-block-title page-title"><?=getlang('manage');?> <?=getlang('User_Login_activity');?></h3>
                                    <div class="" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url()?>/beheerpaneel/settings/manage" class="btn btn-primary"><span><?=getlang('back')?></span></a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <div class="spinner-border spin" role="status" id="datatable-loader-enquiry">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <table class="datatable-init-enquiry nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                            <thead>
                                                <tr class="nk-tb-item nk-tb-head">
                                                    <th class="nk-tb-col nk-tb-col-check">
                                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                                            <input type="checkbox" class="custom-control-input" id="selectAll">
                                                            <label class="custom-control-label" for="selectAll"></label>
                                                        </div>
                                                    </th> 
                                                    <th class="nk-tb-col"><span class="sub-text"><?=getlang('id');?></span></th>
                                                    <th class="nk-tb-col"><span class="sub-text"><?=getlang('E-mail');?></span></th>
                                                    <th class="nk-tb-col "><span class="sub-text"><?=getlang('Message');?></span></th>
                                                    <th class="nk-tb-col "><span class="sub-text"><?=getlang('ip_address');?></span></th>
                                                    <th class="nk-tb-col "><span class="sub-text"><?=getlang('date');?></span></th>
                                                    <th class="nk-tb-col tb-col-lg text-end"><span class="sub-text"><?=getlang('action');?></span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .nk-block -->
                        </div><!-- .card-inner -->
                        <?php //echo view('beheerpaneel/settings/settingstableftmenu');?>
                    </div><!-- .card-aside-wrap -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>
</div>

<script>
    // Show loader
    $('#datatable-loader-enquiry').show();

    NioApp.DataTable('.datatable-init-enquiry', {
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
      { className: 'nk-tb-col' }, 
      { className: 'nk-tb-col' }, 
      { className: 'nk-tb-col' }, 
      { className: 'nk-tb-col ' }, 
      { className: 'nk-tb-col ' }, 
      { className: 'nk-tb-col nk-tb-col-tools' }],

      initComplete: function () {
        // Hide loader when DataTable is initialized
        $('#datatable-loader-enquiry').removeClass('spin').hide();
        
      }
    });

  </script>


</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>
