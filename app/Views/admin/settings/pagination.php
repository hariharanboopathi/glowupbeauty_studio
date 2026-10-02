<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('pagination')?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                            
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
					      <?php $uri = current_url(true);?> 
						
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
                        <?php echo form_open_multipart("beheerpaneel/settings/pagination",array("id"=>'pagination'));?>
						

							<div class="form-group">
                                <label class="form-label"><?=getlang("pagination");?></label>
                                <div class="form-control-wrap">
									<div class="form-control-wrap">        
										<input type="text" name="pagination" class="form-control" id="default-01" value="<?php if(!empty($setting_data)){ echo $setting_data[0]->value; }?>" placeholder="<?=getlang("pagination");?>">    
									</div>
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
$("#pagination").validate({ 
	rules: { 
        pagination: {
            required: true,            
        },
		



    },

});

</script>