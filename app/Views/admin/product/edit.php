
<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('products');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(ADMIN_URL); ?>/product/manage" class="btn btn-primary"><span><?=getlang('back_to_products');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a target="_blank" href="<?php echo product_slug($product_data[0]->id); ?>" class="btn btn-primary"><?=getlang('preview');?></a>
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
						<!-- <form method="post" action="" id="pageform" enctype="multipart/form-data"> -->
                        <?php echo form_open_multipart(ADMIN_URL."/product/edit/".$product_data[0]->id,array('id'=>'productform'))?>
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1"><?=getlang('general')?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2"><?=getlang('variants')?></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3"><?=getlang('features')?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"  data-bs-toggle="tab" href="#tabItem4"><?=getlang('media')?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"  data-bs-toggle="tab" href="#tabItem5"><?=getlang('meta')?></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link"  data-bs-toggle="tab" href="#tabItem6"><?=getlang('videos')?></a>
                                </li>

                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3"><?=getlang('categories')?></a>
                                </li> -->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem1">
                                    <div class="form-group">
                                        <label class="form-label" name="faq" for="fva-topics"><?=getlang('category');?></label>                               
                                        <div class="form-control-wrap ">                               
                                            <select class="form-select js-select2" data-search="on" id="fva-topics" name="cat_id[]" data-placeholder="<?=getlang('select_category');?>" multiple>   
                                        <option value="0"><?=getlang('select_category');?></option>
                                            <?php if(!empty($category_detail)){ ?> 
                                                <?=$category_detail;?>                                  
                                            <?php  }?>                                                           
                                            </select>                               
                                        </div>                               
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('product_name');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="pname" class="form-control" id="default-01" placeholder="<?=getlang("product_name");?>"  value="<?php echo $product_data[0]->pname;?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-02"><?=getlang("product_sku");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="product_sku"  class="form-control" id="default-02" placeholder="<?=getlang("product_sku");?>" value="<?php echo $product_data[0]->product_sku;?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-02"><?=getlang("EAN");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="ean"  class="form-control" id="default-02" placeholder="<?=getlang("ean");?>" value="<?php echo $product_data[0]->ean;?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-productfeed_ean"><?=getlang("shoppingfeed_ean");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="productfeed_ean"  class="form-control" id="default-productfeed_ean" placeholder="<?=getlang("shoppingfeed_ean");?>" value="<?php echo $product_data[0]->productfeed_ean;?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" name="stock" for="fva-stock"><?=getlang('stock_availability');?></label>                               
                                        <div class="form-control-wrap ">                               
                                            <select class="form-select js-select2" id="fva-stock" name="stock" data-placeholder="<?=getlang('stock_availability');?>" >   
                                        <option value="1" <?php if($product_data[0]->stock == 1){ echo "selected";}?>><?=getlang('Op_voorraad');?></option>
                                        <option value="0" <?php if($product_data[0]->stock == 0){ echo "selected";}?>><?=getlang('voorraad_uit');?></option>
                                        </select>                               
                                        </div>                               
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-03"><?=getlang("stock");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="quantity"  class="form-control" id="default-03" placeholder="<?=getlang("stock");?>" value="<?php echo $product_data[0]->quantity;?>">    
                                        </div>
                                    </div>

                                    <div class="form-group">    
                                        <label class="form-label" for="default-03"><?=getlang("Vat");?></label>    
                                        <div class="form-control-wrap"> 
                                            
                                        <select class="form-select js-select2" id="fva-vat" name="vat" data-placeholder="<?=getlang('Vat');?>" >
                                        <?php foreach($vat as $v){?>
                                        <option value="<?=$v->name;?>" <?php if($product_data[0]->vat == $v->name){ echo "selected";}?>><?=$v->name;?></option>
                                        <?php } ?>
                                        </select> 
                                                
                                        </div>
                                    </div>

                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("regular_price");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="rprice"  class="form-control" id="default-04" placeholder="<?=getlang("regular_price");?>" value="<?php if(!empty($product_data[0]->rprice)){echo $product_data[0]->rprice;}?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("offer_price");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="regoffprice"  class="form-control" id="default-04" placeholder="<?=getlang("offer_price");?>"value="<?php echo $product_data[0]->regoffprice;?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("DeliveryTime");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="DeliveryTime"  class="form-control" id="default-04" placeholder="<?=getlang("DeliveryTime");?>"value="<?php echo $product_data[0]->DeliveryTime;?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("DeliveryCosts");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="DeliveryCosts"  class="form-control" id="default-04" placeholder="<?=getlang("DeliveryCosts");?>"value="<?php echo $product_data[0]->DeliveryCosts;?>" onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 44 || event.charCode == 46)"
                                            Explanation:>    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="default-05"><?=getlang("short_description");?></label>
                                        <div class="form-control-wrap">
                                            <textarea name="shortdesc" class="summernote-basic"><?php echo $product_data[0]->shortdesc;?></textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group">    
                                        <label class="form-label" for="default-03"><?=getlang("ondertitel");?> 1</label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="subtitle1"  class="form-control" placeholder="<?=getlang("ondertitel 1");?>" value="<?php echo $product_data[0]->subtitle1;?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="default-05"><?=getlang("short_description");?> 1</label>
                                        <div class="form-control-wrap">
                                            <textarea name="shortdesc1" class="summernote-basic"><?php echo $product_data[0]->shortdesc1;?></textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group">    
                                        <label class="form-label" for="default-03"><?=getlang("ondertitel");?> 2</label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="subtitle2"  class="form-control"  placeholder="<?=getlang("ondertitel 2");?>" value="<?php echo $product_data[0]->subtitle2;?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="default-05"><?=getlang("short_description");?> 2</label>
                                        <div class="form-control-wrap">
                                            <textarea name="shortdesc2" class="summernote-basic"><?php echo $product_data[0]->shortdesc2;?></textarea>
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label class="form-label" for="default-05"><?=getlang("product_information");?></label>
                                        <div class="form-control-wrap">
                                            <textarea name="pinfo" class="summernote-basic"><?php echo $product_data[0]->pinfo;?></textarea>
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label class="form-label" for="default-05"><?=getlang('additional_product_information');?></label>
                                        <div class="form-control-wrap">
                                            <textarea name="additional_info" class="summernote-basic"><?php echo $product_data[0]->additional_info;?></textarea>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label class="form-label" for="default-06"><?=getlang('Product_UPS');?></label>
                                        <div class="form-control-wrap">
                                            <textarea name="product_ups" class="summernote-basic"><?php echo $product_data[0]->product_ups;?></textarea>
                                        </div>
                                    </div> 
                                  


                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("product_url");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="slug"  class="form-control" id="default-04" value="<?php echo $product_data[0]->slug;?>" placeholder="<?=getlang("product_url");?>">    
                                        </div>
                                    </div>

                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('product_review_star_rating');?></label>    
                                        <!-- <div class="form-control-wrap">        
                                            <input type="text" name="review_star_rating" class="form-control" id="default-01" placeholder="<?=getlang("product_review_star_rating");?>" value="<?php echo $product_data[0]->review_star_rating;?>">    
                                        </div> -->
                                        <div clsss="review">
                                        <div class="rating-container" id="rating-container">
                                            <!-- Stars will be dynamically added here using JavaScript -->
                                        </div>
                                        </div>
                                        <input type="hidden" id="selected-rating" value="<?php echo $product_data[0]->review_star_rating;?>" name="review_star_rating" >
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="<?php if(!empty($product_data[0]->cart_product)){echo 1;}else{echo 0;}?>" name="cart_product"  id="cart_product" <?php if(!empty($product_data[0]->cart_product)){echo 'checked';} ?> >
                                        <label class="custom-control-label" for="cart_product"> <?=getlang("winkelwagen_product");?></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="1" <?php if($product_data[0]->is_sale == '1'){echo "checked";}?> name="is_sale"  id="fv-com-sale" >
                                            <label class="custom-control-label" for="fv-com-sale"> <?=getlang("
                                            Aanbiedingen");?></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="1" <?php if($product_data[0]->bestseller == '1'){echo "checked";}?> name="bestseller"  id="fv-com-insurance" >
                                            <label class="custom-control-label" for="fv-com-insurance"> <?=getlang("
                                            Populaire Producten");?></label>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('Insurance_price');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="insurance_price" class="form-control" id="Insurance_price" placeholder="<?=getlang("Insurance_price");?>" value="<?php echo $product_data[0]->insurance_price;?>">    
                                        </div>
                                    </div> -->

                                    <!-- <div class="form-group">
                                        <label class="form-label" for="default-05"><?=getlang("Insurance_Popup_Content");?></label>
                                        <div class="form-control-wrap">
                                            <textarea name="insurance_pop_content" id="Insurance_Popup_Content" class="summernote-basic"><?php echo $product_data[0]->insurance_pop_content;?></textarea>
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="1" <?php if($product_data[0]->status == '1'){echo "checked";}?> name="status"  id="fv-com-status" >
                                            <label class="custom-control-label" for="fv-com-status"> <?=getlang("hide_product");?></label>
                                        </div>
                                    </div>

                                    <div class="form-group">    
                                            <label class="form-label"><?=getlang("select_accessories_products");?></label>    
                                        <div class="form-control-wrap">   
                                            <?php $selected_accessories_product = explode(',',$product_data[0]->accesorries_products_list);?>     
                                            <select class="form-select js-select2" multiple name="accesorries_products_list[]">
                                                <?php if(!empty($all_products)) { foreach($all_products as $all_p){ if($all_p->id !=$product_data[0]->id){?>
                                                    <option value="<?=$all_p->id?>" <?php if(in_array($all_p->id,$selected_accessories_product)){ echo "selected";}?>><?php echo $all_p->pname;?></option>
                                                <?php }  } }?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">    
                                            <label class="form-label"><?=getlang("select_group_products");?></label>    
                                        <div class="form-control-wrap">   
                                            <select class="form-select js-select2"  name="group_product_list">
                                                <?php //if(!empty($group_products)) { foreach($group_products as $gp){ 
                                                    //if(empty($product_data[0]->group_product_list)){ ?>
                                                    <option value="" selected><?php //echo getlang("select_group_products"); ?></option>
                                                    <?php //} ?>
                                                    <option value="<?php //echo $gp->id?>" <?php //if($gp->id == $product_data[0]->group_product_list){ echo "selected"; }?>><?php //echo $gp->pname;?></option>
                                                <?php //}  
                                            //} } ?>
                                            </select>
                                        </div>
                                    </div> -->

                                </div>
                                <div class="tab-pane" id="tabItem2">
                                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                    <thead>
                                        <tr class="nk-tb-item nk-tb-head">
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('options_name')?></span></th>
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('chosen_options_name')?></span></th>

                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('choose_variants')?></span></th>
                                            <th class="nk-tb-col"><span class="sub-text"><?=getlang('action')?></span></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php if(!empty($product_options)){         
                                            
                                            foreach($product_options as $p){?>              
                                                
                                        <tr class="nk-tb-item">
                                            <td class="nk-tb-col">
                                                <div class="user-card">
                                                    <div class="user-info">
                                                        <span class="tb-lead"><?php echo $p->optionname;?> </span>
                                                    </div>
                                                </div>
                                            </td>

                                            <?php 
                                            
                                            $get_chosen_options_name = $general_model->fetch_data('product_options_variants_with_product',array('product_id'=>$product_data[0]->id,'status'=>'A','option_id'=>$p->id));
                                            $choosenoptionname = '-';
                                            if(!empty($get_chosen_options_name)){
                                                $chosenoptionsname = array();
                                                foreach($get_chosen_options_name as $g_chosen_name)
                                                {
                                                    $chosenoptionsname[] = $g_chosen_name->name;
                                                }
                                            $choosenoptionname = implode(',',$chosenoptionsname);
                                            }
                                            
                                            ?>
                                            <td class="nk-tb-col">
                                                <div class="user-card">
                                                    <div class="user-info">
                                                        <span class="tb-lead"><?=$choosenoptionname;?></span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="nk-tb-col">
                                                <div class="user-card">
                                                    <div class="user-info">
                                                        <span class="tb-lead"><a href="<?=base_url('beheerpaneel/product_options/select_varaints/'.$p->id.'/'.$product_data[0]->id);?>" target="_blank"><?=getlang('select_variants')?></a></span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="nk-tb-col">
                                                <div class="user-card">
                                                    <div class="user-info">
                                                        <span class="tb-lead"><a href="<?=base_url('beheerpaneel/product_options/delete_varaints/'.$p->id.'/'.$product_data[0]->id);?>" ><?=getlang('remove')?></a></span>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                        
                                        </tr><!-- .nk-tb-item  -->
                                    
                                        <?php  }  
                                    
                                    } ?>      

                                        
                                    </tbody>
                                </table>
                                </div>




                                <div class="tab-pane" id="tabItem3"> 
                                    <?php 
                                    if($product_features) {

                                        // echo "<pre>";print_r($product_features);exit;

                                        foreach($product_features as $key => $pf){ 
                                          if(!empty($feature_having_catergory)){
                                            if(in_array($pf->feature_id ,$feature_having_catergory)){
                                            ?>
                                        
                                                 <?php if($pf->feature_style == 'checkbox' && $pf->feature_type == 'c'){ 
                                                        $pf_value = get_product_features_variant_values($product_data[0]->id,$pf->feature_id);
                                                    
                                                    ?>
                                                    <div class="custom-control custom-checkbox">
                                                    <input type="hidden" id="customCheck_no_<?php echo $pf->feature_id; ?>" value="0" name="product_data[product_features][<?php echo $pf->feature_id; ?>_<?php echo $pf->feature_style; ?>_<?php echo $pf->feature_type; ?>][]">
                                                            <input type="checkbox" <?php if($pf_value == 'on'){ ?> checked <?php } ?> class="custom-control-input" id="customCheck<?php echo $pf->feature_id; ?>" name="product_data[product_features][<?php echo $pf->feature_id; ?>_<?php echo $pf->feature_style; ?>_<?php echo $pf->feature_type; ?>][]">
                                                           
                                                            <label class="custom-control-label" for="customCheck<?php echo $pf->feature_id; ?>"><?php echo $pf->internal_name; ?></label>
                                                        </div>

                                                <?php } else if($pf->feature_style == 'text' && $pf->feature_type == 'd'){ 
                                                    
                                                    $pf_value = get_product_features_variant_values($product_data[0]->id,$pf->feature_id);  ?>
                                                    <div class="form-group">
                                                        <label class="form-label"><?php echo $pf->internal_name; ?></label>
                                                        <div class="form-control-wrap">
                                                            <div class="form-icon form-icon-left">
                                                                <em class="icon ni ni-calendar"></em>
                                                            </div>
                                                            <input type="text" class="form-control date-picker" value="<?php echo $pf_value; ?>" id="feature<?php echo $pf->feature_id; ?>" name="product_data[product_features][<?php echo $pf->feature_id; ?>_<?php echo $pf->feature_style; ?>_<?php echo $pf->feature_type; ?>][]">
                                                        </div> 
                                                    </div>

                                                <?php } else { ?> 
                                                    <div class="form-group">
                                                       <label class="form-label"><?php echo $pf->internal_name; ?></label>
                                                        <div class="form-control-wrap">

                                                    <?php  $feature_variants = get_product_feature_variants($pf->feature_id);

                                                           if($feature_variants){ ?> 
                                                                <select name="product_data[product_features][<?php echo $pf->feature_id; ?>_<?php echo $pf->feature_style; ?>_<?php echo $pf->feature_type; ?>][]" class="form-select js-select2" <?php if($pf->feature_style == 'multiple_checkbox'){ ?>multiple="multiple"<?php } ?> data-placeholder="<?=getlang('select_variants');?>" id="feature<?php echo $pf->feature_id; ?>">
                                                                 <?php foreach($feature_variants as $fv){ 
                                                                         $pfvv = get_product_features_variant_value_match($product_data[0]->id,$pf->feature_id,$fv->variant_id);
                                                                         ?>
                                                                       <option <?php if($pfvv == '1'){ ?> selected="selected" <?php } ?> value="<?php echo $fv->variant_id; ?>"><?php echo $fv->variant; ?></option>
                                                                 <?php } ?>  
                                                                </select>
                                                      <?php }   ?>

                                                      </div>
                                                    </div>

                                                    <?php } ?>
                                                       
                                                
                                            

                                     <?php 
                                            }   
                                        }
                                        } 
                                    } ?>

                             </div>
                            <div class="tab-pane" id="tabItem4">
                                <label class="form-label"><?=getlang("image");?></label>
                                    <label for="fileInput" id="dropArea">
                                        <p>Click or drag and drop images here</p>
                                    </label>
                                    <input type="file" accept=".jpg,.png,.jpeg,.webp" name="pimage[]" id="fileInput" multiple style="display:none;">

                                    <div id="previewContainer"></div>
                                <!-- <div class="form-group">
                                <?php 
                               // $product_images = product_images($product_data[0]->id);
                                //if(!empty($product_images)){ 

                                   // foreach($product_images as $p){?>
                                        <span class="prod-item">
                                            <img src="<?php //echo image_url('uploads/product/'.$p->image);?>" >

                                            <a class="btn" id="deletepimage" data-image="<?php //echo $p->image;?>" data-id="<?php //echo $p->id;?>" data-proid = "<?php //echo $product_data[0]->id; ?>">X</a>
                                        </span>

                                <?php //} }?>
                                </div> -->
                                <div class="form-group">
                                    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
                                    <style>
                                        #sortable { list-style-type: none; margin: 0; padding: 0; width: 450px; }
                                        #sortable li { margin: 3px 3px 3px 0; padding: 1px; float: left; width: 100px; height: 90px; font-size: 4em; text-align: center; }
                                    </style>
                                    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
                                    <script>
                                        $( function() {
                                        $( "#sortable" ).sortable();
                                        $( "#sortable" ).disableSelection();

                                        $('#productform').on('click', function () {
                                            var r = $("#sortable").sortable("toArray");
                                            var a = $("#sortable").sortable("serialize", {
                                                attribute: "id"
                                            });
                                            var product_imags = '';
                                            $.each( r, function( key, value ) {
                                                product_imags +=value +',';
                                            });

                                            $('#product_imags_sort').val(product_imags);
                                        });
                                        } );
                                    </script>

                                    <input type="hidden" id="product_imags_sort" name="product_imags_sort" value="" />

                                    <ul id="sortable">
                                        <?php 
                                        $product_images = product_images($product_data[0]->id);
                                        if(!empty($product_images)){ 

                                            foreach($product_images as $p){?>
                                                <li class="ui-state-default" id="<?php echo $p->id;?>">
                                                    <span class="prod-item">
                                                        <img style="width:auto;" src="<?php echo image_url('uploads/product/'.$p->image);?>" >
                                                        <a class="btn" id="deletepimage" data-image="<?php echo $p->image;?>" data-id="<?php echo $p->id;?>" data-proid = "<?=$product_data[0]->id?>">X</a>
                                                    </span>
                                                </li>
                                        <?php } }?>
                                    </ul>
                                </div>

                            </div>
                            <div class="tab-pane" id="tabItem5">
                                <div class="form-group">    
                                    <label class="form-label" for="default-04"><?=getlang("meta_title");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="meta_title"  class="form-control" id="default-04" placeholder="<?=getlang("meta_title");?>" value="<?php echo $product_data[0]->meta_title;?>">    
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-04"><?=getlang("meta_description");?></label>    
                                    <div class="form-control-wrap">        
                                        <textarea name="meta_desc" class="summernote-basic"><?php echo $product_data[0]->meta_desc;?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-04"><?=getlang("meta_keyword");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="meta_keyword"  class="form-control" id="default-04" placeholder="<?=getlang("meta_keyword");?>" value="<?php echo $product_data[0]->meta_keyword;?>">    
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="form-label" for="default-04"><?=getlang("meta_OG_title");?></label>    
                                    <div class="form-control-wrap">        
                                        <input type="text" name="og_title"  class="form-control" id="default-04" placeholder="<?=getlang("meta_OG_title");?>" value="<?php echo $product_data[0]->og_title;?>">    
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
                                </div>

                                <div class="form-group">
                                <?php if($product_data[0]->og_image){?>
                                                <img src="<?php echo !empty($product_data[0]->og_image)?image_url('uploads/product/'.$product_data[0]->og_image):''; ?>" width="50%">
                                            <?php }  else{?>
                                                <?php echo ""?>
                                            <?php } ?>
                                </div>

                            </div> 


                                             <div class="tab-pane" id="tabItem6">        
                                               <div class="container py-4">
                                                    <div class="row">
                                                        <div class="col-md-12 form_sec_outer_task  ">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label>Pos</label>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label> Embed </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 p-0">
                                                                    <div class="col-md-12 form_field_outer p-0">
                                                                        <?php if($product_videos){ 

                                                                            foreach($product_videos as $pv) {  ?>

                                                                            <div class="row form_field_outer_row">
                                                                                <div class="form-group col-md-2">
                                                                                    <input type="text" class="form-control w_90" name="pos[]" value="<?php echo $pv->position; ?>" id="pos" placeholder="" />
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                <input type="text" class="form-control w_91" name="youtube_code[]" value="<?php echo $pv->youtube_code; ?>" id="youtube_code" placeholder="" />

                                                                                </div>
                                                                                <div class="form-group col-md-2 add_del_btn_outer">
                                                                                    <button class="btn_round remove_node_btn_frm_field" >Delete </button>
                                                                                </div>
                                                                            </div>

                                                                            <?php  } 
                                                                        
                                                                        } ?>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <div class="row ml-0 bg-light mt-3 border py-3">
                                                            <div class="col-md-12">
                                                            <span  class="btn btn-outline-lite py-0 add_new_frm_field_btn"><i class="fas fa-plus add_icon"></i> Add New row</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                $(document).ready(function(){
                                                    $("body").on("click",".add_new_frm_field_btn", function (){ 
                                                    console.log("clicked");
                                                    var index = $(".form_field_outer").find(".form_field_outer_row").length + 1;
                                                    $(".form_field_outer").append(`
                                                        <div class="row form_field_outer_row">
                                                            <div class="form-group col-md-2">
                                                                <input type="text" class="form-control w_90" name="pos[]" id="pos${index}" placeholder="" />
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                            <input type="text" class="form-control w_90" name="youtube_code[]" id="youtube_code${index}" placeholder="" />
                                                            </div>
                                                            <div class="form-group col-md-2 add_del_btn_outer">
                                                                <button class="btn_round remove_node_btn_frm_field" disabled>
                                                                Delete
                                                                </button>
                                                            </div>
                                                            </div>
                                                        `);

                                                    $(".form_field_outer").find(".remove_node_btn_frm_field:not(:first)").prop("disabled", false);
                                                    $(".form_field_outer").find(".remove_node_btn_frm_field").first().prop("disabled", true);
                                                    });
                                                });


                                                    ///======Clone method
                                                $(document).ready(function(){
                                                    $("body").on("click", ".add_node_btn_frm_field", function (e) {
                                                    var index = $(e.target).closest(".form_field_outer").find(".form_field_outer_row").length + 1;
                                                    var cloned_el = $(e.target).closest(".form_field_outer_row").clone(true);

                                                    $(e.target).closest(".form_field_outer").last().append(cloned_el).find(".remove_node_btn_frm_field:not(:first)").prop("disabled", false);

                                                    $(e.target).closest(".form_field_outer").find(".remove_node_btn_frm_field").first().prop("disabled", true);

                                                    
                                                    //change id
                                                    $(e.target).closest(".form_field_outer").find(".form_field_outer_row").last().find("input[type='text']").attr("id", "mobileb_no_"+index);

                                                    $(e.target).closest(".form_field_outer").find(".form_field_outer_row").last().find("select").attr("id", "no_type_"+index);

                                                    console.log(cloned_el);
                                                    //count++;
                                                    });
                                                });


                                                $(document).ready(function(){
                                                    //===== delete the form fieed row
                                                    $("body").on("click", ".remove_node_btn_frm_field", function () {
                                                    $(this).closest(".form_field_outer_row").remove();
                                                    console.log("success");
                                                    });
                                                });



                                                </script> 
                                                </div>






                             
                                </div>
                                </br>   
                                </br>
                                </br>
                                </br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button>
                                </div>
                    </form>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div><!-- .content-page -->
        </div>
    </div>
</div>
<!-- content @e -->

 


<!-- Include rateYo library -->
<link rel="stylesheet" href="<?php echo base_url('assets/frontend');?>/css/review_star.css">
<link rel="stylesheet" href="<?php echo base_url('assets/admin_new');?>/plugins/lightbox/css/baguetteBox.min.css">

<!-- Include rateYo library -->
<script src="<?php echo base_url('assets/frontend');?>/js/review_star.js"></script>
<script src="<?php echo base_url('assets/admin_new');?>/plugins/lightbox/js/baguetteBox.min.js"></script>

<script>
// $(document).ready(function () {
    var adminStarCount = "<?php echo !empty($product_data[0]->review_star_rating)?$product_data[0]->review_star_rating:0;?>";

    // Initialize RateYo with readOnly set to false for admin
    $("#rating-container").rateYo({
        rating: adminStarCount,
        readOnly: false,
        onChange: function (rating, rateYoInstance) {
            // Update a hidden input field or any other element to store the selected rating
            $("#selected-rating").val(rating);
        }
    });

    
// });

</script>

 
<?php echo minifier('adminvalidate.min.js'); ?>


<script>
$("#productform").validate({ 
	rules: { 
        cat_id: {
            required: true,            
         },
         pname: {
         	required: true,
         },
         product_sku: {
         	required: true,
         },
         quantity:{
            required: true,
         },
         rprice:{
            required: true,
         },
         slug:
         {
            required: true,
         },
      },

});

</script>


<script>
    $(document).ready(function () {
        $('body').on('click', '#deletepimage', function () {
            var imageId = $(this).data('id');
            var productId = $(this).data('proid');
         
            // Store a reference to 'this'
            var deleteButton = $(this);
            $.ajax({
                url: '<?= base_url(ADMIN_URL)."/product/deleteImage"; ?>',
                type: 'POST',
                data: { image_id: imageId,product_id: productId },
                // dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        // Image deleted successfully, hide the corresponding UI element
                        // deleteButton.closest('.prod-item').remove();

                        var element = $("#"+imageId);
                        if (element.is("li")) {
                            element.remove();
                        }
                    } else {
                        // Handle error if needed
                        console.error('Error deleting image');
                    }
                },
                error: function () {
                    // Handle Ajax error if needed
                    console.error('Ajax request failed');
                }
            });
        });
    });
</script>

<script>
    const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');

    dropArea.addEventListener('mousedown', (e) => {
        e.preventDefault();
        fileInput.click();
    });

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('dragover');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('dragover');
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.classList.remove('dragover');
        handleFileSelect(e.dataTransfer.files);
    });

    fileInput.addEventListener('change', () => {
        handleFileSelect(fileInput.files);
    });

    function handleFileSelect(files) {
    const newFiles = new DataTransfer();

    function processFile(index) {
        if (index < files.length) {
            const file = files[index];
            const reader = new FileReader();

            reader.onload = function (e) {
                const preview = document.createElement('div');
                preview.classList.add('imagePreview');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.borderRadius = '4px';
                img.setAttribute('data-original-filename', file.name);
                preview.appendChild(img);

                const deleteButton = document.createElement('button');
                deleteButton.classList.add('deleteButton');
                deleteButton.innerHTML = 'X';
                deleteButton.addEventListener('click', () => {
                    previewContainer.removeChild(preview);
                    updateFileInput();
                });

                preview.appendChild(deleteButton);
                previewContainer.appendChild(preview);

                // Process the next file
                processFile(index + 1);
            };

            reader.readAsDataURL(file);
        } else {
            // All files processed, update the fileInput
            updateFileInput();
        }
    }

    // Start processing files from index 0
    processFile(0);
}

function updateFileInput() {
    // Update fileInput.files based on existing previews
    const existingPreviews = document.querySelectorAll('.imagePreview img');
    const newFiles = new DataTransfer();

    existingPreviews.forEach((preview) => {
        const originalFileName = preview.getAttribute('data-original-filename');
        const file = dataURLtoFile(preview.src, originalFileName);
        newFiles.items.add(file);
    });

    // Replace the entire files array in fileInput
    fileInput.files = newFiles.files;

    // Log the number of files after update
}

    // Convert data URL to File object
    function dataURLtoFile(dataurl, filename) {
        const arr = dataurl.split(',');
        const mime = arr[0].match(/:(.*?);/)[1];
        const bstr = atob(arr[1]);
        let n = bstr.length;
        const u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], filename, { type: mime });
    }
</script>


<script>
    $(document).ready(function(){
        if (!$('#fv-com-insurance').prop('checked')) {
            $('#Insurance_price').closest('.form-group').hide();
            $('#Insurance_Popup_Content').closest('.form-group').hide();
        }

        $('#fv-com-insurance').change(function(){
            if ($(this).prop('checked')) {
                $('#Insurance_price').closest('.form-group').show();
                $('#Insurance_Popup_Content').closest('.form-group').show();
            } else {
                $('#Insurance_price').closest('.form-group').hide();
                $('#Insurance_Popup_Content').closest('.form-group').hide();
            }
        });

        $('#fv-com-insurance').change();
    });
</script>
<script>
    $(document).ready(function(){

        $('#cart_product').change(function(){
            if ($('#cart_product').prop('checked')) {
                $('#cart_product').val(1);
            }else{
                $('#cart_product').val(0);
            }

        });
    });
</script>
<?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>

<!-- <script>
$(document).ready(function() {
    let summernoteOptions = {
        height: 300
    }
  $('.summernote-basic').summernote(summernoteOptions);
});
</script> -->