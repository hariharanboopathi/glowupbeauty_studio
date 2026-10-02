<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("blog_content");?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
						<?php echo form_open_multipart("beheerpaneel/pages/blogcontent",array('id'=>'blogcontent'))?>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("content");?> 1</label>    
                                <div class="form-control-wrap">        
								<textarea name="content_1" class="summernote-basic"><?php echo $blogcontent[0]->content_1;?></textarea>   
                                </div>
                            </div>
                            <div class="form-group"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
							</form>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div><!-- .content-page -->
        </div>
    </div>
</div>
<!-- content @e --><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>