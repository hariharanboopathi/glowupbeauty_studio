<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("add");?> <?=getlang("category");?>s</h3>
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
                                                <a href="<?php echo base_url()?>/beheerpaneel/category/manage" class="btn btn-primary"><span><?=getlang("back_to_categories");?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url()?>/beheerpaneel/category/manage" class="btn btn-icon btn-primary"><?=getlang("back_to_categories");?></a>
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
                        <?php echo form_open_multipart("beheerpaneel/category/add",array('id'=>'categoryform'));?>
						<!-- <form action=""  method="post" accept-charset="utf-8" enctype="multipart/form-data"> -->
                        <ul class="nav nav-tabs mt-n3">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1"><?=getlang("general");?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabItem2"><?=getlang("media");?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabItem3"><?=getlang("meta");?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabItem4"><?=getlang("common_meta_info");?></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabItem1">
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("name");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="name" class="form-control" id="default-01" value="<?= old('name', $previousInput['name'] ?? ''); ?>" >    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("description");?></label>
                                    <div class="form-control-wrap">
                                        <textarea name="description" class="summernote-basic"><?= old('description', $previousInput['description'] ?? ''); ?></textarea>
                                    </div>
                                </div> 
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("category_url");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="slug" class="form-control" id="default-01" value="<?= old('slug', $previousInput['slug'] ?? ''); ?>" >    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="fv-topics"><?=getlang("parent_category");?></label>
                                    <div class="form-control-wrap ">
                                        <select class="form-select js-select2" id="fv-topics" name="parent_categories" data-placeholder="Select a option" >
                                        <option value="0"><?=getlang('select_category');?></option>
                                        <?php if(!empty($option_detail)){?>                
                                            <?=$option_detail;?>                         
                                        <?php  }?>                              
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="fv-topics"><?=getlang("meerdere_oudercategorieën");?></label>
                                    <div class="form-control-wrap ">
                                        <select class="form-select js-select2" id="fv-topics" name="multi_parent_categories[]" multiple data-placeholder="Select a option" >
                                        <option value="0"><?=getlang('select_category');?></option>
                                        <?php if(!empty($option_detail)){?>                
                                            <?=$option_detail;?>                         
                                        <?php  }?>                              
                                        </select>
                                    </div>
                                </div>
                                <?php $getcategorygoogleshoppingnames = getcategorygoogleshoppingnames();?>

                                <div class="form-group">
                                    <label class="form-label" for="fv-shopping_feed"><?=getlang("shopping_feed");?></label>
                                    <div class="form-control-wrap ">
                                        <select class="form-select js-select2" data-search="on" id="fv-shopping_feed" name="shoppingfeed" data-placeholder="<?=getlang('select_shoppingfeed');?>" >
                                        <option value=""><?=getlang('select_shoppingfeed');?></option>
                                        <?php if(!empty($getcategorygoogleshoppingnames)){?>                
                                            <?php foreach($getcategorygoogleshoppingnames as $skey=>$shopping){?>
                                                <option value="<?=$skey?>"><?=$shopping;?></option>
                                                <?php } ?>                       
                                        <?php  }?> 
                                                                    
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" name="is_sale"  id="show-on-sale" >
                                            <label class="custom-control-label" for="show-on-sale"><?=getlang("Aanbiedingen");?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" name="featured_category"  id="fv-com-email" >
                                            <label class="custom-control-label" for="fv-com-email"><?=getlang("enable_featured_category");?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1"  name="status"  id="fv-com-phone" >
                                        <label class="custom-control-label" for="fv-com-phone"> <?=getlang("hide_category");?></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                                    
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" name="show_on_homepage"  id="show_on_homepage" >
                                            <label class="custom-control-label" for="show_on_homepage"><?=getlang("show_on_homepage");?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1"  name="show_on_footer"  id="show_on_footer" >
                                        <label class="custom-control-label" for="show_on_footer"> <?=getlang("show_on_footer");?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1"  name="chris_theme"  id="chris_theme" >
                                        <label class="custom-control-label" for="chris_theme"> <?=getlang("Chris_Theme");?></label>
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("Bottom_Content_Title");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="bottom_cont_title" class="form-control" id="default-01" value="<?= old('bottom_cont_title', $previousInput['bottom_cont_title'] ?? ''); ?>" >    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("bottom content 1");?></label>
                                    <div class="form-control-wrap">
                                        <textarea name="ban_description" class="summernote-basic"><?= old('ban_description', $previousInput['ban_description'] ?? ''); ?></textarea>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("bottom content 2");?></label>
                                    <div class="form-control-wrap">
                                        <textarea name="bottom_content" class="summernote-basic"><?= old('bottom_content', $previousInput['bottom_content'] ?? ''); ?></textarea>
                                    </div>
                                </div> 


                                
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("Bottom Comment");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="bottom_cont_sub_title" class="form-control" id="default-01" value="<?= old('bottom_cont_sub_title', $previousInput['bottom_cont_sub_title'] ?? ''); ?>" >    
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("Bottom content title 2");?></label>    
                                    <div class="form-control-wrap">
                                        <textarea name="bottom_content_title2" class="summernote-basic"><?= old('bottom_content_title2', $previousInput['bottom_content_title2'] ?? ''); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("Bottom content 3");?></label>
                                    <div class="form-control-wrap">
                                        <textarea name="bottom_content3" class="summernote-basic"><?= old('bottom_content3', $previousInput['bottom_content3'] ?? ''); ?></textarea>
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("Bottom_button_name");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="bottom_cont_button_name" class="form-control" id="default-01" value="<?= old('bottom_cont_button_name', $previousInput['bottom_cont_button_name'] ?? ''); ?>" >    
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("Bottom_button_url");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="bottom_cont_button_url" class="form-control" id="default-01" value="<?= old('bottom_cont_button_url', $previousInput['bottom_cont_button_url'] ?? ''); ?>" >    
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabItem2">
                                <div class="form-group">
                                    <label class="form-label"><?=getlang("category_image");?></label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file" name="image" accept=".png,.jpg,.jpeg,.webp" class="form-file-input" id="customMultipleFiles">
                                            <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label"><?=getlang("Bottom_content_image_1");?></label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file" name="bimage" accept=".png,.jpg,.jpeg,.webp" class="form-file-input" id="customMultipleFiles">
                                            <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?=getlang("Bottom_content_image_2");?></label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file" name="bottom_cont_image" accept=".png,.jpg,.jpeg,.webp" class="form-file-input" id="customMultipleFiles">
                                            <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tabItem3">
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("meta_title");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="meta_title" class="form-control" id="default-01" value="<?= old('meta_title', $previousInput['meta_title'] ?? ''); ?>" >    
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("meta_description");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="meta_desc" class="form-control" id="default-01" value="<?= old('meta_desc', $previousInput['meta_desc'] ?? ''); ?>" >    
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("meta_keyword");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="meta_keyword" class="form-control" id="default-01" value="<?= old('meta_keyword', $previousInput['meta_keyword'] ?? ''); ?>" >    
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tabItem4">
                                <label class="shortcode-info"><?=getlang('product_name_shortcode')?> - {product_name}</label>
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("meta_title");?></label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="cmmeta_title" class="form-control" id="default-cmmeta_title" value="<?= old('cmmeta_title', $previousInput['cmmeta_title'] ?? ''); ?>" >
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("meta_keyword");?></label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="cmmeta_keyword" class="form-control" id="default-cmmeta_keyword" value="<?= old('cmmeta_keyword', $previousInput['cmmeta_keyword'] ?? ''); ?>" >
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("meta_description");?></label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="cmmeta_desc" class="form-control" id="default-cmmeta_desc" value="<?= old('cmmeta_desc', $previousInput['cmmeta_desc'] ?? ''); ?>" >
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("meta_OG_title");?></label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="cmog_title" class="form-control" id="default-cmog_title" value="<?= old('cmog_title', $previousInput['cmog_title'] ?? ''); ?>" >
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label class="form-label"><?=getlang("meta_OG_image");?></label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file" name="cmog_image" accept=".png,.jpg,.jpeg,.webp"  class="form-file-input" id="customMultipleFiles">
                                            <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

							
                            </br>
                            </br>
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
        // image:{
        //     required: true,
        // },
    },
   

});

</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>