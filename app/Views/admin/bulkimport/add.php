<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("bulkimport");?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url('sampleimport.csv'); ?>" class="btn btn-primary" download><span><?=getlang('sample_file')?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url('sampleimport.csv'); ?>" class="btn btn-icon btn-primary" download><?=getlang('sample_file')?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
					      <?php $uri = current_url(true);?> 
						
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
                        <?php echo form_open_multipart(ADMIN_URL."/bulkimport/add",array('id'=>'bulkproduct'));?>
						<!-- <form action=""  method="post" accept-charset="utf-8" enctype="multipart/form-data"> -->
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("file");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="file" name="uploadFile" accept=".csv" class="form-control" id="default-01" >    
                                </div>
                            </div>
                        
                            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
						</form>
							<?php //echo form_close();?>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div><!-- .content-page -->
        </div>
    </div>
</div>
<!-- content @e -->	
<?php echo minifier('adminvalidate.min.js'); ?>

<script>
$("#bulkproduct").validate({ 
	rules: { 
        uploadFile: {
            required: true,            
        },
    },

});

</script>