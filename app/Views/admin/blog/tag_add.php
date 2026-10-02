<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('add')?> <?=getlang('tag')?></h3>
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
                                                <a href="<?php echo base_url()?>/beheerpaneel/blog/tags" class="btn btn-primary"><span><?=getlang('terug_naar_blogtags')?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url()?>/beheerpaneel/blog/tags" class="btn btn-icon btn-primary"><?=getlang('terug_naar_blogtags')?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
					      <?php $uri = current_url(true);?> 
						
                </div><!-- .nk-block-head -->


                <?php echo form_open_multipart("beheerpaneel/blog/tag_add",array('id'=>'blogtagform'))?>
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-xl">
                        <div class="nk-content-body">
                            <div class="card">
                                <div class="nk-editor bg_Tag_ad">
                                    <div class="nk-editor-header">
                                        <div class="nk-editor-title">
                                            <input type="text" name="title" class="page_input_title form-control" id="default-01" value="<?= old('title', $previousInput['title'] ?? ''); ?>" placeholder="<?=getlang("titel");?>">    
                                        </div>
                                        <div class="nk-editor-tools d-none d-xl-flex">
                                            <ul class="d-inline-flex gx-3">
                                                <li>
                                                    <button class="btn btn-md btn-primary rounded-pill" type="submit"> Save </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .nk-editor -->
                            </div>
                        </div>
                    </div>
                </div>
                </form>








                 
            </div><!-- .content-page -->
        </div>
    </div>
</div>
<!-- content @e -->	


<?php echo minifier('adminvalidate.min.js'); ?> 

<script>
$("#blogform").validate({ 
	rules: { 
        title: {
            required: true,            
         }
      },

});

</script>

<?php
    //echo minifier('summernote.min.css'); 
    //echo minifier('summernote.min.js'); 
?>

<script>
   
    // $('.summernote-basic').summernote(summernoteOptions);
</script>