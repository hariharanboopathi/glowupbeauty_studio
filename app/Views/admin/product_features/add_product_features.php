<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('add');?> <?=getlang('products');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/product/manage" class="btn btn-primary"><span><?=getlang('back_to_products');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/product/manage" class="btn btn-icon btn-primary"><?=getlang('back_to_products');?></a>
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
						
                        <?php echo form_open_multipart("beheerpaneel/product/add",array('id'=>'productform'))?>
						    <div class="form-group">
                                <label class="form-label" name="faq" for="fva-topics"><?=getlang('category');?></label>                               
                                <div class="form-control-wrap ">                               
                                    <select class="form-select js-select2" id="fva-topics" name="cat_id" data-placeholder="<?=getlang('select_category');?>" >   
                                    <option label="empty" value=""></option>
									<?php if(!empty($category_detail)){         
                                              foreach($category_detail as $c){?>     ?>              
                                        
                                        <option value="<?php echo $c->id;?>"><?php echo $c->name;?></option>                       
                                     <?php  }  } ?>                                                        
                                    </select>                               
                                </div>                               
                            </div>
						    <div class="form-group">    
                                <label class="form-label" for="default-01"><?=getlang('product_name');?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="pname" class="form-control" id="default-01" placeholder="<?=getlang("product_name");?>" value="<?= old('pname', $previousInput['pname'] ?? ''); ?>">    
                                </div>
                            </div>
                            <div class="form-group">    
                                <label class="form-label" for="default-02"><?=getlang("product_sku");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="product_sku"  class="form-control" id="default-02" placeholder="<?=getlang("product_sku");?>" value="<?= old('product_sku', $previousInput['product_sku'] ?? ''); ?>">    
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-03"><?=getlang("stock");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="quantity"  class="form-control" id="default-03" placeholder="<?=getlang("stock");?>" value="<?= old('quantity', $previousInput['quantity'] ?? ''); ?>">    
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-04"><?=getlang("regular_price");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="rprice"  class="form-control" id="default-04" placeholder="<?=getlang("regular_price");?>" value="<?= old('rprice', $previousInput['rprice'] ?? ''); ?>">    
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-04"><?=getlang("offer_price");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="regoffprice"  class="form-control" id="default-04" placeholder="<?=getlang("offer_price");?>" value="<?= old('regoffprice', $previousInput['regoffprice'] ?? ''); ?>">    
                                </div>
                            </div>
    
							<div class="form-group">
                                <label class="form-label" for="default-05"><?=getlang("short_description");?></label>
                                <div class="form-control-wrap">
                                    <textarea name="shortdesc" class="summernote-basic"> <?= old('shortdesc', $previousInput['shortdesc'] ?? ''); ?></textarea>
                                </div>
                            </div>   
							<div class="form-group">
                                <label class="form-label" for="default-05"><?=getlang("product_information");?></label>
                                <div class="form-control-wrap">
                                    <textarea name="pinfo" class="summernote-basic"><?= old('pinfo', $previousInput['pinfo'] ?? ''); ?></textarea>
                                </div>
                            </div>   
							<div class="form-group">
                                <label class="form-label" for="default-05"><?=getlang("additional_product_information");?></label>
                                <div class="form-control-wrap">
                                    <textarea name="additional_info" class="summernote-basic"><?= old('additional_info', $previousInput['additional_info'] ?? ''); ?></textarea>
                                </div>
                            </div>   
							<div class="form-group">    
                                <label class="form-label" for="default-04"><?=getlang("product_url");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="slug"  class="form-control" id="default-04" placeholder="<?=getlang("product_url");?>" value="<?= old('slug', $previousInput['slug'] ?? ''); ?>">    
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-04"><?=getlang("meta_title");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="meta_title"  class="form-control" id="default-04" placeholder="<?=getlang("meta_title");?>" value="<?= old('meta_title', $previousInput['meta_title'] ?? ''); ?>">    
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-04"><?=getlang("meta_description");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="meta_desc"  class="form-control" id="default-04" placeholder="<?=getlang("meta_description");?>" value="<?= old('meta_desc', $previousInput['meta_desc'] ?? ''); ?>">    
                                </div>
                            </div>
							<div class="form-group">    
                                <label class="form-label" for="default-04"><?=getlang("meta_keyword");?></label>    
                                <div class="form-control-wrap">        
                                    <input type="text" name="meta_keyword"  class="form-control" id="default-04" placeholder="<?=getlang("meta_keyword");?>" value="<?= old('meta_keyword', $previousInput['meta_keyword'] ?? ''); ?>">    
                                </div>
                            </div>

							<div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="1" name="status"  id="fv-com-phone" >
                                    <label class="custom-control-label" for="fv-com-phone"> <?=getlang("
                                    hide_product");?></label>
                                </div>
                            </div>
												
						
												
                            <div class="form-group">
                                <label class="form-label"><?=getlang("image");?></label>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" accept=".png,.jpg,.jpeg,.webp" name="pimage[]" multiple class="form-file-input" id="customMultipleFiles" multiple>
                                        <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
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
         regoffprice:{
            required: true,
         },
         slug:
         {
            required: true,
         },
        //  meta_title:{
        //     required: true,
        //  }
        //  meta_desc:{
        //     required: true,
        //  }
        //  meta_keyword:{
        //     required: true,
        //  }
      },

});

</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>