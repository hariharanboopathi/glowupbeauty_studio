<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('add');?> <?=getlang('shipping');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/shipments/manage" class="btn btn-primary"><span><?=getlang('back_to_shipments');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/shipments/manage" class="btn btn-icon btn-primary"><?=getlang('back_to_shipments');?></a>
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
						
                        <?php echo form_open_multipart("beheerpaneel/shipments/add",array('id'=>'productform'))?>
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tabItem1"><?=getlang('general')?></a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tabItem2"><?=getlang('rates')?></a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tabItem3"><?=getlang('icon')?></a></li>


                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem1">
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('shipping_name');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="sname" class="form-control" id="default-01" placeholder="<?=getlang("shipping_name");?>" value="<?= old('sname', $previousInput['sname'] ?? ''); ?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label" for="default-02"><?=getlang("delivery_time");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="delivery_time"  class="form-control" id="default-02" placeholder="<?=getlang("delivery_time");?>" value="<?= old('delivery_time', $previousInput['delivery_time'] ?? ''); ?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" name="stock" for="fva-stock"><?=getlang('status');?></label>                               
                                        <div class="form-control-wrap ">                               
                                            <select class="form-select js-select2" id="fva-stock" name="status" data-placeholder="<?=getlang('status');?>" >   
                                        <option value="1"><?=getlang('Active');?></option>
                                        <option value="0"><?=getlang('disabled');?></option>
                                        </select>                               
                                        </div>                               
                                    </div> 

                                     
                                    <div class="form-group">
                                        <label class="form-label" for="default-05"><?=getlang("description");?></label>
                                        <div class="form-control-wrap">
                                            <textarea name="sinfo" class="summernote-basic"><?= old('sinfo', $previousInput['sinfo'] ?? ''); ?></textarea>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="Y" name="shipping_pickup"  id="fv-com-pickup" >
                                        <label class="custom-control-label" for="fv-com-pickup"> <?=getlang("Pickup?");?></label>
                                        </div>
                                    </div>
                                   
                                    
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" value="1" name="free_shipping"  id="fv-com-Aanbiedingen" >
                                            <label class="custom-control-label" for="fv-com-Aanbiedingen"> <?=getlang("free_shipping");?></label>
                                        </div>
                                    </div>


                                    <div class="form-group">    
                                        <label class="form-label" for="default-02"><?=getlang("position");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="position"  class="form-control" id="default-02" placeholder="<?=getlang("position");?>" value="<?= old('position', $previousInput['position'] ?? ''); ?>">    
                                        </div>
                                    </div>

                                     
                                </div>
                                <div class="tab-pane" id="tabItem2">

                                       
 

                                            
                        <div class="container py-4">
                        <div class="row">
                                <div class="col-md-12 form_sec_outer_task  ">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>Country</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label> Price </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                                <div class="col-md-12 form_field_outer p-0">
                                                        <div class="row form_field_outer_row">
                                                            <div class="form-group col-md-2">
                                                                <select class="form-select js-select2" name="country[]" id="country">
                                                                <?php if($countries){ 
                                                                        foreach($countries as $cinfo) {  ?>
                                                                              <option value="<?php echo $cinfo->id;?>"><?php echo $cinfo->name;?></option>
                                                                <?php   }
                                                                } ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                            <input type="text" class="form-control w_91" name="price[]" value="" id="price" placeholder="" />
 
                                                            </div>
                                                            <div class="form-group col-md-2 add_del_btn_outer">
                                                            <a href="javascript:void(0)" class="btn btn-icon btn-lg btn-primary remove_node_btn_frm_field" disabled><em class="icon ni ni-delete"></em></a>
                                                            </div>
                                                        </div>

                                                       
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
                                                                <select class="form-select js-select2" name="country[]" id="country">
                                                                <?php if($countries){ 
                                                                        foreach($countries as $cinfo) {  ?>
                                                                              <option value="<?php echo $cinfo->id;?>"><?php echo $cinfo->name;?></option>
                                                                <?php   }
                                                                } ?>
                                                                </select>
                                                            </div>
                                                <div class="form-group col-md-2">
                                                <input type="text" class="form-control w_90" name="price[]" id="variant${index}" placeholder="" />
                                                </div>
                                                <div class="form-group col-md-2 add_del_btn_outer">
                                                <a href=""javascript:void(0)" class="btn btn-icon btn-lg btn-primary remove_node_btn_frm_field" disabled><em class="icon ni ni-delete"></em></a>
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


                                <div class="tab-pane" id="tabItem3">                   
                                    <label class="form-label"><?=getlang("image");?></label>
                                    <label for="fileInput" id="dropArea">
                                        <p>Click or drag and drop image here</p>
                                    </label>
                                    <input type="file" accept=".png,.jpg,.jpeg,.webp,.svg" name="simage" id="fileInput" multiple style="display:none;">
 
                                    <div id="previewContainer"></div>
                                     <div class="form-group"> </div>
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