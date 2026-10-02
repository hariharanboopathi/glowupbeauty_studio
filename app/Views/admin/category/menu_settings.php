  
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
<h3 class="nk-block-title page-title"><?=getlang("Category menu arrangements");?></h3>
                                 <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                             
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
					      <?php $uri = current_url(true);?> 
						
                </div><!-- .nk-block-head -->
                <div class="nk-block ms_blk">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
                        <?php echo form_open_multipart(ADMIN_URL."/category/menu_settings",array('id'=>'categoryform'));?>
						 
                        <input type="hidden" id="nestable-output" name="menu">
                        <div class="dd" id="nestable">
                                    <?php
                                        $html_menu = menuTree();
                                        echo (empty($html_menu)) ? '<ol class="dd-list"></ol>' : $html_menu;
                                    ?>
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
$("#categoryform").validate({ 
	rules: { 
        name: {
            required: true,            
        },
        slug: {
         	required: true,
        },
    },

});

</script>
