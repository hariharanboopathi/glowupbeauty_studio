<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="nk-block">
                <div class="card">
                    <div class="card-aside-wrap">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head nk-block-head-lg">
                                <div class="nk-block-between">
                                    <h3 class="nk-block-title page-title"><?=getlang("working_hours");?></h3>
                                    <div class="nk-block-head-content align-self-start d-lg-none">
                                        <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <div class="nk-block">
                                <div class="card card-preview">
                                    <div class="card-inner card-inner-xl">
                                    <?php echo form_open_multipart("beheerpaneel/pages/workinghours",array('id'=>'workinghourscontent'))?>

                                    <div class="form-group">    
                                            <label class="form-label" for="default-02"><?=getlang("monday");?></label>    
                                            <div class="form-control-wrap">        
                                                <input type="text" name="monday" value="<?=!empty($get_working_hours[0]->monday)?$get_working_hours[0]->monday:"";?>" class="form-control" id="default-02" placeholder="<?=getlang("monday");?>" >    
                                            </div>
                                    </div>

                                    <div class="form-group">    
                                            <label class="form-label" for="default-02"><?=getlang("tuesday");?></label>    
                                            <div class="form-control-wrap">        
                                                <input type="text" name="tuesday" value="<?=!empty($get_working_hours[0]->tuesday)?$get_working_hours[0]->tuesday:"";?>" class="form-control" id="default-02" placeholder="<?=getlang("tuesday");?>" >    
                                            </div>
                                    </div>

                                    <div class="form-group">    
                                            <label class="form-label" for="default-02"><?=getlang("wednesday");?></label>    
                                            <div class="form-control-wrap">        
                                                <input type="text" name="wednesday" value="<?=!empty($get_working_hours[0]->wednesday)?$get_working_hours[0]->wednesday:"";?>" class="form-control" id="default-02" placeholder="<?=getlang("wednesday");?>" >    
                                            </div>
                                    </div>

                                    <div class="form-group">    
                                            <label class="form-label" for="default-02"><?=getlang("thursday");?></label>    
                                            <div class="form-control-wrap">        
                                                <input type="text" name="thursday" value="<?=!empty($get_working_hours[0]->thursday)?$get_working_hours[0]->thursday:"";?>" class="form-control" id="default-02" placeholder="<?=getlang("thursday");?>" >    
                                            </div>
                                    </div>

                                    <div class="form-group">    
                                            <label class="form-label" for="default-02"><?=getlang("friday");?></label>    
                                            <div class="form-control-wrap">        
                                                <input type="text" name="friday" value="<?=!empty($get_working_hours[0]->friday)?$get_working_hours[0]->friday:"";?>" class="form-control" id="default-02" placeholder="<?=getlang("friday");?>" >    
                                            </div>
                                    </div>

                                    <div class="form-group">    
                                            <label class="form-label" for="default-02"><?=getlang("saturday");?></label>    
                                            <div class="form-control-wrap">        
                                                <input type="text" name="saturday" value="<?=!empty($get_working_hours[0]->saturday)?$get_working_hours[0]->saturday:"";?>" class="form-control" id="default-02" placeholder="<?=getlang("saturday");?>" >    
                                            </div>
                                    </div>
                                    
                                    <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
                                        </form>
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
