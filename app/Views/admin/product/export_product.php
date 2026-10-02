<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="components-preview wide-xl mx-auto">
                <div class="nk-block nk-block-lg"> 
                    <div class="nk-block-head">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"><?=getlang("product");?> <?=getlang("export");?></h3>
                                <div class="nk-block-des text-soft">
                                    <!-- <p>You have total 95 projects.</p> -->
                                </div>
                            </div><!-- .nk-block-head-content -->

                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <!-- <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-primary" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <!-- <li><a href="<?php //echo base_url(ADMIN_URL.'/product/group_product_add');?>"><span><?=getlang('add')?> <?=getlang('products')?></span></a></li> 
                                                </ul>
                                            </div>
                                        </div> -->
                                    </li>
                                </ul>
                            </div><!-- .nk-block-head-content -->



                            
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    </div>


                    
                    <div class="card card-preview prd_tb">
                        <div class="card-inner">
                        <div class="" role="status" id="datatable-loader-products">
                            <!-- <span class="visually-hidden">Loading...</span> -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="white-box">
                                        <div class="row">
                                            <form action="<?=base_url(); ?>beheerpaneel/product/productexport" class="" id="export_product" method="post" >
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="input-group csv_fil">
                                                        <input type="date" class="form-control" name="start_date" id="datepicker-autoclose1" placeholder="<?php echo Date('d-m-Y', strtotime('-1 day')); ?>" value= "<?= old('pname', $previousInput['start_date'] ?? ''); ?>" autocomplete="off">
                                                        <input type="date" class="form-control" name="end_date" id="datepicker-autoclose2" placeholder="<?php echo Date('d-m-Y'); ?>" value= "<?= old('pname', $previousInput['end_date'] ?? ''); ?>" autocomplete="off">
                                                        <div class="col-md-4">
                                                            <input type="hidden" name="<?php echo csrf_token();?>" value="<?php echo csrf_hash();?>">
                                                            <input type="submit" name="submit" value="Exporteren" class="btn btn-primary" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            </form>
                                        </div>
                                    
                                    </div>	
                                </div>
                            </div>
                        </div>
                            
                        </div>
                    </div><!-- .card-preview -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo minifier('adminvalidate.min.js'); ?>

<script>
$("#export_product").validate({ 
	rules: { 
        start_date: {
            required: true,            
         },
         end_date: {
         	required: true,
         },
        
      },

});

</script>


