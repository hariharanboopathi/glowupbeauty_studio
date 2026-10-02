<!-- content @s -->
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="content-page wide-md m-auto">
                <div class="nk-block-head nk-block-head-lg">
                <div class="nk-block-head">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang('add');?> <?=getlang('product_features');?></h3>
                                <div class="nk-block-des text-soft">
                                   
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt d-none d-sm-block">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/product/manage_product_features" class="btn btn-primary"><span><?=getlang('back_to_products');?></span></a>
                                            </li>
                                            <li class="nk-block-tools-opt d-block d-sm-none">
                                                <a href="<?php echo base_url(); ?>/beheerpaneel/product/manage_product_features" class="btn btn-icon btn-primary"><?=getlang('back_to_products');?></a>
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

                        <?php echo form_open_multipart("beheerpaneel/product/add_product_features",array('id'=>'productform'))?>

                            <ul class="nav nav-tabs mt-n3">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">General</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Variants</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3">Categories</a>
                                                </li>
                                                
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tabItem1">
                                                            
                                                <div class="form-group">    
                                                    <label class="form-label" for="default-01"><?=getlang('name');?></label>    
                                                    <div class="form-control-wrap">        
                                                        <!-- <input type="text" name="feature_name" class="form-control" id="default-01"  onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122))" placeholder="<?=getlang("feature_name");?>" value="<?php //echo old('feature_name', $previousInput['feature_name'] ?? ''); ?>">     -->
                                                        <input type="text" name="feature_name" class="form-control" id="default-01" placeholder="<?=getlang("feature_name");?>" value="<?= old('feature_name', $previousInput['feature_name'] ?? ''); ?>" >    
                                                    </div>
                                                </div>

                                            
                                                <div class="form-group">    
                                                    <label class="form-label" for="default-01"><?=getlang('feature_style');?></label>    
                                                    <div class="form-control-wrap">        
                                                        <select name="feature_style" id="feature_style" class="form-control">
                                                        <!--  <option value="text">Text or number</option> -->
                                                            <option value="text">Text or number</option>
                                                            <option value="checkbox">Checkbox</option>
                                                            <option value="multiple_checkbox">Multiple checkboxes</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">    
                                                    <label class="form-label" for="default-01"><?=getlang('feature_type');?></label>    
                                                    <div class="form-control-wrap">   
                                                    <select name="feature_type" id="feature_type"  class="form-control">
                                                        <option value="checkbox">Checkbox</option>
                                                        <option value="date">Date selector</option>
                                                    </select>

                                                    <div id="feature_type_msg"></div>

                                                    
                                                    </div>
                                                </div>

                                                <div class="form-group">    
                                                    <label class="form-label" for="default-02"><?=getlang("position");?></label>    
                                                    <div class="form-control-wrap">        
                                                        <input type="text" name="position"  class="form-control" id="default-02"  value="<?= old('position', $previousInput['position'] ?? ''); ?>">    
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-sm-6">
                                                    <div class="preview-block">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" value="Y" name="display_on_product" class="custom-control-input" id="customSwitch2">
                                                            <label class="custom-control-label" for="customSwitch2"><?=getlang("show_on_the_features_tab");?></label>
                                                        </div>
                                                    </div>
                                                </div></br>


                                                <div class="col-md-3 col-sm-6">
                                                    <div class="preview-block">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" value="Y" name="display_on_filter" class="custom-control-input" id="customSwitch3">
                                                            <label class="custom-control-label" for="customSwitch3"><?=getlang("show_on_the_filters");?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                </br>
                                                <div class="form-group">    
                                                    <label class="form-label" for="default-02"><?=getlang("status");?></label>    
                                                    <div class="form-control-wrap">   
                                                   
                                                 <label class="radio " for="elm_feature_status_15_0_a">
                                                    <input type="radio" name="status" id="status" checked="checked" value="A">Active</label>


                                                <label class="radio " for="elm_feature_status_15_0_h">
                                                    <input type="radio" name="status" id="status" value="H">Hidden</label>

                                                <label class="radio " for="elm_feature_status_15_0_d">
                                                    <input type="radio" name="status" id="status" value="D">Disabled</label>

                                                    </div>
                                                </div>

                                                </div>
                                                <div class="tab-pane" id="tabItem2">
                                                 
 


                                                
<div class="container py-4">
 <div class="row">
      <div class="col-md-12 form_sec_outer_task  ">
        <div class="row">
          
          <div class="col-md-2">
            <label>Pos</label>
          </div>
          <div class="col-md-4">
            <label> Variant </label>
          </div>
        </div>
        <div class="col-md-12 p-0">
          <div class="col-md-12 form_field_outer p-0">
            <div class="row form_field_outer_row">
              <div class="form-group col-md-2">
                <input type="text" class="form-control w_90" name="pos[]" id="pos" placeholder="" />
              </div>
              <div class="form-group col-md-6">
              <input type="text" class="form-control w_91" name="variant[]" id="pos" placeholder="" />
              </div>
              <div class="form-group col-md-2 add_del_btn_outer">
                <button class="btn_round remove_node_btn_frm_field" disabled>Delete </button>
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
                <input type="text" class="form-control w_90" name="pos[]" id="pos${index}" placeholder="" />
              </div>
              <div class="form-group col-md-6">
              <input type="text" class="form-control w_90" name="variant[]" id="variant${index}" placeholder="" />
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
                                                <div class="tab-pane" id="tabItem3">

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

                                                <?php if(!empty($category_detail)){         
                                                        
                                                        foreach($category_detail as $c){?>              
                                                            
                                                    <tr class="nk-tb-item">
                                                        <td class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control-sm notext">
                                                            <input type="checkbox" value="<?php echo $c->id;?>" name="category_id[]"  id="category_id<?php echo $c->id;?>" />
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
$("#productform").validate({ 
	rules: { 
        feature_name: {
            required: true,            
         },
      },

});

</script>

<script>

$(document).ready(function () {


         $("#feature_type").change(function () {

            if($( '#feature_style' ).val() == 'text' && $( this ).val() == 'date'){
                $('#feature_type_msg'). html('Clicking on save will remove product features values');

            } else if($( '#feature_style' ).val() == 'checkbox' && $( this ).val() == 'checkbox'){
                $('#feature_type_msg'). html('Clicking on save will remove product features values');

            } else {
                $('#feature_type_msg'). html('');

            }

        });


        $("#feature_style").change(function () {

            $('#feature_type_msg'). html('');
            $('#feature_type').empty();
            if($( this ).val() == 'text'){
              $('#feature_type'). append(new Option('Checkbox', 'checkbox'));
              $('#feature_type'). append(new Option('Date selector', 'date'));

            } else if($( this ).val() == 'checkbox'){
                $('#feature_type'). append(new Option('Checkbox', 'checkbox'));

            } else {
                $('#feature_type'). append(new Option('Checkbox', 'checkbox'));

            }

            $("#feature_type").trigger("change");

        }).change();


        
      

        



});

</script>

<script>
    $(document).ready(function() {
        $('#customSwitch3').change(function() {
            if ($(this).is(':checked')) {
                $('#feature_style').val('multiple_checkbox');
            }
        });

        // Optionally, if you want to unselect the "multiple_checkbox" option when unchecked:
        $('#customSwitch3').change(function() {
            if (!$(this).is(':checked') && $('#feature_style').val() == 'multiple_checkbox') {
                $('#feature_style').val('text'); // or any other default value
            }
        });
    });
</script>