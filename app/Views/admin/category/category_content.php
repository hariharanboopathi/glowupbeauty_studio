<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("edit");?> <?=getlang("category_content");?>s</h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <!-- <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url()?>/beheerpaneel/category/manage" class="btn btn-primary"><span><?=getlang("back_to_categories");?></span></a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
					      <?php $uri = current_url(true);?> 
						
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
                        <?php //echo form_open_multipart();?>
						<!-- <form action="<?php echo base_url()."/beheerpaneel/category/edit/".$uri->getSegment(4);?>"  method="post" accept-charset="utf-8" enctype="multipart/form-data"> -->
                        <?php echo form_open_multipart('beheerpaneel/category/category_content/'.$categorycontent_data[0]->id,array('id'=>'categorycontenteditform'));?>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("title");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="title" class="form-control" id="default-01" value="<?php echo $categorycontent_data[0]->title;?>" >    
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("subtitle");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="sub_title" class="form-control" id="default-01" value="<?php echo $categorycontent_data[0]->sub_title;?>" >    
                                </div>
                            </div>
							<div class="form-group">
                                <label class="form-label" for="default-05"><?=getlang("content");?></label>
                                <div class="form-control-wrap">
                                    <textarea name="content" class="summernote-basic"><?php echo $categorycontent_data[0]->content ?></textarea>
                                </div>
                            </div> 
							
                            
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("button_name");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="button_name" class="form-control" id="default-01" value="<?php echo $categorycontent_data[0]->button_name;?>" >    
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang("button_url");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="button_url" class="form-control" id="default-01" value="<?php echo $categorycontent_data[0]->button_url;?>" >    
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="form-label"><?=getlang("image");?></label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" name="image" accept=".png,.jpg,.jpeg,.webp" multiple class="form-file-input" id="customMultipleFiles">
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                    </div>
                                </div>
                            </div>

							<div class="form-group">
                            <?php if($categorycontent_data[0]->image){?>
								<img width="350" height="350" src="<?php echo !empty($categorycontent_data[0]->image)?base_url('uploads/category/'.$categorycontent_data[0]->image):''; ?>">
                                <?php }  else{?>
                                    <?php echo ""?>
                                <?php } ?>
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
$("#categorycontenteditform").validate({ 
	rules: { 
        title: {
            required: true,            
        },
        sub_title: {
         	required: true,
        },
        content: {
            required: true,            
        },
        
    },

});

</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>