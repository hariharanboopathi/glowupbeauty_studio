<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"> <?=getlang("edit");?>  <?=getlang("faq");?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/faq/faq_manage" class="btn btn-primary"><span> <?=getlang("back_to_faq");?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/faq/faq_manage" class="btn btn-icon btn-primary"> <?=getlang("back_to_faq");?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .toggle-wrap -->
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner card-inner-xl">
                            <?php echo form_open_multipart('beheerpaneel/faq/faq_edit/'.$faq_data[0]->id,array('id'=>'faqform'));?>
						
						    <div class="form-group">
                                <label class="form-label" name="faq" for="fva-topics"><?=getlang("category");?></label>                               
                                <div class="form-control-wrap ">                               
                                    <select class="form-select js-select2" id="fva-topics" name="faq_cat_id" >   
                                          
                                      <?php 
									       if(!empty($faq_category_detail))
												{
												 foreach($faq_category_detail as $cat)
													{  ?>                     
                                             <option <?php if($faq_data[0]->faq_cat_id == $cat->id){ ?> selected="selected" <?php }?> value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>              
                                        <?php }} ?>                                                      
                                    </select>                               
                                </div>                               
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-02"><?=getlang("title");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="title"  class="form-control" id="default-02" value="<?php echo $faq_data[0]->title;?>"  placeholder="<?=getlang("title");?>">    
                                </div>
                            </div>
							<div class="form-group">
                                <label class="form-label" for="default-05"><?=getlang("description");?></label>
                                <div class="form-control-wrap">
                                    <textarea name="description" class="summernote-basic"><?php echo $faq_data[0]->description;?></textarea>
                                </div>
                            </div>   

							<div class="form-group">           
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="1" name="status"  id="fv-com-email" <?php if($faq_data[0]->status == '1'){echo "checked";}?> >
                                        <label class="custom-control-label" for="fv-com-email"><?=getlang("hide_category");?></label>
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
<!-- content @e -->


<?php echo minifier('adminvalidate.min.js'); ?>

<script>
$("#faqform").validate({ 
	rules: { 
        faq_cat_id: {
            required: true,            
        },
        title: {
         	required: true,
        },
    },

});

</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>