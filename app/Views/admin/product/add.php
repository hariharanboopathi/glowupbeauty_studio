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
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1"><?=getlang('general')?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2"><?=getlang('media')?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3"><?=getlang('meta')?></a>
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
                                            <?php if(!empty($category_detail)){?>                
                                                <?=$category_detail;?>                         
                                            <?php  }?>                                                      
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
                                        <label class="form-label" for="default-02"><?=getlang("EAN");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="ean"  class="form-control" id="default-02" placeholder="<?=getlang("ean");?>" value="<?= old('ean', $previousInput['ean'] ?? ''); ?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-productfeed_ean"><?=getlang("shoppingfeed_ean");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="productfeed_ean"  class="form-control" id="default-productfeed_ean" placeholder="<?=getlang("shoppingfeed_ean");?>" value="">    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" name="stock" for="fva-stock"><?=getlang('stock_availability');?></label>                               
                                        <div class="form-control-wrap ">                               
                                            <select class="form-select js-select2" id="fva-stock" name="stock" data-placeholder="<?=getlang('stock_availability');?>" >   
                                        <option value="1"><?=getlang('Op_voorraad');?></option>
                                        <option value="0"><?=getlang('voorraad_uit');?></option>
                                        </select>                               
                                        </div>                               
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-03"><?=getlang("stock");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="quantity"  class="form-control" id="default-03" placeholder="<?=getlang("stock");?>" value="<?= old('quantity', $previousInput['quantity'] ?? ''); ?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-03"><?=getlang("Vat");?></label>    
                                        <div class="form-control-wrap">   
                                            <select class="form-select js-select2" id="fva-vat" name="vat" data-placeholder="<?=getlang('Vat');?>" >
                                                <?php foreach($vat as $v){?>
                                                <option value="<?=$v->name;?>"><?=$v->name;?></option>
                                                <?php } ?>
                                                </select>      
                                            
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
                                        <label class="form-label" for="default-04"><?=getlang("DeliveryTime");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="DeliveryTime"  class="form-control" id="default-04" placeholder="<?=getlang("DeliveryTime");?>"value="<?= old('regoffprice', $previousInput['DeliveryTime'] ?? ''); ?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("DeliveryCosts");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="DeliveryCosts"  class="form-control" id="default-04" placeholder="<?=getlang("DeliveryCosts");?>"value="<?= old('regoffprice', $previousInput['DeliveryCosts'] ?? ''); ?>" onkeypress="return (event.charCode != 8 && event.charCode == 0 || (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 44 || event.charCode == 46)"
                                            Explanation:>    
                                        </div>
                                    </div>
            
                                    <div class="form-group">
                                        <label class="form-label" for="default-05"><?=getlang("short_description");?></label>
                                        <div class="form-control-wrap">
                                            <textarea name="shortdesc" class="summernote-basic"> <?= old('shortdesc', $previousInput['shortdesc'] ?? ''); ?></textarea>
                                        </div>
                                    </div>   
                                    <div class="form-group">    
                                        <label class="form-label" for="default-03"><?=getlang("ondertitel");?> 1</label>    
                                        <div class="form-control-wrap">        
                                        <input type="text" name="subtitle1"  class="form-control" placeholder="<?=getlang("ondertitel 1");?>" value="<?= old('subtitle1', $previousInput['subtitle1'] ?? ''); ?>">      
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="default-05"><?=getlang("short_description");?> 1</label>
                                        <div class="form-control-wrap">
                                        <textarea name="shortdesc1" class="summernote-basic"> <?= old('shortdesc1', $previousInput['shortdesc1'] ?? ''); ?></textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group">    
                                        <label class="form-label" for="default-03"><?=getlang("ondertitel");?> 2</label>    
                                        <div class="form-control-wrap">        
                                        <input type="text" name="subtitle2"  class="form-control" placeholder="<?=getlang("ondertitel 2");?>" value="<?= old('subtitle2', $previousInput['subtitle2'] ?? ''); ?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="default-05"><?=getlang("short_description");?> 2</label>
                                        <div class="form-control-wrap">
                                        <textarea name="shortdesc2" class="summernote-basic"> <?= old('shortdesc2', $previousInput['shortdesc2'] ?? ''); ?></textarea>
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
                                        <label class="form-label" for="default-06"><?=getlang("Product_UPS");?></label>
                                        <div class="form-control-wrap">
                                            <textarea name="product_ups" class="summernote-basic"><?= old('product_ups', $previousInput['product_ups'] ?? ''); ?></textarea>
                                        </div>
                                    </div>

                                    


                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("product_url");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="slug"  class="form-control" id="default-04" placeholder="<?=getlang("product_url");?>" value="<?= old('slug', $previousInput['slug'] ?? ''); ?>">    
                                        </div>
                                    </div>

                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('product_review_star_rating');?></label>    
                                        <!-- <div class="form-control-wrap">        
                                            <input type="text" name="review_star_rating" class="form-control" id="default-01" placeholder="<?=getlang("product_review_star_rating");?>" value="<?= old('review_star_rating', $previousInput['review_star_rating'] ?? ''); ?>">    
                                        </div> -->

                                        <div clsss="review">
                                        <div class="rating-container" id="rating-container">
                                            <!-- Stars will be dynamically added here using JavaScript -->
                                        </div>
                                        </div>
                                        <input type="hidden" id="selected-rating" value="" name="review_star_rating" >
                                    </div>

                                    
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value=0 name="cart_product"  id="cart_product" >
                                        <label class="custom-control-label" for="cart_product"> <?=getlang("winkelwagen_product");?></label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="1" name="is_sale"  id="fv-com-Aanbiedingen" >
                                            <label class="custom-control-label" for="fv-com-Aanbiedingen"> <?=getlang("
                                            Aanbiedingen");?></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="1" name="bestseller"  id="fv-com-insurance" >
                                            <label class="custom-control-label" for="fv-com-insurance"> <?=getlang("
                                            populaire_producten");?></label>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group">    
                                        <label class="form-label" for="default-02"><?=getlang('Insurance_price');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="insurance_price" class="form-control" id="Insurance_price" placeholder="<?=getlang("Insurance_price");?>" value="<?= old('insurance_price', $previousInput['insurance_price'] ?? ''); ?>">    
                                        </div>
                                    </div> -->
<!-- 
                                    <div class="form-group">
                                        <label class="form-label" for="default-05"><?=getlang("Insurance_Popup_Content");?></label>
                                        <div class="form-control-wrap">
                                            <textarea name="insurance_pop_content" id="Insurance_Popup_Content" class="summernote-basic"><?= old('insurance_pop_content', $previousInput['insurance_pop_content'] ?? ''); ?></textarea>
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="1" name="status"  id="fv-com-status" >
                                            <label class="custom-control-label" for="fv-com-status"> <?=getlang("
                                            hide_product");?></label>
                                        </div>
                                    </div>

                                    <div class="form-group">    
                                            <label class="form-label"><?=getlang("select_accessories_products");?></label>    
                                        <div class="form-control-wrap">        
                                            <select class="form-select js-select2" multiple name="accesorries_products_list[]">
                                                <?php if(!empty($all_products)) { foreach($all_products as $all_p){ ?>
                                                    <option value="<?=$all_p->id?>"><?php echo $all_p->pname;?></option>
                                                <?php }  }?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">    
                                            <label class="form-label"><?=getlang("select_group_products");?></label>    
                                        <div class="form-control-wrap">        
                                            <select class="form-select js-select2" name="group_product_list">
                                                <?php //if(!empty($group_products)) { foreach($group_products as $gp){ ?>
                                                    <option value="" selected><?php //echo getlang("select_group_products"); ?></option>
                                                    <option value="<?php //echo $gp->id?>"><?php //echo $gp->pname;?></option>
                                                <?php //}  }?>
                                            </select>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="tab-pane" id="tabItem2">
                               

                                        <label class="form-label"><?=getlang("image");?></label>
                                        <label for="fileInput" id="dropArea">
                                            <p>Click or drag and drop images here</p>
                                        </label>
                                        <input type="file" accept=".png,.jpg,.jpeg,.webp" name="pimage[]" id="fileInput" multiple style="display:none;">

                                        <div id="previewContainer"></div>
                                </div>
                                <div class="tab-pane" id="tabItem3">
                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("meta_title");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="meta_title"  class="form-control" id="default-04" placeholder="<?=getlang("meta_title");?>" value="<?= old('meta_title', $previousInput['meta_title'] ?? ''); ?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("meta_description");?></label>    
                                        <div class="form-control-wrap">  
                                            <textarea name="meta_desc" class="summernote-basic"><?= old('meta_desc', $previousInput['meta_desc'] ?? ''); ?></textarea>      
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("meta_keyword");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="meta_keyword"  class="form-control" id="default-04" placeholder="<?=getlang("meta_keyword");?>" value="<?= old('meta_keyword', $previousInput['meta_keyword'] ?? ''); ?>">    
                                        </div>
                                    </div>

                                    <div class="form-group">    
                                        <label class="form-label" for="default-04"><?=getlang("meta_OG_title");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="og_title"  class="form-control" id="default-04" placeholder="<?=getlang("meta_OG_title");?>" value="<?= old('og_title', $previousInput['og_title'] ?? ''); ?>">    
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label"><?=getlang("meta_OG_image");?></label>
                                        <div class="form-control-wrap">
                                            <div class="form-file">
                                                <input type="file" accept=".png,.jpg,.jpeg,.webp" name="og_image" multiple class="form-file-input" id="customMultipleFiles">
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
    var adminStarCount = 3;

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
        //  regoffprice:{
        //     required: true,
        //  },
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
    console.log('Before update:', fileInput.files.length);
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
    console.log('After update:', fileInput.files.length);
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