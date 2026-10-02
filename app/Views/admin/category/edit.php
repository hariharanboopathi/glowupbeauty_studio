<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("edit");?> <?=getlang("category");?>s</h3>
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
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a target="_blank" href="<?php echo base_url($category_data[0]->slug)?>" class="btn btn-primary"><?=getlang("preview");?></a>
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
                        <?php //echo form_open_multipart();?>
						<!-- <form action="<?php echo base_url()."/beheerpaneel/category/edit/".$uri->getSegment(4);?>"  method="post" accept-charset="utf-8" enctype="multipart/form-data"> -->
                        <?php echo form_open_multipart('beheerpaneel/category/edit/'.$category_data[0]->id,array('id'=>'categoryeditform'));?>
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
                                <a class="nav-link" data-bs-toggle="tab" href="#tabItem5"><?=getlang("common_meta_info");?></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabItem1">
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("name");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="name" class="form-control" id="default-01" value="<?php echo $category_data[0]->name;?>" >    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("description");?></label>
                                    <div class="form-control-wrap">
                                        <textarea name="description" class="summernote-basic"><?php echo $category_data[0]->description ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("category_url");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="slug" class="form-control" id="default-01" value="<?php echo $category_data[0]->slug;?>" >    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="fv-topics"><?=getlang("parent_category");?></label>
                                    <div class="form-control-wrap ">
                                        <select class="form-select js-select2" data-search="on" id="fva-topics" name="parent_categories"  data-placeholder="Select a option" >
                                        <option value="0"><?=getlang('select_category');?></option>
                                        <?php if(!empty($option_detail)){?>                
                                            <?=$option_detail;?>                         
                                        <?php  } ?> 
                                                                    
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="fv-topics"><?=getlang("meerdere_oudercategorieën");?></label>
                                    <div class="form-control-wrap ">
                                        <select class="form-select js-select2" data-search="on" id="fva-topics" name="multi_parent_categories[]" multiple data-placeholder="Select a option" >
                                        <option value="0"><?=getlang('select_category');?></option>
                                        <?php if(!empty($option_detail1)){?>                
                                            <?=$option_detail1;?>                         
                                        <?php  } ?> 
                                                                    
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
                                                <option value="<?=$skey?>" <?php if($skey == $category_data[0]->shoppingfeed){ echo 'selected';}?>><?=$shopping;?></option>
                                                <?php } ?>                       
                                        <?php  }?> 
                                                                    
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" name="is_sale" <?php if($category_data[0]->is_sale == '1'){echo "checked";}?> id="show-on-sale" >
                                            <label class="custom-control-label" for="show-on-sale"><?=getlang("Aanbiedingen");?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" name="featured_category" <?php if($category_data[0]->featured_category == '1'){echo "checked";}?> id="fv-com-email" >
                                            <label class="custom-control-label" for="fv-com-email"><?=getlang("enable_featured_category");?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" <?php if($category_data[0]->status == '1'){echo "checked";}?> name="status"  id="fv-com-phone" >
                                        <label class="custom-control-label" for="fv-com-phone"> <?=getlang("hide_category");?></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                                    
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" name="show_on_homepage" <?php if($category_data[0]->show_on_homepage == '1'){echo "checked";}?> id="show_on_homepage" >
                                            <label class="custom-control-label" for="show_on_homepage"><?=getlang("show_on_homepage");?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" <?php if($category_data[0]->show_on_footer == '1'){echo "checked";}?> name="show_on_footer"  id="show_on_footer" >
                                        <label class="custom-control-label" for="show_on_footer"> <?=getlang("show_on_footer");?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="1" <?php if($category_data[0]->chris_theme == '1'){echo "checked";}?> name="chris_theme"  id="chris_theme" >
                                        <label class="custom-control-label" for="chris_theme"> <?=getlang("Chris_Theme");?></label>
                                    </div>
                                </div>
                                
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("Bottom_Content_Title");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="bottom_cont_title" class="form-control" id="default-01" value="<?php echo $category_data[0]->bottom_cont_title;?>" >    
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("bottom content 1");?></label>
                                    <div class="form-control-wrap">
                                        <textarea name="ban_description" class="summernote-basic"><?php echo $category_data[0]->ban_description ?></textarea>
                                    </div>
                                </div> 

                                
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("Bottom content 2");?></label>
                                    <div class="form-control-wrap">
                                        <textarea name="bottom_content" class="summernote-basic"><?php echo $category_data[0]->bottom_content ?></textarea>
                                    </div>
                                </div> 
                                
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("Bottom Comment");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="bottom_cont_sub_title" class="form-control" id="default-01" value="<?php echo $category_data[0]->bottom_cont_sub_title;?>" >    
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("Bottom content title 2");?></label>    
                                    <div class="form-control-wrap">
                                        <textarea name="bottom_content_title2" class="summernote-basic"><?php echo $category_data[0]->bottom_content_title2 ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("Bottom content 3");?></label>
                                    <div class="form-control-wrap">
                                        <textarea name="bottom_content3" class="summernote-basic"><?php echo $category_data[0]->bottom_content3 ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("Bottom_button_name");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="bottom_cont_button_name" class="form-control" id="default-01" value="<?php echo $category_data[0]->bottom_cont_button_name;?>" >    
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("Bottom_button_url");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="bottom_cont_button_url" class="form-control" id="default-01" value="<?php echo $category_data[0]->bottom_cont_button_url;?>" >    
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
                                <?php if($category_data[0]->image){?>
                                   
                                    <img width="200" height="200" src="<?php echo !empty($category_data[0]->image)?image_url('uploads/category/'.$category_data[0]->image):''; ?>" style="object-fit:contain;">
                                    <span data-id="<?=$category_data[0]->id;?>" class="rem_cat_img" onclick="remove_cat_image(this);" data-key="image" data-image_value="<?=$category_data[0]->image;?>">X</span>
                                    <?php }  else{?>
                                        <?php echo ""?>
                                    <?php } ?>
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
                                <?php if($category_data[0]->bimage){?>
                                    
                                    <img  src="<?php echo !empty($category_data[0]->bimage)?image_url('uploads/category/'.$category_data[0]->bimage):''; ?>" style="object-fit:contain;">
                                    <span data-id="<?=$category_data[0]->id;?>" class="rem_cat_img" onclick="remove_cat_image(this);" data-key="bimage" data-image_value="<?=$category_data[0]->bimage;?>">X</span>
                                    <?php }  else{?>
                                        <?php echo ""?>
                                    <?php } ?>
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

                                <div class="form-group">
                                <?php if($category_data[0]->bottom_cont_image){?>
                                    
                                    <img width="200" height="200" src="<?php echo !empty($category_data[0]->bottom_cont_image)?image_url('uploads/category/'.$category_data[0]->bottom_cont_image):''; ?>" style="object-fit:contain;">
                                    <span data-id="<?=$category_data[0]->id;?>" class="rem_cat_img" onclick="remove_cat_image(this);" data-key="bottom_cont_image" data-image_value="<?=$category_data[0]->bottom_cont_image;?>">X</span>
                                    <?php }  else{?>
                                        <?php echo ""?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabItem3">
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("meta_title");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="meta_title" class="form-control" id="default-01" value="<?php echo $category_data[0]->meta_title;?>" >    
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("meta_description");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="meta_desc" class="form-control" id="default-01" value="<?php echo $category_data[0]->meta_desc;?>" >    
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-01"><?=getlang("meta_keyword");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="meta_keyword" class="form-control" id="default-01" value="<?php echo $category_data[0]->meta_keyword;?>" >    
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabItem5">
                                <label class="shortcode-info"><?=getlang('product_name_shortcode')?> - {product_name}</label>
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("meta_title");?></label>
                                    <div class="form-control-wrap">
                                        
                                        <input type="text" name="cmmeta_title" class="form-control" id="default-cmmeta_title" value="<?=strip_tags($category_data[0]->cmmeta_title)?>" >
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("meta_keyword");?></label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="cmmeta_keyword" class="form-control" id="default-cmmeta_keyword" value="<?=strip_tags($category_data[0]->cmmeta_keyword)?>" >
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("meta_description");?></label>
                                    <div class="form-control-wrap">
                                        
                                        <input type="text" name="cmmeta_desc" class="form-control" id="default-cmmeta_desc" value="<?=strip_tags($category_data[0]->cmmeta_desc)?>" >
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="form-label" for="default-05"><?=getlang("meta_OG_title");?></label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="cmog_title" class="form-control" id="default-cmog_title" value="<?=strip_tags($category_data[0]->cmog_title)?>" >
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

                                <div class="form-group">
                                <?php if($category_data[0]->cmog_image){?>
                                    <img width="200" height="200" src="<?php echo !empty($category_data[0]->cmog_image)?image_url('uploads/productcategoriesmetainfo/'.$category_data[0]->cmog_image):''; ?>" style="object-fit:contain;">
                                    <?php }  else{?>
                                        <?php echo ""?>
                                    <?php } ?>
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
<!-- content @e -->	<?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>
<script>
    function remove_cat_image(element) {
        var key = element.getAttribute('data-key');
        var imageValue = element.getAttribute('data-image_value');
        var category_id = element.getAttribute('data-id');
        $.ajax({
            url: "<?php echo base_url(); ?>beheerpaneel/category/remove_cat_image/" + category_id,
            method: 'POST',
            data: { key: key,imageValue: imageValue,category_id: category_id},
            success: function(response) {
                res = JSON.parse(response);
                // console.log(res);
                if(res.success){

                    NioApp.Toast(res.message, 'success');
                    
                }else{
                    NioApp.Toast(res.message, 'error');

                }
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        });


        console.log("Removing image with key:", key, "and value:", imageValue);
        // Add your logic here to handle image removal
    }
</script>