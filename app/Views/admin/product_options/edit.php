<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('edit');?> <?=getlang('product_options');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/product_options/manage" class="btn btn-primary"><span><?=getlang('back_to_product_options');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/product_options/manage" class="btn btn-icon btn-primary"><?=getlang('back_to_product_options');?></a>
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
						
                        
                        <?php echo form_open_multipart("beheerpaneel/product_options/edit/".$product_options_details[0]->id,array('id'=>'productoptionsform'))?>

                            <ul class="nav nav-tabs mt-n3">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1"><?=getlang('general')?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabItem2"><?=getlang('variants')?></a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabItem3"><?=getlang('categories')?></a>
                            </li> -->
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem1">
                                            
                                <div class="form-group">
                                    <label class="form-label" for="fw-first-name"><?=getlang('name')?></label>
                                    <div class="form-control-wrap">
                                        <input type="text" data-msg="Required" class="form-control required" id="fw-first-name" name="optionname" required autocomplete="false" value="<?php echo $product_options_details[0]->optionname;?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                <label class="form-label" for="default-05"><?=getlang("description");?></label>
                                <div class="form-control-wrap">
                                    <textarea name="description" class="summernote-basic"><?php echo $product_options_details[0]->description;?></textarea>
                                </div>
                                </div>

                                <div class="form-group">
                                <label class="form-label" for="fw-field_type"><?=getlang('field_type')?></label>
                                <div class="form-control-wrap ">
                                    <div class="form-control-select">
                                        <select class="form-control required" data-msg="Required" id="fw-field_type" name="field_type" required>
                                            <option><?=getlang('select_field_type')?></option>
                                            <option value="select" <?php if($product_options_details[0]->field_type == 'select'){ echo 'selected';}?>><?=getlang('select_box_type')?></option>
                                            <option value="image" <?php if($product_options_details[0]->field_type == 'image'){ echo 'selected';}?>><?=getlang('image_type_select')?></option>
                                            <option value="battery" <?php if($product_options_details[0]->field_type == 'battery'){ echo 'selected';}?>><?=getlang('battery_type_select')?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">   
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="Y" name="display_on_product"  id="fv-com-email" <?php if($product_options_details[0]->display_on_product == 'Y'){ echo 'checked';}?>>
                                        <label class="custom-control-label" for="fv-com-email"><?=getlang("show_on_products_tab");?></label>
                                </div> 
                                
                            </div>

                            <div class="form-group">    
                                <label class="form-label" for="default-02"><?=getlang("status");?></label> 
                                 
                                <div class="form-control-wrap radio_div">   

                                    <div class="custom-control custom-radio radion_btn" >    
                                        <input type="radio" id="customRadio1" name="optionstatus" <?php if($product_options_details[0]->optionstatus == 'A'){ echo 'checked';}?> value="A" class="custom-control-input">    
                                        <label class="custom-control-label" for="customRadio1"><?=getlang('active')?></label>
                                    </div> 
                                    
                                    <div class="custom-control custom-radio radion_btn" >    
                                        <input type="radio" id="customRadio2" name="optionstatus" <?php if($product_options_details[0]->optionstatus == 'H'){ echo 'checked';}?> value="H" class="custom-control-input">    
                                        <label class="custom-control-label" for="customRadio2"><?=getlang('hidden')?></label>
                                    </div> 

                                    <div class="custom-control custom-radio radion_btn" >    
                                        <input type="radio" id="customRadio3" name="optionstatus" <?php if($product_options_details[0]->optionstatus == 'D'){ echo 'checked';}?> value="D" class="custom-control-input">    
                                        <label class="custom-control-label" for="customRadio3"><?=getlang('disabled')?></label>
                                    </div> 
                                </div>
                                </div>

                                </div>
                            <div class="tab-pane" id="tabItem2">
                                                                            
                             
                                                                            
                            <div class="container py-4">
                            <div class="reg_time_wrap">
                                <?php foreach($product_options_variants_data as $key=>$prd_var){?>
                                    <input type="hidden" value="<?=$prd_var->id;?>" name="prod_option_variant[]">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" for="fw-username"><?=getlang('options_name')?></label>
                                            <div class="form-control-wrap">
                                                <input type="text"  class="form-control" id="fw-username" name="option_name[]" value="<?=$prd_var->name;?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="fw-password"><?=getlang('price')?></label>
                                            <div class="form-control-wrap">
                                                <input type="number" class="form-control" id="fw-password" name="options_price[]" value="<?=$prd_var->price;?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" for="fw-option_status"><?=getlang('option_status')?></label>
                                            <div class="form-control-wrap ">
                                                <div class="form-control-select">
                                                    <select class="form-control"  id="fw-option_status" name="option_status[]">
                                                        <option value="A" <?php if($prd_var->status == 'A'){ echo "selected";}?>><?=getlang('active')?></option>
                                                        <option value="H" <?php if($prd_var->status == 'H'){ echo "selected";}?>><?=getlang('hidden')?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label"><?=getlang("image");?></label>
                                            <div class="form-control-wrap">
                                                <div class="form-file">
                                                    <input type="file" accept=".png,.jpg,.jpeg,.webp" name="oimage[]" class="form-file-input" id="customMultipleFiles">
                                                    <label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($key != 0){?>
                                    <div class="col-md-1 delete_btn">
                                        <a href="javascript:void(0);" class="delete" id="0">X</a>
                                    </div>
                                    <?php } ?>
                                    <?php if(!empty($prd_var->image)){?>
                                    <div>
                                        <img src="<?php echo image_url('uploads/product_options/'.$prd_var->image);?>" width="200" height="200" alt="<?=getlang('image')?>">
                                    </div>
                                    <?php } ?>
                                </div><!-- .row -->
                                <?php } ?>
                                
                            </div>
                            <div class="reg_add_icon icon_add">
                                    <a href="javascript:void(0);"><?=getlang('add')?></a>
                                </div>
                            </div>

                            </div>
                            

                            </br>   </br>
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



<?php echo minifier('adminvalidate.min.js'); ?>

<script>

$('body').on("click",".icon_add",function(){
    
            
            
			$('.reg_time_wrap').append(`<input type="hidden" value="0" name="prod_option_variant[]"><div class="row">
   <div class="col-md-3">
      <div class="form-group">
         <label class="form-label" for="fw-username"><?=getlang('options_name')?></label>
         <div class="form-control-wrap"><input type="text" class="form-control" id="fw-username" name="option_name[]"></div>
      </div>
   </div>
   <div class="col-md-2">
      <div class="form-group">
         <label class="form-label" for="fw-password"><?=getlang('price')?></label>
         <div class="form-control-wrap"><input type="number" class="form-control" id="fw-password" name="options_price[]"></div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="form-group">
         <label class="form-label" for="fw-option_status"><?=getlang('option_status')?></label>
         <div class="form-control-wrap ">
            <div class="form-control-select">
               <select class="form-control" id="fw-option_status" name="option_status[]">
                  <option value="A"><?=getlang('active')?></option>
                  <option value="H"><?=getlang('hidden')?></option>
               </select>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="form-group">
         <label class="form-label"><?=getlang("image");?></label>
         <div class="form-control-wrap">
            <div class="form-file"><input type="file" accept=".png,.jpg,.jpeg,.webp" name="oimage[]"  class="form-file-input" id="customMultipleFiles"><label class="form-file-label" for="customMultipleFiles"><?=getlang("choose_file");?></label></div>
         </div>
      </div>
  	</div>
  	<div class="col-md-1 delete_btn">
     	<a href="javascript:void(0);" class="delete" id="0">X</a>
  	</div>
</div>
`);
		});

        $('body').on('click',".delete", function(e){
			e.preventDefault();
			$(this).parents('.row').remove();			
		});	
    // });        
</script>

<?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>