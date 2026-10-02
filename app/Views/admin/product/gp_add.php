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
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/product/gegroepeerde_producten" class="btn btn-primary"><span><?=getlang('back_to_group_products');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/product/gegroepeerde_producten" class="btn btn-icon btn-primary"><?=getlang('back_to_group_products');?></a>
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
						
                        <?php echo form_open_multipart("beheerpaneel/product/group_product_add",array('id'=>'groupproductform'))?>
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1"><?=getlang('general')?></a>
                                </li>

                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3"><?=getlang('categories')?></a>
                                </li> -->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem1">
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('group_product_name');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="pname" class="form-control" id="default-01" placeholder="<?=getlang("product_name");?>" value="<?= old('pname', $previousInput['pname'] ?? ''); ?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                            <label class="form-label"><?=getlang("product_and_sku");?></label>    
                                        <div class="form-control-wrap">        
                                            <select class="form-select js-select2" multiple name="product_sku[]">
                                                <?php if(!empty($all_products)) { foreach($all_products as $all_p){ ?>
                                                    <option value="<?=$all_p->id?>"><?php echo $all_p->pname . ' - ' .$all_p->product_sku;?></option>
                                                <?php }  }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            </br>
                            </br>

                            <div class="form-group gp_sub_cls"><button type="submit" class="btn btn-lg btn-primary"><?=getlang("submit");?></button></div>
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
</script><?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>