<!-- content @s -->
<div class="nk-content nk-content-fluid lander_page_bk">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('lander');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/lander/manage" class="btn btn-primary"><span><?=getlang('back_to_lander');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/lander/manage" class="btn btn-icon btn-primary"><span><?=getlang('back_to_lander');?></a>
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
						

                        <?php echo form_open_multipart("beheerpaneel/lander/edit/".$lander[0]->id,array('id'=>'lander_edit_form'));?>
						    
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1"><?=getlang('general')?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"  data-bs-toggle="tab" href="#tabItem2"><?php echo getlang('media'); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"  data-bs-toggle="tab" href="#tabItem4"><?=getlang('categories')?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem5"><?=getlang('producten')?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3"><?=getlang('meta')?></a>
                                </li>
                               
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem1">
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang("ondertitel 1");?></label>    
                                        <div class="form-control-wrap">        
                                            <textarea name="sub_title2" class="summernote-basic"><?php echo $lander[0]->sub_title2;?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang("ondertitel 2");?></label>    
                                        <div class="form-control-wrap">        
                                            <textarea name="sub_title1" class="summernote-basic"><?php echo $lander[0]->sub_title1;?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang("titel");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="title" class="form-control" id="default-01" placeholder="<?=getlang("titel");?>" value="<?php echo $lander[0]->title;?>" >    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('slug');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="slug" class="form-control" id="default-01" placeholder="<?=getlang("slug");?>" value="<?php echo $lander[0]->slug;?>" >    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('canonical_url');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="cananical_url" class="form-control" id="default-01" placeholder="<?=getlang("canonical_url");?>" value="<?php echo $lander[0]->cananical_url;?>" >    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang("Inhoud doos");?></label>    
                                        <div class="form-control-wrap">        
                                            <textarea name="box_content" class="summernote-basic"><?php echo $lander[0]->box_content;?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('Inhoud in knop');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="button_content" class="form-control" id="default-01" placeholder="<?=getlang("Inhoud in knop");?>" value="<?php echo $lander[0]->button_content;?>" >    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('knop-URL');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="button_url" class="form-control" id="default-01" placeholder="<?=getlang("knop-URL");?>" value="<?php echo $lander[0]->button_url;?>" >    
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang("Onderste inhoud");?></label>    
                                        <div class="form-control-wrap">        
                                            <textarea name="bottom_content" class="summernote-basic"><?php echo $lander[0]->bottom_content;?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang("onderste_inhoud");?></label>    
                                        <div class="form-control-wrap">        
                                            <textarea name="category_content" class="summernote-basic"><?php echo $lander[0]->category_content;?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('Onderste inhoud in knop');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="bottom_button_content" class="form-control" id="default-01" placeholder="<?=getlang("Onderste inhoud in knop");?>" value="<?php echo $lander[0]->bottom_button_content;?>" >    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('Onderste knop-URL');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="bottom_button_url" class="form-control" id="default-01" placeholder="<?=getlang("Onderste knop-URL");?>" value="<?php echo $lander[0]->bottom_button_url;?>" >    
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabItem2">
                                    <div class="form-group">
                                        <label class="form-label"><?=getlang('Onderste');?><?=getlang("image");?></label>
                                        <div class="form-control-wrap">
                                            <div class="form-file">
                                                <input type="file" name="bottom_image" accept=".png,.jpg,.jpeg,.webp" class="form-file-input" id="customMultipleFiles">
                                                <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <?php if($lander[0]->bottom_image){?>
                                        <img width="200" height="200" src="<?php echo !empty($lander[0]->bottom_image)?image_url('uploads/lander/'.$lander[0]->bottom_image):''; ?>" style="object-fit:contain;">
                                        <?php }  else{?>
                                            <?php echo ""?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabItem3">
                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("meta_title");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="meta_title"  class="form-control" id="default-04" placeholder="<?=getlang("meta_title");?>" value="<?php echo $lander[0]->meta_title;?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("meta_description");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="meta_description"  class="form-control" id="default-04" placeholder="<?=getlang("meta_description");?>"  value="<?php echo $lander[0]->meta_description;?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("meta_keyword");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="meta_keyword"  class="form-control" id="default-04" placeholder="<?=getlang("meta_keyword");?>" value="<?php echo $lander[0]->meta_keyword;?>">    
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("meta_OG_title");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="og_title"  class="form-control" id="default-04" placeholder="<?=getlang("meta_OG_title");?>" value="<?php //echo $lander[0]->og_title;?>">    
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label"><?=getlang("meta_OG_image");?></label>
                                        <div class="form-control-wrap">
                                            <div class="form-file">
                                                <input type="file" accept=".jpg,.png,.jpeg,.webp" name="og_image" multiple class="form-file-input" id="customMultipleFiles">
                                                <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- <div class="form-group"> -->
                                    <?php //if($lander[0]->og_image){?>
                                                    <!-- <img src="<?php //echo !empty($lander[0]->og_image)?image_url('uploads/product/'.$lander[0]->og_image):''; ?>" width="50%"> -->
                                                <?php //}  else{?>
                                                    <?php //echo ""?>
                                                <?php //} ?>
                                    <!-- </div> -->

                                </div> 
                                <div class="tab-pane" id="tabItem4">
                                    <table class="datatable-init-categories nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        
                                                    </div>
                                                </th>
                                                <th class="nk-tb-col"><span class="sub-text">Category name</span></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php $categories = explode(",",$lander[0]->categories_id);
                                                
                                                if(!empty($category_detail)){         
                                                
                                                foreach($category_detail as $c){?>              
                                                    
                                            <tr class="nk-tb-item">
                                                <td class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control-sm notext">
                                                    <input type="checkbox" value="<?php echo $c->id;?>" name="categories_id[]" <?php if(in_array($c->id,$categories)) { ?> checked ="checked" <?php } ?>  id="category_id<?php echo $c->id;?>" />
                                                    </div>
                                                </td>
                                                <td class="nk-tb-col">
                                                    <div class="user-card">
                                                        <div class="user-info">
                                                            <span class="tb-lead"><?php echo $c->name;?> </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                
                                            </tr><!-- .nk-tb-item  -->
                                            
                                            <?php  }  
                                        
                                        } ?>      

                                            
                                        </tbody>
                                    </table>
                                    

                                </div> 
                                <div class="tab-pane" id="tabItem5">
                                    <!-- <div class="form-group">    
                                        <label class="form-label"><?=getlang("Enkele topinhoud");?></label>    
                                        <div class="form-control-wrap">       
                                            <select class="form-select js-select2" data-search="on" name="single_bottom_products">
                                                <option value=""><?=getlang('Selecteer één product');?></option>
                                                <?php //if(!empty($lander_product)) { foreach($lander_product as $all_p){ ?>
                                                    <option value="<?php //echo $all_p->id; ?>" 
                                                        <?php //if($all_p->id == $lander[0]->single_bottom_products){ echo "selected";}?>>
                                                        <?php //echo $all_p->title;?>
                                                    </option>
                                                <?php //}  }  ?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="form-group">    
                                        <label class="form-label"><?=getlang("top_inhoud");?></label>    
                                        <div class="form-control-wrap">   
                                            <?php 
                                            $bottom_products = !empty($lander[0]->bottom_products) ? $lander[0]->bottom_products : array();
                                            if(!empty($bottom_products)){
                                                $bottom_products = explode(',',$bottom_products);
                                            }
                                            ?>     
                                            <select class="form-select js-select2" multiple name="bottom_products[]">
                                                <?php if(!empty($lander_product)) { foreach($lander_product as $all_p){ ?>
                                                    <option value="<?=$all_p->id?>" 
                                                        <?php if(in_array($all_p->id,$bottom_products)){ echo "selected";}?>>
                                                        <?php echo $all_p->title;?>
                                                    </option>
                                                <?php }  }  ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label"><?=getlang("Topproducten");?></label>    
                                        <div class="form-control-wrap">   
                                            <?php 
                                            $top_products = !empty($lander[0]->top_products) ? $lander[0]->top_products : array();
                                            if(!empty($top_products)){
                                                $top_products = explode(',',$top_products);
                                            }
                                            ?>     
                                            <select class="form-select js-select2" multiple name="top_products[]">
                                                <?php if(!empty($all_products)) { foreach($all_products as $all_p){ ?>
                                                    <option value="<?=$all_p->id?>" 
                                                        <?php if(in_array($all_p->id,$top_products)){ echo "selected";}?>>
                                                        <?php echo $all_p->pname .' - '. $all_p->product_sku;?>
                                                    </option>
                                                <?php }  } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">    
                                        <label class="form-label"><?=getlang("Best verkopende producten");?></label>    
                                        <div class="form-control-wrap">   
                                            <?php 
                                            $best_selling_products = !empty($lander[0]->best_selling_products) ? $lander[0]->best_selling_products : array();
                                            if(!empty($best_selling_products)){
                                                $best_selling_products = explode(',',$best_selling_products);
                                            }
                                            ?>     
                                            <select class="form-select js-select2" multiple name="best_selling_products[]">
                                                <?php if(!empty($all_products)) { foreach($all_products as $all_p){ ?>
                                                    <option value="<?=$all_p->id?>" 
                                                        <?php if(in_array($all_p->id,$best_selling_products)){ echo "selected";}?>>
                                                        <?php echo $all_p->pname .' - '. $all_p->product_sku;?>
                                                    </option>
                                                <?php }  } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
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
$("#lander_edit_form").validate({ 
	rules: { 
        name: {
            required: true,            
        },
        sub_name: {
            required: true,            
        },
        lander: {
            required: true,            
        },
        
    },

});

</script>


<!-- Include rateYo library -->

<link rel="stylesheet" href="<?php echo base_url('assets/admin_new');?>/plugins/lightbox/css/baguetteBox.min.css">

<!-- Include rateYo library -->

<script src="<?php echo base_url('assets/admin_new');?>/plugins/lightbox/js/baguetteBox.min.js"></script>



<?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?><script>
$(document).ready(function() {
    let summernoteOptions = {
        height: 300
    }
  $('.summernote-basic').summernote(summernoteOptions);
});
</script>