
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
                                                <a href="<?php echo base_url(ADMIN_URL); ?>/product/gegroepeerde_producten" class="btn btn-primary"><span><?=getlang('back_to_group_products');?></span></a>
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
                        <?php echo form_open_multipart(ADMIN_URL."/product/group_product_edit/".$product_data->id,array('id'=>'groupproducteditform'))?>
                            <ul class="nav nav-tabs mt-n3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1"><?=getlang('general')?></a>
                                </li>
                                
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem1">
                                    
                                    <div class="form-group">    
                                        <label class="form-label" for="default-01"><?=getlang('product_name');?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="pname" class="form-control" id="default-01" placeholder="<?=getlang("product_name");?>"  value="<?php echo $product_data->pname;?>">    
                                        </div>
                                    </div>
                                    <div class="form-group">    
                                        <label class="form-label"><?=getlang("product_and_sku");?></label>    
                                        <div class="form-control-wrap">   
                                            <?php //$selected_accessories_product = explode(',',$blog_data[0]->accesorries_products_list);
                                            $products_sku = !empty($product_data->product_sku) ? $product_data->product_sku : '';
                                            if(!empty($products_sku)){
                                                $products_sku = explode(',',$products_sku);
                                                // $tagIds = array_map(function($item) {
                                                //     return $item;
                                                // }, $products_sku);
                                            }
                                            //print_r($blog_tag_ids);?>     
                                            <select class="form-select js-select2" multiple name="product_sku[]">
                                                <?php if(!empty($all_products)) { foreach($all_products as $all_p){ 
                                                    //if($all_p->id !=$product_data[0]->id){?>
                                                    <option value="<?=$all_p->id?>" 
                                                        <?php if(in_array($all_p->id,$products_sku)){ echo "selected";}?>>
                                                        <?php echo $all_p->pname .' - '. $all_p->product_sku;?>
                                                    </option>
                                                <?php }  } 
                                            //} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">    
                                        <label class="form-label" for="default-02"><?=getlang("product_sku");?></label>    
                                        <div class="form-control-wrap">        
                                            <input type="text" name="product_sku"  class="form-control" id="default-02" placeholder="<?=getlang("product_sku");?>" value="<?php echo $product_data->product_sku;?>">    
                                        </div>
                                    </div> -->
                                 


                                </div>
                            </div>
                            <div class="form-group gp_sub_cls">
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
<link rel="stylesheet" href="<?php echo base_url('assets/admin_new');?>/plugins/lightbox/css/baguetteBox.min.css">

<!-- Include rateYo library -->
<script src="<?php echo base_url('assets/admin_new');?>/plugins/lightbox/js/baguetteBox.min.js"></script>


 
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

<?php
    echo minifier('summernote.min.css'); 
    echo minifier('summernote.min.js'); 
?>