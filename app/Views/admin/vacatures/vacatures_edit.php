<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("edit");?> <?=getlang("vacatures");?></h3>
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
                                                <a href="<?php echo base_url()?>/beheerpaneel/vacatures/vacatures_manage" class="btn btn-primary"><span><?=getlang("back_to_vacatures");?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url()?>/beheerpaneel/vacatures/vacatures_manage" class="btn btn-icon btn-primary"><?=getlang("back_to_vacatures");?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
					      <?php $uri = current_url(true);?> 
						
                </div><!-- .nk-block-head -->

 
                <?php echo form_open_multipart("beheerpaneel/vacatures/vacatures_edit/".$uri->getSegment(4),array('id'=>'vacaturesform'));?>
                <div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-xl">
                        <div class="nk-content-body">
                            <div class="card">
                                <div class="nk-editor">
                                    <div class="nk-editor-header">
                                        <div class="nk-editor-title">
                                        <input type="text" name="title" class="page_input_title form-control" id="default-01" value="<?php echo $vacatures_data[0]->title;?>" >    
                                        </div>
                                        <div class="nk-editor-tools d-none d-xl-flex">
                                            <ul class="d-inline-flex gx-3">
                                                <li>
                                                    <button class="btn btn-md btn-primary rounded-pill" type="submit"> Save </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="nk-editor-main">
                                        <div class="nk-editor-base">
                                            <ul class="nav nav-tabs nav-sm nav-tabs-s1 px-3">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#general">General</a>
                                                </li>
                                                
                                            </ul>
                                            <div class="tab-content mt-0">
                                                <div class="tab-pane fade show active" id="general">

                                                <div class="form-group">    
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" value="1" name="status" <?php if($vacatures_data[0]->status == '1'){echo "checked";}?> id="fv-com-email" >
                                                                <label class="custom-control-label" for="fv-com-email"><?=getlang("hide");?></label>
                                                        </div>
                                                </div>
                                                    
                                                </div><!-- .tab-pane -->
                                                 
                                            </div><!-- .tab-content -->
                                        </div><!-- .nk-editor-base -->
                                        <div class="nk-editor-body">
                                        <textarea name="short_description" class="summernote-basic"><?php echo $vacatures_data[0]->short_description ?></textarea>
                                        <textarea name="description" class="summernote-basic"><?php echo $vacatures_data[0]->description ?></textarea>


                                    </div><!-- .nk-editor-body --> 
                                    </div><!-- .nk-editor-main -->

                                    
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
$("#vacaturesform").validate({ 
	rules: { 
        title: {
            required: true,            
        },
    },

});

</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>